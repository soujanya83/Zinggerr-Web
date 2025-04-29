<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\BbbMeeting;
use App\Services\BigBlueButtonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BigBlueButtonController extends Controller
{
    protected $bbbService;

    public function __construct(BigBlueButtonService $bbbService)
    {
        $this->bbbService = $bbbService;
    }

    public function createMeeting(Request $request)
    {
        // Validate request data
        $request->validate([
            'meeting_name' => 'required|string',
            'meeting_id' => 'required|string|unique:meetings,meeting_id',
            'meeting_type' => 'required|in:instant,scheduled',
            'scheduled_at' => 'required_if:meeting_type,scheduled|date_format:d/m/Y H:i',
            'meeting_admin_pw' => 'required|string',
            'meeting_attenduser_pw' => 'required|string',
        ]);

        Carbon::setLocale('en');
        $timezone = config('app.timezone', 'UTC');

        // Determine scheduled time based on meeting type
        if ($request->meeting_type === 'instant') {
            $scheduledAt = now();
        } else {
            $scheduledAtInput = trim($request->scheduled_at);
            try {
                $scheduledAt = Carbon::createFromFormat('d/m/Y H:i', $scheduledAtInput);
                if ($scheduledAt === false) {
                    throw new \Exception('Invalid date format');
                }
                $scheduledAt->setTimezone($timezone);
                $formattedDate = $scheduledAt->format('d/m/Y H:i');
                if ($formattedDate !== $scheduledAtInput) {
                    throw new \Exception('Date format mismatch');
                }
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['scheduled_at' => 'Scheduled At must match the format d/m/Y H:i (e.g., 28/04/2025 08:46)']);
            }
        }

        // Set status based on whether the meeting is in the future
        $status = $scheduledAt->isFuture() ? 'scheduled' : 'running';

        // Save meeting details to the database for both instant and scheduled meetings
        $meeting = BbbMeeting::create([
            'id' => Str::uuid()->toString(),
            'meeting_id' => $request->meeting_id,
            'meeting_name' => $request->meeting_name,
            'moderator_pw' => $request->meeting_admin_pw,
            'attendee_pw' => $request->meeting_attenduser_pw,
            'scheduled_at' => $scheduledAt,
            'status' => $status,
            'host_started' => $request->meeting_type === 'instant' && $status === 'running',
        ]);

        // Handle instant meetings: create meeting link and return join URLs
        // if ($request->meeting_type === 'instant' && $status === 'running') {
        //     $result = $this->bbbService->createMeeting(
        //         $request->meeting_name,
        //         $request->meeting_id,
        //         [
        //             'moderatorPW' => $request->meeting_admin_pw,
        //             'attendeePW' => $request->meeting_attenduser_pw,
        //         ]
        //     );

        //     if ($result['returncode'] !== 'SUCCESS') {
        //         $meeting->delete(); // Rollback if BBB creation fails
        //         return redirect()->back()->withErrors(['message' => $result['message']]);
        //     }

        //     $meeting->update(['host_started' => true]);

        //     // Generate join URLs for moderator and attendees
        //     $moderatorJoinUrl = $this->bbbService->joinMeeting(
        //         Auth::user()->name ?? 'Admin',
        //         $request->meeting_id,
        //         $request->meeting_admin_pw,
        //         true
        //     );

        //     $attendeeJoinUrl = $this->bbbService->joinMeeting(
        //         'Guest',
        //         $request->meeting_id,
        //         $request->meeting_attenduser_pw,
        //         false
        //     );

        //     return view('bbb.room-link', [
        //         'joinUrl' => $moderatorJoinUrl,
        //         'attendeeJoinUrl' => $attendeeJoinUrl,
        //         'meetingId' => $request->meeting_id,
        //         'meeting' => $meeting,
        //     ])->with('success', 'Instant meeting created successfully.');
        // }

        if ($request->meeting_type === 'instant' && $status === 'running') {
            $result = $this->bbbService->createMeeting(
                $request->meeting_name,
                $request->meeting_id,
                [
                    'moderatorPW' => $request->meeting_admin_pw,
                    'attendeePW' => $request->meeting_attenduser_pw,
                ]
            );

            if ($result['returncode'] !== 'SUCCESS') {
                $meeting->delete(); // Rollback if BBB creation fails
                return redirect()->back()->withErrors(['message' => $result['message']]);
            }

            // Generate join URLs
            $moderatorJoinUrl = $this->bbbService->joinMeeting(
                Auth::user()->name ?? 'Admin',
                $request->meeting_id,
                $request->meeting_admin_pw,
                true
            );

            $attendeeJoinUrl = $this->bbbService->joinMeeting(
                'Guest',
                $request->meeting_id,
                $request->meeting_attenduser_pw,
                false
            );

            // Save join URLs and update meeting
            $meeting->update([
                'moderator_join_url' => $moderatorJoinUrl,
                'attendee_join_url' => $attendeeJoinUrl,
                'host_started' => true,
                'status' => 'running',
            ]);

            return view('bbb.room-link', [
                'joinUrl' => $moderatorJoinUrl,
                'attendeeJoinUrl' => $attendeeJoinUrl,
                'meetingId' => $request->meeting_id,
                'meeting' => $meeting,
            ])->with('success', 'Instant meeting created successfully.');
        }

        // Handle scheduled meetings: redirect without creating a meeting link
        return redirect()->route('meetings.list')->with('success', 'Scheduled meeting created successfully.');
    }

    public function startMeeting($id)
    {
        $meeting = BbbMeeting::findOrFail($id);

        if ($meeting->status !== 'scheduled') {
            return redirect()->route('meetings.list')->withErrors(['message' => 'Meeting is not in scheduled status.']);
        }

        $result = $this->bbbService->createMeeting(
            $meeting->meeting_name,
            $meeting->meeting_id,
            [
                'moderatorPW' => $meeting->moderator_pw,
                'attendeePW' => $meeting->attendee_pw,
            ]
        );

        if ($result['returncode'] !== 'SUCCESS') {
            return redirect()->route('meetings.list')->withErrors(['message' => $result['message']]);
        }

        // Generate join URLs
        $moderatorJoinUrl = $this->bbbService->joinMeeting(
            Auth::user()->name ?? 'Admin',
            $meeting->meeting_id,
            $meeting->moderator_pw,
            true
        );

        $attendeeJoinUrl = $this->bbbService->joinMeeting(
            'Guest',
            $meeting->meeting_id,
            $meeting->attendee_pw,
            false
        );

        // Save join URLs and update meeting
        $meeting->update([
            'moderator_join_url' => $moderatorJoinUrl,
            'attendee_join_url' => $attendeeJoinUrl,
            'status' => 'running',
            'host_started' => true,
        ]);

        return view('bbb.room-link', [
            'joinUrl' => $moderatorJoinUrl,
            'attendeeJoinUrl' => $attendeeJoinUrl,
            'meetingId' => $meeting->meeting_id,
            'meeting' => $meeting,
        ])->with('success', 'Scheduled meeting started successfully.');
    }



    // public function joinMeeting(Request $request)
    // {
    //     $meeting = BbbMeeting::where('meeting_id', $request->meeting_id)->firstOrFail();
    //     $isModerator = $request->is_moderator == true;

    //     if (!$isModerator && !$meeting->host_started) {
    //         return redirect()->route('meetings.list')->with('error', 'Meeting has not yet been started by the host.');
    //     }

    //     $fullName = $request->full_name ?? ($isModerator ? 'Admin' : 'Guest');
    //     $password = $isModerator ? $meeting->moderator_pw : $meeting->attendee_pw;

    //     $joinUrl = $this->bbbService->joinMeeting(
    //         $fullName,
    //         $meeting->meeting_id,
    //         $password,
    //         $isModerator
    //     );

    //     return redirect($joinUrl);
    // }

    public function joinMeeting(Request $request)
    {
        $meeting = BbbMeeting::where('meeting_id', $request->meeting_id)->firstOrFail();
        $isModerator = $request->is_moderator == true;

        // Prevent joining if the meeting is not running or not started
        if ($meeting->status !== 'running' || !$meeting->host_started) {
            return redirect()->route('meetings.list')->with('error', 'Meeting is not currently running or has not been started by the host.');
        }

        $fullName = $request->full_name ?? ($isModerator ? 'Admin' : 'Guest');
        $password = $isModerator ? $meeting->moderator_pw : $meeting->attendee_pw;

        // Handle moderator joining
        if ($isModerator) {
            $moderatorJoinUrl = $this->bbbService->joinMeeting(
                $fullName,
                $meeting->meeting_id,
                $meeting->moderator_pw,
                true
            );

            $attendeeJoinUrl = $this->bbbService->joinMeeting(
                'Guest',
                $meeting->meeting_id,
                $meeting->attendee_pw,
                false
            );

            // Save join URLs for moderator and attendees
            $meeting->update([
                'moderator_join_url' => $moderatorJoinUrl,
                'attendee_join_url' => $attendeeJoinUrl,
                'host_started' => true,
                'status' => 'running',
            ]);

            return redirect($moderatorJoinUrl);
        }

        // Handle non-moderator (student) joining
        if ($meeting->attendee_join_url) {
            return redirect($meeting->attendee_join_url);
        }

        // Fallback: Generate a new join URL if attendee_join_url is missing
        $joinUrl = $this->bbbService->joinMeeting(
            $fullName,
            $meeting->meeting_id,
            $meeting->attendee_pw,
            false
        );

        // Save the attendee_join_url for future use
        $meeting->update(['attendee_join_url' => $joinUrl]);

        return redirect($joinUrl);
    }

    public function listMeetings()
    {
        try {
            $bbbResponse = $this->bbbService->getMeetings();
            $bbbMeetings = [];

            if (isset($bbbResponse['returncode']) && $bbbResponse['returncode'] === 'SUCCESS') {
                $bbbMeetings = $bbbResponse['meetings'] ?? [];
            } else {
                Log::warning('Failed to fetch BBB meetings: ' . json_encode($bbbResponse));
            }

            $activeMeetingIds = array_map(function ($meeting) {
                return $meeting['meetingID'] ?? null;
            }, $bbbMeetings);
            $activeMeetingIds = array_filter($activeMeetingIds);

            BbbMeeting::where('status', 'running')
                ->whereNotIn('meeting_id', $activeMeetingIds)
                ->where('updated_at', '<', now()->subMinutes(5))
                ->update(['status' => 'ended']);

            BbbMeeting::whereIn('meeting_id', $activeMeetingIds)
                ->where('status', '!=', 'ended')
                ->update(['status' => 'running', 'host_started' => true]);

            BbbMeeting::where('status', 'scheduled')
                ->where('scheduled_at', '<=', now())
                ->where('host_started', false)
                ->update(['status' => 'scheduled']);

            $liveMeetings = BbbMeeting::where('status', 'running')
                ->orderBy('scheduled_at')
                ->get();

            $scheduledMeetings = BbbMeeting::where('status', 'scheduled')
                ->where('scheduled_at', '>', now())
                ->where('host_started', false)
                ->orderBy('scheduled_at')
                ->get();

            $endedMeetings = BbbMeeting::where('status', 'ended')
                ->orderBy('updated_at', 'desc')
                ->get();

            return view('meetings.meeting_list', compact('liveMeetings', 'scheduledMeetings', 'endedMeetings'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error fetching meetings: ' . $e->getMessage());
        }
    }





    public function endMeeting(Request $request)
    {
        $request->validate([
            'meetingID' => 'required|string',
        ]);

        $result = $this->bbbService->endMeeting($request->meetingID);

        if ($result['returncode'] === 'SUCCESS') {
            // Update the meeting status in the database
            BbbMeeting::where('meeting_id', $request->meetingID)
                ->update(['status' => 'ended', 'updated_at' => now()]);

            return redirect()->route('meetings.list')->with('success', 'Meeting ended successfully.');
        }

        return redirect()->back()->with('error', 'Failed to end meeting: ' . ($result['message'] ?? 'Unknown error'));
    }


    public function index()
    {
        return view('meetings.create');
    }




    private function generateMeetingId($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $meetingId = '';
        for ($i = 0; $i < $length; $i++) {
            $meetingId .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $meetingId;
    }



    public function getRecordings(Request $request)
    {
        $request->validate([
            'meeting_id' => 'required|string',
        ]);

        $result = $this->bbbService->getRecordings($request->meeting_id);

        if ($result['returncode'] === 'SUCCESS') {
            return response()->json(['recordings' => $result['recordings']]);
        }

        return response()->json(['message' => $result['message']], 500);
    }


    public function showRecordings(Request $request)
    {
        $request->validate(['meeting_id' => 'required|string']);
        $result = $this->bbbService->getRecordings($request->meeting_id);
        return view('meetings.recordings', ['recordings' => $result['recordings']]);
    }

    public function showRoomLink($meetingId)
    {
        $moderatorJoinUrl = $this->bbbService->joinMeeting(
            Auth::user()->name ?? 'Admin',
            $meetingId,
            request()->get('meeting_admin_pw', 'mp'),
            true
        );

        $attendeeJoinUrl = $this->bbbService->joinMeeting(
            'Guest',
            $meetingId,
            request()->get('meeting_attenduser_pw', 'ap'),
            false
        );

        return view('bbb.room-link', [
            'joinUrl' => $moderatorJoinUrl,
            'attendeeJoinUrl' => $attendeeJoinUrl,
            'meetingId' => $meetingId,
        ]);
    }
}
