<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Laravel\Fortify\Http\Responses\RedirectAsIntended;
use Ramsey\Uuid\Guid\Guid;
class UserController extends Controller
{

    public function createuser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            'username' => 'required|min:5|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10|unique:users,phone',
            'password' => 'required|min:6',
            'status' => 'required|in:1,0',
            'gender' => 'required', // Assuming 1=Male, 2=Female
            'role' => 'required',  // Adjust based on role values in your system
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        try {
            $uuid = (string) Guid::uuid4();
            $user = new User([
                'id'=>$uuid,
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'status' => $request->input('status'),
                'gender' => $request->input('gender'),
                'type' => $request->input('role'),
                'password' => bcrypt($request->input('password'))
            ]);

            // Handle file upload
            if ($request->hasFile('profile_picture')) {
                $filePath = $request->file('profile_picture')->store('profile pictures', 'public');
                $user->profile_picture = $filePath;
            }

            $user->save();

            // $verificationUrl = URL::temporarySignedRoute(
            //     'verification.verify',
            //     now()->addMinutes(60),
            //     ['id' => $user->id, 'hash' => sha1($user->email)]
            // );
            // Mail::to($user->email)->send(new VerifyEmail($user, $verificationUrl));

            return redirect()->back()->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }


    public function updateuser(Request $request, $id)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            'username' => 'required|min:5|max:255|unique:users,username,' . $id, // Ensure the username is unique except for the current user
            'email' => 'required|email|unique:users,email,' . $id, // Ensure the email is unique except for the current user
            'phone' => 'required|digits:10|unique:users,phone,' . $id, // Ensure phone number is unique except for the current user
            'status' => 'required|in:1,0',
            'gender' => 'required', // Assuming 1=Male, 2=Female
            'role' => 'required',  // Adjust based on role values in your system
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        try {
            // Find the user by ID
            $user = User::findOrFail($id);

            // Update user data
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->status = $request->input('status');
            $user->gender = $request->input('gender');
            $user->type = $request->input('role');

            // If password is provided, hash and update it
            if ($request->filled('password')) {
                $user->password = bcrypt($request->input('password'));
            }

            // Handle file upload for profile picture
            if ($request->hasFile('profile_picture')) {
                // Delete the old profile picture if it exists
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }

                // Store the new profile picture
                $filePath = $request->file('profile_picture')->store('profile pictures', 'public');
                $user->profile_picture = $filePath;
            }

            // Save the updated user
            $user->save();

            return redirect('user-list')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }


    public function userdelete($id)
    {

        if (Gate::denies('role')) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }
        $user = User::find($id); // Use correct model and variable name
        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'User ID not found.');
        }
    }
    public function useredit($id)
    {
        $user=user::find($id);
        return view('users.useredit',compact('user'));
    }

    public function useradd(Request $request)
    {
        return view('users.useradd');
    }
    public function userlist(Request $request)
    {
        $data=user::all();
        return view('users.userlist',compact('data'));
    }
}
