@extends('layouts.app')

@section('pageTitle', 'Forgot Password')

@section('content')
<div class="auth-main">
    <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="card mt-5">
                <div class="card-body">
                    <a href="#" class="d-flex justify-content-center">
                        <img src="/images/logo.png" alt="image" style="max-width: 50%;">
                    </a>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="auth-header text-center">
                                <h2 class="text-secondary mt-5"><b>Forgot password?</b></h2>
                                <p class="f-16 mt-3">Enter your email address below and we'll send you password reset OTP.</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" id="floatingInput" placeholder="Email address / Phone / Username"> 
                        <label for="floatingInput">Email address / Phone / Username</label>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-secondary p-2">Send Reset Link</button>
                    </div>
                    <hr>
                    <a href="{{ route('login') }}" class="d-flex justify-content-center">Already have an account?</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection