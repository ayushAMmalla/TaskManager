@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}! You have full control over the system.</p>
    
    <div class="card">
        <div class="card-header">Manage Tasks</div>
        <div class="card-body">
            <a href="{{ route('admin.tasks') }}" class="btn btn-primary">View All Tasks</a>
            <a href="{{ route('admin.tasks.create') }}" class="btn btn-success">Create Task</a>
        </div>
    </div>
</div>
@endsection
