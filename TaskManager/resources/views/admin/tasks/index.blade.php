@extends('layouts.app')

@section('content')

<div class="content">
    @if($tasks->isEmpty())
    @if(request()->has('search'))
    <!-- No Search Results Found Message -->
    <div class="text-center d-flex flex-column align-items-center">
        <img src="{{ asset('images/no_result.jpg') }}" alt="No results found" class="img-fluid" style="max-width: 250px;">
        <p class="mt-3">No tasks found for "<strong>{{ request()->search }}</strong>". Try a different keyword.</p>
        <a href="{{ route('admin.tasks') }}" class="btn btn-success mt-2"><i class="fa-solid fa-arrow-left me-2"></i>Back to All Tasks</a>
    </div>
    @else
    <!-- No Tasks Available Message -->
    <div class="text-center d-flex flex-column align-items-center">
        <img src="{{ asset('images/notask.jpg') }}" alt="No tasks available" class="img-fluid" style="max-width: 300px;">
        <p class="mt-3">No tasks available at the moment. Please check back later or add a task.</p>
        <a href="{{ route('admin.tasks.create') }}" class="btn btn-success mt-2"><i class="fa-solid fa-list-check me-2"></i>Add Task</a>
    </div>
    @endif
    @else
    <div class="d-flex justify-content-end mb-4">
        <!-- Search Bar with Icon -->
        <div class="position-relative me-3">
            <form class="d-flex" action="{{ route('admin.tasks') }}" style="flex: 1;">
                <input
                    id="searchInput"
                    class="form-control ps-4"
                    type="text"
                    name="search"
                    placeholder="Search tasks..."
                    value="{{ request()->search }}"
                    style="flex: 1;">
                <i class="fa-solid fa-magnifying-glass position-absolute top-50 start-0 translate-middle-y ms-2"></i>
            </form>
        </div>
        <!-- Sort Dropdown and Button Group -->
        <div class="d-flex">
            <form class="d-flex" action="{{ route('admin.tasks') }}" style="flex: 1;" method="GET">
                <input type="hidden" name="search" value="{{ request()->search }}">
                <select id="sortSelect" name="sort" class="form-select me-2" onchange="this.form.submit()">
                    <option value="" disabled selected>Sort By</option>
                    <option value="end_date_asc" {{ request()->sort == 'end_date_asc' ? 'selected' : '' }}>Deadline (Earliest)</option>
                    <option value="end_date_dsc" {{ request()->sort == 'end_date_dsc' ? 'selected' : '' }}>Deadline (Latest)</option>
                    <option value="status_pending" {{ request()->sort == 'status_pending' ? 'selected' : '' }}>Pending</option>
                    <option value="status_in_progress" {{ request()->sort == 'status_in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="status_completed" {{ request()->sort == 'status_completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </form>
        </div>
    </div>
    <!-- Tasks Table -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Assigned User</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $index => $task)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->employee->name ?? 'Unassigned' }} </td>
                <td>{{ $task->start_date }}</td>
                <td>{{ $task->end_date }}</td>
                <td>{{ $task->status }}</td>
                <td>
                    <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
                    <form method="POST" action="{{ route('admin.tasks.delete', $task->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?');">
                            <i class="fa-solid fa-trash me-2"></i>Remove
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection