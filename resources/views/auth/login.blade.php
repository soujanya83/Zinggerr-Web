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
            <div class="card my-5"   style="background-image: url('{{ asset('asset/zinggerr-web-image.jpg') }}'); background-size: cover; background-position: center;">
                <div class="card-body">
                    <a href="#" class="d-flex justify-content-center">
                        <img src="asset/images/logo.png" alt="image" style="max-width: 50%;">
                    </a>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="auth-header">
                                <h2 class="text-secondary mt-5"><b>Welcome</b></h2>
                                <p class="f-16 mt-2">Enter your credentials to continue</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" name="login" class="form-control" id="loginInput"
                                placeholder="Email address / Username" required>
                            <label for="floatingInput">Email address / Username</label>
                        </div>
                        {{-- <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="passwordInput" placeholder="Password"
                                name="password" required>
                            <label for="passwordInput">Password</label>
                        </div> --}}
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control" id="passwordInput" placeholder="Password"
                                name="password" required>
                            <label for="passwordInput">Password</label>
                            <span class="password-toggle-icon" onclick="togglePassword()" style="">
                                <i class="bi bi-eye-slash" id="toggleEyeIcon" style="font-size:18px"></i>
                            </span>
                        </div>

                        <div class="d-flex mt-1 justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input input-primary" type="checkbox" id="rememberCheck"
                                    checked="" name="remember">
                                <label class="form-check-label text-muted" for="rememberCheck">Remember me</label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-secondary">Forgot Password?</a>

                        </div>
                        <div class="d-grid mt-4">
                            <input type="submit" class="btn btn-secondary" value="Login">
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

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('passwordInput');
        const toggleEyeIcon = document.getElementById('toggleEyeIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleEyeIcon.classList.remove('bi-eye-slash');
            toggleEyeIcon.classList.add('bi-eye');
        } else {
            passwordInput.type = 'password';
            toggleEyeIcon.classList.remove('bi-eye');
            toggleEyeIcon.classList.add('bi-eye-slash');
        }
    }
</script>

@endsection
