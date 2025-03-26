<?php

namespace App\Http\Controllers;

use App\Models\ToDoTask;
use Illuminate\Http\Request;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Support\Facades\Auth;

class ToDoController extends Controller
{
    public function tasks_edit($id)
    {
        echo "working......";
    }
    public function deleteTask($id)
    {
        $task = ToDoTask::find($id);

        if ($task) {
            $task->delete();
            return response()->json(['success' => true, 'message' => 'Task deleted successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Task not found.']);
        }
    }


    public function all_tasks(Request $request)
    {
        if ($request->ajax()) {
            $query = ToDoTask::where('user_id', Auth::id())->latest();

            if (!empty($request->date)) {
                $query->whereDate('date', $request->date);
            }

            $todos = $query->get();

            return response()->json(['todos' => $todos]);
        }

        $todos = ToDoTask::where('user_id', Auth::id())->latest()->get();

        return view('tasks.list', compact('todos'));
    }


    public function index(Request $request)
    {
        // Get the date from the query parameter, default to current date if not provided
        $date = $request->query('date', now()->format('Y-m-d'));

        // Fetch tasks for the authenticated user where the date matches the provided date
        $todos = ToDoTask::where('user_id', Auth::user()->id)
            ->whereDate('date', $date)->latest()
            ->get();

        return response()->json($todos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
            'due_date' => 'required|date',
            'completed' => 'sometimes|in:0,1',
        ]);

        $uuid = (string) Guid::uuid4();
        $todo = ToDoTask::create([
            'id' => $uuid,
            'task' => $request->task,
            'user_id' => Auth::user()->id,
            'date' => $request->due_date,
            'completed' => $request->completed ?? 0,
        ]);

        return response()->json(['success' => true, 'message' => 'Task added successfully']);
    }

    public function destroy($id)
    {
        $todo = ToDoTask::find($id);
        if (!$todo) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        $todo->delete();
        return response()->json(['success' => true, 'message' => 'Task deleted successfully']);
    }

    public function complete($id, Request $request)
    {
        $request->validate([
            'completed' => 'required|in:0,1',
        ]);

        $todo = ToDoTask::find($id);
        if (!$todo) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        $todo->update([
            'completed' => $request->completed,
        ]);

        return response()->json(['success' => true, 'message' => 'Task updated successfully']);
    }
}
