@extends('layouts.app')

@section('content')
<div class="content mt-4">
    <div class="row">
        <!-- Profile Information Card (Half Width) -->
        <div class="col-md-6">
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
        <div class="col-md-6">
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

    <!-- Delete Account Card (Full Width) -->
    <div class="row">
        <div class="col-md-12">
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
