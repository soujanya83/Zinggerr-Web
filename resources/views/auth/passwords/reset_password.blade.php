@extends('layouts.app')

@section('pageTitle', 'Forgot Password')

@section('content')
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
                                <h2 class="text-secondary mt-3"><b>Set New password</b></h2>

                            </div>
                        </div>
                    </div>
                    <form action="{{ route('set.new.password') }}" method="post" onsubmit="return validateForm()">
                        @csrf

                        <!-- Email Input -->
                        <div class="form-floating mb-2">
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" required value="{{ old('email') }}" onkeyup="validateForm()">
                            <label>Enter Email</label>
                            <span id="emailError" class="text-danger"></span>
                        </div>

                        <!-- Hidden OTP Email -->
                        <input type="hidden" name="otp_email" value="{{ session()->get('otp_identifier_email') }}">

                        <!-- New Password Input -->
                        <div class="form-floating mb-2">
                            <input type="password" class="form-control" id="newPassword" name="password" placeholder="Enter New Password" required onkeyup="validateForm()">
                            <label>Enter New Password</label>
                            <span id="passwordError" class="text-danger"></span>
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="form-floating mb-2">
                            <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Enter Confirm Password" required onkeyup="validateForm()">
                            <label>Enter Confirm Password</label>
                            <span id="confirmPasswordError" class="text-danger"></span>
                        </div>

                        <div class="d-grid mt-4">
                            <input type="submit" class="btn btn-secondary p-2" value="Set Password">
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function validateForm() {
        let email = document.querySelector("input[name='email']").value;
        let otpEmail = document.querySelector("input[name='otp_email']").value;
        let newPassword = document.getElementById("newPassword").value;
        let confirmPassword = document.getElementById("confirmPassword").value;
        let emailError = document.getElementById("emailError");
        let passwordError = document.getElementById("passwordError");
        let confirmPasswordError = document.getElementById("confirmPasswordError");

        let valid = true;

        // Email Match Validation
        if (email !== otpEmail) {
            emailError.textContent = "Email does not match otp email !";
            valid = false;
        } else {
            emailError.textContent = "";
        }

        // Password Match Validation
        if (newPassword.length < 6) {
            passwordError.textContent = "Password must be at least 6 characters.";
            valid = false;
        } else {
            passwordError.textContent = "";
        }

        if (newPassword !== confirmPassword) {
            confirmPasswordError.textContent = "Passwords do not match!";
            valid = false;
        } else {
            confirmPasswordError.textContent = "";
        }

        return valid;
    }
</script>
@endsection
