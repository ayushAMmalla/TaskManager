@extends('layouts.app')

@section('content')
<div class="content">
    <h2>Employee Task: {{ auth()->user()->name }}</h2>
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
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Update Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $index => $task)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->start_date }}</td>
                <td>{{ $task->end_date }}</td>
                <td>
                    <span class="badge p-2 fs-6
                        @if($task->status == 'pending') bg-warning text-dark
                        @elseif($task->status == 'in-progress') bg-primary text-white
                        @elseif($task->status == 'completed') bg-success text-white
                        @endif">
                        {{ ucfirst($task->status) }}
                    </span>
                </td>
                <td>
                    <form class="d-flex" method="POST" action="{{ route('employee.tasks.update', $task->id) }}">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-control">
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in-progress" {{ $task->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <button type="submit" class="btn btn-success ms-2">Update </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection