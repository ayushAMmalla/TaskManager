<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('adminDashboard');
    }

    // View all tasks
    public function tasks()
    {
        $tasks = Task::all();
        return view('admin.tasks.index', compact('tasks'));
    }

    // Create a new task
    public function createTask()
    {
        $users = User::all();
        return view('admin.tasks.create', compact('users'));
    }

    public function storeTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'status' => 'required|in:pending,in-progress,completed',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Task::create($request->all());

        return redirect()->route('admin.tasks')->with('success', 'Task created successfully');
    }

    public function editTask(Task $task)
    {
        $users = User::all();
        return view('admin.tasks.edit', compact('task', 'users'));
    }

    public function updateTask(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'status' => 'required|in:pending,in-progress,completed',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $task->update($request->all());

        return redirect()->route('admin.tasks')->with('success', 'Task updated successfully');
    }

    // Delete a task
    public function deleteTask(Task $task)
    {
        $task->delete();
        return redirect()->route('admin.tasks')->with('success', 'Task deleted successfully');
    }
}
