<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CoursesAssets;
use App\Models\CoursesAssign;
use App\Models\CoursesChepters;
use App\Models\User;
use App\Models\UsersPermission;
use App\Models\Permission;
use App\Models\CoursesRemark;
use App\Models\CoursesCategory;
use App\Models\CourseSection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\session;

class CourseController extends Controller
{

    public function delete_section($id)
    {
        $course = CourseSection::find($id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'Section delete successfully.');
        } else {
            return redirect()->back()->with('error', 'Section ID not found.');
        }
    }
    public function create_section(Request $request, $slug)
    {
        $courseId = Course::where('slug', $slug)->first();
        $id = $courseId->id;
        return view('courses.create_sections', compact('id', 'slug'));
    }

    public function section_list($slug)
    {

        $sections = Course::select('courses_sections.*')->where('slug', $slug)->join('courses_sections', 'courses_sections.courses_id', '=', 'courses.id')->get();

        return view('courses.section_list', compact('sections'));
    }

    public function update_section(Request $request)
    {
        $section = CourseSection::find($request->id);
        if (!$section) {
            return response()->json(['error' => 'Section not found'], 404);
        }

        $section->update([
            'sections_remark' => $request->sections_remark
        ]);

        return response()->json(['success' => 'Section updated successfully']);
    }





    public function section_submit(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|uuid',
            'course_start_date' => 'required|date',
            'sections' => 'required|array',
            'sections.*' => 'string|max:500', // Increased max length
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Loop through sections and save each date as a new record
        foreach ($request->sections as $date => $content) {
            CourseSection::create([
                'id' => (string) Guid::uuid4(),
                'courses_id' => $request->course_id,
                'course_start_date' => $request->course_start_date,
                'sections_remark_date' => $date, // Store the section date
                'sections_remark' => $content, // Store the section content
                'status' => $request->status,
            ]);
        }

        return redirect()->back()->with('success', 'Sections create successfully.');
    }



    // public function updateAssets(Request $request)
    // {


    //     try {
    //         // Validation
    //         $validator = Validator::make($request->all(), [
    //             'assets_id' => 'required|exists:courses_assets,id',
    //             'course_id' => 'required|exists:courses,id',
    //             'chapter_id' => 'required|exists:courses_chapters,id',
    //             'topicName' => 'required|string|max:255',
    //             'assetstype' => 'required|in:blog,url,videos,youtube',
    //             'status' => 'required|boolean',
    //             'fileName' => 'required_if:assetstype,videos|string',
    //             'chunkNumber' => 'required_if:assetstype,videos|integer',
    //             'totalChunks' => 'required_if:assetstype,videos|integer',
    //             'file' => 'required_if:assetstype,videos|file',
    //             'assets_discription' => 'nullable|string',
    //             'videourl' => 'nullable|url',
    //             'youtubelink' => 'nullable|url',
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => $validator->errors()->first(),
    //             ], 400);
    //         }

    //         // Fetch the existing asset
    //         $asset = CoursesAssets::findOrFail($request->assets_id);

    //         // Handle video uploads for 'videos' type
    //         $videoPath = $asset->assets_video; // Preserve the current video path
    //         if ($request->input('assetstype') === 'videos') {
    //             $fileName = $request->input('fileName');
    //             $chunkNumber = $request->input('chunkNumber');
    //             $totalChunks = $request->input('totalChunks');
    //             $file = $request->file('file');

    //             $tempDir = storage_path('app/chunks/' . md5($fileName));
    //             if (!is_dir($tempDir)) {
    //                 mkdir($tempDir, 0777, true);
    //             }

    //             $chunkPath = $tempDir . '/' . $chunkNumber;
    //             $file->move($tempDir, $chunkNumber);

    //             if ($chunkNumber == $totalChunks) {
    //                 $finalPath = storage_path('app/public/assets_videos/' . $fileName);
    //                 if (!is_dir(dirname($finalPath))) {
    //                     mkdir(dirname($finalPath), 0777, true);
    //                 }

    //                 try {
    //                     $out = fopen($finalPath, 'wb');
    //                     for ($i = 1; $i <= $totalChunks; $i++) {
    //                         $chunkFile = $tempDir . '/' . $i;

    //                         if (!file_exists($chunkFile)) {
    //                             throw new \Exception("Chunk {$i} is missing.");
    //                         }

    //                         $in = fopen($chunkFile, 'rb');
    //                         while ($buffer = fread($in, 4096)) {
    //                             fwrite($out, $buffer);
    //                         }
    //                         fclose($in);
    //                         unlink($chunkFile);
    //                     }
    //                     fclose($out);
    //                     rmdir($tempDir);

    //                     $videoPath = 'assets_videos/' . $fileName; // Update video path
    //                 } catch (\Exception $e) {
    //                     return response()->json([
    //                         'success' => false,
    //                         'message' => 'Error merging video chunks.',
    //                     ], 500);
    //                 }
    //             }

    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Video chunks uploaded. Waiting for merge.',
    //             ]);
    //         }

    //         // Update the asset record
    //         $asset->update([
    //             'course_id' => $request->input('course_id'),
    //             'chapter_id' => $request->input('chapter_id'),
    //             'topic_name' => $request->input('topicName'),
    //             'assets_type' => $request->input('assetstype'),
    //             'blog_description' => $request->input('assets_discription', ''),
    //             'video_url' => $request->input('videourl', ''),
    //             'youtube_links' => $request->input('youtubelink', ''),
    //             'assets_video' => $videoPath, // Updated or original video path
    //             'status' => $request->input('status'),
    //         ]);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Assets updated successfully!',
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Something went wrong. Please try again.',
    //         ], 500);
    //     }
    // }

    public function updateAssets(Request $request)
    {
        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'assets_id' => 'required|exists:courses_assets,id',
                'course_id' => 'required|exists:courses,id',
                'chapter_id' => 'required',
                'topicName' => 'required|string|max:255',
                'assetstype' => 'required|in:blog,url,videos,youtube',
                'status' => 'required|boolean',
                'fileName' => 'required_if:assetstype,videos|string',
                'chunkNumber' => 'required_if:assetstype,videos|integer',
                'totalChunks' => 'required_if:assetstype,videos|integer',
                'file' => 'required_if:assetstype,videos|file',
                'assets_discription' => 'nullable|string',
                'videourl' => 'nullable',
                'youtubelink' => 'nullable',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ], 400);
            }

            // Fetch the existing asset
            $asset = CoursesAssets::findOrFail($request->assets_id);

            // Handle video uploads for 'videos' type
            $videoPath = $asset->assets_video; // Preserve the current video path
            if ($request->input('assetstype') === 'videos') {
                $fileName = $request->input('fileName');
                $chunkNumber = $request->input('chunkNumber');
                $totalChunks = $request->input('totalChunks');
                $file = $request->file('file');

                $tempDir = storage_path('app/chunks/' . md5($fileName));
                if (!is_dir($tempDir)) {
                    mkdir($tempDir, 0777, true);
                }

                $chunkPath = $tempDir . '/' . $chunkNumber;
                $file->move($tempDir, $chunkNumber);

                if ($chunkNumber == $totalChunks) {
                    $finalPath = storage_path('app/public/assets_videos/' . $fileName);
                    if (!is_dir(dirname($finalPath))) {
                        mkdir(dirname($finalPath), 0777, true);
                    }

                    try {
                        $out = fopen($finalPath, 'wb');
                        for ($i = 1; $i <= $totalChunks; $i++) {
                            $chunkFile = $tempDir . '/' . $i;

                            if (!file_exists($chunkFile)) {
                                throw new \Exception("Chunk {$i} is missing.");
                            }

                            $in = fopen($chunkFile, 'rb');
                            while ($buffer = fread($in, 4096)) {
                                fwrite($out, $buffer);
                            }
                            fclose($in);
                            unlink($chunkFile);
                        }
                        fclose($out);
                        rmdir($tempDir);

                        $videoPath = 'assets_videos/' . $fileName; // Update video path
                    } catch (\Exception $e) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Error merging video chunks.',
                        ], 500);
                    }
                } else {
                    // Respond for intermediate chunks
                    return response()->json([
                        'success' => true,
                        'message' => 'Video chunks uploaded. Waiting for merge.',
                    ]);
                }
            }

            // Update the asset record
            $asset->update([
                'course_id' => $request->input('course_id'),
                'chapter_id' => $request->input('chapter_id'),
                'topic_name' => $request->input('topicName'),
                'assets_type' => $request->input('assetstype'),
                'blog_description' => $request->input('assets_discription', ''),
                'video_url' => $request->input('videourl', ''),
                'youtube_links' => $request->input('youtubelink', ''),
                'assets_video' => $videoPath, // Updated or original video path
                'status' => $request->input('status'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Assets updated successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }



    public function assetsedit(Request $request)
    {

        $id = $request->assets_id;
        $data = CoursesAssets::find($id);
        return view('courses.assets_edit', compact('data'));
    }

    public function blog_assets(Request $request)
    {
        $chapterId = $request->chapter_id;
        $courseId = $request->course_id;
        $assetsdata = CoursesAssets::where('chapter_id', $chapterId)->get();


        return view('courses.create_blogs_assets', compact('chapterId', 'courseId', 'assetsdata'));
    }

    public function manage_activity($slug)
    {
        $chapterId = '11';
        $coursesdata = Course::where('slug', $slug)->first();
        $courseId = $coursesdata->id;
        $assetsdata = CoursesAssets::where(['course_id' => $courseId, 'chapter_id' => 11])->get();

        return view('courses.create_blogs_assets', compact('chapterId', 'courseId', 'assetsdata'));
    }


    public function assetsdelete($id)
    {
        $course = CoursesAssets::find($id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'Assets deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Assets ID not found.');
        }
    }


    public function chapterupdate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:courses_chapters,id',
            'chepter_name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $chapter = CoursesChepters::findOrFail($request->id);
        $chapter->chepter_name = $request->chepter_name;
        $chapter->status = $request->status;
        $chapter->save();

        return redirect()->back()->with('success', 'Chapter updated successfully!');
    }


    public function chapterdelete($id)
    {
        $course = CoursesChepters::find($id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'Chapter deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Chapter ID not found.');
        }
    }
    public function chapterStatus(Request $request)
    {
        $user = CoursesChepters::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();

        return redirect()->back()->with('success', 'Chapter status updated successfully!');
    }

    public function assetsStatus(Request $request)
    {
        $user = CoursesAssets::findOrFail($request->asset_id);
        $user->status = $request->status;
        $user->save();

        return redirect()->back()->with('success', 'Assets status updated successfully!');
    }

    public function add_assets(Request $request, $slug)
    {
        $courseId = Course::where('slug', $slug)->first();
        $id = $courseId->id;

        $data = CoursesChepters::where('courses_id', $id)->latest()->get();

        return view('courses.create_chepter', compact('id', 'data'));
    }


    public function uploadQuizes(Request $request){
        dd($request->all());
    }



    public function chepter_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'chepter_name' => 'required|max:255',
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
                    'chepter_discription' => null,
                    'no_of_chepter' => null,
                    'status' => $request->status,
                    'mode' => null,
                ]
            );
            // $chapter_id = $chapter->id;
            // $course_id = $request->course_id;

            // session::put('courses_id', $course_id);
            // session::put('chapter_id', $chapter_id);

            return redirect()->back()->with('success', 'Chapter created successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something want wrong');
        }
    }




    public function blog_assets_submit(Request $request)
    {
        dd($request);
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

        $slug = $this->generateUniqueSlug($request->course_full_name);

        try {
            $course = new Course();
            $course->id = $uuid;
            $course->slug = $slug;

            $course->user_id = Auth::user()->id;
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
            return redirect()->route('after_course_create', ['slug' => $slug])->with('success', 'Course Create successfully.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    private function generateUniqueSlug($courseFullName)
    {
        $slug = Str::slug($courseFullName);
        $originalSlug = $slug;
        $counter = 1;
        while (Course::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        return $slug;
    }


    public function courses_pause_users(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'assign_id' => 'required|exists:courses_assign,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $assignId = $request->assign_id;
        $assignStatus = CoursesAssign::where('id', $assignId)->value('status');
        $newStatus = ($assignStatus == 1) ? 0 : 1;
        $updated = CoursesAssign::where('id', $assignId)->update(['status' => $newStatus]);


        if ($updated) {
            $statusMessage = $newStatus == 1 ? 'Active' : 'Paused';
            return redirect()->back()->with('success', "User  \"{$statusMessage}\" successfully.");
        } else {
            return redirect()->back()->with('error', 'Failed to update status.');
        }
    }


    public function assigned_delete_with_remark(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'assign_id' => 'required|exists:courses_assign,id',
            'remark' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $assignId = $request->assign_id;
        $remark = $request->remark;

        $courseAssign = CoursesAssign::find($assignId);
        $uuid = (string) Guid::uuid4();
        if ($courseAssign) {
            // Log the remark (optional: create a separate table for remarks if needed)
            CoursesRemark::create([
                'id' => $uuid,
                'users_id' => $courseAssign->users_id,
                'courses_id' => $courseAssign->courses_id,
                'remarks' => $remark,
            ]);

            // Remove the assignment
            $courseAssign->delete();

            return redirect()->back()->with('success', 'User removed and remark saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Assigned ID not found.');
        }
    }



    public function assigned_delete($id)
    {
        $course = CoursesAssign::find($id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'Assigned User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Assigned ID not found.');
        }
    }


    public function getUserPermissions(Request $request, $userId)
    {
        $assignedPermissions = UsersPermission::where('user_id', $userId)
            ->pluck('permission_id') // Get only the permission IDs
            ->toArray();

        return response()->json($assignedPermissions);
    }

    // public function updatePermissions(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'user_id' => 'required|exists:users,id',
    //         'permissions' => 'required|array',
    //         'permissions.*' => 'exists:permissions,id',
    //     ]);

    //     if ($validator->fails()) {
    //         return back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $userId = $request->user_id;
    //     $permissions = $request->permissions;

    //     foreach ($permissions as $permissionId) {
    //         $uuid = (string) Guid::uuid4();
    //         UsersPermission::updateOrCreate(
    //             [
    //                 'user_id' => $userId,
    //                 'permission_id' => $permissionId,
    //             ],
    //             [
    //                 'id' => $uuid,
    //             ]
    //         );
    //     }

    //     return redirect()->back()->with('success', 'Permissions assigned successfully!');
    // }

    public function updatePermissions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'permissions' => 'nullable|array', // Allow permissions to be null or an array
            'permissions.*' => 'exists:permissions,id',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $userId = $request->user_id;
        $permissions = $request->permissions;

        if (is_null($permissions)) {
            // If permissions is null, delete all permissions for the user
            UsersPermission::where('user_id', $userId)->delete();

            return redirect()->back()->with('success', 'All permissions removed for the user!');
        }

        // Delete old permissions for the user
        UsersPermission::where('user_id', $userId)->delete();

        // Insert new permissions
        foreach ($permissions as $permissionId) {
            $uuid = (string) Guid::uuid4();
            UsersPermission::create([
                'id' => $uuid,
                'user_id' => $userId,
                'permission_id' => $permissionId,
            ]);
        }

        return redirect()->back()->with('success', 'Permissions updated successfully!');
    }






    public function courseedit(Request $request, $slug)
    {

        $course = Course::where('slug', $slug)->first();

        if ($course) {
            $id = $course->id;
            $data = CoursesAssign::select('users.*', 'courses_assign.id as assignId', 'courses_assign.status as assignStatus')
                ->where('courses_id', $id)->where('users.type', 'Teacher')
                ->join('users', 'users.id', 'courses_assign.users_id')
                ->paginate(10);

            $assignedTeachersIds = CoursesAssign::where('courses_id', $id)
                ->pluck('users_id'); // Get all assigned teacher IDs for the course

            $availableTeachers = User::where('type', 'Teacher') // Get only teachers
                ->whereNotIn('id', $assignedTeachersIds) // Exclude assigned teachers
                ->paginate(10);


            $userdata = CoursesAssign::select('users.*', 'courses_assign.id as assignId', 'courses_assign.status as assignStatus')
                ->where('courses_id', $id)->where('users.type', 'Student')
                ->join('users', 'users.id', 'courses_assign.users_id')
                ->paginate(10);

            $assignedUsersIds = CoursesAssign::where('courses_id', $id)
                ->pluck('users_id'); // Get all assigned teacher IDs for the course

            $availableUsers = User::where('type', 'Student') // Get only teachers
                ->whereNotIn('id', $assignedUsersIds) // Exclude assigned teachers
                ->paginate(10);

            $categories = CoursesCategory::all();

            $courseName = 'course';
            $permissions = Permission::where('name', 'LIKE', '%' . 'course' . '%')->get();

            return view('courses.course_edit', compact('course', 'categories', 'data', 'availableTeachers', 'userdata', 'availableUsers', 'id', 'permissions'));
        } else {
            return redirect()->route('courses')->with('error', 'Course not found.');
        }
    }



    public function courses_category()
    {

        $roles = CoursesCategory::all();
        return view('courses.course_category', compact('roles'));
    }

    public function submit_category(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:courses_category,name',
            'displayname' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            CoursesCategory::create([

                'name' => $request->name,
                'display_name' => $request->displayname,
                'description' => $request->description,
            ]);


            return redirect()->back()
                ->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
    public function category_delete($id)
    {
        if (Gate::denies('role')) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }
        $course = CoursesCategory::find($id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Category ID not found.');
        }
    }

    public function update_category(Request $request)
    {
        $permission = CoursesCategory::findOrFail($request->id);

        $permission->update([
            'name' => $request->name,
            'display_name' => $request->displayname,
            'description' => $request->description,
        ]);

        return redirect()->route('course.category')->with('success', 'Category updated successfully!');
    }

    public function submitAssets(Request $request)
    {

        // Validation
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
            'chapter_id' => 'required',
            'topicName' => 'required|string|max:255',
            'assetstype' => 'required|in:blog,url,videos,youtube',
            'status' => 'required|boolean',
            'fileName' => 'required_if:assetstype,videos|string',
            'chunkNumber' => 'required_if:assetstype,videos|integer',
            'totalChunks' => 'required_if:assetstype,videos|integer',
            'file' => 'required_if:assetstype,videos|file',
            'assets_discription' => 'nullable|string',
            'videourl' => 'nullable',
            'youtubelink' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 400);
        }


        try {
            $videoPath = null;

            // Handle chunk-based video uploads
            if ($request->input('assetstype') === 'videos') {
                $fileName = $request->input('fileName');
                $chunkNumber = $request->input('chunkNumber');
                $totalChunks = $request->input('totalChunks');
                $file = $request->file('file');

                $tempDir = storage_path('app/chunks/' . md5($fileName));
                if (!is_dir($tempDir)) {
                    mkdir($tempDir, 0777, true);
                }

                $chunkPath = $tempDir . '/' . $chunkNumber;
                $file->move($tempDir, $chunkNumber);

                if ($chunkNumber == $totalChunks) {
                    $finalPath = storage_path('app/public/assets_videos/' . $fileName);
                    if (!is_dir(dirname($finalPath))) {
                        mkdir(dirname($finalPath), 0777, true);
                    }

                    try {
                        $out = fopen($finalPath, 'wb');
                        for ($i = 1; $i <= $totalChunks; $i++) {
                            $chunkFile = $tempDir . '/' . $i;

                            if (!file_exists($chunkFile)) {
                                throw new \Exception("Chunk {$i} is missing.");
                            }

                            $in = fopen($chunkFile, 'rb');
                            while ($buffer = fread($in, 4096)) {
                                fwrite($out, $buffer);
                            }
                            fclose($in);
                            unlink($chunkFile);
                        }
                        fclose($out);
                        rmdir($tempDir);

                        $videoPath = 'assets_videos/' . $fileName;

                        // Create the database record after merging all chunks
                        CoursesAssets::create([
                            'id' => (string) Guid::uuid4(),
                            'course_id' => $request->input('course_id'),
                            'chapter_id' => $request->input('chapter_id'),
                            'topic_name' => $request->input('topicName'),
                            'assets_type' => $request->input('assetstype'),
                            'blog_description' => $request->input('assets_discription', ''),
                            'video_url' => $request->input('videourl', ''),
                            'youtube_links' => $request->input('youtubelink', ''),
                            'assets_video' => $videoPath,
                            'status' => $request->input('status'),
                        ]);
                    } catch (\Exception $e) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Error merging video chunks.',
                        ], 500);
                    }
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Video chunks uploaded. Waiting for merge.',
                ]);
            }

            // Handle other asset types (blog, url, youtube)
            CoursesAssets::create([
                'id' => (string) Guid::uuid4(),
                'course_id' => $request->input('course_id'),
                'chapter_id' => $request->input('chapter_id'),
                'topic_name' => $request->input('topicName'),
                'assets_type' => $request->input('assetstype'),
                'blog_description' => $request->input('assets_discription', ''),
                'video_url' => $request->input('videourl', ''),
                'youtube_links' => $request->input('youtubelink', ''),
                'assets_video' => null,
                'status' => $request->input('status'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Assets Created successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }




    public function courseadd(Request $request)
    {
        $categories = CoursesCategory::all();
        return view('courses.add', compact('categories'));
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
        $userIds = $request->input('user_id');
        $uuid = (string) Guid::uuid4();
        CoursesAssign::updateOrCreate(
            ['courses_id' => $courseId, 'users_id' => $userIds],
            ['id' => $uuid]
        );
        return redirect()->back()->with('success', 'Courses assigned successfully!');
    }




    public function courselist(Request $request)
    {
        $userId = Auth::user()->id;

        $userType = Auth::user()->type;
        if ($userType == 'Superadmin' || $userType == 'Admin' || $userType == 'Staff') {
            $query = Course::where('user_id', $userId);
        } else {
            $query = CoursesAssign::where('users_id', $userId)->where('courses.course_status', 1)->where('courses_assign.status', 1)->join('courses', 'courses.id', '=', 'courses_assign.courses_id');
        }

        if ($request->has('name')) {
            $query->where('courses.course_full_name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('category')) {
            $query->where('courses.course_category', 'like', '%' . $request->category . '%');
        }
        $courses = $query->latest('courses.created_at')->paginate(12);

        $users = User::where('status', 1)->get();
        $categories = CoursesCategory::all();

        return view('courses.list', compact('courses', 'users', 'categories'));
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
        $slug = $this->generateUniqueSlug($request->course_full_name);
        try {
            $course->course_full_name = $request->course_full_name;
            $course->slug = $slug;
            $course->user_id = Auth::user()->id;
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

        return redirect()->back()->with('success', 'Courses status updated successfully!');
    }
}
