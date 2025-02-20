<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function index()
    {
        return view('managerDashboard');
    }

    public function tasks()
    {
        $tasks = Task::with('employee')->get();
        return view('manager.tasks.index', compact('tasks'));
    }

    public function updateTask(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,in-progress,completed'
        ]);

        $task->status = $validated['status'];
        $task->save();

        return redirect()->back()->with('success', 'Task status updated successfully.');
    }
}
