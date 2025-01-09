<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
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

                    <form id="registerForm" action="{{ route('register') }}" method="post" autocomplete="off">
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
                            <input type="submit" class="btn btn-secondary p-2" value="Sign Up">
                        </div>
                    </form>
                    <hr>
                    <a href="{{ route('login') }}" class="d-flex justify-content-center">Already have an account?</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const registerForm = document.getElementById('registerForm');

    const fullNameInput = document.getElementById('nameInput');
    const userNameInput = document.getElementById('usernameInput');
    const phoneInput = document.getElementById('phoneInput');
    const emailInput = document.getElementById('emailInput');
    const passwordInput = document.getElementById('passwordInput');
    const termsInput = document.getElementById('customCheckc1');
    const submitButton = document.getElementById('submitButton');

    const nameError = document.getElementById('nameError');
    const usernameError = document.getElementById('usernameError');
    const phoneError = document.getElementById('phoneError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const termsError = document.getElementById('termsError');

    let isFullNameUnique = true;
    let isUsernameUnique = true;
    let isPhoneUnique = true;
    let isEmailUnique = true;

    const checkUniqueness = (value, route, errorField, fieldName) => {
        return fetch(route, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ [fieldName]: value })
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                errorField.textContent = `This ${fieldName} is already registered.`;
                return false;
            } else {
                errorField.textContent = '';
                return true;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            return false;
        });
    };
    const validateFullName = () => {
    const value = fullNameInput.value.trim();
    if (value.length < 5) {
        nameError.textContent = 'Full Name must be at least 5 characters.';
        return false;
    }
    nameError.textContent = '';
    return true;
};

    const validateUserName = () => {
        const value = userNameInput.value.trim();
        if (value === '' ) {
            usernameError.textContent = 'Username is required.';
            isUsernameUnique = false;
            return false;
        }
        if (value.length < 5 ) {
            usernameError.textContent = 'User Name must be at least 5 characters.';
            isUsernameUnique = false;
            return false;
        }

        checkUniqueness(value, '{{ route("check.username") }}', usernameError, 'username')
            .then(isUnique => (isUsernameUnique = isUnique));

        return true;
    };

    const validatePhone = () => {
        const value = phoneInput.value.trim();
        if (!/^\d{10}$/.test(value)) {
            phoneError.textContent = 'Phone number must be exactly 10 digits.';
            isPhoneUnique = false;
            return false;
        }


        checkUniqueness(value, '{{ route("check.phone") }}', phoneError, 'phone')
            .then(isUnique => (isPhoneUnique = isUnique));

        return true;
    };

    const validateEmail = () => {
        const value = emailInput.value.trim();
        const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        if (!isValid) {
            emailError.textContent = 'Invalid email format.';
            isEmailUnique = false;
            return false;
        }


        checkUniqueness(value, '{{ route("check.email") }}', emailError, 'email')
            .then(isUnique => (isEmailUnique = isUnique));

        return true;
    };

    const validatePassword = () => {
        if (passwordInput.value.trim().length < 6) {
            passwordError.textContent = 'Password must be at least 6 characters.';
            return false;
        }
        passwordError.textContent = '';
        return true;
    };

    const validateTerms = () => {
        if (!termsInput.checked) {
            termsError.textContent = 'You must agree to the terms and conditions.';
            return false;
        }
        termsError.textContent = '';
        return true;
    };


    registerForm.addEventListener('submit', async function (event) {
        event.preventDefault();


        const isFormValid =
            validateFullName() &&
            validatePassword() &&
            validateTerms();

        await validateFullName();
        await validateUserName();
        await validatePhone();
        await validateEmail();

        if (
            isFormValid &&
            isFullNameUnique &&
            isUsernameUnique &&
            isPhoneUnique &&
            isEmailUnique
        ) {
            this.submit();
        } else {
            console.error('Form has errors, fix them before submitting.');
        }
    });

    fullNameInput.addEventListener('blur', validateFullName);
    userNameInput.addEventListener('blur', validateUserName);
    phoneInput.addEventListener('blur', validatePhone);
    emailInput.addEventListener('blur', validateEmail);
    passwordInput.addEventListener('input', validatePassword);
    termsInput.addEventListener('change', validateTerms);
</script>

<script>
    document.getElementById('registerForm').addEventListener('submit', function (event) {
    const termsInput = document.getElementById('customCheckc1');
    if (!termsInput.checked) {
        termsInput.value = '0';
    }
});

</script>


@endsection
