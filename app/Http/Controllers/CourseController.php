<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CoursesAssign;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{

    public function courseadd(Request $request)

    {
        return view('courses.add');
    }

    public function getUsers(Request $request)
    {
        return response()->json(User::select('id', 'name','type')->whereNotIn('type',['Superadmin','Admin','Staff'])->where('status',1)->get());
    }

    public function couserassign(Request $request)
    {
        $courseId = $request->input('course_id');
        $userIds = $request->input('users', []);
        foreach ($userIds as $userId) {
            $uuid = (string) Guid::uuid4();
            CoursesAssign::updateOrCreate(
                ['courses_id' => $courseId, 'users_id' => $userId],
                [ 'id' => $uuid]
            );
        }
        return redirect()->back()->with('success', 'Users assigned successfully!');
    }


    public function createCourse(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'course_full_name' => 'required|string|max:255',
        //     'course_short_name' => 'required|string|max:255',
        //     'course_category' => 'required|string|max:100',
        //     'course_start_date' => 'required|date|before_or_equal:course_end_date',
        //     'course_end_date' => 'required|date|after_or_equal:course_start_date',
        //     'course_id_number' => 'nullable|string|max:50',
        //     'course_status' => 'required|boolean',
        //     'downloa_status' => 'nullable|boolean',
        //     'course_summary' => 'nullable|string|max:1000',
        //     // 'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'hidden_section' => 'nullable|string|max:255',
        //     'course_layout' => 'nullable|string|max:255',
        //     'course_sections' => 'required|integer|min:0|max:100',
        //     'force_theme' => 'nullable|string|max:50',
        //     'force_language' => 'nullable|string|max:50',
        //     'no_announcements' => 'nullable|integer|min:0|max:255',
        //     'gradebook_student' => 'nullable|boolean',
        //     'activity_report' => 'nullable|boolean',
        //     'activity_date' => 'nullable|boolean',
        //     'file_uploads_size' => 'nullable|integer|min:0|max:2048',
        //     'completion_tracking' => 'nullable|boolean',
        //     'activity_completion_conditions' => 'nullable|boolean',
        //     'group_mode' => 'nullable|string|max:50',
        //     'force_group_mode' => 'nullable|boolean',
        //     'default_group' => 'nullable|string|max:50',
        //     'course_format' => 'nullable|string|max:100',
        //     'tags' => 'nullable|array',
        //     'tags.*' => 'string|max:50',
        //     'module_credit' => 'nullable|integer|min:0|max:255',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        $tags = $request->tags; // This should be an array like ['Basic', 'Advanced', 'Intermediate']
        $tagsString = implode(',', $tags);
        $uuid = (string) Guid::uuid4();

        try {
            $course = new Course();
            $course->id = $uuid;
            $course->course_full_name = $request->course_full_name;
            $course->course_short_name = $request->course_short_name;
            $course->course_category = $request->course_category;
            $course->course_start_date = $request->course_start_date;
            $course->course_end_date = $request->course_end_date;
            $course->course_id_number = $request->course_id_number;
            $course->course_status = $request->course_status;
            $course->downloa_status = $request->downloa_status ?? 0;
            $course->course_summary = $request->course_summary;
            $course->hidden_section = $request->hidden_section;
            $course->course_layout = $request->course_layout;
            $course->course_sections = $request->course_sections;
            $course->force_theme = $request->force_theme;
            $course->force_language = $request->force_language;
            $course->no_announcements = $request->no_announcements ?? 0;
            $course->gradebook_student = $request->gradebook_student ?? 0;
            $course->activity_report = $request->activity_report ?? 0;
            $course->activity_date = $request->activity_date ?? 0;
            $course->file_uploads_size = $request->file_uploads_size ?? 0;
            $course->completion_tracking = $request->completion_tracking ?? 0;
            $course->activity_completion_conditions = $request->activity_completion_conditions ?? 0;
            $course->group_mode = $request->group_mode;
            $course->force_group_mode = $request->force_group_mode ?? 0;
            $course->default_group = $request->default_group;
            $course->course_format = $request->course_format;
            $course->tags = $tagsString;
            $course->module_credit = $request->module_credit ?? 0;

            if ($request->hasFile('course_image')) {
                $filePath = $request->file('course_image')->store('courses', 'public');
                $course->course_image = $filePath;
            }

            $course->save();

            return response()->json(['success' => true, 'message' => 'Course created successfully!']);
        } catch (\Exception $e) {

            Log::error('Error occurred while creating a course: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function courselist(Request $request)
    {
        $userId=Auth::user()->id;
       $userType=Auth::user()->type;
       if($userType=='Superadmin' || $userType=='Admin' || $userType=='Staff'){
        $query=Course::query();
       }else{
        $query=CoursesAssign::where('users_id',$userId)->join('courses','courses.id','=','courses_assign.courses_id');
       }

        if ($request->has('name')) {
            $query->where('courses.course_full_name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('teacher_name')) {
            $query->where('courses.course_category', 'like', '%' . $request->teacher_name . '%');
        }
        $courses = $query->latest('courses.created_at')->paginate(12);

        $users = User::where('status', 1)->get();

        return view('courses.list', compact('courses', 'users'));
    }

    public function coursedetails(Request $request, $id)
    {
        $course = Course::find($id);

        if ($course) {
            return view('courses.course_details', compact('course'));
        } else {
            return redirect()->route('courses')->with('error', 'Course not found.');
        }
    }

    public function courseedit(Request $request, $id)
    {
        $course = Course::find($id);
        if ($course) {
            return view('courses.course_edit', compact('course'));
        } else {
            return redirect()->route('courses')->with('error', 'Course not found.');
        }
    }

    public function courseupdate(Request $request, $id)
    {

        // $validator = Validator::make($request->all(), [
        //     'course_full_name' => 'required|string|max:255',
        //     'course_short_name' => 'required|string|max:255',
        //     'course_category' => 'required|string|max:100',
        //     'course_start_date' => 'required|date|before_or_equal:course_end_date',
        //     'course_end_date' => 'required|date|after_or_equal:course_start_date',
        //     'course_id_number' => 'nullable|string|max:50',
        //     'course_status' => 'required|boolean',
        //     'downloa_status' => 'nullable|boolean',
        //     'course_summary' => 'nullable|string|max:1000',
        //     'hidden_section' => 'nullable|string|max:255',
        //     'course_layout' => 'nullable|string|max:255',
        //     'course_sections' => 'required|integer|min:0|max:100',
        //     'force_theme' => 'nullable|string|max:50',
        //     'force_language' => 'nullable|string|max:50',
        //     'no_announcements' => 'nullable|integer|min:0|max:255',
        //     'gradebook_student' => 'nullable|boolean',
        //     'activity_report' => 'nullable|boolean',
        //     'activity_date' => 'nullable|boolean',
        //     'file_uploads_size' => 'nullable|integer|min:0|max:2048',
        //     'completion_tracking' => 'nullable|boolean',
        //     'activity_completion_conditions' => 'nullable|boolean',
        //     'group_mode' => 'nullable|string|max:50',
        //     'force_group_mode' => 'nullable|boolean',
        //     'default_group' => 'nullable|string|max:50',
        //     'course_format' => 'nullable|string|max:100',
        //     'tags' => 'nullable|array',
        //     'tags.*' => 'string|max:50',
        //     'module_credit' => 'nullable|integer|min:0|max:255',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['success' => false, 'message' => 'Course not found'], 404);
        }
        $tags = $request->tags;
        $tagsString = implode(',', $tags);

        try {
            $course->course_full_name = $request->course_full_name;
            $course->course_short_name = $request->course_short_name;
            $course->course_category = $request->course_category;
            $course->course_start_date = $request->course_start_date;
            $course->course_end_date = $request->course_end_date;
            $course->course_id_number = $request->course_id_number;
            $course->course_status = $request->course_status;
            $course->downloa_status = $request->downloa_status ?? 0;
            $course->course_summary = $request->course_summary;
            $course->hidden_section = $request->hidden_section;
            $course->course_layout = $request->course_layout;
            $course->course_sections = $request->course_sections;
            $course->force_theme = $request->force_theme;
            $course->force_language = $request->force_language;
            $course->no_announcements = $request->no_announcements ?? 0;
            $course->gradebook_student = $request->gradebook_student ?? 0;
            $course->activity_report = $request->activity_report ?? 0;
            $course->activity_date = $request->activity_date ?? 0;
            $course->file_uploads_size = $request->file_uploads_size ?? 0;
            $course->completion_tracking = $request->completion_tracking ?? 0;
            $course->activity_completion_conditions = $request->activity_completion_conditions ?? 0;
            $course->group_mode = $request->group_mode;
            $course->force_group_mode = $request->force_group_mode ?? 0;
            $course->default_group = $request->default_group;
            $course->course_format = $request->course_format;
            $course->tags = $tagsString;
            $course->module_credit = $request->module_credit ?? 0;

            if ($request->hasFile('course_image')) {
                $filePath = $request->file('course_image')->store('courses', 'public');
                $course->course_image = $filePath;
            }
            $course->save();
            return response()->json(['success' => true, 'message' => 'Courses updated successfully!']);
        } catch (\Exception $e) {
            Log::error('Error occurred while updating the course: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function coursedelete($id)
    {
        if (Gate::denies('role')) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }
        $course = Course::find($id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'Course deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Course ID not found.');
        }
    }
    public function couserchangeStatus(Request $request)
    {
        $user = Course::findOrFail($request->id);
        $user->course_status = $request->status;
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully!');
    }
}
