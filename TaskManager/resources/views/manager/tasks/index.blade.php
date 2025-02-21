@extends('layouts.app')

@section('content')
<div class="content">
    <h2>Manager Tasks</h2>
    @if($tasks->isEmpty())
    <div class="text-center d-flex flex-column align-items-center">
        <img src="{{ asset('images/notask.jpg') }}" alt="No tasks available" class="img-fluid" style="max-width: 300px;">
        <p class="mt-3">No tasks available at the moment. Please check back later.</p>
    </div>
    @else
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Deadline</th>
                <th>Assigned To</th>
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
                <td>{{ \Carbon\Carbon::parse($task->deadline)->format('y-m-d') }}</td>
                <td>{{ $task->employee->name ?? 'Unassigned' }}</td> <!-- Show Employee Name -->
                <td>{{ $task->status }}</td>
                <td>
                    <form method="POST" action="{{ route('manager.tasks.update', $task->id) }}" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-control">
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in-progress" {{ $task->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <button type="submit" class="btn btn-success mt-2">
                            <i class="fa-solid fa-check me-2"></i>Update
                        </button>
                    </form>
                </td>
                <td>
                <a href="{{ route('manager.tasks.edit', $task->id) }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection