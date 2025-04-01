<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CoursesAssign;
use App\Models\Role;
use App\Models\TaskAssignUser;
use App\Models\TaskModel;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;
use PHPUnit\Metadata\Uses;

class TaskController extends Controller
{

    public function task_store(Request $request)
    {
        try {
            // Validation rules
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:500',
                'task_date' => 'required|date_format:d/m/Y', // Validates input as dd/mm/yyyy
                'status' => 'required|boolean',
                'description' => 'required|string',
                'assign_users' => 'nullable|array', // Optional array of user IDs
                'assign_users.*' => 'exists:users,id', // Validate each ID exists in users table
                'assign_roles' => 'nullable|array', // Optional array of role IDs
                'assign_roles.*' => 'exists:roles,id', // Validate each ID exists in roles table
                'assign_courses' => 'nullable|array', // Optional array of course IDs
                'assign_courses.*' => 'exists:courses,id', // Validate each ID exists in courses table
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Convert dd/mm/yyyy to Y-m-d for database storage
            $taskDate = DateTime::createFromFormat('d/m/Y', $request->task_date)->format('Y-m-d');

            // Create the task
            $uuid = (string) Guid::uuid4();
            $task = TaskModel::create([
                'id' => $uuid,
                'task_title' => $request->title,
                'task_completion_date' => $taskDate, // Use converted date
                'description' => $request->description,
                'status' => $request->status,
                'created_by' => Auth::user()->id,
            ]);

            $taskId = $task->id; // Correct variable name (singular $task, not $tasks)

            // Assign users (if provided)
            if ($request->assign_users) {
                foreach ($request->assign_users as $userId) {
                    $uuid = (string) Guid::uuid4();
                    TaskAssignUser::updateOrCreate(
                        ['task_id' => $taskId, 'user_id' => $userId],
                        ['task_completed_date' => null, 'id' => $uuid,'created_by' => Auth::user()->id]
                    );
                }
            }


            if ($request->assign_roles) {
                foreach ($request->assign_roles as $roleId) {
                    $role = Role::where('id', $roleId)->first();

                    if ($role) {
                        $users = User::where('type', $role->name)->get();

                        foreach ($users as $user) {
                            $uuid = (string) Guid::uuid4();
                            TaskAssignUser::updateOrCreate(
                                ['task_id' => $taskId, 'user_id' => $user->id],
                                ['task_completed_date' => null, 'id' => $uuid,'created_by' => Auth::user()->id]
                            );
                        }
                    }
                }
            }

            if ($request->assign_courses) {
                foreach ($request->assign_courses as $courseId) {
                    // Fetch all user assignments for this course
                    $courseAssignments = CoursesAssign::where('courses_id', $courseId)->get();

                    if ($courseAssignments->isNotEmpty()) {
                        foreach ($courseAssignments as $assignment) {
                            $uuid = (string) Guid::uuid4();
                            TaskAssignUser::updateOrCreate(
                                ['task_id' => $taskId, 'user_id' => $assignment->users_id], // Adjust column name if needed
                                ['task_completed_date' => null, 'id' => $uuid,'created_by' => Auth::user()->id]
                            );
                        }
                    }
                }
            }

            return redirect()->route('tasks.list')->with('success', 'Task created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    // public function task_store(Request $request)
    // {
    //     // dd($request);
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'title' => 'required|string|max:500',
    //             'task_date' => 'required|date_format:d/m/Y',
    //             'status' => 'required|boolean',
    //             'description' => 'required|string',
    //             'assign_users' => 'nullable|array', // Optional array of user IDs
    //             'assign_users.*' => 'exists:users,id', // Validate each ID exists in users table
    //             'assign_roles' => 'nullable|array', // Optional array of role IDs
    //             'assign_roles.*' => 'exists:roles,id', // Validate each ID exists in roles table
    //             'assign_courses' => 'nullable|array', // Optional array of course IDs
    //             'assign_courses.*' => 'exists:courses,id',
    //         ]);
    //         if ($validator->fails()) {
    //             return back()
    //                 ->withErrors($validator)
    //                 ->withInput();
    //         }
    //         $uuid = (string) Guid::uuid4();
    //         $tasks = TaskModel::create([
    //             'id' => $uuid,
    //             'task_title' => $request->title,
    //             'task_completion_date' => $request->task_date,
    //             'description' => $request->description,
    //             'status' => $request->status,
    //             'created_by' => Auth::user()->id
    //         ]);

    //         $taskId = $tasks->id;
    //         if ($request->assign_users) {
    //             foreach ($request->assign_users as $userId) {
    //                 $uuid = (string) Guid::uuid4();
    //                 TaskAssignUser::updateOrCreate(
    //                     ['task_id' => $taskId, 'user_id' => $userId],
    //                     ['task_completed_date' => null, 'id' => $uuid]
    //                 );
    //             }
    //         }



    //         return redirect()->route('tasks.list')->with('success', 'Task created successfully');
    //     } catch (\Exception $e) {

    //         return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    //     }
    // }

    public function task_create_form()
    {
        $userId = Auth::user()->id;
        $users = User::where('user_id', $userId)->get();
        $courses = Course::where('user_id', $userId)->get();
        $roles = Role::where(function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->orWhereNull('user_id');
        })->get();
        return view('tasks.create', compact('users', 'courses', 'roles'));
    }
    public function task_list(Request $request)
    {
        $tasks = TaskModel::all();
        $users = User::where('user_id',Auth::user()->id)->get(); // Fetch all users for assignment

        return view('tasks.list', compact('tasks', 'users'));
    }


    public function assignTask(Request $request)
    {
        $request->validate([
            'tasks' => 'required|array',
            'tasks.*' => 'exists:task,id',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        // Get authenticated user (assuming 'created_by' should store assigner's ID)


        foreach ($request->tasks as $taskId) {
            foreach ($request->user_ids as $userId) {
                $uuid = (string) Guid::uuid4();
                TaskAssignUser::updateOrCreate(
                    ['task_id' => $taskId, 'user_id' => $userId],
                    ['task_completed_date' => null, 'id' => $uuid,'created_by'=>Auth::user()->id]
                );
            }
        }

        return response()->json(['message' => 'Tasks assigned successfully.']);
    }

    public function updateTaskStatus(Request $request)
    {
        $task = TaskModel::find($request->id);

        if ($task) {
            $task->status = $request->status;
            $task->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Task not found']);
    }

    public function task_delete($id)
    {
        $task = TaskModel::find($id);

        if ($task) {
            $task->delete();
            return response()->json(['success' => true, 'message' => 'Task deleted successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Task not found.']);
        }
    }

    public function task_edit($id)
    {
        $task = TaskModel::find($id);
        if (!$task) {
            return redirect()->back()->with('error', 'Task not found');
        }

        return view('tasks.edit', compact('task'));
    }

    public function task_update(Request $request, $id)
    {

        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:500',
                'task_date' => 'required|date_format:Y-m-d',
                'status' => 'required|boolean',
                'description' => 'required|string'
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            TaskModel::where('id', $id)->update([

                'task_title' => $request->title,
                'task_completion_date' => $request->task_date,
                'description' => $request->description,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);

            return redirect()->route('tasks.list')->with('success', 'Task updated successfully');
        } catch (\Exception $e) {

            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
