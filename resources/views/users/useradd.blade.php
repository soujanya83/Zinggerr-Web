<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

@extends('layouts.app')

@section('pageTitle', 'Users Create')

@section('content')
@include('partials.sidebar')
@include('partials.headerdashboard')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .iti {
        width: 100%;
    }

</style>


<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Create User</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Users</a></li>
                            <li class="breadcrumb-item" aria-current="page">Create</li>
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
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Create User</h5>
                    </div>
                    <div class="card-body">
                        <form id="registerForm" action="{{ route('createuser') }}" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf



                            <div class="row">

                                <div class="col-md-4">
                                    <div class=" mb-3">
                                        <label for="emailInput">Role</label>
                                        <select name="role" id="roleSelect" class="form-select" required>
                                            <option value="">Select Role</option>
                                            <option value="other">Other</option>
                                            @foreach($role as $roledata)
                                            <option value="{{ $roledata->name }}">{{ $roledata->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class=" mb-3">
                                        <label for="nameInput">Full Name</label>
                                        <input type="text" class="form-control" id="nameInput" name="name" required
                                            value="{{ old('name') }}">

                                        <small id="nameError" class="text-danger"></small>
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class=" mb-3">
                                        <label for="usernameInput">Username</label>
                                        <input type="text" class="form-control" id="usernameInput" placeholder=""
                                            name="username" required value="{{ old('username') }}"
                                            oninput="this.value = this.value.replace(/\s/g, '')">

                                        <small id="usernameError" class="text-danger"></small>
                                        @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="col-md-4">
                                    <div class="mb-3 position-relative">
                                        <label for="usernameInput">Username</label>
                                        <input type="text" class="form-control" id="usernameInput" name="username" required
                                               oninput="this.value = this.value.replace(/\s/g, '')">

                                        <!-- Suggestions Dropdown -->
                                        <div class="position-relative">
                                            <div id="usernameSuggestions" class="suggestions-box" style="display: none; position: absolute; background: #fff; border: 1px solid #ccc; width: 100%; z-index: 1000; padding: 5px;">
                                                <strong style="color:rgb(18, 18, 98)">Suggested Usernames:</strong>
                                                <div id="suggestionsList" class="mt-1"></div>
                                            </div>
                                        </div>
                                        <small id="usernameError" class="text-danger"></small>
                                        @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>




                                <div class="col-md-4" style="margin-top: -8px;">
                                    <div class="mb-3">
                                        <label for="phoneInput" class="form-label">Phone</label>
                                        <div class="input-group" style="display: flex; align-items: center;">
                                            <input type="tel" class="form-control" id="phoneInput" name="phone" required
                                                value="{{ old('phone') }}" style="height: 43px;">
                                            <input type="hidden" name="full_phone" id="fullPhone">
                                            <input type="hidden" name="country_code" id="countryCode">
                                            <input type="hidden" name="country_name" id="countryName">
                                        </div>
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
                                            name="email" required value="{{ old('email') }}">

                                        <small id="emailError" class="text-danger"></small>
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class=" mb-3">
                                        <label for="passwordInput">Password</label>
                                        <div class="input-group">
                                            <input type="password" id="passwordInput" class="form-control"
                                                name="password" required>
                                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
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
                                    <div class=" mb-3">
                                        <label for="profile">Profile Picture</label>
                                        <input type="file" name="profile_picture" class="form-control" accept="image/*"
                                            placeholder="Profile Picture" id="profile">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="gender">Gender:</label>
                                        <div style="margin-top: 10px;">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="genderMale" value="Male" checked>
                                                <label class="form-check-label" for="genderMale">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="genderFemale" value="Female">
                                                <label class="form-check-label" for="genderFemale">Female</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="genderOther" value="Other">
                                                <label class="form-check-label" for="genderOther">Other</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="status">Status:</label>
                                        <div style="margin-top: 10px;">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="statusActive" value="1" checked>
                                                <label class="form-check-label" for="statusActive">Active</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="statusInactive" value="0">
                                                <label class="form-check-label" for="statusInactive">Inactive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <input type="submit" class="btn  btn-shadow btn-primary" id="submitButton"
                                        value="Submit">
                                </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Creating New Role -->
<div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="createRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRoleModalLabel">Create New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('roles.newstore') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="roleName" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="roleName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="roleDescription" class="form-label">Role Description</label>
                        <textarea class="form-control" id="roleDescription" name="description" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Role</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('roleSelect');
    const createRoleModal = new bootstrap.Modal(document.getElementById('createRoleModal'));

    roleSelect.addEventListener('change', function () {
        if (this.value === 'other') {
            createRoleModal.show();
            this.value = ''; // Reset the dropdown selection
        }
    });
});

</script>


<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('passwordInput');
        const icon = this.querySelector('i');
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
    document.addEventListener('DOMContentLoaded', () => {
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
            method: 'post',
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
       });
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', () => {
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

            return checkUniqueness(value, '{{ route("check.username") }}', usernameError, 'username')
                .then(isUnique => (isUsernameUnique = isUnique));
        };

        const validatePhone = () => {
            const value = phoneInput.value.trim();
            if (!/^\d{10}$/.test(value)) {
                phoneError.textContent = 'Phone number must be exactly 10 digits.';
                isPhoneUnique = false;
                return false;
            }

            return checkUniqueness(value, '{{ route("check.phone") }}', phoneError, 'phone')
                .then(isUnique => (isPhoneUnique = isUnique));
        };

        const validateEmail = () => {
            const value = emailInput.value.trim();
            const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
            if (!isValid) {
                emailError.textContent = 'Invalid email format.';
                isEmailUnique = false;
                return false;
            }

            return checkUniqueness(value, '{{ route("check.email") }}', emailError, 'email')
                .then(isUnique => (isEmailUnique = isUnique));
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
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var input = document.querySelector("#phoneInput");
        var iti = window.intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                fetch('https://ipapi.co/json')
                    .then(response => response.json())
                    .then(data => callback(data.country_code))
                    .catch(() => callback("US"));
            },
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        input.addEventListener("blur", function() {
            document.querySelector("#fullPhone").value = iti.getNumber(); // Full phone number
            document.querySelector("#countryCode").value = iti.getSelectedCountryData().dialCode; // Country code
            document.querySelector("#countryName").value = iti.getSelectedCountryData().name; // Country name
        });
    });
</script>


@include('partials.footer')
@endsection
