@extends('layouts.app')

@section('content')
<div class="content mt-5">
    <div class="card shadow-lg mx-auto" style="max-width: 450px; padding: 20px;">
        <h2>Create Task</h2>
        <form method="post" action="{{ route('admin.tasks.store')}}">
            @csrf
            <div class="mb-3">
                <label for="name">Title:</label>
                <input type="text" class="form-control" name="name" id="name" required value="{{ old('name') }}">
                @if ($errors->has('name'))
                <p class="text-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </p>
                @endif
            </div>

            <div class="mb-3">
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="description" id="description" required value="{{ old('description') }}">
                @error('description')
                <p class="text-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>

            <div class="d-flex mb-3">
                <label for="description">Deadline:</label>
                <input type="time" class="form-control ms-2" name="time" id="time" required>
                @error('time')
                <p class="text-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>

            <div class="d-flex mb-3">
                <label for="status">Status:</label>
                <select class="form-select ms-2" name="status" id="status" required>
                    <option value="" selected disabled>-- Select a Status --</option>
                    <option value="pending" {{ old('status', $task->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in-progress" {{ old('status', $task->status ?? '') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status', $task->status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                <p class="text-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>
            <div class="button-container">
                <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle me-1"></i> Add Task</button>
            </div>

    </div>
    @endsection