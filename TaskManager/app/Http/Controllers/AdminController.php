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
        return view('admin.adminDashboard');
    }
    // View all tasks
    public function tasks(Request $request)
    {
        $search = $request->search;
        $sort = $request->sort;
        $tasks = Task::query();

        if ($search) {
            $tasks = $tasks->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%')
                ->orWhereHas('assignedUser', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
        }
        // Sorting Logic
        switch ($sort) {
            case 'end_date_asc':
                $tasks->orderBy('end_date', 'asc');
                break;
            case 'end_date_dsc':
                $tasks->orderBy('end_date', 'desc');
                break;
            case 'status_pending':
                $tasks->where('status', 'pending');
                break;
            case 'status_in_progress':
                $tasks->where('status', 'in-progress');
                break;
            case 'status_completed':
                $tasks->where('status', 'completed');
                break;
        }

        // Fix: Fetch results before returning to view
        $tasks = $tasks->get(); // or use paginate(10) for pagination

        return view('admin.tasks.index', compact('tasks'));
    }


    // Create a new task
    public function createTask()
    {
        $users = User::whereIn('role', ['employee', 'manager'])->get();
        return view('admin.tasks.create', compact('users'));
    }

    public function storeTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:pending,in-progress,completed',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Task::create($request->all());
        toastr()->success('Task created successfully');
        return redirect()->route('admin.tasks');
    }

    public function editTask(Task $task)
    {
        $users = User::whereIn('role', ['employee', 'manager'])->get();
        return view('admin.tasks.edit', compact('task', 'users'));
    }

    public function updateTask(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:pending,in-progress,completed',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $task->update($request->all());
        toastr()->success('Task updated successfully');
        return redirect()->route('admin.tasks');
    }

    // Delete a task
    public function deleteTask(Task $task)
    {
        $task->delete();
        toastr()->success('Task deleted successfully');
        return redirect()->route('admin.tasks');
    }
}
