<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

@extends('layouts.app')

@section('pageTitle', 'Update Faculty')

@section('content')
@include('partials.sidebar')
@include('partials.headerdashboard')
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
                            <h5 class="m-b-10">Faculty View</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Faculty</a></li>
                            <li class="breadcrumb-item" aria-current="page">Update</li>
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



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Update Faculty</h5>
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
                                                value="{{ old('username', $user->username) }}" required
                                                oninput="this.value = this.value.replace(/\s/g, '')">

                                            <!-- Suggestions Dropdown -->
                                            <div class="position-relative">
                                                <div id="usernameSuggestions" class="suggestions-box"
                                                    style="display: none; position: absolute; background: #fff; border: 1px solid #ccc; width: 100%; z-index: 1000; padding: 5px;">
                                                    <strong style="color:rgb(18, 18, 98)">Suggested Usernames:</strong>
                                                    <div id="suggestionsList" class="mt-1"></div>
                                                </div>
                                            </div>
                                            @error('username')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class=" mb-3">
                                            <label for="phoneInput">Phone</label>
                                            <input type="tel" class="form-control" id="phoneInput" placeholder=""
                                                name="phone" required
                                                value="{{ old('phone', $user->country_code.$user->phone) }}" readonly>

                                            <small id="phoneError" class="text-danger"></small>
                                            @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <div class="col-md-4" style="margin-top: -8px;">
                                        <div class="mb-3">
                                            <label for="phoneInput" class="form-label">Phone</label>
                                            <div class="input-group" style="display: flex; align-items: center;">
                                                <input type="tel" class="form-control" id="phoneInput" name="phone" required
                                                    value="{{ old('phone', $user->phone) }}" style="height: 43px;"
                                                    pattern="[0-9\- ]*" inputmode="numeric">

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
                                    <input type="hidden" name="role" value="Faculty">

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
    document.addEventListener("DOMContentLoaded", function () {
   var input = document.querySelector("#phoneInput");

   // Full country name from database (e.g., "India (भारत)")
   var savedCountryName = "{{ $user->country_name }}";

   // Extract only the English part before the first "("
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

   // Convert English country name to country code
   var savedCountryCode = countryNameToCode[englishCountryName] || "us"; // Default to "US" if not found

   var iti = window.intlTelInput(input, {
       separateDialCode: true,
       initialCountry: savedCountryCode, // Set correct country based on database
       utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
   });

   // Ensure the correct country is set
   iti.promise.then(() => {
       if (savedCountryCode) {
           iti.setCountry(savedCountryCode);
       }
   });
    });

</script> --}}

{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        var input = document.querySelector("#phoneInput");
        var countryCodeInput = document.querySelector("#countryCode");
        var countryNameInput = document.querySelector("#countryName");

        // Allow only numeric input
        input.addEventListener("input", function () {
            this.value = this.value.replace(/\D/g, ''); // Remove non-numeric characters
        });

        // Full country name from database (e.g., "India (भारत)")
        var savedCountryName = "{{ $user->country_name }}";
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

        var savedCountryCode = countryNameToCode[englishCountryName] || "us";

        var iti = window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: savedCountryCode,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        iti.promise.then(() => {
            if (savedCountryCode) {
                iti.setCountry(savedCountryCode);
            }
            var countryData = iti.getSelectedCountryData();
            countryCodeInput.value = "+" + countryData.dialCode;
            countryNameInput.value = countryData.name;
        });

        // Update hidden inputs when country is changed
        input.addEventListener("countrychange", function () {
            var countryData = iti.getSelectedCountryData();
            console.log("Changed Country:", countryData);
            countryCodeInput.value = "+" + countryData.dialCode;
            countryNameInput.value = countryData.name;
        });

        // Ensure values are set before form submission
        document.querySelector("form").addEventListener("submit", function () {
            var countryData = iti.getSelectedCountryData();
            countryCodeInput.value = "+" + countryData.dialCode;
            countryNameInput.value = countryData.name;
        });
    });
</script> --}}


{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        var input = document.querySelector("#phoneInput");
        var countryCodeInput = document.querySelector("#countryCode");
        var countryNameInput = document.querySelector("#countryName");

        // Allow only numeric input
        input.addEventListener("input", function () {
            this.value = this.value.replace(/\D/g, ''); // Remove non-numeric characters
        });
        input.addEventListener("input", function () {
            this.value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
        });
        // Full country name from database (e.g., "India (भारत)")
        var savedCountryName = "{{ $user->country_name }}";
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

        var savedCountryCode = countryNameToCode[englishCountryName] || "us";

        var iti = window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: savedCountryCode,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        iti.promise.then(() => {
            if (savedCountryCode) {
                iti.setCountry(savedCountryCode);
            }
            var countryData = iti.getSelectedCountryData();
            countryCodeInput.value = "+" + countryData.dialCode;
            countryNameInput.value = countryData.name;
        });

        // Update hidden inputs and clear phone input when country is changed
        input.addEventListener("countrychange", function () {
            var countryData = iti.getSelectedCountryData();
            console.log("Changed Country:", countryData);
            countryCodeInput.value = "+" + countryData.dialCode;
            countryNameInput.value = countryData.name;

            // Clear the phone input field when country changes
            input.value = "";
        });

        // Ensure values are set before form submission
        document.querySelector("form").addEventListener("submit", function () {
            var countryData = iti.getSelectedCountryData();
            countryCodeInput.value = "+" + countryData.dialCode;
            countryNameInput.value = countryData.name;
        });
    });
</script> --}}

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var input = document.querySelector("#phoneInput");
        var countryCodeInput = document.querySelector("#countryCode");
        var countryNameInput = document.querySelector("#countryName");

        // Allow only numeric input
        input.addEventListener("input", function () {
            this.value = this.value.replace(/\D/g, ''); // Remove non-numeric characters
        });

        // Full country name from database (e.g., "India (भारत)")
        var savedCountryName = "{{ $user->country_name }}";
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

        var savedCountryCode = countryNameToCode[englishCountryName] || "us";

        var iti = window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: savedCountryCode,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        iti.promise.then(() => {
            if (savedCountryCode) {
                iti.setCountry(savedCountryCode);
            }
            var countryData = iti.getSelectedCountryData();
            countryCodeInput.value = "+" + countryData.dialCode;
            countryNameInput.value = countryData.name;
        });

        // Update hidden inputs and clear phone input when country is changed
        input.addEventListener("countrychange", function () {
            var countryData = iti.getSelectedCountryData();
            console.log("Changed Country:", countryData);
            countryCodeInput.value = "+" + countryData.dialCode;
            countryNameInput.value = countryData.name;

            // Clear the phone input field when country changes
            input.value = "";
        });

        // Ensure values are set before form submission
        document.querySelector("form").addEventListener("submit", function () {
            var countryData = iti.getSelectedCountryData();
            countryCodeInput.value = "+" + countryData.dialCode;
            countryNameInput.value = countryData.name;
        });
    });
</script>




@include('partials.footer')
@endsection
