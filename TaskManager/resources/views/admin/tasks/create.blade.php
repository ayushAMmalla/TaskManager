@extends('layouts.app')

@section('content')
<div class="content mt-2">
    <div class="card shadow-lg mx-auto" style="max-width: 550px; padding: 30px; border-radius: 15px;">
        <h2 class="text-center fs-4" style="font-weight: bold;">Create New Task</h2>
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
                <textarea class="form-control" id="description" name="description" rows="2" placeholder="Describe.."></textarea>
                @error('description')
                <p class="text-danger"><strong>{{ $message }}</strong></p>
                @enderror
            </div>
            <div class="row mb-4">
                <!-- Start Date -->
                <div class="col-md-6">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" required value="{{ old('start_date') }}">
                    @error('start_date')
                    <div class="text-danger mt-2"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <!-- End Date -->
                <div class="col-md-6">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" required value="{{ old('end_date') }}">
                    @error('end_date')
                    <div class="text-danger mt-2"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
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

            <div class="button-container text-end">
                <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle me-1"></i> Add Task</button>
            </div>
        </form>
    </div>
</div>
@endsection