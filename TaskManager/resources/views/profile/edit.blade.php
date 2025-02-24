@extends('layouts.app')

@section('content')
<div class="content mt-4">
    <div class="row justify-content-center">
        <!-- Profile Information Card (Half Width) -->
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    {{ __('Profile Information') }}
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <!-- Update Password Card (Half Width) -->
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    {{ __('Update Password') }}
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    {{ __('Delete Account') }}
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
