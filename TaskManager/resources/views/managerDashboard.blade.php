@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Manager Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}! Manage and assign tasks.</p>
    
    <div class="card">
        <div class="card-header">Manage Tasks</div>
        <div class="card-body">
            <a href="{{ route('manager.tasks') }}" class="btn btn-primary">View Tasks</a>
            <a href="{{ route('manager.tasks.create') }}" class="btn btn-success">Create Task</a>
        </div>
    </div>
</div>
@endsection
