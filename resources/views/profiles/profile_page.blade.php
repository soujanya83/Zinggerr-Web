@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">

@section('pageTitle', 'Teachers List')

@section('content')
@include('partials.sidebar')
@include('partials.header')


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
                            <li class="breadcrumb-item"><a href="/app">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Account Settings</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="">


                <div class="card">
                    <div class="card-header pb-0">
                        <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">


                            <li class="nav-item " role="presentation">
                                <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1"
                                    role="tab" aria-selected="true">
                                    <i class="material-icons-two-tone me-2">account_circle</i>
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">edit</i>
                                    Edit Profile
                                </a>
                            </li>
                            {{-- <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-3" data-bs-toggle="tab" href="#profile-3" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">library_books</i>
                                    My Account
                                </a>
                            </li> --}}
                            {{-- <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-4" data-bs-toggle="tab" href="#profile-4" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">lock</i>
                                    Change Password
                                </a>
                            </li> --}}
                            {{-- <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-5" data-bs-toggle="tab" href="#profile-5" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">email</i>
                                    Settings
                                </a>
                            </li> --}}
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
                                                <img src="{{ asset('storage/users pictures/' . Auth::user()->profile_picture) }}"
                                                    class="rounded-circle" width="100" height="100">
                                                @else
                                                <img src="{{ asset('images/user/avatar-1.jpg') }}"
                                                    class="rounded-circle" width="100" height="100">
                                                @endif

                                                <h5 class="card-title mt-3">{{ Auth::user()->name }}</h5>
                                                {{-- <p class="card-text">{{ Auth::user()->type }}</p> --}}
                                                <span class="badge bg-primary">{{ Auth::user()->type }}</span>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <i class="material-icons-two-tone f-20">email</i>
                                                    <strong>Emaiil</strong>
                                                    <span>&nbsp&nbsp {{ Auth::user()->email }}</span>
                                                </li>
                                                <li class="list-group-item">
                                                    <i class="material-icons-two-tone f-20">phonelink_ring</i>
                                                    <strong>Phone</strong>
                                                    <span>&nbsp&nbsp {{ Auth::user()->phone }}</span>
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
                                                        <td>{{ Auth::user()->name }}</td>
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
                                                        <td>{{ Auth::user()->phone }}</td>
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
                                    <div class="card-body">
                                        <form id="editForm" action="{{ route('user.profile.update') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            {{-- @method('PUT') --}}
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th>Profile Picture</th>
                                                    <td>:</td>
                                                    <td>

                                                        @if(Auth::user()->profile_picture)
                                                        <img src="{{ asset('storage/users_pictures/' . Auth::user()->profile_picture) }}"
                                                            class="rounded-circle" width="100" height="100">
                                                        @else
                                                        <img src="{{ asset('images/user/avatar-1.jpg') }}"
                                                            class="rounded-circle" width="100" height="100">
                                                        @endif

                                                        <div class="mt-3">
                                                            <input type="file" name="profile_picture"
                                                                class="form-control" accept="image/*">
                                                        </div>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Full Name</th>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ old('name', Auth::user()->name) }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Username</th>
                                                    <td>:</td>
                                                    {{-- <td>{{ Auth::user()->username }} <small
                                                            class="text-muted">(Read Only)</small></td> --}}
                                                    <td><input type="text" class="form-control" name="phone"
                                                            value="{{ old('phone', Auth::user()->username) }}"></td>
                                                </tr>
                                                <tr>
                                                    <th>Phone</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control" name="phone"
                                                            value="{{ old('phone', Auth::user()->phone) }}"></td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>:</td>
                                                    {{-- <td>{{ Auth::user()->email }} <small class="text-muted">(Read
                                                            Only)</small></td> --}}
                                                    <td><input type="text" class="form-control" name="email"
                                                            value="{{ old('phone', Auth::user()->email) }}"></td>
                                                </tr>
                                                <tr>
                                                    <th>Gender</th>
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
                                                <tr>
                                                    <th></th>
                                                    <td></td>
                                                    <td> <button type="submit" class="btn btn-primary">Update
                                                            Profile</button></td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-3">
                                {{-- ///////////////////////////////////////////////////// --}}
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


@include('partials.footer')
@endsection
