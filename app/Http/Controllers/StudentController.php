<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\User;
use App\Models\Course;
use App\Models\VideoQuiz;
use App\Models\CoursesChepters;
use App\Models\CoursesAssets;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\CoursesAssign;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function courses_views($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $existsData = CoursesAssets::where('course_id', $course->id)
            ->where('chapter_id', '!=', 11)
            ->exists();

        if ($existsData) {
            $chapters = CoursesChepters::where('courses_id', $course->id)->get();
            $assetsData = null; // Set to null for clarity
            $pageName = 'Chapters';
        } else {
            $assetsData = CoursesAssets::where('course_id', $course->id)
                ->where('chapter_id', '=', 11)
                ->first();
            $chapters = null; // Set to null for clarity
            $pageName = 'Assets';

            if ($assetsData != null) {

                $quizzes = VideoQuiz::where(['video_name' => $assetsData->assets_video, 'course_id' => $course->id])->orderBy('quiz_time')->get();
            } else {
                $quizzes = null;
            }
        }
        return view('students.courses_views', compact('course', 'chapters', 'assetsData', 'pageName', 'quizzes'));
    }


    public function studentdashboard()
    {
        $userId = Auth::user()->id;
        $student_courses = CoursesAssign::where('users_id', $userId)->where('courses.course_status', 1)->where('courses_assign.status', 1)->join('courses', 'courses.id', '=', 'courses_assign.courses_id')->latest('courses_assign.created_at')->take(10)->get();


        $student = User::where('type', 'Student')->count();
        $courses =  CoursesAssign::where('users_id', $userId)->where('courses.course_status', 1)->where('courses_assign.status', 1)->join('courses', 'courses.id', '=', 'courses_assign.courses_id')->count();
        $teacher = User::where('type', 'Teacher')->count();


        return view('app.studentdashboard', compact('student', 'courses', 'teacher', 'student_courses'));
    }

    public function studentadd(Request $request)
    {
        return view('students.studentadd');
    }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'username' => 'required|string|unique:students,username|max:255',
    //         'email' => 'required|email|unique:students,email|max:255',
    //         'phone' => 'required|numeric|digits:10',
    //         'password' => 'required|string|min:6',
    //         'profile' => 'required|string',
    //         'gender' => 'required|string|in:Male,Female,Other',
    //     ]);

    //     // Save the data
    //    $arr= array([
    //         'name' => $request->name,
    //         'username' => $request->username,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'password' => bcrypt($request->password), // Hash the password
    //         'profile' => $request->profile,
    //         'gender' => $request->gender,
    //     ]);

    // }

    public function studentlist(Request $request)
    {
        $query = User::whereIn('type', ['Student'])->whereNotNull('email_verified_at');

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

        return view('students.studentlist', compact('data'));
    }


    // public function teacher_delete(User $user)
    // {
    //     try {
    //         $user->delete();
    //         return response()->json(['status' => 'success', 'message' => 'User deleted successfully.']);
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    //     }
    // }



    public function studentedit($slug)
    {
        $user = User::where('slug', $slug)->first();

        return view('students.studentedit', compact('user'));
    }


    public function updatestudent(Request $request)
    {
        $id = $request->userid;
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            'username' => 'required|min:5|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|digits:10|unique:users,phone,' . $id,
            'status' => 'required|in:1,0',
            'gender' => 'required',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
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
                $filePath = $request->file('profile_picture')->store('users pictures', 'public');
                $user->profile_picture = $filePath;
            }
            $user->save();

            return redirect('student-list')->with('success', 'Student updated successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
