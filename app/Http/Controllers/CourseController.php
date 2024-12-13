<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

class CourseController extends Controller
{
    public function createCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:50',
            'start_date' => 'required|date',
            'duration' => 'required|string',
            'price' => 'required|numeric',
            'teacher_name' => 'required|max:255',
            'max_students' => 'required|integer',
            'status' => 'required|in:1,0',
            'details' => 'nullable|string',
            'course_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        try {
            $course = new Course();
            $course->course_name = $request->course_name;
            $course->code = $request->course_code;
            $course->start_date = $request->start_date;
            $course->duration = $request->duration;
            $course->price = $request->price;
            $course->teacher_name = $request->teacher_name;
            $course->max_students = $request->max_students;
            $course->status = $request->status;
            $course->details = $request->details;

            if ($request->hasFile('course_image')) {
                $filePath = $request->file('course_image')->store('courses', 'public');
                $course->course_image = $filePath;
            }

            $course->save();

            return response()->json(['success' => true, 'message' => 'Course created successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function courselist(Request $request)
    {
        $query = Course::query();

        if ($request->has('name')) {
            $query->where('course_name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('teacher_name')) {
            $query->where('teacher_name', 'like', '%' . $request->teacher_name . '%');
        }

        $courses = $query->latest()->paginate(12);

        return view('app.courses.list', compact('courses'));
    }
    public function coursedetails(Request $request, $id)
    {
        $course = Course::find($id);

        if ($course) {
            return view('app.courses.course_details', compact('course'));
        } else {
            return redirect()->route('courses')->with('error', 'Course not found.');
        }
    }
}
