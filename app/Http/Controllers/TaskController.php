<?php

namespace App\Http\Controllers;

use App\Models\TaskAssignUser;
use App\Models\TaskModel;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use PHPUnit\Metadata\Uses;

class TaskController extends Controller
{

    public function task_store(Request $request)
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
            $uuid = (string) Guid::uuid4();
            TaskModel::create([
                'id' => $uuid,
                'task_title' => $request->title,
                'task_completion_date' => $request->task_date,
                'description' => $request->description,
                'status' => $request->status,
                'created_by' => Auth::user()->id
            ]);

            return redirect()->route('tasks.list')->with('success', 'Task created successfully');
        } catch (\Exception $e) {

            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function task_create_form()
    {
        return view('tasks.create');
    }
    public function task_list(Request $request)
    {
        $tasks = TaskModel::all();
        $users = User::all(); // Fetch all users for assignment

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
                    ['task_completed_date' => null,'id'=>$uuid]
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
