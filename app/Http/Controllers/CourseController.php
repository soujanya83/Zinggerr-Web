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
use App\Models\CourseUserPermission;
use App\Models\CourseSection;
use App\Models\InteractiveAsset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\session;
use Illuminate\Validation\Rule;
use App\Models\FillBlanks;
use App\Notifications\CourseCreatedNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\VideoQuiz;
use Illuminate\Support\Collection;
use App\Models\MontessoriAgeGroup;
use App\Models\MontessoriAreas;
use App\Notifications\CourseAssignedNotification;
class CourseController extends Controller
{

    public function courseadd(Request $request)
    {
        $montessori_area = $request->has('montessori_area') ? ucwords($request->montessori_area) : null;
        $montessori_agegroup = $request->has('montessori_agegroup') ? ucwords($request->montessori_agegroup) : null;

        $userid = Auth::user()->id;
        $categories = CoursesCategory::where('user_id', $userid)->get();

        $agegroup = MontessoriAgeGroup::where('status', 1)->orderBy('created_at', 'asc')->get();
        $areas = MontessoriAreas::where('status', 1)->orderBy('created_at', 'asc')->get();

        return view('courses.add', compact('categories', 'agegroup', 'areas', 'montessori_area', 'montessori_agegroup'));
    }


    public function courseedit(Request $request, $slug)
    {
        $agegroups = MontessoriAgeGroup::where('status', 1)->orderBy('created_at', 'asc')->get();
        $areas = MontessoriAreas::where('status', 1)->orderBy('created_at', 'asc')->get();

        $userId = Auth::user()->id;
        $course = Course::where('slug', $slug)->first();

        if ($course) {
            $id = $course->id;
            $data = CoursesAssign::select('users.*', 'courses_assign.id as assignId', 'courses_assign.status as assignStatus')
                ->where('courses_id', $id)->where('users.type', 'Faculty')->where('users.user_id', $userId)
                ->join('users', 'users.id', 'courses_assign.users_id')
                ->paginate(10);

            $assignedTeachersIds = CoursesAssign::where('courses_id', $id)
                ->pluck('users_id');

            $availableTeachers = User::where('type', 'Faculty')->where('user_id', $userId)
                ->whereNotIn('id', $assignedTeachersIds) // Exclude assigned teachers
                ->paginate(10);


            $userdata = CoursesAssign::select('users.*', 'courses_assign.id as assignId', 'courses_assign.status as assignStatus')
                ->where('courses_id', $id)->where('users.type', 'Student')->where('users.user_id', $userId)
                ->join('users', 'users.id', 'courses_assign.users_id')
                ->paginate(10);

            $assignedUsersIds = CoursesAssign::where('courses_id', $id)
                ->pluck('users_id'); // Get all assigned teacher IDs for the course

            $availableUsers = User::where('type', 'Student')->where('user_id', $userId)
                ->whereNotIn('id', $assignedUsersIds) // Exclude assigned teachers
                ->paginate(10);

            $categories = CoursesCategory::all();

            $courseName = 'course';
            $permissionsdata = Permission::where('name', 'LIKE', '%' . 'course' . '%')->get();

            session()->put('course_id_f_edit', $id);

            // assets data get from(API) assets project


            $response = Http::timeout(0)->get('https://assets.zinggerr.com/api/course/assets-list');
            if ($response->failed()) {
                return back()->with('error', 'Failed to fetch data from API.');
            }
            $assetsData = $response->json()['data'];


            return view('courses.course_edit', compact(
                'course',
                'assetsData',
                'categories',
                'data',
                'availableTeachers',
                'userdata',
                'availableUsers',
                'id',
                'permissionsdata',
                'areas',
                'agegroups'
            ));
        } else {
            return redirect()->route('courses')->with('error', 'Course not found.');
        }
    }


    public function createCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_full_name' => 'required|string|max:255',
            'course_short_name' => 'required|string|max:255',
            // 'course_category' => 'required|string|max:100',
            'age_groups' => 'required|string|max:100',
            'areas' => 'required|string|max:100',
            'course_id_number' => 'nullable|string|max:50',
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

        // Step 1 back


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
            $course->course_category = $request->course_category ?? null;
            $course->age_group = $request->age_groups;
            $course->area = $request->areas;
            $course->course_start_date = null;
            $course->course_end_date = null;
            $course->course_id_number = $request->course_id_number ?? null;
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


            $users = User::where('user_id', Auth::user()->id)->get();
            $users->push(Auth::user());
            $uniqueUsers = $users->unique('id');
            Notification::send($uniqueUsers, new CourseCreatedNotification($course));

            return redirect()->route('after_course_create', ['slug' => $slug])->with('success', 'Course Create successfully.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function courseupdate(Request $request, $id)
    {
        $formattedAgeGroup = Str::slug($request->age_groups); // Converts "Toddlers" -> "toddlers"
        $formattedArea = Str::slug($request->areas); // Converts "Sensorial" -> "sensorial"
        $back_url = url('courses/' . $formattedAgeGroup . '/' . $formattedArea);

        $validator = Validator::make($request->all(), [
            'course_full_name' => 'required|string|max:255',
            'course_short_name' => 'required|string|max:255',
            // 'course_category' => 'required|string|max:100',
            'age_groups' => 'required|string|max:100',
            'areas' => 'required|string|max:100',
            'course_id_number' => 'nullable|string|max:50',
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
            $course->course_category = $request->course_category ?? null;
            $course->course_start_date = $request->course_start_date;
            $course->course_end_date = $request->course_end_date;
            $course->course_id_number = $request->course_id_number ?? null;
            $course->course_status = $request->course_status;
            $course->downloa_status = $request->downloa_status ?? 0;
            $course->course_summary = $request->course_summary;

            $course->age_group = $request->age_groups;
            $course->area = $request->areas;

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

            // $users = User::where('user_id', Auth::user()->id)->get();
            // $users->push(Auth::user());
            // $uniqueUsers = $users->unique('id');
            // Notification::send($uniqueUsers, new CourseCreatedNotification($course));

            return redirect($back_url)->with('success', 'Course Updated successfully.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }




    public function getInteractiveAsset($assetId)
    {
        try {
            $response = Http::timeout(10)->get('https://assets.zinggerr.com/api/course/assets-list');

            if ($response->failed()) {
                Log::error("API Request Failed: " . $response->body());
                return response()->json(['success' => false, 'message' => 'Failed to fetch data from API.'], 500);
            }

            $responseData = $response->json();

            if (!isset($responseData['data']) || !is_array($responseData['data'])) {
                Log::error("Invalid API Response: " . json_encode($responseData));
                return response()->json(['success' => false, 'message' => 'Invalid API response format.'], 500);
            }

            $filteredAsset = collect($responseData['data'])
                ->where('asset_id', $assetId)
                ->where('assets_type', 'interactive')
                ->first();

            if (!$filteredAsset) {
                return response()->json(['success' => false, 'message' => 'Interactive asset not found.'], 404);
            }

            return response()->json([
                'success' => true,
                'asset' => $filteredAsset
            ]);
        } catch (\Exception $e) {
            dd($e);
            Log::error("Error in API: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }



    public function setupinteractive(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'video_id' => 'required|string', // UUIDs are strings
            'asset_id' => 'required|string', // UUIDs are strings
            'video_time' => 'required|numeric' // Ensure it's a valid number
        ]);


        $videoPath = $request->input('video_id');

        // Remove domain dynamically and keep only the video file name
        $parsedUrl = parse_url($videoPath, PHP_URL_PATH); // Get only the path
        $videoName = str_replace('/storage/', '', $parsedUrl);

        // dd($videoName);

        try {
            // ✅ Create Checkpoint
            $checkpoint = InteractiveAsset::create([
                'id' => (string) Str::uuid(), // Generate UUID
                'video_id' => $videoName,
                'user_id' => Auth::user()->id, // Use Auth::id() for cleaner code
                'asset_id' => $validated['asset_id'],
                'checkpoint_time' => $validated['video_time'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Checkpoint saved successfully.',
                'data' => $checkpoint,
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function getvideointeractives(Request $request)
    {
        // Extract video name from the VideoPaths URL
        $videoPath = $request->video_name;

        // Remove domain dynamically and keep only the video file name
        $parsedUrl = parse_url($videoPath, PHP_URL_PATH); // Get only the path
        $videoName = str_replace('/storage/', '', $parsedUrl);
        //    dd($videoPath);

        $interactives = InteractiveAsset::where('video_id', $videoName)
            ->orderBy('checkpoint_time', 'asc')
            ->get();



        return response()->json([
            'success' => true,
            'interactives' => $interactives
        ]);
    }

    public function getassetdetails(Request $request)
    {
        $assetid = $request->asset_id;



        $response = Http::timeout(0)->get('https://assets.zinggerr.com/api/course/assets-list');

        if ($response->failed()) {
            return back()->with('error', 'Failed to fetch data from API.');
        }

        $assetsData = $response->json()['data'];

        // Filter assets by $assetid
        $filteredAssets = collect($assetsData)->where('asset_id', $assetid)->first();
        // dd($filteredAssets);


        return response()->json([
            'success' => true,
            'asset' => $filteredAssets
        ]);
    }
    public function deletefillintheblanks(Request $request)
    {

        try {

            $fillBlanks = FillBlanks::findOrFail($request->id);
            $fillBlanks->delete();

            return response()->json([
                'success' => true,
                'message' => 'fillBlanks deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error Deleting fill in the blanks: ' . $e->getMessage()
            ], 500);
        }
    }


    public function updatefillintheblanks(Request $request)
    {
        try {
            $validated = $request->validate([
                'video_time' => 'nullable|numeric',
                'instructions' => 'required|string',
                'sentence' => 'required|string',
                'answers' => 'required|array',
                'answers.*' => 'required|string',
                'is_skippable' => 'required|boolean',
                'position_x' => 'required|numeric',
                'position_y' => 'required|numeric',
                'VideoPaths' => 'nullable|string'
            ]);

            $fillBlanks = FillBlanks::findOrFail($request->id);

            // If VideoPaths is provided, update video_name accordingly
            // if ($request->has('VideoPaths')) {
            //     $videoPath = $request->input('VideoPaths');
            //     $parsedUrl = parse_url($videoPath, PHP_URL_PATH); // Get only the path
            //     $videoName = str_replace('/storage/', '', $parsedUrl);

            //     $getcourseassestdata = CoursesAssets::where('assets_video', $videoName)->first();

            //     if ($getcourseassestdata) {
            //         $fillBlanks->course_id = $getcourseassestdata->course_id;
            //         $fillBlanks->chapter_id = $getcourseassestdata->chapter_id;
            //         $fillBlanks->video_name = $videoName;
            //     }
            // }

            // Update the fillBlanks model with new data
            // $fillBlanks->video_time = $validated['video_time'] ?? $fillBlanks->video_time; // Only update if provided
            $fillBlanks->instructions = $validated['instructions'];
            $fillBlanks->sentence = $validated['sentence'];
            $fillBlanks->answers = json_encode($validated['answers']);
            $fillBlanks->skippable = $validated['is_skippable'];
            $fillBlanks->position_x = $validated['position_x'];
            $fillBlanks->position_y = $validated['position_y'];

            $fillBlanks->save();

            return response()->json([
                'success' => true,
                'message' => 'Fill in the blanks updated successfully',
                'data' => $fillBlanks
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating fill in the blanks: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteInteractive($id)
    {
        try {
            // Find and delete the quiz
            $quiz = InteractiveAsset::findOrFail($id);
            $quiz->delete();

            return response()->json([
                'success' => true,
                'message' => 'InterActive deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting quiz: ' . $e->getMessage()
            ], 500);
        }
    }
    public function deleteQuiz($id)
    {
        try {
            // Find and delete the quiz
            $quiz = VideoQuiz::findOrFail($id);
            $quiz->delete();

            return response()->json([
                'success' => true,
                'message' => 'Quiz deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting quiz: ' . $e->getMessage()
            ], 500);
        }
    }
    public function updateQuiz(Request $request, $id)
    {
        // dd($request->all());
        // Validate the request data
        $request->validate([
            'question' => 'required|string',
            'options' => 'required|array|size:4',
            'correct_option' => 'required|integer|min:1|max:4',
            'time_position' => 'required|numeric',
            'position_x' => 'required|numeric',
            'position_y' => 'required|numeric',
            'VideoPaths' => 'required|string',
        ]);

        // Find the quiz by ID
        $quiz = VideoQuiz::findOrFail($id);

        // Extract video name from the VideoPaths URL
        $videoPath = $request->input('VideoPaths');
        $parsedUrl = parse_url($videoPath, PHP_URL_PATH);
        $videoName = str_replace('/storage/', '', $parsedUrl);

        // Update quiz data
        $quiz->video_name = $videoName;
        $quiz->quiz_time = $request->input('time_position');
        $quiz->quiz_question = $request->input('question');
        $quiz->option_1 = $request->input('options')[0];
        $quiz->option_2 = $request->input('options')[1];
        $quiz->option_3 = $request->input('options')[2];
        $quiz->option_4 = $request->input('options')[3];
        $quiz->correct_option = $request->input('correct_option');
        $quiz->position_x = $request->input('position_x');
        $quiz->skippable = $request->input('skippable');
        $quiz->position_y = $request->input('position_y');

        // Save the changes
        $quiz->save();

        return response()->json([
            'success' => true,
            'message' => 'Quiz updated successfully'
        ]);
    }


    public function getvideofillintheblanks(Request $request)
    {
        // Extract video name from the VideoPaths URL
        $videoPath = $request->video_name;

        // Remove domain dynamically and keep only the video file name
        $parsedUrl = parse_url($videoPath, PHP_URL_PATH); // Get only the path
        $videoName = str_replace('/storage/', '', $parsedUrl);

        $fillBlanks = FillBlanks::where('video_name', $videoName)
            ->orderBy('video_time', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'fillBlanks' => $fillBlanks
        ]);
    }

    public function storefillintheblanks(Request $request)
    {
        // dd($request->all());
        try {
            $validated = $request->validate([
                'video_time' => 'required|numeric',
                'instructions' => 'required|string',
                'sentence' => 'required|string',
                'answers' => 'required|array',
                'answers.*' => 'required|string',
                'is_skippable' => 'required|boolean',
                'position_x' => 'required|numeric',
                'position_y' => 'required|numeric',
                'VideoPaths' => 'required|string'
            ]);

            $videoPath = $request->input('VideoPaths');

            // Remove domain dynamically and keep only the video file name
            $parsedUrl = parse_url($videoPath, PHP_URL_PATH); // Get only the path
            $videoName = str_replace('/storage/', '', $parsedUrl);

            $getcourseassestdata = CoursesAssets::where('assets_video', $videoName)->first();

            $id = (string) Guid::uuid4();

            $course_id = $getcourseassestdata->course_id;
            $chapter_id = $getcourseassestdata->chapter_id;
            $video_name = $videoName;

            // Save to database
            $fillBlanks = FillBlanks::create([
                'id' => $id,
                'course_id' => $course_id,
                'chapter_id' => $chapter_id,
                'video_name' => $video_name,
                'video_time' => $validated['video_time'],
                'instructions' => $validated['instructions'],
                'sentence' => $validated['sentence'],
                'answers' => json_encode($validated['answers']),
                'skippable' => $validated['is_skippable'],
                'position_x' => $validated['position_x'],
                'position_y' => $validated['position_y'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Fill in the blanks saved successfully',
                'data' => $fillBlanks
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving fill in the blanks: ' . $e->getMessage()
            ], 500);
        }
    }
    public function getvideoQuizzes(Request $request)
    {
        // Extract video name from the VideoPaths URL
        $videoPath = $request->video_path;

        // Remove domain dynamically and keep only the video file name
        $parsedUrl = parse_url($videoPath, PHP_URL_PATH); // Get only the path
        $videoName = str_replace('/storage/', '', $parsedUrl);

        $quizzes = VideoQuiz::where('video_name', $videoName)
            ->orderBy('quiz_time', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'quizzes' => $quizzes
        ]);
    }
    public function play(Request $request)
    {
        $asset_id = $request->query('asset_id');

        // ✅ Fetch Asset List from API
        $response = Http::timeout(0)->get('https://assets.zinggerr.com/api/course/assets-list');

        if ($response->failed()) {
            return back()->with('error', 'Failed to fetch data from API.');
        }

        // ✅ Convert API Data to Array
        $assetsData = collect($response->json()['data']);

        // ✅ Find the Matching Asset by `asset_id`
        $asset = $assetsData->firstWhere('asset_id', $asset_id);

        if (!$asset) {
            return back()->with('error', 'Asset not found.');
        }

        return view('interactive.play', compact('asset'));
    }


    public function getCheckpoints(Request $request)
    {
        $video_id = $request->query('video_id'); // Get video_id from request

        // Fetch checkpoints for the given video_id
        $checkpoints = InteractiveAsset::where('video_id', $video_id)
            ->orderBy('checkpoint_time', 'asc') // Order by checkpoint time
            ->get(['checkpoint_time', 'asset_id']);

        // Format the response
        $formattedCheckpoints = $checkpoints->map(function ($checkpoint) {
            return [
                'video_time' => (int) $checkpoint->checkpoint_time, // Convert to integer
                'formatted_time' => gmdate("i:s", $checkpoint->checkpoint_time), // Format as mm:ss
                'asset_id' => $checkpoint->asset_id,
            ];
        });

        return response()->json($formattedCheckpoints);
    }






    public function interactive_setup(Request $request)
    {
        $validated = $request->validate([
            'video_id' => 'required|string', // UUIDs are strings
            'asset_id' => 'required|string', // UUIDs are strings
            'video_time' => 'required|numeric' // Ensure it's a valid number
        ]);

        try {
            // ✅ Create Checkpoint
            $checkpoint = InteractiveAsset::create([
                'id' => (string) Str::uuid(), // Generate UUID
                'video_id' => $validated['video_id'],
                'user_id' => Auth::user()->id, // Use Auth::id() for cleaner code
                'asset_id' => $validated['asset_id'],
                'checkpoint_time' => $validated['video_time'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Checkpoint saved successfully.',
                'data' => $checkpoint,
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function add_assets(Request $request, $slug)
    {
        $courseId = Course::where('slug', $slug)->first();
        $id = $courseId->id;

        $data = CoursesChepters::where('courses_id', $id)->latest()->get();

        $response = Http::timeout(0)->get('https://assets.zinggerr.com/api/course/assets-list');
        if ($response->failed()) {
            return back()->with('error', 'Failed to fetch data from API.');
        }
        $assetsData = $response->json()['data'];

        return view('courses.create_chepter', compact('id', 'assetsData', 'data'));
    }

    public function api_asset_delete($id)
    {
        $response = Http::put('https://assets.zinggerr.com/api/course/assets-delete-status/' . $id, [
            'deleted_at' => 0 // Mark as inactive
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Asset Delete successfully.');
        }

        return redirect()->back()->with('error', 'Failed to asset delete. API Error');
    }





    public function updatesectionvideo(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:courses_weekly_sections,id',
            'file_name' => 'required|string',
            'chunk_index' => 'required|integer',
            'total_chunks' => 'required|integer',
            'video' => 'required|file',
        ]);

        $sectionId = $request->section_id;
        $fileName = $request->file_name;
        $chunkIndex = $request->chunk_index;
        $totalChunks = $request->total_chunks;

        $tempPath = storage_path("app/public/temp/$fileName");

        // Ensure temp directory exists
        if (!file_exists(storage_path('app/public/temp'))) {
            mkdir(storage_path('app/public/temp'), 0777, true);
        }

        // Append the chunk to the temporary file
        file_put_contents($tempPath, file_get_contents($request->file('video')->getRealPath()), FILE_APPEND);

        // If it's the last chunk, move it to the final storage location
        if ($chunkIndex + 1 == $totalChunks) {
            $finalPath = "weeklysectionsvideos/$fileName";

            if (Storage::disk('public')->exists("temp/$fileName")) {
                Storage::disk('public')->move("temp/$fileName", $finalPath);
            } else {
                return response()->json(['message' => 'File move failed: temp file not found'], 500);
            }

            // Update the CourseSection video field
            CourseSection::where('id', $sectionId)->update(['video' => $fileName]);
        }

        return response()->json(['message' => 'Chunk uploaded']);
    }

    public function sections_update(Request $request, $id)
    {
        $section = CourseSection::findOrFail($id);
        $updated = false; // Flag to track updates

        if ($request->has('blog')) {
            $section->blog = $request->blog;
            $updated = true;
        }
        if ($request->has('url')) {
            $section->url = $request->url;
            $updated = true;
        }
        if ($request->has('youtube')) {
            $section->youtube = $request->youtube;
            $updated = true;
        }

        if (!$updated) {
            return response()->json(['message' => 'No data to update!'], 400);
        }

        $section->save();

        return response()->json(['message' => 'Updated Successfully!']);
    }


    public function uploadVideoChunk(Request $request)
    {
        $request->validate([
            'video' => 'required|file',
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'chunkIndex' => 'required|integer',
            'totalChunks' => 'required|integer',
            'fileName' => 'required|string',
        ]);

        $chunkFile = $request->file('video');
        $fileName = $request->fileName;
        $tempPath = storage_path("app/public/temp/$fileName");

        // Create a temporary directory if it doesn't exist
        if (!file_exists(storage_path('app/public/temp'))) {
            mkdir(storage_path('app/public/temp'), 0777, true);
        }

        // Append the chunk to the temporary file
        file_put_contents($tempPath, file_get_contents($chunkFile), FILE_APPEND);

        // If it's the last chunk, move it to the final storage location
        if ($request->chunkIndex + 1 == $request->totalChunks) {
            $finalPath = "weeklysectionsvideos/$fileName";
            Storage::disk('public')->move("temp/$fileName", $finalPath);

            // Save file name in CourseSection table
            CourseSection::create([
                'id' => (string) Str::uuid(),
                'course_id' => $request->course_id,
                'date' => $request->date,
                'assetstype' => 'videos',
                'video' => $fileName, // Save the video file name
                'status' => 1,
            ]);

            return response()->json(['message' => 'Upload complete', 'fileName' => $fileName]);
        }

        return response()->json(['message' => 'Chunk received']);
    }




    public function section_submit(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
        ]);

        $date = $request->date;
        $videoFileName = $request->input("sections.$date.video"); // Retrieve uploaded file name

        $validatedData = [
            'id' => (string) Guid::uuid4(),
            'course_id' => $request->course_id,
            'date' => $date,
            'assetstype' => $request->assetstype ?? null,
            'blog' => $request->blog ?? null,
            'url' => $request->url ?? null,
            'youtube' => $request->youtube ?? null,
            'video' => $videoFileName, // Save file name
            'status' => $request->status,
        ];

        CourseSection::create($validatedData);

        return response()->json([
            'message' => 'Section submitted successfully!',
        ]);
    }



    public function courselist(Request $request)
    {
        $userId = Auth::user()->id;

        $userType = Auth::user()->type;
        if ($userType == 'Superadmin' || $userType == 'Admin') {
            $query = Course::where('user_id', $userId);
            $CourseUserPermission = [];
        } else {
            // $query = CoursesAssign::where('users_id', $userId)->where('courses_assign.status', 1)->join('courses', 'courses.id', '=', 'courses_assign.courses_id');

            $query = CoursesAssign::where('courses_assign.users_id', $userId)
                ->where('courses_assign.status', 1)
                ->join('courses', 'courses.id', '=', 'courses_assign.courses_id')
                ->select('courses.*'); // Select only needed fields

            $CourseUserPermission = CourseUserPermission::join('permissions', 'permissions.id', '=', 'courses_user_permissions.permission_id')
                ->where('courses_user_permissions.assign_user_id', $userId)
                ->select('courses_user_permissions.course_id', 'permissions.name')
                ->get()
                ->groupBy('course_id');;
        }

        if ($request->has('name')) {
            $query->where('courses.course_full_name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('category')) {
            $query->where('courses.course_category', 'like', '%' . $request->category . '%');
        }
        $courses = $query->latest('courses.created_at')->paginate(12);

        $users = User::where('status', 1)->get();
        $categories = CoursesCategory::where('user_id', $userId)->get();




        return view('courses.list', compact('courses', 'users', 'categories', 'CourseUserPermission'));
    }





    public function getUserPermissions(Request $request, $userId)
    {
        $courseId = session()->get('course_id_f_edit');
        $assignedPermissions = CourseUserPermission::where('assign_user_id', $userId)->where('course_id', $courseId)
            ->pluck('permission_id') // Get only the permission IDs
            ->toArray();

        return response()->json($assignedPermissions);
    }

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

        $permission_assign_userId = $request->user_id;
        $permissions = $request->permissions;
        $course_id = $request->course_id;

        if (is_null($permissions)) {
            // If permissions is null, delete all permissions for the user
            CourseUserPermission::where('assign_user_id', $permission_assign_userId)->where('course_id', $course_id)->delete();

            return redirect()->back()->with('success', 'All permissions removed for the user!');
        }
        CourseUserPermission::where('assign_user_id', $permission_assign_userId)->where('course_id', $course_id)->delete();
        foreach ($permissions as $permissionId) {
            $uuid = (string) Guid::uuid4();
            CourseUserPermission::create([
                'id' => $uuid,
                'user_id' => Auth::user()->id,
                'assign_user_id' => $permission_assign_userId,
                'permission_id' => $permissionId,
                'course_id' => $course_id,
            ]);
        }

        return redirect()->back()->with('success', 'Permissions updated successfully!');
    }


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

        $sections = Course::select('courses_weekly_sections.*')->where('slug', $slug)->join('courses_weekly_sections', 'courses_weekly_sections.course_id', '=', 'courses.id')->orderBy('courses_weekly_sections.date', 'asc')->get();

        return view('courses.section_list', compact('sections'));
    }









    // public function section_submit(Request $request)
    // {
    //     // Validate the request
    //     $validator = Validator::make($request->all(), [
    //         'course_id' => 'required|uuid',
    //         'course_start_date' => 'required|date',
    //         'sections' => 'required|array',
    //         'sections.*' => 'string|max:500', // Increased max length
    //         'status' => 'required|boolean',
    //     ]);

    //     if ($validator->fails()) {
    //         return back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     // Loop through sections and save each date as a new record
    //     foreach ($request->sections as $date => $content) {
    //         CourseSection::create([
    //             'id' => (string) Guid::uuid4(),
    //             'courses_id' => $request->course_id,
    //             'course_start_date' => $request->course_start_date,
    //             'sections_remark_date' => $date, // Store the section date
    //             'sections_remark' => $content, // Store the section content
    //             'status' => $request->status,
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Sections create successfully.');
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




    public function uploadQuizes(Request $request)
    {
        // dd($request->all());
        // Validate the request data
        $request->validate([
            'question' => 'required|string',
            'options' => 'required|array|size:4',
            'correct_option' => 'required|integer|min:1|max:4',
            'time_position' => 'required|numeric',
            'position_x' => 'required|numeric',
            'position_y' => 'required|numeric',
            'VideoPaths' => 'required|string',
        ]);

        // Extract video name from the VideoPaths URL
        $videoPath = $request->input('VideoPaths');

        // Remove domain dynamically and keep only the video file name
        $parsedUrl = parse_url($videoPath, PHP_URL_PATH); // Get only the path
        $videoName = str_replace('/storage/', '', $parsedUrl);

        $getcourseassestdata = CoursesAssets::where('assets_video', $videoName)->first();
        // dd($getcourseassestdata);

        // Create a new quiz entry
        $quiz = new VideoQuiz();
        $quiz->id = (string) Guid::uuid4();
        $quiz->course_id = $getcourseassestdata->course_id;
        $quiz->chapter_id = $getcourseassestdata->chapter_id;
        $quiz->video_name = $videoName;
        $quiz->quiz_time = $request->input('time_position');
        $quiz->quiz_question = $request->input('question');
        $quiz->option_1 = $request->input('options')[0];
        $quiz->option_2 = $request->input('options')[1];
        $quiz->option_3 = $request->input('options')[2];
        $quiz->option_4 = $request->input('options')[3];
        $quiz->correct_option = $request->input('correct_option');
        $quiz->skippable = $request->input('skippable');
        $quiz->position_x = $request->input('position_x');
        $quiz->position_y = $request->input('position_y');
        // Store only the extracted video name

        // Save to the database
        $quiz->save();

        return response()->json([
            'success' => true,
            'message' => 'Quiz added successfully'
        ]);
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

    public function courses_category()
    {
        $userId = Auth::user()->id;
        $roles = CoursesCategory::where('user_id', $userId)->get();
        return view('courses.course_category', compact('roles'));
    }

    public function submit_category(Request $request)
    {
        $userId = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('courses_category', 'name')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                }),
            ],
            // 'displayname' => 'required|string|max:255',
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
                'user_id' => $userId,
                'display_name' => $request->name,
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

        $user = User::find($userIds);
        $course = Course::find($courseId);

        // Send notification to the user
        if ($user && $course) {
            $user->notify(new CourseAssignedNotification($course));
        }


        return redirect()->back()->with('success', 'Courses assigned successfully!');
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
