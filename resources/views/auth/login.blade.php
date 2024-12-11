@extends('layouts.app')

@section('pageTitle', 'Login')

@section('content')
    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body">
                        <a href="#" class="d-flex justify-content-center">
                            <img src="/images/logo.png" alt="image" style="max-width: 50%;">
                        </a>
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="auth-header">
                                <h2 class="text-secondary mt-5"><b>Hi, Welcome Back</b></h2>
                                <p class="f-16 mt-2">Enter your credentials to continue</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="login" class="form-control" id="loginInput" placeholder="Email address / Username / Phone" >
                            <label for="floatingInput">Email address / Username / Phone</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="passwordInput" placeholder="Password" >
                            <label for="passwordInput">Password</label>
                        </div>
                        <div class="d-flex mt-1 justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input input-primary" type="checkbox" id="rememberCheck" checked="" >
                            <label class="form-check-label text-muted" for="rememberCheck">Remember me</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-secondary">Forgot Password?</a>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-secondary">Sign In</button>
                        </div>
                        <hr >
                        <a href="{{ route('register') }}" class="d-flex justify-content-center">Don't have an account?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection