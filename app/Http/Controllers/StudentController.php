<?php

namespace App\Http\Controllers;

use App\Models\BbbMeeting;
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
use Illuminate\Support\Facades\DB;
use App\Models\CourseSection;
use App\Models\CourseUserPermission;
use App\Models\Permission;
use App\Models\UsersPermission;
use Illuminate\Validation\Rule;


class StudentController extends Controller
{

    public function share_user_register_page(){
        return view('auth.share_link_register');
    }

    public function generateShareLink($slug){
      $course= Course::where('slug',$slug)->first();
        $userData=User::select('profile_picture')->where('id',$course->user_id)->first();

        session()->put('course_id_share',$course->id);
        $courseAssetsData=CoursesAssets::select('assets_type','topic_name')->where('course_id',$course->id)->get();

        return view('students.course_share_view',compact('course','userData','courseAssetsData'));
    }


    public function courses_views($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $existsData = CoursesAssets::where('course_id', $course->id)
            ->where('chapter_id', '!=', 11)
            ->exists();

        if ($existsData) {
            $chapters = CoursesChepters::where('courses_id', $course->id)->get();
            $assetsData = null;
            $quizzes=null;
            $weeklysectiondata=null;
            $pageName = 'Chapters';
        } else {
            $assetsData = CoursesAssets::where('course_id', $course->id)
                ->where('chapter_id', '=', 11)
                ->first();

                if($assetsData){
                    $weeklysectiondata=null;

            $chapters = null;
            $pageName = 'Assets';

            if ($assetsData != null) {

                $quizzes = VideoQuiz::where(['video_name' => $assetsData->assets_video, 'course_id' => $course->id])->orderBy('quiz_time')->get();
            } else {
                $quizzes = null;
            }
        }else{
            $assetsData = null;
            $chapters = null;
            $quizzes = null;
            $pageName = 'Weekly Sections';
            $weeklysectiondata= CourseSection::where('course_id', $course->id)->where('status',1)->orderBy('date')->get();

        }


        }
        return view('students.courses_views', compact('course', 'chapters', 'assetsData', 'pageName', 'quizzes','weeklysectiondata'));
    }

    public function studentdashboard()
    {
        $userId = Auth::user()->id;
        $student_courses = CoursesAssign::where('users_id', $userId)->where('courses.course_status', 1)->where('courses_assign.status', 1)->join('courses', 'courses.id', '=', 'courses_assign.courses_id')->latest('courses_assign.created_at')->take(10)->get();
        $student = User::where('type', 'Student')->count();
        $courses =  CoursesAssign::where('users_id', $userId)->where('courses.course_status', 1)->where('courses_assign.status', 1)->join('courses', 'courses.id', '=', 'courses_assign.courses_id')->count();
        $teacher = User::where('type', 'Teacher')->count();
        $user = Auth::user();
        $unread = $user->unreadNotifications;
        $read = $user->readNotifications;
        $notifications = $unread->concat($read)->take(5);
        $bbbmeetings = BbbMeeting::orderByRaw("CASE WHEN status = 'running' THEN 0 ELSE 1 END")
        ->latest('scheduled_at')
        ->take(5)
        ->get();
        return view('app.studentdashboard', compact('bbbmeetings','notifications','student', 'courses', 'teacher', 'student_courses'));
    }



    public function shareCourse(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $courseId = $request->input('course_id');
        $userId = $request->input('user_id');

        $uuid = (string) Guid::uuid4();
        CoursesAssign::updateOrCreate(
            ['courses_id' => $courseId, 'users_id' => $userId],
            ['id' => $uuid]
        );

        $userdata = User::select('type')->where('id', $userId)->first();
        if ($userdata->type == 'Faculty') {
            $allPermissions = Permission::all();
            $editCoursePermission = $allPermissions->firstWhere('name', 'courses_edit');
            $statusCoursePermission = $allPermissions->firstWhere('name', 'courses_status');
            $permissionsToAssign = [];
            if ($editCoursePermission) {
                $permissionsToAssign[] = $editCoursePermission->id;
            }
            if ($statusCoursePermission) {
                $permissionsToAssign[] = $statusCoursePermission->id;
            }
            foreach ($permissionsToAssign as $permissionId) {
                $uuid = (string) Guid::uuid4();
                CourseUserPermission::updateOrCreate(
                    [
                        'permission_id' => $permissionId,
                        'assign_user_id' => $userId,
                        'course_id' => $courseId,
                    ],
                    [

                        'user_id' => Auth::user()->id,
                        'id' => $uuid
                    ]
                );
            }
        }

        return response()->json(['message' => 'Course shared successfully']);
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
        $userid = Auth::user()->id;
        $query = User::whereIn('type', ['Student'])->whereNotNull('email_verified_at')->where('user_id',$userid);

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
        $request->merge([
            'phone' => $request->phone ?: null, // Convert empty phone to NULL
        ]);

        $id = $request->userid;
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            'username' => 'required|min:5|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => [
                'nullable',
                'digits_between:9,15',
                Rule::unique('users', 'phone')->ignore($id),
            ],
            'status' => 'required|in:1,0',
            'gender' => 'required',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->phone == null) {
            $country_code = null;
            $country_name = null;
        } else {
            $country_code = $request->input('country_code');
            $country_name = $request->input('country_name');
        }
        try {

            $user = User::findOrFail($request->userid);
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone') ?? null;
            $user->country_code = $country_code;
            $user->country_name = $country_name;
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

            return redirect()->route('studentlist')->with('success', 'Student updated successfully!');
        } catch (\Exception $e) {
dd($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
