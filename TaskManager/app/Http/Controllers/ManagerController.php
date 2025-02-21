<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function index()
    {
        return view('manager.managerDashboard');
    }

    public function tasks()
    {
        $tasks = Task::with('employee')->get();
        return view('manager.tasks.index', compact('tasks'));
    }

    public function editTask(Task $task)
    {
        $users = User::all();
        return view('manager.tasks.edit', compact('task', 'users'));
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
        toastr()->success('Task updated successfully');
        return redirect()->route('manager.tasks');
    }


    // public function updateTask(Request $request, $id)
    // {
    //     $task = Task::findOrFail($id);

    //     $validated = $request->validate([
    //         'status' => 'required|in:pending,in-progress,completed'
    //     ]);

    //     $task->status = $validated['status'];
    //     $task->save();
    //     toastr()->success('Task status updated successfully.');
    //     return redirect()->back()->with('success', 'Task status updated successfully.');
    // }
}
