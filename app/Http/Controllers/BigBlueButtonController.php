<?php

namespace App\Http\Controllers;

use App\Services\BigBlueButtonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BigBlueButtonController extends Controller
{
    protected $bbbService;

    public function __construct(BigBlueButtonService $bbbService)
    {
        $this->bbbService = $bbbService;
    }

    public function index()
    {
        return view('meetings.create');
    }

    // public function createMeeting(Request $request)
    // {
    //     $request->validate([
    //         'meeting_name' => 'required|string',
    //         'meeting_id' => 'required|string',
    //     ]);

    //     $result = $this->bbbService->createMeeting(
    //         $request->meeting_name,
    //         $request->meeting_id
    //     );



    //     if ($result['returncode'] === 'SUCCESS') {
    //         return response()->json([
    //             'message' => 'Meeting created',
    //             'data' => $result,
    //             'join_url' => $result['joinUrl'] ?? null,
    //         ]);
    //     }

    //     return response()->json(['message' => $result['message']], 500);
    // }

    public function createMeeting(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'meeting_name' => 'required|string',
            'meeting_id' => 'required|string',
            'meeting_admin_pw' => 'required|string', // Moderator password
            'meeting_attenduser_pw' => 'required|string', // Attendee password
        ]);

        // Create the meeting using the BBB service
        $result = $this->bbbService->createMeeting(
            $request->meeting_name,
            $request->meeting_id
        );

        // Check if the meeting was created successfully
        if ($result['returncode'] === 'SUCCESS') {
            // Generate join URLs for moderator and attendee
            $moderatorJoinUrl = $this->bbbService->joinMeeting(
                Auth::user()->name ?? 'Admin', // Use authenticated user name or fallback
                $request->meeting_id,
                $request->meeting_admin_pw,
                true // isModerator
            );

            $attendeeJoinUrl = $this->bbbService->joinMeeting(
                'Guest',
                $request->meeting_id,
                $request->meeting_attenduser_pw,
                false // isModerator
            );

            // Pass the join URLs to the view
            return view('bbb.room-link', [
                'joinUrl' => $moderatorJoinUrl, // Default to moderator URL
                'attendeeJoinUrl' => $attendeeJoinUrl,
                'meetingId' => $request->meeting_id,
            ]);
        }

        // Handle failure
        return response()->json(['message' => $result['message']], 500);
    }


    public function joinMeeting(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'meeting_id' => 'required|string',
            'is_moderator' => 'boolean',
        ]);

        $password = $request->is_moderator ? 'mp' : 'ap';
        $joinUrl = $this->bbbService->joinMeeting(
            $request->full_name,
            $request->meeting_id,
            $password,
            $request->is_moderator
        );

        return redirect($joinUrl);
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
}
