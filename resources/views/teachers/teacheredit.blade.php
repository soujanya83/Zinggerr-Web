<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@extends('layouts.app')

@section('pageTitle', 'Update Teacher')

@section('content')
@include('partials.sidebar')
@include('partials.headerdashboard')

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Teachers View</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Teacher</a></li>
                            <li class="breadcrumb-item" aria-current="page">Update</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

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



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Update Teacher</h5>
                    </div>
                    <div class="card-body">
                        <form id="registerForm" id="createuser" action="{{ route('updateteacher') }}" method="post"
                            autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="userid" value="{{ $user->id }}">

                            <div class="row">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="nameInput">Full Name</label>
                                            <input type="text" class="form-control" id="nameInput" name="name"
                                                value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="usernameInput">Username</label>
                                            <input type="text" class="form-control" id="usernameInput" name="username"
                                                value="{{ old('username', $user->username) }}" required  oninput="this.value = this.value.replace(/\s/g, '')">
                                            @error('username')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class=" mb-3">
                                            <label for="phoneInput">Phone</label>
                                            <input type="tel" class="form-control" id="phoneInput" placeholder=""
                                                name="phone" required value="{{ old('phone', $user->phone) }}" readonly>

                                            <small id="phoneError" class="text-danger"></small>
                                            @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class=" mb-3">
                                            <label for="emailInput">Email</label>
                                            <input type="email" class="form-control" id="emailInput" placeholder=""
                                                name="email" required value="{{ old('email', $user->email) }}" readonly>

                                            <small id="emailError" class="text-danger"></small>
                                            @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="passwordInput">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="passwordInput"
                                                    name="password" required placeholder="Enter New Password">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="togglePassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            <small id="passwordError" class="text-danger"></small>
                                            @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="profile_picture">Profile Picture</label>

                                            <input type="file" name="profile_picture" class="form-control"
                                                accept="image/*">
                                            @if ($user->profile_picture)
                                            <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                                alt="Profile Picture" class="img-thumbnail mb-2" width="150px"
                                                height="150px">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="gender">Gender</label>
                                            <div style="margin-top: 10px">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="genderMale" value="Male" {{ old('gender', $user->gender) ==
                                                    'Male' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="genderMale">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="genderFemale" value="Female" {{ old('gender', $user->gender)
                                                    == 'Female' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="genderFemale">Female</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="genderOther" value="Other" {{ old('gender', $user->gender)
                                                    == 'Other' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="genderOther">Other</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="role" value="Teacher">

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <div style="margin-top: 10px">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="statusActive" value="1" {{ old('status', $user->status) == 1
                                                    ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="statusActive">Active</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="statusInactive" value="0" {{ old('status', $user->status) ==
                                                    0 ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="statusInactive">Inactive</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <input type="submit" class="btn btn-primary" id="submitButton" value="Submit">
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // JavaScript to toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('passwordInput');
        const icon = this.querySelector('i');

        // Toggle password visibility
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
</script>

{{-- <script>
    const registerForm = document.getElementById('registerForm');

    const fullNameInput = document.getElementById('nameInput');
    const userNameInput = document.getElementById('usernameInput');
    const phoneInput = document.getElementById('phoneInput');
    const emailInput = document.getElementById('emailInput');
    const passwordInput = document.getElementById('passwordInput');
    const submitButton = document.getElementById('submitButton');

    const nameError = document.getElementById('nameError');
    const usernameError = document.getElementById('usernameError');
    const phoneError = document.getElementById('phoneError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');

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
        if (value === '') {
            usernameError.textContent = 'Username is required.';
            isUsernameUnique = false;
            return false;
        }
        if (value.length < 5) {
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

    registerForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        const isFormValid =
            validateFullName() &&
            validateUserName() &&
            validatePhone() &&
            validateEmail() &&
            validatePassword();

        await Promise.all([
            validateUserName(),
            validatePhone(),
            validateEmail()
        ]);

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
</script> --}}





@include('partials.footer')
@endsection
