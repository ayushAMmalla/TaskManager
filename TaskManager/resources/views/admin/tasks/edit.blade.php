@extends('layouts.app')

@section('content')
<div class="content mt-2">
    <div class="card shadow-lg mx-auto" style="max-width: 550px; padding: 30px; border-radius: 15px;">
        <h2 class="text-center fs-4" style="font-weight: bold;">Edit Task</h2>
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
                <textarea class="form-control" id="description" name="description" rows="2">{{ old('description', $task->description) }}</textarea>
                @error('description')
                <p class="text-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>
            <div class="row mb-4">
                <!-- Start Date -->
                <div class="col-md-6">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" required value="{{ old('start_date', $task->start_date) }}">
                    @error('start_date')
                    <div class="text-danger mt-2"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <!-- End Date -->
                <div class="col-md-6">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" required value="{{ old('end_date', $task->end_date) }}">
                    @error('end_date')
                    <div class="text-danger mt-2"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
            </div>

            <div class="d-flex mb-3 col-12">
                <label class="col-md-3" for="status">Status:</label>
                <select class="form-select" name="status">
                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in-progress" {{ $task->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                <p class="text-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>

            <div class="d-flex mb-3 col-12">
            <label class="col-md-3" for="status">Assigned to:</label>
                <select class="form-select" id="user_id" name="user_id">
                    <option value="" disabled selected>-- Select Employee --</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="button-container text-end">
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Update Task</button>
            </div>
        </form>
    </div>
</div>
@endsection