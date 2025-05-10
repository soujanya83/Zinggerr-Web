@extends('layouts.app')

@section('pageTitle', 'Login')

@section('content')




@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@foreach ($errors->all() as $error)
{{-- <div class="alert alert-danger">{{ $error }}</div> --}}
<div class="alert alert-danger alert-dismissible  fade show" role="alert">
    {{ $error }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endforeach
<style>
    .password-toggle-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        z-index: 2;
    }
</style>
<div class="auth-main">
    <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">
                    <a href="#" class="d-flex justify-content-center">
                        <img src="asset/images/logo.png" alt="image" style="max-width: 50%;">
                    </a>
                    <div class="row">

                        <div class="auth-header">
                            <h2 class="text-secondary mt-5"><b>Join Meeting</b></h2>

                            <p class="f-16 mt-2">Enter your credentials to continue</p>
                        </div>

                    </div>

                    <form action="{{ route('meetings.join.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name"
                                value="{{ old('full_name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="meeting_id" class="form-label">Meeting ID</label>
                            <input type="text" class="form-control" id="meeting_id" name="meeting_id"
                                value="{{ $meeting_id }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Meeting Password</label>
                            <input type="text" class="form-control" id="password" name="password"
                                value="{{ old('password') }}" required>
                        </div>

                        <input type="hidden" name="is_moderator" value="0">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Join as Attendee</button>
                        </div>
                    </form>

                    <hr>
                    <a href="/register-page" class="d-flex justify-content-center">Don't have an account?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">



@endsection
