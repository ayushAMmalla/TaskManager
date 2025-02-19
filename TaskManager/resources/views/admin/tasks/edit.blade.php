@extends('layouts.app')

@section('content')
<div class="content mt-5">
    <div class="card shadow-lg mx-auto" style="max-width: 450px; padding: 20px;">
        <h2>Edit Task</h2>
        <form method="post" action="{{ route('admin.tasks.update', $task->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $task->title) }}" required>
                @error('title')
                <p class="text-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $task->description) }}</textarea>
                @error('description')
                <p class="text-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deadline">Deadline:</label>
                <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline', $task->deadline) }}" required>
                @error('deadline')
                <p class="text-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status">Status:</label>
                <select class="form-select" name="status">
                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in-progress" {{ $task->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                <p class="text-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="user_id">Assign To:</label>
                <select class="form-select" id="user_id" name="user_id">
                    <option value="">-- Select Employee --</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="button-container">
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Update Task</button>
            </div>
        </form>
    </div>
</div>
@endsection
