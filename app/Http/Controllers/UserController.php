<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
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
                'id' => $uuid,
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


    public function updateuser(Request $request)
    {
        $id=$request->userid;

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            'username' => 'required|min:5|max:255|unique:users,username,' . $id, // Ensure the username is unique except for the current user
            'email' => 'required|email|unique:users,email,' . $id, // Ensure the email is unique except for the current user
            'phone' => 'required|digits:10|unique:users,phone,' . $id, // Ensure phone number is unique except for the current user
            'status' => 'required|in:1,0',
            'gender' => 'required', // Assuming 1=Male, 2=Female
            'role' => 'required',  // Adjust based on role values in your system
            // 'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        try {

            $user = User::findOrFail($request->userid);


            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->status = $request->input('status');
            $user->gender = $request->input('gender');
            $user->type = $request->input('role');


            if ($request->filled('password')) {
                $user->password = bcrypt($request->input('password'));
            }

            if ($request->hasFile('profile_picture')) {
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }

                $filePath = $request->file('profile_picture')->store('profile pictures', 'public');
                $user->profile_picture = $filePath;
            }


            $user->save();

            return redirect('users-list')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }



    public function user_delete($id)
    {
        if (Gate::denies('role')) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }
        $course = user::find($id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Course ID not found.');
        }
    }



    public function useredit($id)
    {
        $user = user::find($id);
        $role = role::all();
        return view('users.useredit', compact('user', 'role'));
    }

    public function useradd(Request $request)
    {
        $role = Role::all();
        return view('users.useradd', compact('role'));
    }

    public function userlist(Request $request)
    {

        $query = User::query();

        $query->whereIn('type', ['staff', 'Admin']);
        // Search logic
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%');
            });
        }

        $perPage = $request->input('per_page', 5); // Default to 5 per page
        $data = $query->latest()->paginate($perPage);
        if ($request->ajax()) {
            return response()->json([
                'html' => view('users.userlist_table', compact('data'))->render(),
                'pagination' => view('users.pagination', compact('data'))->render(),
            ]);
        }


        return view('users.userlist', compact('data'));
    }




    // public function userlist(Request $request)
    // {
    //     $role = Role::all();
    //     $query = user::query();
    //     if ($request->has('name')) {
    //         $query->where(function ($subQuery) use ($request) {
    //             $subQuery->where('name', 'like', '%' . $request->name . '%')
    //                 ->orWhere('email', 'like', '%' . $request->name . '%');
    //         });
    //     }

    //     if ($request->has('role') !== null) {
    //         $query->where('type', 'like', '%' . $request->role . '%');
    //     }
    //     if ($request->has('username')) {
    //         $query->where('username', 'like', '%' . $request->username . '%');
    //     }
    //     $data = $query->latest()->paginate(10);


    //     return view('users.userlist', compact('data', 'role'));
    // }

    // public function changeStatus(User $user)
    // {
    //     try {
    //         $user->status = $user->status == 1 ? 0 : 1;
    //         $user->save();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'User status updated successfully.'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error updating user status.'
    //         ], 500);
    //     }
    // }

    public function changeStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully!');
    }
}
