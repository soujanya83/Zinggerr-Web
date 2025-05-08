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
        $this->middleware('auth')->except('joinMeeting');
        $this->bbbService = $bbbService;
    }

    public function createMeeting(Request $request)
    {
        // Validate request data
        $request->validate([
            'meeting_name' => 'required|string',
            'meeting_id' => 'required|string|unique:bbb_meetings,meeting_id',
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

        // Use the logged-in user's name in the meeting name
        $userName = Auth::user()->name ?? 'Host';
        $meetingName = $request->meeting_name . " - {$userName}'s Room";

        // Save meeting details to the database
        $meeting = BbbMeeting::create([
            'id' => Str::uuid()->toString(),
            'user_id' => Auth::id(),
            'meeting_id' => $request->meeting_id,
            'meeting_name' => $meetingName,
            'moderator_pw' => $request->meeting_admin_pw,
            'attendee_pw' => $request->meeting_attenduser_pw,
            'scheduled_at' => $scheduledAt,
            'status' => $status,
            'host_started' => $request->meeting_type === 'instant' && $status === 'running',
        ]);

        if ($request->meeting_type === 'instant' && $status === 'running') {
            $result = $this->bbbService->createMeeting(
                $meetingName,
                $request->meeting_id,
                [
                    'moderatorPW' => $request->meeting_admin_pw,
                    'attendeePW' => $request->meeting_attenduser_pw,
                ]
            );

            // Log the createMeeting response
            Log::info('BBB createMeeting response', [
                'meeting_id' => $request->meeting_id,
                'result' => $result,
            ]);

            if ($result['returncode'] !== 'SUCCESS') {
                $meeting->delete();
                return redirect()->route('meetings.list')->withErrors(['message' => $result['message'] ?? 'Failed to create meeting on BBB server']);
            }

            // Generate join URLs using the logged-in user's name
            $moderatorJoinUrl = $this->bbbService->joinMeeting(
                $userName,
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

            // Log the generated URLs
            Log::info('Generated join URLs in createMeeting', [
                'meeting_id' => $request->meeting_id,
                'moderator_join_url' => $moderatorJoinUrl,
                'attendee_join_url' => $attendeeJoinUrl,
            ]);

            // Validate URLs
            if (filter_var($moderatorJoinUrl, FILTER_VALIDATE_URL) === false) {
                Log::error('Invalid moderator join URL', [
                    'meeting_id' => $request->meeting_id,
                    'url' => $moderatorJoinUrl,
                ]);
                $meeting->delete();
                return redirect()->route('meetings.list')->withErrors(['message' => 'Failed to generate moderator join link']);
            }

            if (filter_var($attendeeJoinUrl, FILTER_VALIDATE_URL) === false) {
                Log::error('Invalid attendee join URL', [
                    'meeting_id' => $request->meeting_id,
                    'url' => $attendeeJoinUrl,
                ]);
                $meeting->delete();
                return redirect()->route('meetings.list')->withErrors(['message' => 'Failed to generate attendee join link']);
            }

            // Save join URLs and update meeting
            $meeting->update([
                'moderator_join_url' => $moderatorJoinUrl,
                'attendee_join_url' => $attendeeJoinUrl,
                'host_started' => true,
                'status' => 'running',
            ]);

            // Redirect directly to the moderator join URL for instant meetings
            return redirect($moderatorJoinUrl)
                ->with('success', 'Instant meeting created successfully. Joining as moderator...');
        }

        return redirect()->route('meetings.list')->with('success', 'Scheduled meeting created successfully.');
    }

    public function showRoomLink($meetingId)
    {
        // Retrieve the meeting
        $meeting = BbbMeeting::where('meeting_id', $meetingId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Check if the meeting is running and started by the host
        if ($meeting->status !== 'running' || !$meeting->host_started) {
            return redirect()->route('meetings.list')
                ->with('error', 'The meeting is not currently running or has not been started by the host.');
        }

        // Use the existing join URLs from the database
        $moderatorJoinUrl = $meeting->moderator_join_url;
        $attendeeJoinUrl = $meeting->attendee_join_url;

        // Log the URLs for debugging
        Log::info('ShowRoomLink accessed', [
            'meeting_id' => $meetingId,
            'moderator_join_url' => $moderatorJoinUrl,
            'attendee_join_url' => $attendeeJoinUrl,
        ]);

        // If the URLs are missing, regenerate them (fallback)
        if (!$moderatorJoinUrl || !$attendeeJoinUrl) {
            $hostName = Auth::user()->name ?? 'Host';

            $moderatorJoinUrl = $this->bbbService->joinMeeting(
                $hostName,
                $meetingId,
                $meeting->moderator_pw,
                true
            );

            $attendeeJoinUrl = $this->bbbService->joinMeeting(
                'Guest',
                $meetingId,
                $meeting->attendee_pw,
                false
            );

            // Validate regenerated URLs
            if (filter_var($moderatorJoinUrl, FILTER_VALIDATE_URL) === false) {
                Log::error('Invalid regenerated moderator join URL in showRoomLink', [
                    'meeting_id' => $meetingId,
                    'url' => $moderatorJoinUrl,
                ]);
                return redirect()->route('meetings.list')->withErrors(['message' => 'Failed to generate moderator join link']);
            }

            if (filter_var($attendeeJoinUrl, FILTER_VALIDATE_URL) === false) {
                Log::error('Invalid regenerated attendee join URL in showRoomLink', [
                    'meeting_id' => $meetingId,
                    'url' => $attendeeJoinUrl,
                ]);
                return redirect()->route('meetings.list')->withErrors(['message' => 'Failed to generate attendee join link']);
            }

            $meeting->update([
                'moderator_join_url' => $moderatorJoinUrl,
                'attendee_join_url' => $attendeeJoinUrl,
            ]);

            Log::warning('Join URLs regenerated in showRoomLink', [
                'meeting_id' => $meetingId,
                'moderator_join_url' => $moderatorJoinUrl,
                'attendee_join_url' => $attendeeJoinUrl,
            ]);
        }

        return view('bbb.room-link', [
            'joinUrl' => $moderatorJoinUrl,
            'attendeeJoinUrl' => $attendeeJoinUrl,
            'meetingId' => $meetingId,
            'meeting' => $meeting,
        ]);
    }

    public function startMeeting($id)
    {
        $meeting = BbbMeeting::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

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

        // Log the createMeeting response
        Log::info('BBB createMeeting response in startMeeting', [
            'meeting_id' => $meeting->meeting_id,
            'result' => $result,
        ]);

        if ($result['returncode'] !== 'SUCCESS') {
            return redirect()->route('meetings.list')->withErrors(['message' => $result['message'] ?? 'Failed to start meeting on BBB server']);
        }

        $hostName = Auth::user()->name ?? 'Host';

        $moderatorJoinUrl = $this->bbbService->joinMeeting(
            $hostName,
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

        // Validate URLs
        if (filter_var($moderatorJoinUrl, FILTER_VALIDATE_URL) === false) {
            Log::error('Invalid moderator join URL in startMeeting', [
                'meeting_id' => $meeting->meeting_id,
                'url' => $moderatorJoinUrl,
            ]);
            return redirect()->route('meetings.list')->withErrors(['message' => 'Failed to generate moderator join link']);
        }

        if (filter_var($attendeeJoinUrl, FILTER_VALIDATE_URL) === false) {
            Log::error('Invalid attendee join URL in startMeeting', [
                'meeting_id' => $meeting->meeting_id,
                'url' => $attendeeJoinUrl,
            ]);
            return redirect()->route('meetings.list')->withErrors(['message' => 'Failed to generate attendee join link']);
        }

        $meeting->update([
            'moderator_join_url' => $moderatorJoinUrl,
            'attendee_join_url' => $attendeeJoinUrl,
            'status' => 'running',
            'host_started' => true,
        ]);

        // Redirect to the room-link page, similar to instant meeting behavior
        return redirect()->route('bbb.room-link', ['meetingId' => $meeting->meeting_id])
            ->with('success', 'Scheduled meeting started successfully.');
    }

    public function joinMeeting(Request $request)
    {
        $meeting = BbbMeeting::where('meeting_id', $request->meeting_id)->firstOrFail();
        $isModerator = $request->is_moderator == true;

        if ($meeting->status !== 'running' || !$meeting->host_started) {
            $redirectRoute = Auth::check() ? 'meetings.list' : 'guest.join';
            return redirect()->route($redirectRoute, ['meeting_id' => $request->meeting_id])
                ->with('error', 'Meeting is not currently running or has not been started by the host.');
        }

        // If the user is trying to join as a moderator, they must be authenticated and the meeting's creator
        if ($isModerator) {
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Please log in to join as a moderator.');
            }

            if ($meeting->user_id !== Auth::id()) {
                return redirect()->route('meetings.list')
                    ->with('error', 'You are not authorized to join this meeting as a moderator.');
            }

            $fullName = Auth::user()->name ?? 'Host';

            if ($meeting->moderator_join_url) {
                return redirect($meeting->moderator_join_url);
            }

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

            // Validate URLs
            if (filter_var($moderatorJoinUrl, FILTER_VALIDATE_URL) === false) {
                Log::error('Invalid moderator join URL in joinMeeting', [
                    'meeting_id' => $meeting->meeting_id,
                    'url' => $moderatorJoinUrl,
                ]);
                return redirect()->route('meetings.list')->withErrors(['message' => 'Failed to generate moderator join link']);
            }

            if (filter_var($attendeeJoinUrl, FILTER_VALIDATE_URL) === false) {
                Log::error('Invalid attendee join URL in joinMeeting', [
                    'meeting_id' => $meeting->meeting_id,
                    'url' => $attendeeJoinUrl,
                ]);
                return redirect()->route('meetings.list')->withErrors(['message' => 'Failed to generate attendee join link']);
            }

            $meeting->update([
                'moderator_join_url' => $moderatorJoinUrl,
                'attendee_join_url' => $attendeeJoinUrl,
                'host_started' => true,
                'status' => 'running',
            ]);

            return redirect($moderatorJoinUrl);
        }

        // Handle non-moderator (attendee) joining (no authentication required)
        $fullName = $request->full_name ?? 'Guest';

        if ($meeting->attendee_join_url) {
            return redirect($meeting->attendee_join_url);
        }

        $joinUrl = $this->bbbService->joinMeeting(
            $fullName,
            $meeting->meeting_id,
            $meeting->attendee_pw,
            false
        );

        // Validate URL
        if (filter_var($joinUrl, FILTER_VALIDATE_URL) === false) {
            Log::error('Invalid attendee join URL in joinMeeting (attendee)', [
                'meeting_id' => $meeting->meeting_id,
                'url' => $joinUrl,
            ]);
            return redirect()->route('guest.join', ['meeting_id' => $meeting->meeting_id])
                ->with('error', 'Failed to generate attendee join link');
        }

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

            // End meetings that are no longer active on BBB server
            BbbMeeting::where('user_id', Auth::id())
                ->where('status', 'running')
                ->whereNotIn('meeting_id', $activeMeetingIds)
                ->where('updated_at', '<', now()->subMinutes(5))
                ->update(['status' => 'ended']);

            // Update meetings that are active on BBB server
            BbbMeeting::where('user_id', Auth::id())
                ->whereIn('meeting_id', $activeMeetingIds)
                ->where('status', '!=', 'ended')
                ->update(['status' => 'running', 'host_started' => true]);

            // Update scheduled meetings that have passed their scheduled time but haven't started
            BbbMeeting::where('user_id', Auth::id())
                ->where('status', 'scheduled')
                ->where('scheduled_at', '<=', now())
                ->where('host_started', false)
                ->update(['status' => 'ended']);

            $liveMeetings = BbbMeeting::where('user_id', Auth::id())
                ->where('status', 'running')
                ->orderBy('scheduled_at')
                ->get();

            $scheduledMeetings = BbbMeeting::where('user_id', Auth::id())
                ->where('status', 'scheduled')
                ->where('scheduled_at', '>', now())
                ->where('host_started', false)
                ->orderBy('scheduled_at')
                ->get();

            $endedMeetings = BbbMeeting::where('user_id', Auth::id())
                ->where('status', 'ended')
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

        $meeting = BbbMeeting::where('meeting_id', $request->meetingID)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $result = $this->bbbService->endMeeting($request->meetingID);

        // Log the endMeeting response
        Log::info('BBB endMeeting response', [
            'meeting_id' => $request->meetingID,
            'result' => $result,
        ]);

        if ($result['returncode'] === 'SUCCESS') {
            $meeting->update(['status' => 'ended', 'updated_at' => now()]);
            return redirect()->route('meetings.list')->with('success', 'Meeting ended successfully.');
        }

        return redirect()->route('meetings.list')->with('error', 'Failed to end meeting: ' . ($result['message'] ?? 'Unknown error'));
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

        $meeting = BbbMeeting::where('meeting_id', $request->meeting_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $result = $this->bbbService->getRecordings($request->meeting_id);

        // Log the getRecordings response
        Log::info('BBB getRecordings response', [
            'meeting_id' => $request->meeting_id,
            'result' => $result,
        ]);

        if ($result['returncode'] === 'SUCCESS') {
            return response()->json(['recordings' => $result['recordings']]);
        }

        return response()->json(['message' => $result['message'] ?? 'Failed to fetch recordings'], 500);
    }

    public function showRecordings(Request $request)
    {
        $request->validate(['meeting_id' => 'required|string']);
        $meeting = BbbMeeting::where('meeting_id', $request->meeting_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $result = $this->bbbService->getRecordings($request->meeting_id);

        // Log the getRecordings response
        Log::info('BBB getRecordings response in showRecordings', [
            'meeting_id' => $request->meeting_id,
            'result' => $result,
        ]);

        if ($result['returncode'] !== 'SUCCESS') {
            return redirect()->route('meetings.list')->with('error', 'Failed to fetch recordings: ' . ($result['message'] ?? 'Unknown error'));
        }

        return view('meetings.recordings', ['recordings' => $result['recordings']]);
    }
}
