<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Teacher;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{


    public function teacheradd(Request $request)
    {
        return view('teachers.teacheradd');
    }

    public function teacherlist(Request $request)
    {
        $query = User::where('type', 'Teacher');

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        $perPage = $request->input('per_page', 5);
        $data = $query->latest()->paginate($perPage);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('teachers.teacherlist_table', compact('data'))->render(),
                'pagination' => view('users.pagination', compact('data'))->render(),
            ]);
        }

        return view('teachers.teacherlist', compact('data'));
    }


    public function teacher_delete(User $user)
    {
        try {
            $user->delete();
            return response()->json(['status' => 'success', 'message' => 'User deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }



    public function teacheredit($id)
    {
        $user = User::find($id);

        return view('teachers.teacheredit', compact('user'));
    }


    public function updateteacher(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            // 'username' => 'required|min:5|max:255|unique:users,username,' . $id, // Ensure the username is unique except for the current user
            // 'email' => 'required|email|unique:users,email,' . $id, // Ensure the email is unique except for the current user
            // 'phone' => 'required|digits:10|unique:users,phone,' . $id, // Ensure phone number is unique except for the current user
            'status' => 'required|in:1,0',
            'gender' => 'required', // Assuming 1=Male, 2=Female
            // 'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $user = User::findOrFail($request->userid);
            $user->name = $request->input('name');
            // $user->username = $request->input('username');
            // $user->email = $request->input('email');
            // $user->phone = $request->input('phone');
            $user->status = $request->input('status');
            $user->gender = $request->input('gender');
            $user->type = $request->input('role');

            // if ($request->filled('password')) {
            //     $user->password = bcrypt($request->input('password'));
            // }

            if ($request->hasFile('profile_picture')) {
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
                $filePath = $request->file('profile_picture')->store('profile pictures', 'public');
                $user->profile_picture = $filePath;
            }
            $user->save();

            return redirect('teachers-list')->with('success', 'Teacher updated successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
