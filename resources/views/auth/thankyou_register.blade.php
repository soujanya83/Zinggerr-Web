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
<div class="auth-main">
    <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="card my-5 shadow-lg rounded-3">
                <div class="card-body text-center">
                    <a href="#" class="d-flex justify-content-center mb-4">
                        <img src="asset/images/logo.png" alt="logo" class="img-fluid"
                            style="max-width: 285px;height:83px">
                    </a>
                    <div class="auth-header">
                        <h2 class="text-secondary mt-3"><b>Thank you for registering!</b></h2>
                        {{-- <h3 class="f-16 mt-3 text-success"></h3> --}}
                        <p class="mt-3 text-muted">
                            We've sent you an email to verify your
                            <a href="mailto:{{ session('registered_email') ?? '' }}">
                                @if(session('registered_email') == null)
                                Email
                                @else
                                {{ session('registered_email') }}
                                @endif
                            </a>. Please check your inbox and click the link to activate your account.
                        </p>


                        <a href="{{ url('/login-page') }}" class="btn btn-success mt-4 px-5">
                            Go to Login
                        </a>
                    </div>

                    <?php $userdata=DB::table('users')->where('email',session('registered_email'))->first();
                    $id=$userdata->id;
                    ?>

                    <div class="mt-4 text-muted">
                        <p>If you did not receive the email,
                            <a href="#" class="text-decoration-none" onclick="document.getElementById('resend-form').submit();">click here</a>
                            to resend it.
                        </p>

                        <form id="resend-form" method="POST" action="{{ route('verification.resend', ['id'=> $id]) }}" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
