@extends('layouts.app')

@section('pageTitle', 'Login')

@extends('layouts.app')
<style>
    .auth-main {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f8f9fa;
    }

    .auth-form .card {
        border: none;
    }

    .auth-header h2 {
        font-size: 1.75rem;
    }

    .auth-header h3 {
        font-size: 1.25rem;
    }

    .auth-header p {
        font-size: 1rem;
    }

    .btn-success {
        background-color: #4caf50;
        border-color: #4caf50;
    }

    .btn-success:hover {
        background-color: #45a049;
        border-color: #45a049;
    }
</style>
@section('content')
<div class="auth-main">
    <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="card my-5 shadow-lg rounded-3">
                <div class="card-body text-center">
                    <a href="{{ url('/') }}" class="d-flex justify-content-center mb-4">
                        <img src="/images/logo.png" alt="logo" class="img-fluid" style="max-width: 150px;">
                    </a>
                    <div class="auth-header">
                        <h2 class="text-secondary mt-3"><b>Welcome to Our Platform!</b></h2>
                        <h3 class="f-16 mt-3 text-success">Thank you for registering!</h3>
                        <p class="mt-3 text-muted">
                            We've sent you an email to verify your account. Please check your inbox and follow the
                            instructions to complete your registration.
                        </p>
                        <a href="{{ url('/login-page') }}" class="btn btn-success mt-4 px-5">
                            Go to Login
                        </a>
                    </div>
                    <div class="mt-4 text-muted">
                        <p>If you did not receive the email, <a href="{{ url('/register-page') }}"
                                class="text-decoration-none">click here</a> to resend it.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
