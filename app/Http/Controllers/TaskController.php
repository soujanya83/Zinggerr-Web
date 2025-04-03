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

    public function markAsComplete(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:task_assign_users,id',
        ]);

        $taskAssignUser  = TaskAssignUser::find($request->task_id);
        $taskAssignUser->task_completed_date = now(); // Set to current date and time
        $taskAssignUser->save();

        return response()->json(['success' => true, 'message' => 'Task marked as complete.']);
    }

    public function task_assign_users()
    {
        $userId = Auth::user()->id;

        // Retrieve all tasks assigned to the user with their related user and task data
        $taskAssignUsers = TaskAssignUser::select('task_assign_users.*', 'users.name', 'task.*','task_assign_users.id as taskId')
            ->where('task_assign_users.user_id', $userId)
            ->join('users', 'users.id', '=', 'task_assign_users.created_by')
            ->join('task', 'task.id', '=', 'task_assign_users.task_id')
            ->get();

        // Filter completed and pending tasks
        $completeTask = $taskAssignUsers->filter(function ($task) {
            return $task->task_completed_date !== null;
        });

        $pendingTask = $taskAssignUsers->filter(function ($task) {
            return $task->task_completed_date === null;
        });

        return view('tasks.assign_task', compact('completeTask', 'pendingTask'));
    }


    public function getAssignedUsers($id)
    {
        $users = TaskAssignUser::select(
            'users.name',
            'users.type',
            'users.profile_picture',
            'task_assign_users.created_at as assignData'
        )
            ->where('task_assign_users.task_id', $id)
            ->join('users', 'users.id', '=', 'task_assign_users.user_id')
            ->get()
            ->map(function ($user) {
                $user->assignData = \Carbon\Carbon::parse($user->assignData)->format('d M Y'); // Format date
                return $user;
            });

        if ($users->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No users assigned to this task.']);
        }

        return response()->json(['success' => true, 'users' => $users]);
    }



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
                        ['task_completed_date' => null, 'id' => $uuid, 'created_by' => Auth::user()->id]
                    );
                }
            }


            if ($request->assign_roles) {
                foreach ($request->assign_roles as $roleId) {
                    $role = Role::find($roleId);
                    if ($role) {
                        $users = User::where('type', $role->name)->where('user_id', Auth::user()->id)->get();
                        if ($users->isNotEmpty()) {
                            foreach ($users as $user) {
                                $uuid = (string) Guid::uuid4();
                                TaskAssignUser::updateOrCreate(
                                    [
                                        'task_id' => $taskId,
                                        'user_id' => $user->id,
                                    ],
                                    [
                                        'task_completed_date' => null,
                                        'id' => $uuid,
                                        'created_by' => Auth::user()->id,
                                        'role_id' => $role->id, // Ensure role_id is correctly assigned
                                    ]
                                );
                            }
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
                                [
                                    'task_id' => $taskId,
                                    'user_id' => $assignment->users_id, // Ensure this column exists
                                ],
                                [
                                    'task_completed_date' => null,
                                    'id' => $uuid,
                                    'created_by' => Auth::user()->id,
                                    'course_id' => $courseId, // Use the correct course ID
                                ]
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


    public function task_create_form()
    {
        // Return the view without passing data since we'll fetch it via AJAX
        return view('tasks.create');
    }

    public function get_assignment_data(Request $request)
    {
        try {
            $userId = Auth::user()->id;

            // Get users where user_id matches current authenticated user
            $users = User::where('user_id', $userId)
                ->select('id', 'name', 'profile_picture', 'type') // Include profile_picture
                ->get();

            // Get courses where user_id matches current authenticated user
            $courses = Course::where('user_id', $userId)
                ->select('id', 'course_full_name')
                ->get();

            // Get roles where user_id matches current user OR user_id is null
            $roles = Role::where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->orWhereNull('user_id');
            })
                ->select('id', 'display_name')
                ->get();

            return response()->json([
                'success' => true,
                'users' => $users,
                'roles' => $roles,
                'courses' => $courses
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    // public function getTaskAssignments($id)
    // {
    //     try {
    //         $task = TaskModel::find($id);
    //         if (!$task) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Task not found'
    //             ], 404);
    //         }

    //         // Get assigned IDs from TaskAssignUser for this specific task
    //         $assignedUserIds = TaskAssignUser::where('task_id', $id)
    //             ->whereNull('role_id')
    //             ->whereNull('course_id')
    //             ->pluck('user_id')
    //             ->toArray();

    //         $assignedRoleIds = TaskAssignUser::where('task_id', $id)
    //             ->whereNotNull('role_id')
    //             ->pluck('role_id')
    //             ->toArray();

    //         $assignedCourseIds = TaskAssignUser::where('task_id', $id)
    //             ->whereNotNull('course_id')
    //             ->pluck('course_id')
    //             ->toArray();

    //         return response()->json([
    //             'success' => true,
    //             'assignments' => [
    //                 'users' => $assignedUserIds,
    //                 'roles' => $assignedRoleIds,
    //                 'courses' => $assignedCourseIds
    //             ]
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error retrieving assignments: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    // public function getTaskAssignments($id)
    // {
    //     try {
    //         $userId = Auth::user()->id;

    //         // Get users, roles, courses
    //         $users = User::where('user_id', $userId)->get();
    //         $courses = Course::where('user_id', $userId)->get();
    //         $roles = Role::where(function ($query) use ($userId) {
    //             $query->where('user_id', $userId)
    //                 ->orWhereNull('user_id');
    //         })->get();

    //         // Initialize assignments
    //         $assignments = [
    //             'users' => [],
    //             'roles' => [],
    //             'courses' => []
    //         ];

    //         // Get assignments if task ID is provided
    //         if ($id && $id != 'null') {
    //             $task = TaskModel::find($id);
    //             if (!$task) {
    //                 return response()->json([
    //                     'success' => false,
    //                     'message' => 'Task not found'
    //                 ], 404);
    //             }

    //             // Get assigned users (direct assignments)
    //             $assignedUserIds = TaskAssignUser ::where('task_id', $id)
    //                 ->whereNull('role_id')
    //                 ->whereNull('course_id')
    //                 ->pluck('user_id')
    //                 ->toArray();

    //             // Get assigned roles
    //             $assignedRoleIds = TaskAssignUser ::where('task_id', $id)
    //                 ->whereNotNull('role_id')
    //                 ->pluck('role_id')
    //                 ->toArray();

    //             // Get assigned courses
    //             $assignedCourseIds = TaskAssignUser ::where('task_id', $id)
    //                 ->whereNotNull('course_id')
    //                 ->pluck('course_id')
    //                 ->toArray();

    //             // Mark assigned users, roles, and courses as checked
    //             $assignments = [
    //                 'users' => $assignedUserIds,
    //                 'roles' => $assignedRoleIds,
    //                 'courses' => $assignedCourseIds
    //             ];
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'users' => $users,
    //             'roles' => $roles,
    //             'courses' => $courses,
    //             'assignments' => $assignments
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error retrieving data: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function getTaskAssignments($id)
    {
        try {
            // Check if the task exists
            $task = TaskModel::find($id);
            if (!$task) {
                return response()->json([
                    'success' => false,
                    'message' => 'Task not found'
                ], 404);
            }

            $userId = Auth::user()->id;

            // Get users, roles, courses
            $users = User::where('user_id', $userId)->get();
            $courses = Course::where('user_id', $userId)->get();
            $roles = Role::where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->orWhereNull('user_id');
            })->get();

            // Get assigned IDs from TaskAssignUser  for this specific task
            $assignedUserIds = TaskAssignUser::where('task_id', $id)
                ->pluck('user_id')
                ->toArray();

            // Get all role IDs from the task assignments
            $assignedRoleIds = TaskAssignUser::where('task_id', $id)
                ->whereNotNull('role_id')
                ->pluck('role_id')
                ->toArray();

            // Get all course IDs from the task assignments
            $assignedCourseIds = TaskAssignUser::where('task_id', $id)
                ->whereNotNull('course_id')
                ->pluck('course_id')
                ->toArray();

            // Prepare assignments
            $assignments = [
                'users' => $assignedUserIds,
                'roles' => $assignedRoleIds,
                'courses' => $assignedCourseIds
            ];

            return response()->json([
                'success' => true,
                'users' => $users,
                'roles' => $roles,
                'courses' => $courses,
                'assignments' => $assignments
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function task_list(Request $request)
    {
        $tasks = TaskModel::select('task.*', 'task.id as taskId', 'users.name as username')->join('users', 'users.id', '=', 'task.created_by')->get();
        $users = User::where('user_id', Auth::user()->id)->get(); // Fetch all users for assignment

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
                    ['task_completed_date' => null, 'id' => $uuid, 'created_by' => Auth::user()->id]
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

    // public function task_edit($id)
    // {
    //     $task = TaskModel::find($id);
    //     if (!$task) {
    //         return redirect()->back()->with('error', 'Task not found');
    //     }

    //     $userId = Auth::user()->id;
    //     $users = User::where('user_id', $userId)->get();
    //     $courses = Course::where('user_id', $userId)->get();
    //     $roles = Role::where(function ($query) use ($userId) {
    //         $query->where('user_id', $userId)
    //             ->orWhereNull('user_id');
    //     })->get();

    //     // Get assigned IDs from TaskAssignUser for this specific task
    //     $assignedUserIds = TaskAssignUser::where('task_id', $id)
    //         ->pluck('user_id')
    //         ->toArray();

    //     // Fix: Get all role IDs from the task assignments, not just matching current role
    //     $assignedRoleIds = TaskAssignUser::where('task_id', $id)
    //         ->whereNotNull('role_id')
    //         ->pluck('role_id')
    //         ->toArray();

    //     // Fix: Get all course IDs from the task assignments, not just matching current course
    //     $assignedCourseIds = TaskAssignUser::where('task_id', $id)
    //         ->whereNotNull('course_id')
    //         ->pluck('course_id')
    //         ->toArray();

    //     return view('tasks.edit', compact('task', 'users', 'roles', 'courses', 'assignedUserIds', 'assignedRoleIds', 'assignedCourseIds'));
    // }

    public function task_edit($id)
    {
        $task = TaskModel::find($id);
        if (!$task) {
            return redirect()->back()->with('error', 'Task not found');
        }

        return view('tasks.edit', compact('task', 'id'));
    }
    // public function task_update(Request $request, $id)
    // {
    //     try {
    //         // Validation rules
    //         $validator = Validator::make($request->all(), [
    //             'title' => 'required|string|max:500',
    //             'task_date' => 'required|date_format:d/m/Y', // Matches store format
    //             'status' => 'required|boolean',
    //             'description' => 'required|string',
    //             'assign_users' => 'nullable|array',
    //             'assign_users.*' => 'exists:users,id',
    //             'assign_roles' => 'nullable|array',
    //             'assign_roles.*' => 'exists:roles,id',
    //             'assign_courses' => 'nullable|array',
    //             'assign_courses.*' => 'exists:courses,id',
    //         ]);

    //         if ($validator->fails()) {
    //             return back()
    //                 ->withErrors($validator)
    //                 ->withInput();
    //         }

    //         // Convert dd/mm/yyyy to Y-m-d for database storage
    //         $taskDate = DateTime::createFromFormat('d/m/Y', $request->task_date)->format('Y-m-d');

    //         // Update the task
    //         $task = TaskModel::find($id);
    //         if (!$task) {
    //             return back()->with('error', 'Task not found');
    //         }

    //         $task->update([
    //             'task_title' => $request->title,
    //             'task_completion_date' => $taskDate,
    //             'description' => $request->description,
    //             'status' => $request->status,
    //             'updated_by' => Auth::user()->id
    //         ]);

    //         // Handle user assignments
    //         // First, get existing assignments
    //         $existingUserIds = TaskAssignUser::where('task_id', $id)->pluck('user_id')->toArray();
    //         $oldid = TaskAssignUser::where('task_id', $id)->first();
    //         // Direct user assignments
    //         if ($request->assign_users) {
    //             $newUserIds = $request->assign_users;

    //             // Remove assignments that are no longer selected
    //             $usersToRemove = array_diff($existingUserIds, $newUserIds);
    //             if (!empty($usersToRemove)) {
    //                 TaskAssignUser::where('task_id', $id)
    //                     ->whereIn('user_id', $usersToRemove)
    //                     ->delete();
    //             }

    //             // Add new assignments
    //             foreach ($newUserIds as $userId) {
    //                 $uuid = (string) Guid::uuid4();
    //                 TaskAssignUser::updateOrCreate(
    //                     ['task_id' => $id, 'user_id' => $userId],
    //                     ['task_completed_date' => null, 'id' => $uuid, 'updated_by' => Auth::user()->id, 'created_by' => $oldid->created_by ?? null]
    //                 );
    //             }
    //         } else {
    //             // If no users selected, remove all existing direct user assignments
    //             TaskAssignUser::where('task_id', $id)->delete();
    //         }

    //         // Role-based assignments
    //         if ($request->assign_roles) {
    //             foreach ($request->assign_roles as $roleId) {
    //                 $role = Role::where('id', $roleId)->first();
    //                 if ($role) {
    //                     $users = User::where('type', $role->name)->get();
    //                     foreach ($users as $user) {
    //                         $uuid = (string) Guid::uuid4();
    //                         TaskAssignUser::updateOrCreate(
    //                             ['task_id' => $id, 'user_id' => $user->id],
    //                             ['task_completed_date' => null, 'id' => $uuid, 'updated_by' => Auth::user()->id, 'created_by' => $oldid->created_by ?? null]
    //                         );
    //                     }
    //                 }
    //             }
    //         }

    //         // Course-based assignments
    //         if ($request->assign_courses) {
    //             foreach ($request->assign_courses as $courseId) {
    //                 $courseAssignments = CoursesAssign::where('courses_id', $courseId)->get();
    //                 if ($courseAssignments->isNotEmpty()) {
    //                     foreach ($courseAssignments as $assignment) {
    //                         $uuid = (string) Guid::uuid4();
    //                         TaskAssignUser::updateOrCreate(
    //                             ['task_id' => $id, 'user_id' => $assignment->users_id],
    //                             ['task_completed_date' => null, 'id' => $uuid, 'updated_by' => Auth::user()->id, 'created_by' => $oldid->created_by ?? null]
    //                         );
    //                     }
    //                 }
    //             }
    //         }

    //         return redirect()->route('tasks.list')->with('success', 'Task updated successfully');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    //     }
    // }

    public function task_update(Request $request, $id)
    {
        try {
            // Validation rules
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:500',
                'task_date' => 'required|date_format:d/m/Y',
                'status' => 'required|boolean',
                'description' => 'required|string',
                'assign_users' => 'nullable|array',
                'assign_users.*' => 'exists:users,id',
                'assign_roles' => 'nullable|array',
                'assign_roles.*' => 'exists:roles,id',
                'assign_courses' => 'nullable|array',
                'assign_courses.*' => 'exists:courses,id',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Convert dd/mm/yyyy to Y-m-d format
            $taskDate = DateTime::createFromFormat('d/m/Y', $request->task_date)->format('Y-m-d');

            // Find the task
            $task = TaskModel::find($id);
            if (!$task) {
                return back()->with('error', 'Task not found');
            }

            // Update task details
            $task->update([
                'task_title' => $request->title,
                'task_completion_date' => $taskDate,
                'description' => $request->description,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);


            $existingUserIds = TaskAssignUser::where('task_id', $id)->pluck('user_id')->toArray();
            $oldAssignment = TaskAssignUser::where('task_id', $id)->first();


            // Handle direct user assignments
            $newUserIds = $request->assign_users ?? [];
            $usersToRemove = array_diff($existingUserIds, $newUserIds);

            if (!empty($usersToRemove)) {
                TaskAssignUser::where('task_id', $id)->whereIn('user_id', $usersToRemove)->delete();
            }

            foreach ($newUserIds as $userId) {
                $uuid = (string) Guid::uuid4();
                TaskAssignUser::updateOrCreate(
                    ['task_id' => $id, 'user_id' => $userId],
                    ['task_completed_date' => null, 'id' => $uuid, 'updated_by' => Auth::user()->id, 'created_by' => $oldAssignment->created_by ?? null]
                );
            }

            // $roleData = role::get();
            // if ($roleData) {
            //     foreach ($roleData->id as $roleId) {
            //         TaskAssignUser::where('role_id', $roleId)->where('task_id', $id)->delete();
            //     }
            // }
            // Handle role-based assignments
            if ($request->assign_roles) {
                foreach ($request->assign_roles as $roleId) {
                    $role = Role::find($roleId);
                    if ($role) {
                        $roleUsers = User::where('type', $role->name)->get();
                        foreach ($roleUsers as $user) {
                            if (!in_array($user->id, $existingUserIds)) {
                                $uuid = (string) Guid::uuid4();
                                TaskAssignUser::updateOrCreate(
                                    ['task_id' => $id, 'user_id' => $user->id],
                                    [
                                        'task_completed_date' => null,
                                        'id' => $uuid,
                                        'updated_by' => Auth::user()->id,
                                        'created_by' => $oldAssignment->created_by ?? null,
                                        'role_id' => $role->id // Add role_id here
                                    ]
                                );
                            }
                        }
                    }
                }
            }

            $currentUserId = Auth::user()->id;
            $userCourses = Course::where('user_id', $currentUserId)->pluck('id')->toArray();

            if (!empty($userCourses)) {
                // Delete existing assignments for the task where course_id matches the user's courses
                TaskAssignUser::where('task_id', $id)
                    ->whereIn('course_id', $userCourses)
                    ->delete();
            }
            if ($request->assign_courses) {
                foreach ($request->assign_courses as $courseId) {
                    $courseUsers = CoursesAssign::where('courses_id', $courseId)->get();
                    foreach ($courseUsers as $assignment) {
                        if (!in_array($assignment->users_id, $existingUserIds)) {
                            $uuid = (string) Guid::uuid4();
                            TaskAssignUser::updateOrCreate(
                                ['task_id' => $id, 'user_id' => $assignment->users_id],
                                ['task_completed_date' => null, 'id' => $uuid, 'updated_by' => Auth::user()->id, 'created_by' => $oldAssignment->created_by ?? null]
                            );
                        }
                    }
                }
            }

            return redirect()->route('tasks.list')->with('success', 'Task updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
