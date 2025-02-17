<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>


@extends('layouts.app')

@section('pageTitle', 'Register')

@section('content')

<style>
    .iti {
        width: 100%;
    }

    .iti input {
        padding-left: 80px !important;
        /* Ensure space for the flag */
    }

    .form-floating>.iti input {
        height: calc(3.5rem + 2px);
        /* Match Bootstrap input height */
    }

    .iti__selected-flag {
        height: 100%;
        display: flex;
        align-items: center;
        padding-left: 10px;
        /* Adjust flag position */
    }

    .iti__country-list {
        z-index: 10
    }
</style>


<div class="auth-main">

    <div class="auth-wrapper v3">

        <div class="auth-form">
            <div class="card mt-5">
                <div class="card-body">
                    <a href="#" class="d-flex justify-content-center mt-0"><img src="asset/images/logo.png" alt="image"
                            style="max-width: 50%;"></a>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="auth-header">
                                <h2 class="text-secondary mt-2"><b>Sign up</b></h2>
                                <p class="f-16 mt-2">Enter your credentials to continue</p>
                            </div>
                        </div>
                    </div>



                    <form id="registerForm" action="{{ route('register') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nameInput" placeholder="Enter Full Name"
                                        name="full_name" required value="{{ old('full_name') }}">
                                    <label for="nameInput">Full Name</label>
                                    <small id="nameError" class="text-danger"></small>
                                    @error('full_name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="usernameInput"
                                        placeholder="Enter Username" name="user_name" required
                                        value="{{ old('user_name') }}"
                                        oninput="this.value = this.value.replace(/\s/g, '')">
                                    <label for="usernameInput">Username</label>
                                    <small id="usernameError" class="text-danger"></small>
                                    @error('user_name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>




                            {{-- <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="hidden" id="countryCode" name="country_code"
                                        value="{{ old('country_code','+91') }}">
                                    <input type="tel" class="form-control" id="phoneInput" placeholder="Enter Phone"
                                        name="phone" required pattern="[0-9]*" inputmode="numeric"
                                        oninput="this.value = this.value.replace(/\D/g, '')" value="{{ old('phone') }}">

                                    <small id="phoneError" class="text-danger"></small>
                                    @error('country_code')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <!-- Hidden Fields for Country Code & Country Name -->
                                    <input type="hidden" id="countryCode" name="country_code" value="{{ old('country_code', '+91') }}">
                                    <input type="hidden" id="countryName" name="country_name" value="{{ old('country_name') }}">

                                    <!-- Phone Number Input -->
                                    <input type="tel" class="form-control" id="phoneInput" placeholder="Enter Phone"
                                        name="phone" required pattern="[0-9]*" inputmode="numeric"
                                        oninput="this.value = this.value.replace(/\D/g, '')" value="{{ old('phone') }}">

                                    <small id="phoneError" class="text-danger"></small>

                                    @error('country_code')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    @error('country_name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>



                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="emailInput" placeholder="Email Address"
                                name="email" required value="{{ old('email') }}">
                            <label for="emailInput">Email Address</label>
                            <small id="emailError" class="text-danger"></small>
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="passwordInput" placeholder="Password"
                                name="password" required>
                            <label for="passwordInput">Password</label>
                            <small id="passwordError" class="text-danger"></small>
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input input-primary" type="checkbox" id="customCheckc1"
                                name="tandc_status" value="1">
                            <label class="form-check-label" for="customCheckc1">
                                <span class="h5 mb-0">Agree with <span>Terms & Condition.</span></span>
                            </label><br>
                            <small id="termsError" class="text-danger"></small>
                            @error('tandc_status')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-grid mt-4">
                            <input type="submit" id="submitButton" class="btn btn-secondary p-2" value="Sign Up">
                        </div>
                    </form>



                    <hr>
                    <a href="{{ route('login') }}" class="d-flex justify-content-center">Already have an account?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
    var input = document.querySelector("#phoneInput");

    var iti = window.intlTelInput(input, {
        initialCountry: "auto",
        separateDialCode: true,  // Show country code separately
        preferredCountries: ["in", "us", "gb"], // Preferred countries
        geoIpLookup: function (callback) {
            fetch('https://ipapi.co/json/') // Detect user location
                .then(response => response.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("IN")); // Fallback to India
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });

    // Ensure only numbers are entered
    input.addEventListener("input", function () {
        this.value = this.value.replace(/\D/g, ''); // Allow only numbers
    });

    // Capture country code and validate phone number on form submit
    document.querySelector("#registerForm").addEventListener("submit", function (e) {
        var phoneNumber = iti.getNumber(); // Full number with country code
        var nationalNumber = input.value.replace(/\D/g, ''); // Strip non-numeric characters
        var countryCode = iti.getSelectedCountryData().dialCode; // Get selected country code

        // Store country code separately
        document.querySelector("#countryCode").value = "+" + countryCode;

    });
});
</script> --}}

<script>
    document.addEventListener("DOMContentLoaded", function () {
    var input = document.querySelector("#phoneInput");

    var iti = window.intlTelInput(input, {
        initialCountry: "auto",
        separateDialCode: true,
        preferredCountries: ["in", "us", "gb"],
        geoIpLookup: function (callback) {
            fetch('https://ipapi.co/json/')
                .then(response => response.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("IN"));
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });

    input.addEventListener("input", function () {
        this.value = this.value.replace(/\D/g, '');
    });

    // Capture country code and country name on form submit
    document.querySelector("#registerForm").addEventListener("submit", function (e) {
        var countryData = iti.getSelectedCountryData();
        var countryCode = "+" + countryData.dialCode; // Get country code
        var countryName = countryData.name; // Get full country name

        document.querySelector("#countryCode").value = countryCode;
        document.querySelector("#countryName").value = countryName;
    });
});

</script>


@endsection
