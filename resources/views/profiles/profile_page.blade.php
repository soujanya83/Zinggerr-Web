@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
@section('pageTitle', 'User Account Settings')

@section('content')
@include('partials.sidebar')
@include('partials.header')

<style>
    .thspace {
        margin-left: 67%;
    }

    .iti {
        width: 100%;
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
                            <h5 class="m-b-10">Users Profile View</h5>
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
                    <div class="card-header pb-0">
                        <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1"
                                    role="tab" aria-selected="true">
                                    <i class="material-icons-two-tone me-1">account_circle</i>
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-1 icons">edit</i>
                                    Edit Profile
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-3" data-bs-toggle="tab" href="#profile-3" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-1">lock</i>
                                    Change Password
                                </a>
                            </li>
                        </ul>
                    </div>




                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="profile-1" role="tabpanel"
                                aria-labelledby="profile-tab-1">

                                <div class="row">


                                    <div class="col-md-3">
                                        <div class="card mb-3">
                                            <div class="card-body text-center">


                                                @if(Auth::user()->profile_picture)
                                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                                    class="rounded-circle" width="100" height="100">
                                                @else
                                                <img src="{{ asset('asset/images/user/download.jpg') }}"
                                                    class="rounded-circle" width="100" height="100">
                                                @endif

                                                <h5 class="card-title mt-3">{{ Str::title(Auth::user()->name) }}</h5>
                                                {{-- <p class="card-text">{{ Auth::user()->type }}</p> --}}
                                                <span class="badge bg-primary">@if(Auth::user()->type =='Superadmin')
                                                    SuperAdmin @else {{Auth::user()->type }} @endif</span>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item" style="margin-left: -16px;">
                                                    <i class="material-icons-two-tone f-20">email</i>
                                                    <strong>Emaiil</strong>
                                                    <span>&nbsp&nbsp {{ Auth::user()->email }}</span>
                                                </li>
                                                <li class="list-group-item" style="margin-left: -16px;">
                                                    <i class="material-icons-two-tone f-20">phonelink_ring</i>
                                                    <strong>Phone</strong>
                                                    <span>&nbsp&nbsp {{ Auth::user()->country_code.Auth::user()->phone
                                                        }}</span>
                                                </li>
                                                {{-- <li class="list-group-item">
                                                    <i class="material-icons-two-tone f-20">pin_drop</i>
                                                    <strong>Location</strong>
                                                    <span>&nbsp&nbsp INDIA</span>
                                                </li> --}}
                                            </ul>
                                            {{-- <div class="card-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5>37</h5>
                                                        <small>Mails</small>
                                                    </div>
                                                    <div class="col-4">
                                                        <h5>2749</h5>
                                                        <small>Followers</small>
                                                    </div>
                                                    <div class="col-4">
                                                        <h5>678</h5>
                                                        <small>Following</small>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h5>About Me</h5>
                                            </div>
                                            <div class="card-body">
                                                <p>Hello, I'm Anshan Handgun Creative Graphic Designer & User Experience
                                                    Designer based
                                                    in Website. I create digital Products a more Beautiful and usable
                                                    place. Morbid
                                                    accusant ipsum. Nam nec tellus at.</p>
                                            </div>
                                        </div>
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h5>Personal Details</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <th>Full Name</th>
                                                        <td>:</td>
                                                        <td>{{ Str::title(Auth::user()->name) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Username</th>
                                                        <td>:</td>
                                                        <td>{{ Auth::user()->username }}</td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <th>Address</th>
                                                        <td>:</td>
                                                        <td>Street 110-B Kalians Bag, Dewan, M.P. INDIA</td>
                                                    </tr> --}}
                                                    {{-- <tr>
                                                        <th>Zip Code</th>
                                                        <td>:</td>
                                                        <td>12345</td>
                                                    </tr> --}}
                                                    <tr>
                                                        <th>Phone</th>
                                                        <td>:</td>
                                                        <td>{{ Auth::user()->country_code.Auth::user()->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email</th>
                                                        <td>:</td>
                                                        <td>{{ Auth::user()->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Gender</th>
                                                        <td>:</td>
                                                        <td>{{ Auth::user()->gender }}</td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <th>Gender</th>
                                                        <td>:</td>
                                                        <td>24 Dec 1996</td>
                                                    </tr> --}}
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                                <div class="card">
                                    {{-- <div class="card-header">
                                        <h5>Edit Profile</h5>
                                    </div> --}}
                                    {{-- <div class="card-body"> --}}
                                        <form id="editForm" action="{{ route('user.profile.update') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            {{-- @method('PUT') --}}

                                            {{-- <input type="hidden" name="userid" value="{{ Auth::user()->id }}"> --}}

                                            <table class="table table-borderless" style="margin-left: -178px;">
                                                <tr>
                                                    <th class="col-md-4"><span class="thspace">Profile Picture</span>
                                                    </th>
                                                    <td class="col-md-1">:</td>
                                                    <td class="col-md-4">

                                                        @if(Auth::user()->profile_picture)
                                                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                                            class="rounded-circle" width="100" height="100">
                                                        @else
                                                        <img src="{{ asset('asset/images/user/download.jpg') }}"
                                                            class="rounded-circle" width="100" height="100">
                                                        @endif

                                                        <div class="mt-3">
                                                            <input type="file" name="profile_picture"
                                                                class="form-control" accept="image/*">
                                                        </div>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th> <span class="thspace">Full Name</span> </th>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ old('name', Auth::user()->name) }}" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th><span class="thspace">Username</span></th>
                                                    <td>:</td>
                                                    {{-- <td>{{ Auth::user()->username }} <small
                                                            class="text-muted">(Read Only)</small></td> --}}
                                                    <td><input type="text" class="form-control" name="username"
                                                            value="{{ old('username', Auth::user()->username) }}"
                                                            required
                                                            oninput="this.value = this.value.replace(/\s/g, '')"></td>
                                                </tr>
                                                <tr>
                                                    <th><span class="thspace">Phone</span></th>
                                                    <td>:</td>

                                                    <td>
                                                        <input type="text" class="form-control" id="phoneInput"
                                                            name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                                            required>
                                                        <input type="hidden" id="country_code" name="country_code">
                                                        <input type="hidden" id="country_name" name="country_name">
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <th><span class="thspace">Email</span></th>
                                                    <td>:</td>
                                                    {{-- <td>{{ Auth::user()->email }} <small class="text-muted">(Read
                                                            Only)</small></td> --}}
                                                    <td><input type="text" class="form-control" name="email"
                                                            value="{{ old('email', Auth::user()->email) }}" readonly
                                                            required></td>
                                                </tr>
                                                <tr>
                                                    <th><span class="thspace">Gender</span></th>
                                                    <td>:</td>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                id="genderMale" value="Male" {{ old('gender',
                                                                Auth::user()->gender) == 'Male' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="genderMale">Male</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                id="genderFemale" value="Female" {{ old('gender',
                                                                Auth::user()->gender) == 'Female' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="genderFemale">Female</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                id="genderOther" value="Other" {{ old('gender',
                                                                Auth::user()->gender) == 'Other' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="genderOther">Other</label>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </table>
                                            <button type="submit" class="btn  btn-shadow btn-success"
                                                style="margin-left: 1003px;">Update
                                                Profile</button>
                                        </form>
                                        {{--
                                    </div> --}}
                                </div>
                            </div>

                            {{-- ...........................................changa
                            password.................................................. --}}



                            <div class="tab-pane fade" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-3">

                                {{-- <div class="card-body">
                                    <div class="tab-content"> --}}



                                        <div class="tab-pane active show" id="profile-4" role="tabpanel"
                                            aria-labelledby="profile-tab-4">
                                            <div class="alert alert-warning" role="alert">
                                                <h5 class="alert-heading"><i class="feather icon-alert-circle me-2"></i>
                                                    Alert!</h5>
                                                {{-- <p>Your Password will expire in every 3 months. So change it
                                                    periodically.</p> --}}
                                                <hr>
                                                <p class="mb-0"><b>Do not share your password</b></p>
                                            </div>

                                            <form action="{{ route('user.changepassword') }}" method="post">
                                                @csrf
                                                <div class="card border">
                                                    <div class="card-header">
                                                        <h5>Change Password</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="mb-3 position-relative">
                                                                    <label class="form-label">Current Password <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="password" id="currentPassword"
                                                                        name="current_password" class="form-control"
                                                                        placeholder="Enter your current password">
                                                                    <button type="button" style="top: 34%;"
                                                                        class="btn btn-outline-secondary toggle-password eyebutton"
                                                                        data-target="currentPassword">
                                                                        <i class="fa fa-eye"></i>
                                                                    </button>
                                                                    <small class="form-text text-muted">
                                                                        Forgot password? <a
                                                                            href="{{ route('forgot.password.sendOtp') }}">Click
                                                                            here</a>
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="mb-3 position-relative">
                                                                    <label class="form-label">New Password <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="password" id="newPassword"
                                                                        name="new_password" class="form-control"
                                                                        placeholder="Enter new password">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary toggle-password eyebutton"
                                                                        data-target="newPassword">
                                                                        <i class="fa fa-eye"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="mb-3 position-relative">
                                                                    <label class="form-label">Confirm Password <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="password" id="confirmPassword"
                                                                        name="new_password_confirmation"
                                                                        class="form-control"
                                                                        placeholder="Confirm your new password">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary toggle-password eyebutton"
                                                                        data-target="confirmPassword">
                                                                        <i class="fa fa-eye"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-end">
                                                        <button type="submit" class="btn btn-shadow btn-danger">Change
                                                            Password</button>
                                                        <button type="reset"
                                                            class="btn btn-shadow btn-outline-dark ms-2">Clear</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        {{--
                                    </div>
                                </div> --}}


                            </div>
                            <div class="tab-pane fade" id="profile-4" role="tabpanel" aria-labelledby="profile-tab-4">
                                {{-- /////////////////////////////////////////////// --}}
                            </div>
                            <div class="tab-pane fade" id="profile-5" role="tabpanel" aria-labelledby="profile-tab-5">
                            </div>
                        </div>
                    </div>
                </div>






            </div>

        </div>
        <!-- [ sample-page ] end -->
    </div>
</div>

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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var input = document.querySelector("#phoneInput");
        var countryCodeInput = document.querySelector("#country_code");
        var countryNameInput = document.querySelector("#country_name");

        // Get phone number from Laravel (ensure correct syntax)
        var savedPhone = "{{ Auth::user()->phone }}".replace(/-/g, ""); // Remove any dashes if present

        // Get country name from Laravel (ensure correct syntax)
        var savedCountryName = "{{ Auth::user()->country_name }}";

        // Extract only the English part before "("
        var englishCountryName = savedCountryName.split(" (")[0].trim();

        // Country name to ISO2 mapping
        var countryNameToCode = {
            "Afghanistan": "af", "Albania": "al", "Algeria": "dz", "Andorra": "ad", "Angola": "ao",
            "Argentina": "ar", "Australia": "au", "Austria": "at", "Bangladesh": "bd", "Belgium": "be",
            "Brazil": "br", "Canada": "ca", "China": "cn", "Denmark": "dk", "Egypt": "eg",
            "France": "fr", "Germany": "de", "India": "in", "Indonesia": "id", "Italy": "it",
            "Japan": "jp", "Mexico": "mx", "Nepal": "np", "Netherlands": "nl", "Pakistan": "pk",
            "Russia": "ru", "Saudi Arabia": "sa", "South Africa": "za", "Spain": "es", "Sri Lanka": "lk",
            "Sweden": "se", "Switzerland": "ch", "Thailand": "th", "United Kingdom": "gb", "United States": "us",
            "Vietnam": "vn", "Zimbabwe": "zw"
        };

        // Convert country name to country code
        var savedCountryCode = countryNameToCode[englishCountryName] || "au"; // Default to "US" if not found

        // Initialize intlTelInput
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: savedCountryCode,
            nationalMode: false, // Ensures raw number input without formatting
            formatOnDisplay: false, // Prevents display formatting (e.g., no dashes)
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        // Ensure correct country is set
        iti.promise.then(() => {
            if (savedCountryCode) {
                iti.setCountry(savedCountryCode);
            }
            updateHiddenFields();
        });

        // Update hidden fields when the country is changed
        input.addEventListener("countrychange", function () {
            updateHiddenFields();
        });

        function updateHiddenFields() {
            var countryData = iti.getSelectedCountryData();
            countryCodeInput.value = countryData.dialCode; // Country code (e.g., +91)
            countryNameInput.value = countryData.name; // Full country name
        }

        // Remove dashes as user types
        input.addEventListener("input", function () {
            input.value = input.value.replace(/-/g, ""); // Remove dashes dynamically
        });

        // Remove dashes before form submission
        document.querySelector("form").addEventListener("submit", function () {
            input.value = input.value.replace(/-/g, ""); // Ensure number is saved without dashes
        });

        // Set phone number in input field without dashes
        input.value = savedPhone;
    });
</script>


@include('partials.footer')
@endsection
