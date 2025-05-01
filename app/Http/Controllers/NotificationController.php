<?php
// app/Http/Controllers/NotificationController.php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = DB::table('notifications')
        ->where('notifiable_id', Auth::user()->id)
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($notification) {
            $notification->data = json_decode($notification->data, true);
            return $notification;
        });

        return view('notifications.list', compact('notifications'));
    }

    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    // public function markAsRead($id)
    // {
    //     $notification = Auth::user()->notifications()->find($id);
    //     if ($notification) {
    //         $notification->markAsRead();
    //         return response()->json(['success' => true]);
    //     }
    //     return response()->json(['success' => false], 404);
    // }
}
