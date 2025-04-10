@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">

@section('pageTitle', 'User Account Settings')

@section('content')
@include('partials.sidebar')
@include('partials.header')

<style>
    .thspace {
        margin-left: 67%;
    }

    .eyebutton {
        position: absolute;
        top: 41%;
        right: 0px;
        height: 43px;
    }

    .nav-tabs .nav-link.active {
        border-bottom: 3px solid #007bff;
        color: #007bff;
        font-weight: bold;
        background-color: white
    }

    .nav-tabs .nav-link {
        border: none;
        /* Remove default tab borders for a cleaner look */
        color: #000000;
        /* Default inactive tab text color */
        transition: color 0.2s ease-in-out;
        /* Smooth transition for hover effects */
    }

    .nav-tabs .nav-link:hover {
        color: #007bff;
        /* Hover effect for inactive tabs */
    }

    .nav-link.active i {
        background-color: #007bff
    }

    .nav-link:hover i {
        background-color: #007bff;
    }
</style>





<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">OTP Verify</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Account Settings</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row">
            <div class="">
                <div class="card">
                    <div class="card-body">



                        <form action="{{ route('profile.otp.submit') }}" method="post">
                            @csrf
                            <div class="card border">
                                <div class="card-header">
                                    <h5>Otp Verify</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label">Enter OTP <span class="text-danger" style="font-weight: bold;">*</span></label>
                                                <input type="text" id="otp" name="otp" class="form-control"
                                                    placeholder="Enter OTP" required pattern="[0-9]{6}"
                                                    title="OTP must be 6 digits" maxlength="6" minlength="6"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">

                                                <p class="mt-2">
                                                    Didn't receive OTP?
                                                    <a href="{{ route('user.resend.otp') }}"
                                                        onclick="disableResendButton(event)">Resend OTP</a>
                                                    <span id="resendTimer" class="text-danger"></span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col mt-4">
                                            <div class="mb-0 position-relative" style="margin-top: 7px">
                                                <button type="submit" class="btn btn-shadow btn-primary">Submit OTP
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function disableResendButton(event) {
            event.preventDefault();
            let link = event.target;
            link.style.pointerEvents = "none"; // Disable click
            link.innerText = "Resending OTP...";

            setTimeout(() => {
                window.location.href = link.href; // Redirect after timeout
            }, 1000);
        }
</script>



@include('partials.footer')
@endsection
