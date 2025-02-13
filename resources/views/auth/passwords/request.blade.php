@extends('layouts.app')

@section('pageTitle', 'Forgot Password')

@section('content')
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="auth-main">
    <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="card mt-5">
                <div class="card-body">
                    <a href="#" class="d-flex justify-content-center">
                        <img src="asset/images/logo.png" alt="image" style="max-width: 50%;">
                    </a>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="auth-header text-center">
                                <h2 class="text-secondary mt-5"><b>Forgot password?</b></h2>
                                <p class="f-16 mt-3">Enter your email address or phone number below and we'll send you
                                    password reset OTP.</p>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('reset.password') }}" method="post">
                        @csrf
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" id="floatingInput" name="identifier"
                                placeholder="Email address / Phone / Username" required>
                            <label for="floatingInput">Enter Email address / Phone number / Username</label>
                        </div>
                        <div class="d-grid mt-4">
                            <input type="submit" class="btn btn-secondary p-2" value="Send OTP">
                        </div>
                    </form>

                    <hr>
                    <a href="{{ route('login') }}" class="d-flex justify-content-center">Already have an account?</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
