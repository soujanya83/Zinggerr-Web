<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profilepage(Request $request)
    {
        return view('profiles.profile_page');
    }

    public function socialprofilepage(Request $request)
    {
        return view('profiles.socialprofile_page');
    }



    public function updateProfile(Request $request)
    {
        $uid = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:10',
            'username' => 'nullable|string|min:6',
            'gender' => 'required|in:Male,Female,Other',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $user = User::findOrFail($uid);

            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'username' => $request->username,
            ]);


            if ($request->hasFile('profile_picture')) {

                // if ($user->profile_picture) {
                //     Storage::disk('public')->delete('users_pictures/' . $user->profile_picture);
                // }


                $imagePath = $request->file('profile_picture')->store('users pictures', 'public');
                $user->update(['profile_picture' => $imagePath]);
            }

            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            // \Log::error('Error in updateProfile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $uid = Auth::user()->id;
        $user = User::findOrFail($uid);

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            // Return with an error message for current_password
            return redirect()->back()
                ->withErrors(['current_password' => 'The current password is incorrect.'])
                ->withInput();
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
