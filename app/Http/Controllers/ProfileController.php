<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profilepage(Request $request)
    {
        return view('profiles.profile_page');
    }

    public function updateProfile(Request $request)
    {

        $user = Auth::user(); // Get the authenticated user

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:10',
            'username' => 'nullable|string|min:6',
            'gender' => 'required|in:Male,Female,Other',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 2MB max
        ]);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'username' => $request->username,
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete('users_pictures/' . $user->profile_picture);
            }

            $imagePath = $request->file('profile_picture')->store('users pictures', 'public');
            $user->update(['profile_picture' => $imagePath]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
