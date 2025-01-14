<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CoursesAssets;
use App\Models\CoursesAssign;
use App\Models\CoursesChepters;
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



    // public function submitAssets(Request $request)
    // {
    //     $fileName = $request->input('fileName');
    //     $chunkNumber = $request->input('chunkNumber');
    //     $totalChunks = $request->input('totalChunks');
    //     $file = $request->file('file');

    //     if (!$file) {
    //         return response()->json(['error' => 'File not provided'], 400);
    //     }

    //     $tempDir = storage_path('app/chunks/' . md5($fileName));

    //     if (!is_dir($tempDir)) {
    //         mkdir($tempDir, 0777, true);
    //     }

    //     // Save chunk
    //     $chunkPath = $tempDir . '/' . $chunkNumber;
    //     $file->move($tempDir, $chunkNumber);

    //     // Check if all chunks are uploaded
    //     if ($chunkNumber == $totalChunks) {
    //         $finalPath = storage_path('app/public/assets_videos/' . $fileName);

    //         if (!is_dir(dirname($finalPath))) {
    //             mkdir(dirname($finalPath), 0777, true);
    //         }

    //         // Merge chunks
    //         $out = fopen($finalPath, 'wb');
    //         for ($i = 1; $i <= $totalChunks; $i++) {
    //             $chunkFile = $tempDir . '/' . $i;
    //             $in = fopen($chunkFile, 'rb');
    //             while ($buffer = fread($in, 4096)) {
    //                 fwrite($out, $buffer);
    //             }
    //             fclose($in);
    //             unlink($chunkFile); // Remove the chunk file
    //         }
    //         fclose($out);
    //         rmdir($tempDir); // Remove the temporary directory

    //         return response()->json(['success' => true, 'path' => 'assets_videos/' . $fileName]);
    //     }

    //     return response()->json(['success' => true]);
    // }

    // public function submitAssets(Request $request)
    // {

    //     $fileName = $request->input('fileName');
    //     $chunkNumber = $request->input('chunkNumber');
    //     $totalChunks = $request->input('totalChunks');
    //     $file = $request->file('file');

    //     $courseId = $request->input('course_id'); // Get course_id
    //     $chapterId = $request->input('chapter_id'); // Get course_id
    //     $blogName = $request->input('blog_name'); // Get blog_name

    //     $assetsdiscription = $request->input('assetsdiscription'); // Get blog_name
    //     $blog = $request->input('blog'); // Get blog_name
    //     $topicimage = $request->input('topicimage'); // Get blog_name
    //     $videolinks = $request->input('videolinks'); // Get blog_name
    //     $blogstatus = $request->input('blogstatus'); // Get blog_name

    //     if (!$file) {
    //         return response()->json(['error' => 'File not provided'], 400);
    //     }

    //     // Temporary directory for chunks
    //     $tempDir = storage_path('app/chunks/' . md5($fileName));
    //     if (!is_dir($tempDir)) {
    //         mkdir($tempDir, 0777, true);
    //     }

    //     // Save the uploaded chunk
    //     $chunkPath = $tempDir . '/' . $chunkNumber;
    //     $file->move($tempDir, $chunkNumber);

    //     // Check if all chunks are uploaded
    //     if ($chunkNumber == $totalChunks) {
    //         $finalPath = storage_path('app/public/assets_videos/' . $fileName);

    //         if (!is_dir(dirname($finalPath))) {
    //             mkdir(dirname($finalPath), 0777, true);
    //         }

    //         // Merge all chunks into a single file
    //         $out = fopen($finalPath, 'wb');
    //         for ($i = 1; $i <= $totalChunks; $i++) {
    //             $chunkFile = $tempDir . '/' . $i;
    //             $in = fopen($chunkFile, 'rb');
    //             while ($buffer = fread($in, 4096)) {
    //                 fwrite($out, $buffer);
    //             }
    //             fclose($in);
    //             unlink($chunkFile); // Delete chunk after merging
    //         }
    //         fclose($out);
    //         rmdir($tempDir); // Remove the temporary directory

    //         // Save file details to the database
    //         $course = Course::find($courseId);
    //         if ($course) {
    //             CoursesAssets::create([
    //                 'id' => (string) Guid::uuid4(),
    //                 'course_id' => $courseId,
    //                 'blog_name' => $blogName,
    //                 'chapter_id' => $chapterId,
    //                 'assets_discription' => $assetsdiscription,
    //                 'topicimage' => $topicimage,
    //                 'no_of_blog' => $blog,
    //                 'videolinks' => $videolinks,
    //                 'blogstatus' => $blogstatus,
    //                 'course_assets_video' => 'assets_videos/' . $fileName, // Save the file path
    //             ]);

    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Video uploaded and data saved successfully!',
    //                 'path' => 'assets_videos/' . $fileName,
    //             ]);
    //         } else {
    //             return response()->json(['error' => 'Course not found'], 404);
    //         }
    //     }

    //     return response()->json(['success' => true, 'message' => 'Chunk uploaded successfully!']);
    // }

    // public function submitAssets(Request $request)
    // {

    //     $fileName = $request->input('fileName');
    //     $chunkNumber = $request->input('chunkNumber');
    //     $totalChunks = $request->input('totalChunks');
    //     $file = $request->file('file');
    //     $courseId = $request->input('course_id');
    //     $chapterId = $request->input('chapter_id');
    //     $topicName = $request->input('topicName');
    //     $blogName = $request->input('blog_name');
    //     $assetsDiscription = $request->input('assets_discription', ''); // Optional
    //     $blog = $request->input('blog', ''); // Optional
    //     $topicImage = $request->input('topicimage', null); // Optional
    //     $videoLinks = $request->input('video_links', ''); // Optional
    //     $blogStatus = $request->input('blogstatus'); // Required


    //     // File validation
    //     if (!$file) {
    //         return response()->json(['error' => 'File not provided'], 400);
    //     }

    //     // Validate required fields
    //     if (!$courseId || !$chapterId || !$blogName || !$blogStatus) {
    //         return response()->json(['error' => 'Required fields missing: Course ID, Chapter ID, Blog Name, and Blog Status'], 400);
    //     }

    //     // Temporary directory for chunks
    //     $tempDir = storage_path('app/chunks/' . md5($fileName));
    //     if (!is_dir($tempDir)) {
    //         mkdir($tempDir, 0777, true);
    //     }

    //     // Save the uploaded chunk
    //     $chunkPath = $tempDir . '/' . $chunkNumber;
    //     $file->move($tempDir, $chunkNumber);

    //     // Check if all chunks are uploaded
    //     if ($chunkNumber == $totalChunks) {
    //         $finalPath = storage_path('app/public/assets_videos/' . $fileName);

    //         if (!is_dir(dirname($finalPath))) {
    //             mkdir(dirname($finalPath), 0777, true);
    //         }

    //         // Merge all chunks into a single file
    //         $out = fopen($finalPath, 'wb');
    //         for ($i = 1; $i <= $totalChunks; $i++) {
    //             $chunkFile = $tempDir . '/' . $i;
    //             $in = fopen($chunkFile, 'rb');
    //             while ($buffer = fread($in, 4096)) {
    //                 fwrite($out, $buffer);
    //             }
    //             fclose($in);
    //             unlink($chunkFile); // Delete chunk after merging
    //         }
    //         fclose($out);
    //         rmdir($tempDir); // Remove the temporary directory

    //         // Save file details to the database
    //         $course = Course::find($courseId);
    //         if ($course) {
    //             CoursesAssets::create([
    //                 'id' => (string) Guid::uuid4(),
    //                 'course_id' => $courseId,
    //                 'chapter_id' => $chapterId,
    //                 'blog_name' => $blogName,
    //                 'topic_name' => $topicName,
    //                 'assets_discription' => $assetsDiscription,
    //                 'topic_image' => $topicImage,
    //                 'no_of_blog' => $blog,
    //                 'video_links' => $videoLinks,
    //                 'blogstatus' => $blogStatus,
    //                 'course_assets_video' => 'assets_videos/' . $fileName, // Save the file path
    //             ]);

    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Video uploaded and data saved successfully!',
    //                 'path' => 'assets_videos/' . $fileName,
    //             ]);
    //         } else {
    //             return response()->json(['error' => 'Course not found'], 404);
    //         }
    //     }

    //     return response()->json(['success' => true, 'message' => 'Chunk uploaded successfully!']);
    // }

    public function submitAssets(Request $request)
    {



        $fileName = $request->input('fileName');
        $chunkNumber = $request->input('chunkNumber');
        $totalChunks = $request->input('totalChunks');
        $file = $request->file('file');
        $courseId = $request->input('course_id');
        $chapterId = $request->input('chapter_id');
        $topicName = $request->input('topicName');
        $blogName = $request->input('blog_name');
        $assetsDiscription = $request->input('assets_discription', ''); // Optional
        $blog = $request->input('blog', ''); // Optional
        $topicImage = $request->file('topic_image'); // Image file (use file() instead of input())
        $videoLinks = $request->input('video_links', ''); // Optional
        $blogStatus = $request->input('blogstatus'); // Required

        // File validation
        if (!$file) {
            return response()->json(['error' => 'File not provided'], 400);
        }

        // Validate required fields
        if (!$courseId || !$chapterId || !$blogName || !$blogStatus) {
            return response()->json(['error' => 'Required fields missing: Course ID, Chapter ID, Blog Name, and Blog Status'], 400);
        }

        // Temporary directory for chunks
        $tempDir = storage_path('app/chunks/' . md5($fileName));
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Save the uploaded chunk
        $chunkPath = $tempDir . '/' . $chunkNumber;
        $file->move($tempDir, $chunkNumber);

        // Check if all chunks are uploaded
        if ($chunkNumber == $totalChunks) {
            $finalPath = storage_path('app/public/assets_videos/' . $fileName);

            if (!is_dir(dirname($finalPath))) {
                mkdir(dirname($finalPath), 0777, true);
            }

            // Merge all chunks into a single file
            $out = fopen($finalPath, 'wb');
            for ($i = 1; $i <= $totalChunks; $i++) {
                $chunkFile = $tempDir . '/' . $i;
                $in = fopen($chunkFile, 'rb');
                while ($buffer = fread($in, 4096)) {
                    fwrite($out, $buffer);
                }
                fclose($in);
                unlink($chunkFile); // Delete chunk after merging
            }
            fclose($out);
            rmdir($tempDir); // Remove the temporary directory

            // Handle topic image upload
            $topicImagePath = null;



            if ($topicImage) {
                $imageName = uniqid() . '.' . $topicImage->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/assets_images');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $topicImage->move($destinationPath, $imageName);
                $topicImagePath = 'assets_images/' . $imageName;
                Log::info('Image successfully uploaded to: ' . $destinationPath . '/' . $imageName);
            }


            // Save file details to the database
            $course = Course::find($courseId);
            if ($course) {
                CoursesAssets::create([
                    'id' => (string) Guid::uuid4(),
                    'course_id' => $courseId,
                    'chapter_id' => $chapterId,
                    'blog_name' => $blogName,
                    'topic_name' => $topicName,
                    'assets_discription' => $assetsDiscription,
                    'topic_image' => $topicImagePath, // Save image path
                    'no_of_blog' => $blog,
                    'video_links' => $videoLinks,
                    'blogstatus' => $blogStatus,
                    'course_assets_video' => 'assets_videos/' . $fileName, // Save video path
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Video and image uploaded, and data saved successfully!',
                    'video_path' => 'assets_videos/' . $fileName,
                    'image_path' => $topicImagePath,
                ]);
            } else {
                return response()->json(['error' => 'Course not found'], 404);
            }
        }

        return response()->json(['success' => true, 'message' => 'Chunk uploaded successfully!']);
    }



    public function add_assets(Request $request, $id)
    {
        return view('courses.create_chepter', compact('id'));
        // return view('courses.assets_create', compact('id'));
    }

    public function chepter_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'chepter_name' => 'required|max:255',
            'chepter_discription' => 'required',
            'no_of_chepter' => 'required|in:1,0',
            'mode' => 'required|in:1,0',
            'status' => 'required|in:1,0',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $chapter = CoursesChepters::create(
                [
                    'id' => (string) Guid::uuid4(),
                    'chepter_name' => $request->chepter_name,
                    'courses_id' => $request->course_id,
                    'chepter_discription' => $request->chepter_discription,
                    'no_of_chepter' => $request->status,
                    'status' => $request->status,
                    'mode' => $request->mode,
                ]

            );
            $chapter_id = $chapter->id;
            $course_id = $request->course_id;
            return redirect()
                ->route('blogs.assets.form')
                ->with('success', 'Chapter created successfully!')
                ->with('course_id', $course_id)
                ->with('chapter_id', $chapter_id);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something want wrong');
        }
    }

    public function blog_assets()
    {
        return view('courses.create_blogs_assets');
    }


    public function blog_assets_submit(Request $request)
    {
        dd($request);
    }




    public function courseadd(Request $request)

    {
        return view('courses.add');
    }

    public function getUsers(Request $request)
    {
        return response()->json(User::select('id', 'name', 'type')->where('type', 'Student')->where('status', 1)->get());
    }

    public function getTeachers(Request $request)
    {
        return response()->json(User::select('id', 'name', 'type')->where('type', 'Teacher')->where('status', 1)->get());
    }

    public function couserassign(Request $request)
    {
        $courseId = $request->input('course_id');
        $userIds = $request->input('users', []);
        foreach ($userIds as $userId) {
            $uuid = (string) Guid::uuid4();
            CoursesAssign::updateOrCreate(
                ['courses_id' => $courseId, 'users_id' => $userId],
                ['id' => $uuid]
            );
        }
        return redirect()->back()->with('success', 'Courses assigned successfully!');
    }


    public function createCourse(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'course_full_name' => 'required|string|max:255',
            'course_short_name' => 'required|string|max:255',
            'course_category' => 'required|string|max:100',
            'course_id_number' => 'required|nullable|string|max:50',
            'course_status' => 'required|boolean',
            'downloa_status' => 'nullable|boolean',
            'course_summary' => 'required|nullable|string|max:1000',
            'course_image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'course_layout' => 'nullable|string|max:255',
            'course_format' => 'nullable|string|max:100',
            'tags' => 'required|nullable|array',
            'tags.*' => 'string|max:50',
        ]);


        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $tags = $request->tags; // This should be an array like ['Basic', 'Advanced', 'Intermediate']
        $tagsString = implode(',', $tags);
        $uuid = (string) Guid::uuid4();

        try {
            $course = new Course();
            $course->id = $uuid;
            $course->course_full_name = $request->course_full_name;
            $course->course_short_name = $request->course_short_name;
            $course->course_category = $request->course_category;
            $course->course_start_date = null;
            $course->course_end_date = null;
            $course->course_id_number = $request->course_id_number;
            $course->course_status = $request->course_status;
            $course->downloa_status = $request->downloa_status ?? 0;
            $course->course_summary = $request->course_summary;
            $course->hidden_section = null;
            $course->course_layout = $request->course_layout;
            $course->course_sections = null;
            $course->force_theme = null;
            $course->force_language = null;
            $course->no_announcements = null;
            $course->gradebook_student = null;
            $course->activity_report = null;
            $course->activity_date = null;
            $course->file_uploads_size = null;
            $course->completion_tracking = null;
            $course->activity_completion_conditions = null;
            $course->group_mode = null;
            $course->force_group_mode = null;
            $course->default_group = null;
            $course->course_format = $request->course_format;
            $course->tags = $tagsString;
            $course->module_credit = null;

            if ($request->hasFile('course_image')) {
                $filePath = $request->file('course_image')->store('courses', 'public');
                $course->course_image = $filePath;
            }

            $course->save();

            return redirect('courses')->with('success', 'Course Create successfully.');
        } catch (\Exception $e) {

             return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }






    public function courselist(Request $request)
    {
        $userId = Auth::user()->id;
        $userType = Auth::user()->type;
        if ($userType == 'Superadmin' || $userType == 'Admin' || $userType == 'Staff') {
            $query = Course::query();
        } else {
            $query = CoursesAssign::where('users_id', $userId)->where('courses.course_status', 1)->join('courses', 'courses.id', '=', 'courses_assign.courses_id');
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


        $validator = Validator::make($request->all(), [
            'course_full_name' => 'required|string|max:255',
            'course_short_name' => 'required|string|max:255',
            'course_category' => 'required|string|max:100',
            'course_id_number' => 'required|nullable|string|max:50',
            'course_status' => 'required|boolean',
            'downloa_status' => 'nullable|boolean',
            'course_summary' => 'required|nullable|string|max:1000',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'course_layout' => 'required|nullable|string|max:255',
            'course_format' => 'required|nullable|string|max:100',
            'tags' => 'required|nullable|array',
            'tags.*' => 'string|max:50',


            // 'hidden_section' => 'nullable|string|max:255',
            // 'course_sections' => 'required|integer|min:0|max:100',
            // 'force_theme' => 'nullable|string|max:50',
            // 'force_language' => 'nullable|string|max:50',
            // 'no_announcements' => 'nullable|integer|min:0|max:255',
            // 'gradebook_student' => 'nullable|boolean',
            // 'activity_report' => 'nullable|boolean',
            // 'activity_date' => 'nullable|boolean',
            // 'file_uploads_size' => 'required',
            // 'completion_tracking' => 'nullable|in:0,1',
            // 'activity_completion_conditions' => 'nullable|in:0,1',
            // 'group_mode' => 'nullable|string|max:50',
            // 'force_group_mode' => 'nullable|boolean',
            // 'default_group' => 'nullable|string|max:50',
            // 'module_credit' => 'nullable|integer|min:0|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $course = Course::find($id);
        if (!$course) {
            // return response()->json(['success' => false, 'message' => 'Course not found'], 404);
            return redirect()->back()->with('error', 'Course not found.');
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
            $course->hidden_section = null;
            $course->course_layout = $request->course_layout;
            $course->course_sections = null;
            $course->force_theme = null;
            $course->force_language = null;
            $course->no_announcements = null;
            $course->gradebook_student = null;
            $course->activity_report = null;
            $course->activity_date = null;
            $course->file_uploads_size = null;
            $course->completion_tracking = null;
            $course->activity_completion_conditions = null;
            $course->group_mode = null;
            $course->force_group_mode = null;
            $course->default_group = null;
            $course->course_format = $request->course_format;
            $course->tags = $tagsString;
            $course->module_credit = null;

            if ($request->hasFile('course_image')) {
                $filePath = $request->file('course_image')->store('courses', 'public');
                $course->course_image = $filePath;
            }
            $course->save();
            return redirect('courses')->with('success', 'Course Updated successfully.');
        } catch (\Exception $e) {

             return redirect()->back()->with('error', 'Something went wrong. Please try again.');
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
