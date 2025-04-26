<?php

namespace App\Http\Controllers;

use App\Models\BbbMeeting;
use Illuminate\Http\Request;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\IsMeetingRunningParameters;
use BigBlueButton\Util\UrlBuilder;
use Ramsey\Uuid\Guid\Guid;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BBBController extends Controller
{
    protected $bbb;
    protected $urlBuilder;

    public function __construct()
    {
        // Initialize BigBlueButton (relies on environment variables for configuration)
        $this->bbb = new BigBlueButton();

        // Initialize UrlBuilder with configuration
        $this->urlBuilder = new UrlBuilder(
            config('services.bbb.secret'),
            rtrim(config('services.bbb.base_url'), '/'),
            '/api'
        );
    }

    public function create_meeting_form()
    {
        return view('big_blue_button.create_meeting_form');
    }

    public function listMeetings()
    {
        try {
            // Get live meetings from BigBlueButton
            $bbbResponse = $this->bbb->getMeetings();
            $bbbMeetings = [];

            if ($bbbResponse->getReturnCode() === 'SUCCESS') {
                $bbbMeetings = $bbbResponse->getMeetings();
            } else {
                Log::warning('Failed to fetch BBB meetings', ['message' => $bbbResponse->getMessage()]);
            }

            // Sync database with BBB response, but allow recently created meetings to show as active
            $activeMeetingIds = array_map(function ($meeting) {
                return $meeting->getMeetingID();
            }, $bbbMeetings);

            // Only update status to ended if the meeting is older than 5 minutes
            BbbMeeting::where('status', 'active')
                ->whereNotIn('meeting_id', $activeMeetingIds)
                ->where('updated_at', '<', now()->subMinutes(5))
                ->update(['status' => 'ended']);

            // Get scheduled meetings from DB
            $scheduledMeetings = BbbMeeting::where('status', 'scheduled')
                ->where('scheduled_at', '>', now())
                ->orderBy('scheduled_at')
                ->get();

            return view('big_blue_button.meeting_list', compact('bbbMeetings', 'scheduledMeetings'));
        } catch (\Exception $e) {
            Log::error('Error fetching meetings', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error fetching meetings: ' . $e->getMessage());
        }
    }

    public function createMeeting(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'meeting_id' => 'required|string|unique:bbb_meetings,meeting_id',
            'meeting_name' => 'required|string|max:255',
            'meeting_admin_pw' => 'required|string|min:6',
            'meeting_attenduser_pw' => 'required|string|min:6',
            'meeting_type' => 'required|in:instant,scheduled',
            'scheduled_datetime' => 'required_if:meeting_type,scheduled|nullable|date|after:now',
        ]);

        try {
            // Generate a unique identifier for the meeting
            $uuid = (string) Guid::uuid4();

            if ($request->meeting_type === 'instant') {
                // Create meeting parameters with supported settings
                $createMeetingParams = new CreateMeetingParameters($request->meeting_id, $request->meeting_name);
                $createMeetingParams->setAttendeePassword($request->meeting_attenduser_pw)
                                   ->setModeratorPassword($request->meeting_admin_pw);

                // Create the meeting
                $response = $this->bbb->createMeeting($createMeetingParams);

                // Log the response for debugging
                Log::info('BBB createMeeting response', ['response' => json_encode($response)]);

                if ($response->getReturnCode() === 'SUCCESS') {
                    // Store instant meeting details in the database
                    $meeting = BbbMeeting::create([
                        'id' => $uuid,
                        'meeting_id' => $request->meeting_id,
                        'meeting_name' => $request->meeting_name,
                        'moderator_pw' => $request->meeting_admin_pw,
                        'attendee_pw' => $request->meeting_attenduser_pw,
                        'scheduled_at' => now(),
                        'status' => 'active',
                    ]);

                    // Verify the meeting is running
                    $isRunningParams = new IsMeetingRunningParameters($request->meeting_id);
                    $isRunningResponse = $this->bbb->isMeetingRunning($isRunningParams);

                    if ($isRunningResponse->isRunning() || now()->diffInSeconds($meeting->created_at) < 300) {
                        // Generate join URL for the moderator
                        $joinMeetingParams = new JoinMeetingParameters(
                            $request->meeting_id,
                            Auth::user()->name,
                            $request->meeting_admin_pw
                        );
                        $joinMeetingParams->setRedirect(true);
                        $joinUrl = $this->bbb->getJoinMeetingURL($joinMeetingParams);

                        // Redirect to a new view with the join URL
                        return redirect()->route('bbb.showMeetingLink', ['joinUrl' => urlencode($joinUrl), 'meeting_id' => $request->meeting_id]);
                    } else {
                        Log::error('Meeting created but not running', ['meeting_id' => $request->meeting_id, 'response' => json_encode($response)]);
                        return redirect()->back()->with('error', 'Meeting created but failed to start. Check server settings or logs.');
                    }
                }

                // Handle API failure with specific error message
                $errorMessage = $response->getMessage() ?: 'Unknown error';
                Log::error('BBB meeting creation failed', ['response' => json_encode($response)]);
                return redirect()->back()->with('error', 'Failed to create instant meeting: ' . $errorMessage);
            } else {
                // Store scheduled meeting details in the database
                BbbMeeting::create([
                    'id' => $uuid,
                    'meeting_id' => $request->meeting_id,
                    'meeting_name' => $request->meeting_name,
                    'moderator_pw' => $request->meeting_admin_pw,
                    'attendee_pw' => $request->meeting_attenduser_pw,
                    'scheduled_at' => $request->scheduled_datetime,
                    'status' => 'scheduled',
                ]);

                return redirect()->route('bbb.list')->with('success', 'Meeting scheduled successfully.');
            }
        } catch (\Exception $e) {
            Log::error('Meeting creation error', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function showMeetingLink(Request $request)
    {
        $joinUrl = urldecode($request->query('joinUrl'));
        $meetingId = $request->query('meeting_id');
        return view('big_blue_button.meeting_link', compact('joinUrl', 'meetingId'));
    }

    public function joinMeeting($meetingID, $userName)
    {
        try {
            // Fetch meeting details from the database
            $meeting = BbbMeeting::where('meeting_id', $meetingID)->where('status', 'active')->firstOrFail();

            // Verify if the meeting is running
            $isRunningParams = new IsMeetingRunningParameters($meetingID);
            $isRunningResponse = $this->bbb->isMeetingRunning($isRunningParams);

            if (!$isRunningResponse->isRunning()) {
                $meeting->update(['status' => 'ended']);
                return redirect()->back()->with('error', 'Cannot join: Meeting has ended.');
            }

            // Determine password based on moderator status
            $isModerator = request()->has('isModerator') && request()->isModerator;
            $password = $isModerator ? $meeting->moderator_pw : $meeting->attendee_pw;

            // Create join parameters
            $params = new JoinMeetingParameters($meetingID, $userName, $password);
            $params->setRedirect(true);

            // Generate join URL using BigBlueButton instance
            $joinUrl = $this->bbb->getJoinMeetingURL($params);

            // Log the join URL for debugging
            Log::info('BBB join URL', ['url' => $joinUrl]);

            return redirect($joinUrl);
        } catch (\Exception $e) {
            Log::error('Join meeting error', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to join meeting: ' . $e->getMessage());
        }
    }

    public function endMeeting(Request $request)
    {
        try {
            $request->validate([
                'meetingID' => 'required|string'
            ]);

            $meeting = BbbMeeting::where('meeting_id', $request->meetingID)->firstOrFail();
            $params = new EndMeetingParameters($request->meetingID, $meeting->moderator_pw);
            $response = $this->bbb->endMeeting($params);

            if ($response->getReturnCode() === 'SUCCESS') {
                $meeting->update(['status' => 'ended']);
                return response()->json(['status' => 'Meeting ended']);
            }

            return response()->json(['status' => 'Failed to end meeting', 'message' => $response->getMessage()], 500);
        } catch (\Exception $e) {
            Log::error('End meeting error', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'Error', 'message' => $e->getMessage()], 500);
        }
    }

    public function isMeetingRunning(Request $request)
    {
        try {
            $request->validate([
                'meetingID' => 'required|string'
            ]);

            $params = new IsMeetingRunningParameters($request->meetingID);
            $response = $this->bbb->isMeetingRunning($params);

            return response()->json(['running' => $response->isRunning()]);
        } catch (\Exception $e) {
            return response()->json(['running' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
