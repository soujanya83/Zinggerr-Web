<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">


@extends('layouts.app')

@section('pageTitle', 'Register')

@section('content')

<div class="auth-main">

    <div class="auth-wrapper v3">

        <div class="auth-form">
            <div class="card mt-5">
                <div class="card-body">
                    <a href="#" class="d-flex justify-content-center mt-3"><img src="asset/images/logo.png" alt="image"
                            style="max-width: 50%;"></a>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="auth-header">
                                <h2 class="text-secondary mt-5"><b>Sign up</b></h2>
                                <p class="f-16 mt-2">Enter your credentials to continue</p>
                            </div>
                        </div>
                    </div>

                    {{-- <form id="registerForm" action="{{ route('register') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nameInput" placeholder="Enter Full Name"
                                        name="full_name" required>
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
                                        placeholder="Enter Username" name="user_name" required>
                                    <label for="usernameInput">Username</label>
                                    <small id="usernameError" class="text-danger"></small>
                                    @error('user_name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="phoneInput" placeholder="Enter Phone"
                                        name="phone" required>
                                    <label for="phoneInput">Phone</label>
                                    <small id="phoneError" class="text-danger"></small>
                                    @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="emailInput" placeholder="Email Address"
                                name="email" required>
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
                    </form> --}}

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
                                           placeholder="Enter Username" name="user_name" required value="{{ old('user_name') }}">
                                    <label for="usernameInput">Username</label>
                                    <small id="usernameError" class="text-danger"></small>
                                    @error('user_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="phoneInput" placeholder="Enter Phone"
                                           name="phone" required value="{{ old('phone') }}">
                                    <label for="phoneInput">Phone</label>
                                    <small id="phoneError" class="text-danger"></small>
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

{{-- <script>
    document.addEventListener('DOMContentLoaded', () => {
        const registerForm = document.getElementById('registerForm');

        const fullNameInput = document.getElementById('nameInput');
        const userNameInput = document.getElementById('usernameInput');
        const phoneInput = document.getElementById('phoneInput');
        const emailInput = document.getElementById('emailInput');
        const passwordInput = document.getElementById('passwordInput');

        const nameError = document.getElementById('nameError');
        const usernameError = document.getElementById('usernameError');
        const phoneError = document.getElementById('phoneError');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');

        let isFullNameUnique = true;
        let isUsernameUnique = true;
        let isPhoneUnique = true;
        let isEmailUnique = true;

        // Helper function for uniqueness checks
        const checkUniqueness = async (value, route, errorField, fieldName) => {
            try {
                const response = await fetch(route, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ [fieldName]: value })
                });

                const data = await response.json();

                if (data.exists) {
                    errorField.textContent = `This ${fieldName} is already registered.`;
                    return false;
                } else {
                    errorField.textContent = '';
                    return true;
                }
            } catch (error) {
                console.error('Error:', error);
                errorField.textContent = 'Error checking availability.';
                return false;
            }
        };

        // Validation functions
        const validateFullName = () => {
            const value = fullNameInput.value.trim();
            if (value.length < 5) {
                nameError.textContent = 'Full Name must be at least 5 characters.';
                return false;
            }
            nameError.textContent = '';
            return true;
        };

        const validateUserName = async () => {
            const value = userNameInput.value.trim();
            if (value === '') {
                usernameError.textContent = 'Username is required.';
                return false;
            }
            if (value.length < 5) {
                usernameError.textContent = 'Username must be at least 5 characters.';
                return false;
            }

            return (isUsernameUnique = await checkUniqueness(value, '{{ route("check.username") }}', usernameError, 'username'));
        };

        const validatePhone = async () => {
            const value = phoneInput.value.trim();
            if (!/^\d{10}$/.test(value)) {
                phoneError.textContent = 'Phone number must be exactly 10 digits.';
                return false;
            }

            return (isPhoneUnique = await checkUniqueness(value, '{{ route("check.phone") }}', phoneError, 'phone'));
        };

        const validateEmail = async () => {
            const value = emailInput.value.trim();
            const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
            if (!isValid) {
                emailError.textContent = 'Invalid email format.';
                return false;
            }

            return (isEmailUnique = await checkUniqueness(value, '{{ route("check.email") }}', emailError, 'email'));
        };

        const validatePassword = () => {
            if (passwordInput.value.trim().length < 6) {
                passwordError.textContent = 'Password must be at least 6 characters.';
                return false;
            }
            passwordError.textContent = '';
            return true;
        };

        // Form submission handler
        registerForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            const isFormValid =
                validateFullName() &&
                validatePassword();

            await Promise.all([validateUserName(), validatePhone(), validateEmail()]);

            if (isFormValid && isFullNameUnique && isUsernameUnique && isPhoneUnique && isEmailUnique) {
                registerForm.submit();
            } else {
                console.error('Form has errors, fix them before submitting.');
            }
        });

        // Add blur event listeners for real-time validation
        fullNameInput.addEventListener('blur', validateFullName);
        userNameInput.addEventListener('blur', () => validateUserName());
        phoneInput.addEventListener('blur', () => validatePhone());
        emailInput.addEventListener('blur', () => validateEmail());
        passwordInput.addEventListener('input', validatePassword);
    });
</script> --}}

{{-- <script>
    document.addEventListener('DOMContentLoaded', () => {
        const registerForm = document.getElementById('registerForm');

        const fullNameInput = document.getElementById('nameInput');
        const userNameInput = document.getElementById('usernameInput');
        const phoneInput = document.getElementById('phoneInput');
        const emailInput = document.getElementById('emailInput');
        const passwordInput = document.getElementById('passwordInput');

        const nameError = document.getElementById('nameError');
        const usernameError = document.getElementById('usernameError');
        const phoneError = document.getElementById('phoneError');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');

        // Helper function for uniqueness checks
        const checkUniqueness = async (value, route, errorField, fieldName) => {
            try {
                const response = await fetch(route, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ [fieldName]: value })
                });

                // const data = await response.json();

                if (data.exists) {
                    errorField.textContent = `This ${fieldName} is already registered.`;
                    return false;
                } else {
                    errorField.textContent = '';
                    return true;
                }
            } catch (error) {
                console.error('Error:', error);
                errorField.textContent = 'Error checking availability.';
                return false;
            }
        };

        // Reusable validation function
        const validateField = async (inputElement, errorElement, validationRules,
                                    uniquenessRoute, fieldName) => {
            const value = inputElement.value.trim();
            errorElement.textContent = '';

            for (const rule of validationRules) {
                if (rule === 'required' && value === '') {
                    errorElement.textContent = `${fieldName} is required.`;
                    return false;
                } else if (rule === 'minLength:5' && value.length < 5) {
                    errorElement.textContent = `${fieldName} must be at least 5 characters.`;
                    return false;
                } else if (rule === 'phone' && !/^\d{10}$/.test(value)) {
                    errorElement.textContent = 'Phone number must be exactly 10 digits.';
                    return false;
                } else if (rule === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                    errorElement.textContent = 'Invalid email format.';
                    return false;
                }
            }

            if (uniquenessRoute) {
                return await checkUniqueness(value, uniquenessRoute, errorElement, fieldName);
            }

            return true;
        };

        // Validation rules for each field
        const validationRules = {
            name: ['required', 'minLength:5'],
            username: ['required', 'minLength:5'],
            phone: ['required', 'phone'],
            email: ['required', 'email'],
            password: ['required', 'minLength:6']
        };

        // Add blur event listeners for real-time validation
        fullNameInput.addEventListener('blur', () =>
            validateField(fullNameInput, nameError, validationRules.name));
        userNameInput.addEventListener('blur', () =>
            validateField(userNameInput, usernameError, validationRules.username,
                          '{{ route("check.username") }}', 'Username'));
        phoneInput.addEventListener('blur', () =>
            validateField(phoneInput, phoneError, validationRules.phone,
                          '{{ route("check.phone") }}', 'Phone'));
        emailInput.addEventListener('blur', () =>
            validateField(emailInput, emailError, validationRules.email,
                          '{{ route("check.email") }}', 'Email'));
        passwordInput.addEventListener('input', () =>
            validateField(passwordInput, passwordError, validationRules.password));

        // Form submission handler
        registerForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            let isFormValid = true;

            // Validate all fields
            for (const field in validationRules) {
                const inputElement = document.getElementById(`${field}Input`);
                const errorElement = document.getElementById(`${field}Error`);
                isFormValid = isFormValid &&
                    await validateField(inputElement, errorElement, validationRules[field],
                                        field === 'username' ? '{{ route("check.username") }}' :
                                        field === 'phone' ? '{{ route("check.phone") }}' :
                                        field === 'email' ? '{{ route("check.email") }}' : null,
                                        field.charAt(0).toUpperCase() + field.slice(1));
            }

            if (isFormValid) {
                registerForm.submit();
            } else {
                console.error('Form has errors, fix them before submitting.');
            }
        });
    });
</script> --}}
@endsection
