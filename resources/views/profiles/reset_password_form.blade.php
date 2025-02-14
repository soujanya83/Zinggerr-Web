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
</style>





<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Reset new Password</h5>
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



                        <form action="{{ route('user.password.update') }}" method="post" onsubmit="return validatePasswords()">
                            @csrf
                            <div class="card border">
                                <div class="card-header">
                                    <h5>Reset New Password</h5>
                                </div>
                                <div class="card-body">

                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                    <input type="hidden" name="otp_email" value="{{ Auth::user()->email }}">

                                    <div class="row">
                                        <!-- New Password -->
                                        <div class="col-sm-6">
                                            <div class="mb-0 position-relative">
                                                <label class="form-label">New Password <span class="text-danger">*</span></label>
                                                <input type="password" id="newPassword" name="password" class="form-control"
                                                    placeholder="Enter new password" onkeyup="checkPasswordMatch()">
                                                <button type="button"  style="top: 40%;" class="btn btn-outline-secondary toggle-password eyebutton"
                                                    data-target="newPassword">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                            </div>
                                            <small id="passwordError" class="text-danger"></small>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="col-sm-6">
                                            <div class="mb-0 position-relative">
                                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                <input type="password" id="confirmPassword" name="password_confirmation"
                                                    class="form-control" placeholder="Confirm your new password" onkeyup="checkPasswordMatch()">
                                                <button type="button"  style="top: 39%;" class="btn btn-outline-secondary toggle-password eyebutton"
                                                    data-target="confirmPassword">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                            </div>
                                            <small id="confirmPasswordError" class="text-danger"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-shadow btn-primary">Update Password</button>
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
   function checkPasswordMatch() {
    let password = document.getElementById("newPassword").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    let passwordError = document.getElementById("passwordError");
    let confirmPasswordError = document.getElementById("confirmPasswordError");

    // Password strength check (at least 6 characters)
    if (password.length < 6) {
        passwordError.innerText = "Password must be at least 6 characters long.";
    } else {
        passwordError.innerText = "";
    }

    // Password match check
    if (confirmPassword.length > 0) {
        if (password !== confirmPassword) {
            confirmPasswordError.innerText = "Passwords do not match!";
        } else {
            confirmPasswordError.innerText = "";
        }
    }
}

// Prevent form submission if validation fails
function validatePasswords() {
    let password = document.getElementById("newPassword").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    let passwordError = document.getElementById("passwordError").innerText;
    let confirmPasswordError = document.getElementById("confirmPasswordError").innerText;

    if (password.length < 6 || password !== confirmPassword || passwordError || confirmPasswordError) {
        alert("Please fix errors before submitting.");
        return false;
    }
    return true;
}

</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const toggleButtons = document.querySelectorAll('.toggle-password');

    toggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetInputId = button.getAttribute('data-target');
            const passwordField = document.getElementById(targetInputId);
            const icon = button.querySelector('i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
});


</script>

@include('partials.footer')
@endsection
