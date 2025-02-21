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
        $tasks = Task::all();
        return view('employee.tasks.index', compact('tasks'));
    }
}
