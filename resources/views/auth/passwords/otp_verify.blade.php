@extends('layouts.app')

@section('pageTitle', 'Forgot Password')

@section('content')
<style>
    .otp-input-container {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .otp-box {
        width: 50px;
        height: 50px;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        border: 2px solid #ccc;
        border-radius: 5px;
    }

    .otp-box:focus {
        border-color: #4CAF50;
        outline: none;
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
            <div class="card mt-5"   style="background-image: url('{{ asset('asset/zinggerr-web-image.jpg') }}'); background-size: cover; background-position: center;">
                <div class="card-body">
                    <a href="#" class="d-flex justify-content-center">
                        <img src="asset/images/logo.png" alt="image" style="max-width: 50%;">
                    </a>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="auth-header text-center">
                                <h2 class="text-secondary mt-3"><b>Reset Password</b></h2>
                                <p class="f-16 mt-3">Enter your OTP</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('opt.submit') }}" method="post">
                        @csrf
                        <div class="otp-input-container d-flex justify-content-center">
                            <input type="text" class="otp-box form-control" maxlength="1" oninput="moveNext(this, 0)"
                                onpaste="handlePaste(event)" placeholder="-">
                            <input type="text" class="otp-box form-control" maxlength="1" oninput="moveNext(this, 1)"
                                placeholder="-">
                            <input type="text" class="otp-box form-control" maxlength="1" oninput="moveNext(this, 2)"
                                placeholder="-">
                            <input type="text" class="otp-box form-control" maxlength="1" oninput="moveNext(this, 3)"
                                placeholder="-">
                            <input type="text" class="otp-box form-control" maxlength="1" oninput="moveNext(this, 4)"
                                placeholder="-">
                            <input type="text" class="otp-box form-control" maxlength="1" oninput="moveNext(this, 5)"
                                placeholder="-">
                            <input type="hidden" name="otp" id="otpValue">
                        </div>

                        <div class="d-grid mt-4">
                            <input type="submit" class="btn btn-secondary p-2" value="Verify OTP">
                        </div>
                    </form>

                    <hr>
                    <!-- Resend OTP Button -->
                    <p class="text-center mt-3">
                        Didn't receive OTP?
                        <a href="{{ route('resend.otp') }}" onclick="disableResendButton(event)">Resend OTP</a>
                        <span id="resendTimer" class="text-danger"></span>
                    </p>



                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function moveNext(input, index) {
        let allInputs = document.querySelectorAll(".otp-box");

        // Move focus to next input if filled
        if (input.value.length === 1 && index < allInputs.length - 1) {
            allInputs[index + 1].focus();
        }

        // Combine OTP values into hidden input
        document.getElementById("otpValue").value = Array.from(allInputs).map(i => i.value).join('');
    }

    function handlePaste(event) {
        event.preventDefault();
        let pasteData = (event.clipboardData || window.clipboardData).getData('text').trim();
        let otpDigits = pasteData.replace(/\D/g, "").slice(0, 6); // Extract digits only, limit to 6 characters

        if (otpDigits.length === 6) {
            let otpInputs = document.querySelectorAll(".otp-box");
            otpDigits.split("").forEach((digit, index) => otpInputs[index].value = digit);
            document.getElementById("otpValue").value = otpDigits;
        }
    }
</script>

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

@endsection
