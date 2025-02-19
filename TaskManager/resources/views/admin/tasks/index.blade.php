@extends('layouts.app')

@section('content')
<div class="content">
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Deadline</th>
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
                <td>{{ $task->deadline }}</td>
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
</div>
@endsection