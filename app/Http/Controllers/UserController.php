<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Course;
use App\Models\Role;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Laravel\Fortify\Http\Responses\RedirectAsIntended;
use Ramsey\Uuid\Guid\Guid;
use Carbon\Carbon;

class UserController extends Controller
{

    public function dashboard()
    {


        $user = Auth::user(); // Get the authenticated user

        // Check user role and redirect accordingly
        switch ($user->type) {
            case 'Superadmin':
                return redirect()->route('dashboard'); ////////////// this defalut user superadmin
            case 'Admin':
                return redirect()->route('admin.dashboard');
            case 'Faculty':
                return redirect()->route('teacher.dashboard');
            case 'Staff':
                return redirect()->route('dashboard');
            case 'Student':
                return redirect()->route('student.dashboard');
            default:
                return redirect()->route('student.dashboard'); // Fallback route
        }
    }

    public function dashboardmain()
    {
        $user = Auth::user();
        $userAuth = $user->email_verified_at;
        if (Auth::check() && ($userAuth != null)) {
            $userId = Auth::user()->id;
            $student = User::where('type', 'Student')->where('user_id', $userId)->count();
            $studentlast7day = User::where('user_id', $userId)->where('type', 'Student')->where('created_at', '>=', Carbon::now()->subDays(7))->count();
            $latestStudents = User::where('type', 'Student')->where('user_id', $userId)->latest()->take(10)->get();
            $studentlastmonth = User::where('user_id', $userId)->where('type', 'Student')->whereBetween('created_at', [
                Carbon::now()->subMonth()->startOfMonth(),
                Carbon::now()->subMonth()->endOfMonth()
            ])->count();

            $teacher = User::where('user_id', $userId)->where('type', 'Faculty')->count();
            $staff = User::where('user_id', $userId)->where('type', 'Staff')->count();

            // $courseslast7day = Course::where('user_id', $userId)->count();
            $coursesLastMonth = Course::where('user_id', $userId)->whereBetween('created_at', [
                Carbon::now()->subMonth()->startOfMonth(),
                Carbon::now()->subMonth()->endOfMonth()
            ])->count();
            $courseslast7day = Course::where('user_id', $userId)->where('created_at', '>=', Carbon::now()->subDays(7))->count();

            $courses = Course::where('user_id', $userId)->count();

            return view('app.dashboard', compact('student', 'courses', 'teacher', 'staff', 'courseslast7day', 'coursesLastMonth', 'studentlast7day', 'studentlastmonth', 'latestStudents'));
        } else {
            return redirect()->route('loginpage');
        }
    }

    public function admindashboard(){
        $user = Auth::user();
        $userAuth = $user->email_verified_at;
        if (Auth::check() && ($userAuth != null)) {
            $userId = Auth::user()->id;
            $student = User::where('type', 'Student')->where('user_id', $userId)->count();
            $studentlast7day = User::where('user_id', $userId)->where('type', 'Student')->where('created_at', '>=', Carbon::now()->subDays(7))->count();
            $latestStudents = User::where('type', 'Student')->where('user_id', $userId)->latest()->take(10)->get();
            $studentlastmonth = User::where('user_id', $userId)->where('type', 'Student')->whereBetween('created_at', [
                Carbon::now()->subMonth()->startOfMonth(),
                Carbon::now()->subMonth()->endOfMonth()
            ])->count();

            $teacher = User::where('user_id', $userId)->where('type', 'Faculty')->count();
            $staff = User::where('user_id', $userId)->where('type', 'Staff')->count();

            // $courseslast7day = Course::where('user_id', $userId)->count();
            $coursesLastMonth = Course::where('user_id', $userId)->whereBetween('created_at', [
                Carbon::now()->subMonth()->startOfMonth(),
                Carbon::now()->subMonth()->endOfMonth()
            ])->count();
            $courseslast7day = Course::where('user_id', $userId)->where('created_at', '>=', Carbon::now()->subDays(7))->count();

            $courses = Course::where('user_id', $userId)->count();

            return view('app.admindashboard', compact('student', 'courses', 'teacher', 'staff', 'courseslast7day', 'coursesLastMonth', 'studentlast7day', 'studentlastmonth', 'latestStudents'));
        } else {
            return redirect()->route('loginpage');
        }
    }

    public function createuser(Request $request)
    {
// dd($request);


        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            'username' => 'required|min:5|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|max:10|unique:users,phone',
            'password' => 'required|min:6',
            'status' => 'required|in:1,0',
            'gender' => 'required', // Assuming 1=Male, 2=Female
            'role' => 'required',  // Adjust based on role values in your system
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $userId = Auth::user()->id;
        try {
            $slug = $this->generateUniqueSlug($request->name);
            $uuid = (string) Guid::uuid4();
            $user = new User([
                'id' => $uuid,
                'name' => $request->input('name'),
                'slug' => $slug,
                'user_id' => $userId,
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'status' => $request->input('status'),
                'country_code' =>'+'.$request->input('country_code'),
                'country_name' => $request->input('country_name'),
                'gender' => $request->input('gender'),
                'type' => $request->input('role'),
                'password' => bcrypt($request->input('password')),
                'email_verified_at' => now()
            ]);

            // Handle file upload
            if ($request->hasFile('profile_picture')) {
                $filePath = $request->file('profile_picture')->store('users pictures', 'public');
                $user->profile_picture = $filePath;
            }

            $user->save();

            if ($request->input('role') == 'Faculty') {
                $route_name = 'teacherlist';
            } elseif ($request->input('role') == 'Student') {
                $route_name = 'studentlist';
            } else {
                $route_name = 'userlist';
            }

            // $verificationUrl = URL::temporarySignedRoute(
            //     'verification.verify',
            //     now()->addMinutes(60),
            //     ['id' => $user->id, 'hash' => sha1($user->email)]
            // );
            // Mail::to($user->email)->send(new VerifyEmail($user, $verificationUrl));

            return redirect()->route($route_name)->with('success', $request->input('role') . ' created successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    private function generateUniqueSlug($Name)
    {
        $slug = Str::slug($Name);
        $originalSlug = $slug;
        $counter = 1;
        while (User::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        return $slug;
    }



    public function updateuser(Request $request)
    {


        $id = $request->userid;

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            'username' => 'required|min:5|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            // 'phone' => 'required|max:14|unique:users,phone,' . $id,
            'status' => 'required|in:1,0',
            'gender' => 'required',
            'role' => 'required',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $slug = $this->generateUniqueSlug($request->name);
            $user = User::findOrFail($request->userid);
            $user->name = $request->input('name');
            $user->slug = $slug;
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            // $user->phone = $request->input('phone');
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

                $filePath = $request->file('profile_picture')->store('users pictures', 'public');
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



    public function useredit($slug)
    {
        $defaultRoles = ['Admin','Student','Faculty'];
        $userId = Auth::user()->id;
        $user = user::where('slug', $slug)->first();
        $role = Role::where(function ($query) use ($userId, $defaultRoles) {
            $query->where('user_id', $userId)
                ->orWhereIn('name', $defaultRoles);
        })
            ->whereNotIn('name', ['Superadmin'])->latest()
            ->get();
        return view('users.useredit', compact('user', 'role'));
    }

    public function useradd(Request $request)
    {
        $userId = Auth::user()->id;
        $defaultRoles = ['Admin','Faculty','Student'];
        $role = Role::where(function ($query) use ($userId, $defaultRoles) {
            $query->where('user_id', $userId)
                ->orWhereIn('name', $defaultRoles);
        })
            ->whereNotIn('name', ['Superadmin'])->latest()
            ->get();
        return view('users.useradd', compact('role'));
    }

    public function userlist(Request $request)
    {
        $userId=Auth::user()->id;
        $query = User::query();
        $query->whereNotIn('type', ['Superadmin'])->where('user_id',$userId)->whereNotNull('email_verified_at');
        // Search logic
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhere('country_code', 'like', '%' . $search . '%');

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
