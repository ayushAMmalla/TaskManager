<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('employee.employeeDashboard');
    }
    public function tasks()
    {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->get();

        return view('employee.tasks.index', compact('tasks'));
    }


    public function updateTask(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,in-progress,completed'
        ]);

        $task->status = $validated['status'];
        $task->save();
        toastr()->success('Task status updated successfully.');
        return redirect()->back();
    }
}
