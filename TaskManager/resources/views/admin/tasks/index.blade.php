@extends('layouts.app')

@section('content')
<div class="content">
    @if($tasks->isEmpty())
    <div class="text-center d-flex flex-column align-items-center">
        <img src="{{ asset('images/notask.jpg') }}" alt="No tasks available" class="img-fluid" style="max-width: 300px;">
        <p class="mt-3">No tasks available at the moment. Please check back later or add task.</p>
        <a href="{{ route('admin.tasks.create') }}" class="btn btn-success mt-2"><i class="fa-solid fa-list-check me-2"></i>Add task</a>
    </div>

    @else
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