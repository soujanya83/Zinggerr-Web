@extends('layouts.app')

@section('pageTitle', 'Login')

@section('content')
<style>
    .thank-you {
        font-size: 24px;
        font-weight: bold;
        color: #f53732;
        margin-bottom: 20px;
    }
</style>



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
<div class="alert alert-danger">{{ $error }}</div>
@endforeach
<div class="auth-main">
    <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">
                    <a href="{{ url('https://www.zinggerr.com') }}" target="_blank"
                        class="d-flex justify-content-center">
                        <img src="{{ asset('asset/images/logo.png') }}" alt="image" style="max-width: 50%;">
                    </a>
                    <div class="thank-you mt-2" style="margin-left:10%">❌ Verification Link Expired</div>
                    <p>Your email verification link has expired. Please request a new one.</p>
                    <form method="POST" action={{ route('verification.resend', ['id'=> $id]) }}>
                        @csrf
                        <button type="submit" class="btn"
                            style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;margin-left:26%">Resend
                            Verification Email</button>
                    </form>
                    <a href="/register-page" class="d-flex justify-content-center mt-2">Don't have an account?</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
