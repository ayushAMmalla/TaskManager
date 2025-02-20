@extends('layouts.app')

@section('content')
<div class="content mt-5">
    <div class="card shadow-lg mx-auto" style="max-width: 450px; padding: 20px;">
        <h2>Create Task</h2>
        <form method="post" action="{{ route('admin.tasks.store') }}">
            @csrf
            <div class="mb-3">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" id="title" required value="{{ old('title') }}">
                @error('title')
                <p class="text-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="description" id="description" value="{{ old('description') }}">
                @error('description')
                <p class="text-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deadline">Deadline:</label>
                <input type="date" class="form-control" name="deadline" id="deadline" required value="{{ old('deadline') }}">
                @error('deadline')
                <p class="text-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>

            <div class="d-flex mb-3 col-12">
                <label class="col-md-3" for="status">Status:</label>
                <select class="form-select" name="status">
                    <option value="pending">Pending</option>
                    <option value="in-progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
                @error('status')
                <p class="text-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>

            <div class="d-flex mb-3 col-12">
                <label class="col-md-3" for="user_id">Assign User:</label>
                <select class="form-select" name="user_id">
                    <option value="">-- Unassigned --</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="button-container">
                <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle me-1"></i> Add Task</button>
            </div>
        </form>
    </div>
</div>
@endsection
