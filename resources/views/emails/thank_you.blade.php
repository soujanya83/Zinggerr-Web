@extends('layouts.app')

@section('pageTitle', 'Login')

@section('content')
<style>
    .thank-you {
        font-size: 24px;
        font-weight: bold;
        color: #4CAF50;
        margin-bottom: 20px;
    }
</style>



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

@foreach ($errors->all() as $error)
<div class="alert alert-danger">{{ $error }}</div>
@endforeach
<div class="auth-main">
    <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">
                    <a href="{{ url('https://www.zinggerr.com') }}" target="_blank" class="d-flex justify-content-center">
                        <img  src="{{ asset('asset/images/logo.png') }}" alt="image" style="max-width: 50%;">
                    </a>
                    <div class="thank-you mt-2" style="margin-left:27%">✅ Thank You!</div>
                    <p style="margin-left:18%">Your email has been successfully verified.</p>

                    <a href="{{ route('loginpage') }}" class="verify-button"
                        style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;margin-left:38%">Login</a>




                    <a href="/register-page" class="d-flex justify-content-center mt-2">Don't have an account?</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
