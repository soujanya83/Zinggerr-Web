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
<style>
    .suggestions-box {
        border: 1px solid #ccc;
        background: white;
        position: absolute;
        z-index: 10;
        width: 100%;
        border-radius: 5px;
        margin-top: 2px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        padding: 8px;
    }

    .suggestions-heading {
        font-size: 14px;
        font-weight: bold;
        display: block;
        padding-bottom: 5px;
        border-bottom: 1px solid #ddd;
        margin-bottom: 5px;
    }

    .suggestion-item {
        padding: 8px;
        cursor: pointer;
        border-bottom: 1px solid #eeeeee;
    }

    .suggestion-item:last-child {
        border-bottom: none;
    }

    .suggestion-item:hover {
        background: #f5f5f5;
    }
</style>

<div class="auth-main">

    <div class="auth-wrapper v3">

        <div class="auth-form">
            <div class="card mt-5">
                <div class="card-body">
                    <a href="#" class="d-flex justify-content-center mt-0"><img src="../asset/images/logo.png"
                            alt="image" style="max-width: 50%;"></a>
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

                            <div class="col-md-12 position-relative">
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
                                <!-- Suggestions Dropdown -->
                                <div class="position-relative" style="margin-top:-17px">
                                    <div id="usernameSuggestions" class="suggestions-box"
                                        style="display: none; position: absolute; background: #fff; border: 1px solid #ccc; width: 100%; z-index: 1000; padding: 5px;">
                                        <strong style="color:rgb(18, 18, 98)">Suggested Usernames:</strong>
                                        <div id="suggestionsList" class="mt-1"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="form-floating mb-3">
                                    <!-- Hidden Fields for Country Code & Country Name -->
                                    <input type="hidden" id="countryCode" name="country_code"
                                        value="{{ old('country_code', '+91') }}">
                                    <input type="hidden" id="countryName" name="country_name"
                                        value="{{ old('country_name') }}">

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

                            <div class="col-md-6 mt-3">
                                <div class="form-floating mb-3">
                                    <select class="form-control" id="roleTypeInput" name="role_type" required>
                                        <option value="" disabled selected>Select Role</option>
                                        <option value="Faculty" {{ old('role_type') == 'Faculty' ? 'selected' : '' }}>Faculty</option>
                                        <option value="Student" {{ old('role_type') == 'Student' ? 'selected' : '' }}>Student</option>
                                    </select>
                                    <label for="roleTypeInput">Role Type</label>

                                    <small id="roleTypeError" class="text-danger"></small>
                                    @error('role_type')
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const fullNameInput = document.getElementById('nameInput'); // Full Name field
    const userNameInput = document.getElementById('usernameInput'); // Username field
    const suggestionsBox = document.getElementById('usernameSuggestions'); // Suggestions box
    const suggestionsList = document.getElementById('suggestionsList'); // Suggestions list inside the box

    // Function to generate username suggestions based on full name
    const generateUsernames = (fullName) => {
        if (!fullName) return [];

        let cleanName = fullName.trim().replace(/\s+/g, '').toLowerCase(); // Remove spaces
        let randomNum = () => Math.floor(10000 + Math.random() * 90000); // 5-digit random number
        let variations = [
            cleanName + randomNum(),
            cleanName + '_' + randomNum(),
            cleanName.charAt(0).toUpperCase() + cleanName.slice(1) + randomNum(),
            cleanName.slice(0, 3).toUpperCase() + cleanName.slice(3) + randomNum(),
            cleanName.toLowerCase() + '.' + randomNum()
        ];

        return variations;
    };

    // Check if usernames exist in the database
    const checkUsernames = async (usernames) => {
        try {
            let response = await fetch('{{ route("check.username.suggestion") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ usernames })
            });

            let data = await response.json();
            console.log("Backend Response:", data); // Debugging output
            return data;
        } catch (error) {
            console.error('Error checking usernames:', error);
            return [];
        }
    };

    // Function to update and display username suggestions
    const updateUsernameSuggestions = async () => {
        let fullName = fullNameInput.value.trim();
        if (!fullName) {
            suggestionsBox.style.display = 'none';
            return;
        }

        let suggestions = generateUsernames(fullName);
        let availableUsernames = await checkUsernames(suggestions);

        console.log("Available Usernames:", availableUsernames);

        // Clear previous suggestions
        suggestionsList.innerHTML = '';

        if (availableUsernames.length > 0) {
            availableUsernames.forEach(username => {
                let div = document.createElement('div');
                div.classList.add('suggestion-item');
                div.textContent = username;
                div.addEventListener('click', () => {
                    userNameInput.value = username;
                    suggestionsBox.style.display = 'none';
                });
                suggestionsList.appendChild(div);
            });

            // Ensure suggestions box is visible
            suggestionsBox.style.display = 'block';
        } else {
            suggestionsBox.style.display = 'none';
        }
    };

    // Show suggestions when user focuses on the username field
    userNameInput.addEventListener('focus', updateUsernameSuggestions);

    // Hide suggestions if user clicks outside
    document.addEventListener('click', (event) => {
        if (!suggestionsBox.contains(event.target) && event.target !== userNameInput) {
            suggestionsBox.style.display = 'none';
        }
    });
});

</script>

@endsection
