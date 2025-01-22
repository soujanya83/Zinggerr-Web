<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@extends('layouts.app')

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




<style>
    /* General nav-link styles */
    .nav-tabs .nav-link {
        color: #000;
        border: none;
        margin-right: 10px;
    }

    /* Active tab underline and font color */
    .nav-tabs .nav-link.active {
        color: #007bff;
        font-weight: bold;
        border: none;
        position: relative;
    }

    .nav-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #007bff;
        border-radius: 2px;

    }

    /* Active tab pane content styling */
    .tab-pane.active {
        color: #007bff;
        /* Matches the line color */
    }

    /* ............................ */
</style>
<style>
    .file-upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 2px dashed #007bff;
        border-radius: 5px;
        /* padding: 10px; */
        cursor: pointer;
        height: 140px;
        width: 387px;
        transition: background-color 0.3s ease;
    }

    .file-upload-label:hover {
        background-color: #f0f8ff;
    }

    .file-upload-input {
        display: none;
    }

    .upload-icon {
        font-size: 2rem;
        color: #007bff;
    }
</style>



@section('pageTitle', 'Course Update')

@section('content')
@include('partials.sidebar')
@include('partials.header')



{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}

<!-- include summernote css/js -->


<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>




<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Courses View</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Courses</a></li>
                            <li class="breadcrumb-item" aria-current="page">Update</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
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
                    <div class="card-header  pb-0">
                        <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                            <li class="nav-item " role="presentation">
                                <a class="nav-link active " id="profile-tab-1" data-bs-toggle="tab" href="#profile-1"
                                    role="tab" aria-selected="true">
                                    <i class="material-icons-two-tone me-2">account_circle</i>
                                    General
                                </a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-3" data-bs-toggle="tab" href="#profile-3" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">book</i>
                                    Course format
                                </a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-8" data-bs-toggle="tab" href="#profile-8" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">group</i>
                                    Teachers Assign
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-9" data-bs-toggle="tab" href="#profile-9" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">group</i>
                                    Students Assign
                                </a>
                            </li>


                        </ul>
                    </div>


                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="profile-1" role="tabpanel"
                                aria-labelledby="profile-tab-1">
                                <div class="row">
                                    <div class="card-body">
                                        {{-- <form id="createCourseForm" method="post" enctype="multipart/form-data"
                                            --}} <form method="post" enctype="multipart/form-data"
                                            action="{{ route('course_update', $course->id) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">

                                                        <input type="text" name="course_full_name" class="form-control"
                                                            placeholder="Enter Course Full Name"
                                                            value="{{ old('course_full_name'). $course->course_full_name }}"
                                                            id="floatingShortname">
                                                        <label style="align-content: center;" class="form-label"
                                                            for="floatingShortname">Course Full
                                                            Name</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">

                                                        <input type="text" name="course_short_name" class="form-control"
                                                            placeholder="Enter Course Short Name"
                                                            value="{{ old('course_short_name'). $course->course_short_name }}"
                                                            id="floatingShortname"  oninput="this.value = this.value.replace(/\s/g, '')">
                                                        <label style="align-content: center;" class="form-label"
                                                            for="floatingShortname">Course Short
                                                            Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <select name="course_category" class="form-select"
                                                            id="floatingShortname">
                                                            @foreach($categories as $category)
                                                            <option value="{{ $category->name }}" {{
                                                                old('course_category', $course->course_category ?? '')
                                                                == $category->name ? 'selected' : '' }}>
                                                                {{ $category->display_name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        <label style="align-content: center;"
                                                            for="floatingShortname">Select Course Category</label>
                                                    </div>

                                                </div>

                                                <input type="hidden" name="course_start_date" class="form-control"
                                                    value="{{ old('course_start_date', $course->course_start_date ?? '') }}">


                                                <input type="hidden" name="course_end_date" class="form-control"
                                                    value="{{ old('course_start_date', $course->course_end_date ?? '') }}">



                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">

                                                        <input type="number" name="course_id_number"
                                                            class="form-control" placeholder="Enter Course ID Number"
                                                            value="{{ old('course_id_number', $course->course_id_number ?? '') }}">
                                                        <label style="align-content: center;" class="form-label">Course
                                                            ID Number</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label">Course Summary</label>
                                                    <div class="form-floating mb-3">
                                                        <!-- Textarea for Summernote -->
                                                        <textarea id="summernote" name="course_summary"
                                                            class="form-control">
                                                            {{ old('course_summary', $course->course_summary ?? '') }}
                                                        </textarea>

                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label">Course Image Upload</label>

                                                    <div class="form-floating mb-3">

                                                        <div class="d-flex align-items-center  rounded">

                                                            <div class="d-flex align-items-center">

                                                                <label for="fileUpload" class="file-upload-label"
                                                                    style="width:1313px">
                                                                    <div class="upload-icon mb-3">
                                                                        <i
                                                                            class="fas fa-cloud-upload-alt fa-3x text-primary"></i>
                                                                    </div>
                                                                    <span class="text-muted"
                                                                        style="    margin-top: -19px;">Click to upload
                                                                        file here</span>
                                                                    <span id="fileName" class="ms-2"></span>
                                                                    <input type="file" id="fileUpload"
                                                                        name="course_image" class="file-upload-input"
                                                                        onchange="showFileName(this)">
                                                                </label>

                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="me-3">

                                                        @if(isset($course->course_image))
                                                        <img src="{{ url('storage/'.$course->course_image) }}"
                                                            alt="Existing Image" width="150px" height="138px"
                                                            class="border rounded"
                                                            style="margin-top: -16px">
                                                        @else
                                                        <img src="{{ asset('path-to-default-image.jpg') }}"
                                                            alt="Default Image" width="100px" height="100px"
                                                            class="border rounded">
                                                        @endif
                                                    </div>


                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade mt-3" id="profile-3" role="tabpanel"
                                aria-labelledby="profile-tab-3">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <select name="course_layout" class="form-select">
                                                    <option value="Hidden sections are shown as not available" {{
                                                        old('course_layout', $course->course_layout) == 'Hidden sections
                                                        are shown as not available' ? 'selected' : '' }}>
                                                        Hidden sections are shown as not available
                                                    </option>
                                                    <option value="Hidden sections are completely invisible" {{
                                                        old('course_layout', $course->course_layout) == 'Hidden sections
                                                        are completely invisible' ? 'selected' : '' }}>
                                                        Hidden sections are completely invisible
                                                    </option>
                                                </select>
                                                <label style="align-content: center;" for="emailInput"
                                                    class="form-label">Course layout</label>
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="status" style="color: #000">Course
                                                    Visibility:</label>
                                                <div>

                                                    <div class="form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="course_status" id="statusshow" value="1" {{
                                                            old('course_status', $course->course_status) == 1 ?
                                                        'checked' : '' }}>
                                                        <label class="form-check-label" for="statusshow"
                                                            style="color: #000">Show</label>
                                                    </div>


                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="course_status" id="statushide" value="0" {{
                                                            old('course_status', $course->course_status) == 0 ?
                                                        'checked' : '' }}>
                                                        <label class="form-check-label" for="statushide"
                                                            style="color: #000">Hide</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="status" style="color: #000">Enable
                                                    Download Course Content:</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="downloa_status" id="statusyes" value="1" {{
                                                            old('course_status', $course->downloa_status) == 1 ?
                                                        'checked' : '' }}>
                                                        <label class="form-check-label" for="statusyes"
                                                            style="color: #000">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="downloa_status" id="statusno" value="0" {{
                                                            old('course_status', $course->downloa_status) == 0 ?
                                                        'checked' : '' }}>
                                                        <label class="form-check-label" for="statusno"
                                                            style="color: #000">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <div class="dropdown">
                                                    <label style="align-content: center;" for="emailInput"
                                                        class="form-label">Format:
                                                        &nbsp&nbsp&nbsp</label>
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        Weekly sections
                                                    </button>
                                                    <ul class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton">
                                                        <li>
                                                            <label style="align-content: center;"
                                                                class="dropdown-item d-flex align-items-start">
                                                                <input type="radio" name="course_format"
                                                                    value="Custom sections"
                                                                    class="form-check-input me-2" {{
                                                                    old('course_format', $course->course_format) ==
                                                                'Custom sections' ? 'checked' : '' }}>
                                                                &nbsp; &nbsp;
                                                                <div>
                                                                    <strong>Custom sections</strong><br>
                                                                    <span class="text-muted">The course is divided into
                                                                        customizable sections.</span>
                                                                </div>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label style="align-content: center;"
                                                                class="dropdown-item d-flex align-items-start">
                                                                <input type="radio" name="course_format"
                                                                    value="Weekly sections"
                                                                    class="form-check-input me-2" {{
                                                                    old('course_format', $course->course_format) ==
                                                                'Weekly sections' ? 'checked' : '' }}> &nbsp; &nbsp;
                                                                <div>
                                                                    <strong>Weekly sections</strong><br>
                                                                    <span class="text-muted">The course is divided into
                                                                        sections corresponding to each week, beginning
                                                                        from the course start date.</span>
                                                                </div>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label style="align-content: center;"
                                                                class="dropdown-item d-flex align-items-start">
                                                                <input type="radio" name="course_format"
                                                                    value="Single activity"
                                                                    class="form-check-input me-2" {{
                                                                    old('course_format', $course->course_format) ==
                                                                'Single activity' ? 'checked' : '' }}> &nbsp; &nbsp;
                                                                <div>
                                                                    <strong>Single activity</strong><br>
                                                                    <span class="text-muted">The course contains only
                                                                        one activity or resource.</span>
                                                                </div>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label style="align-content: center;"
                                                                class="dropdown-item d-flex align-items-start">
                                                                <input type="radio" name="course_format" value="Social"
                                                                    class="form-check-input me-2" {{
                                                                    old('course_format', $course->course_format) ==
                                                                'Social' ? 'checked' : '' }}> &nbsp; &nbsp;
                                                                <div>
                                                                    <strong>Social</strong><br>
                                                                    <span class="text-muted">The course is centred
                                                                        around a main forum on the course page.
                                                                        Additional activities and resources can be added
                                                                        using the Social activities block.</span>
                                                                </div>
                                                            </label>
                                                        </li>


                                                    </ul>
                                                    <a href="{{ route('add_assets', $course->slug) }}" id="createChapterButton" class="btn btn-success mt-3" style="display: none;width: 158px; margin-left: 75px;">
                                                        Manage Sections
                                                    </a>

                                                </div>
                                            </div>
                                        </div>

                                            <!-- Create Chapter Button -->




<script>
document.addEventListener('DOMContentLoaded', function () {
    const radioButtons = document.querySelectorAll('input[name="course_format"]');
    const createChapterButton = document.getElementById('createChapterButton');

    radioButtons.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'Custom sections') {
                createChapterButton.style.display = 'block'; // Show the button
            } else {
                createChapterButton.style.display = 'none'; // Hide the button
            }
        });
    });

    // Initialize the button state based on the current selection
    const selectedRadio = document.querySelector('input[name="course_format"]:checked');
    if (selectedRadio && selectedRadio.value === 'Custom sections') {
        createChapterButton.style.display = 'block';
    }
});

</script>


                                        <div class="col-md-4">
                                            <label style="align-content: center;" for="tags"
                                                class="form-label">Tags:</label> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            <div class="form-floating mb-3">
                                                @php
                                                // Ensure $tags is always an array
                                                $tags = is_array(old('tags', $course->tags ?? []))
                                                ? old('tags', $course->tags ?? [])
                                                : explode(',', old('tags', $course->tags ?? ''));
                                                @endphp

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" value="Basic"
                                                        id="basic" name="tags[]" {{ in_array('Basic', $tags) ? 'checked'
                                                        : '' }}>
                                                    <label class="form-check-label" for="basic"
                                                        style="color: black;">Basic</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" value="Advanced"
                                                        id="advanced" name="tags[]" {{ in_array('Advanced', $tags)
                                                        ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="advanced"
                                                        style="color: black;">Advanced</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" value="Intermediate"
                                                        id="intermediate" name="tags[]" {{ in_array('Intermediate',
                                                        $tags) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="intermediate"
                                                        style="color: black;">Intermediate</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-end" style="margin-left: 100%;">
                                                <button type="submit" class="btn btn-primary">Update Course</button>
                                            </div>
                                        </div>

                                        </form>

                                    </div>
                                </div>
                            </div>

                            {{-- <div class="tab-pane fade" id="profile-8" role="tabpanel"
                                aria-labelledby="profile-tab-8">
                                <div class="">
                                    <div class="row">

                                    </div>
                                </div>
                            </div> --}}

                            <div class="tab-pane fade" id="profile-8" role="tabpanel" aria-labelledby="profile-tab-8">
                                <div class="nested-tabs">
                                    <!-- Nested Tabs Navigation -->
                                    <ul class="nav nav-tabs mb-3" id="nestedTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="assigned-tab" data-bs-toggle="tab"
                                                data-bs-target="#assigned" type="button" role="tab"
                                                aria-controls="assigned" aria-selected="true">
                                                <i class="ti ti-user-plus f-20"></i> Assigned Teachers
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="available-tab" data-bs-toggle="tab"
                                                data-bs-target="#available" type="button" role="tab"
                                                aria-controls="available" aria-selected="false">
                                                <i class="ti ti-user-plus f-20"></i> Available Teachers
                                            </button>
                                        </li>
                                    </ul>

                                    <!-- Nested Tab Content -->
                                    <div class="tab-content" id="nestedTabsContent">
                                        <div class="tab-pane fade show active" id="assigned" role="tabpanel"
                                            aria-labelledby="assigned-tab">
                                            <div class="row">
                                                <!-- [ sample-page ] start -->
                                                <div class="col-sm-12">
                                                    <div class="card table-card">
                                                        <div class="card-header">
                                                            <div class="row align-items-center">
                                                                <h5>Teachers List Assigned For This Courses</h5>


                                                                <div class="col-auto"
                                                                    style=" margin-top: -21px; margin-left: 78%">
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="searchInput"
                                                                            class="form-control"
                                                                            placeholder="Search...">
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <script>
                                                                    $(document).ready(function(){
                                                                        $("#searchInput").on("keyup", function() {
                                                                            var value = $(this).val().toLowerCase();
                                                                            $("#userTableBody tr").filter(function() {
                                                                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                                                            });
                                                                        });
                                                                    });
                                                                </script>



                                                                {{-- <div class="col">
                                                                    <select id="entriesPerPage">
                                                                        <option value="5" selected>5</option>
                                                                        <option value="10">10</option>
                                                                        <option value="15">15</option>
                                                                        <option value="20">20</option>
                                                                        <option value="25">25</option>
                                                                    </select> entries per page
                                                                </div> --}}

                                                            </div>

                                                            <div class="card-body pt-0">
                                                                <div class="table-responsive">




                                                                    <table class="table table-hover">
                                                                        <thead>
                                                                            <tr id="showtr">
                                                                                <th>#</th>
                                                                                <th>Teachers Profile</th>
                                                                                <th>Username</th>
                                                                                <th>Phone</th>
                                                                                <th>Type</th>
                                                                                <th>Gender</th>
                                                                                <th>Status</th>
                                                                                @if(Auth::user()->can('role') ||
                                                                                (isset($permissions) &&
                                                                                in_array('teachers_edit', $permissions))
                                                                                ||
                                                                                (isset($permissions) &&
                                                                                in_array('teachers_delete',
                                                                                $permissions)))
                                                                                <th class="text-center">Action</th>
                                                                                @endif

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="userTableBody">


                                                                            @if ($data->count() > 0)

                                                                            @foreach ($data as $keys=> $user)
                                                                            <tr>
                                                                                <td>{{ ++$keys }}</td>
                                                                                <td>
                                                                                    <div
                                                                                        class="d-flex align-items-center">
                                                                                        <div
                                                                                            class="flex-shrink-0 wid-40">
                                                                                            @if ($user->profile_picture)
                                                                                            <img class="img-radius"
                                                                                                src="{{ asset('storage/' . $user->profile_picture) }}"
                                                                                                alt="User image"
                                                                                                style="height:52px;width: 52px;">
                                                                                            @else
                                                                                            <img class="img-radius"
                                                                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}"
                                                                                                alt="Default image"
                                                                                                style="height:52px;width: 52px;">
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="flex-grow-1 ms-3">
                                                                                            <h5 class="mb-1">{{
                                                                                                $user->name }}</h5>
                                                                                            <p
                                                                                                class="text-muted f-12 mb-0">
                                                                                                {{ $user->email }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>{{ $user->username }}</td>
                                                                                <td>{{ $user->phone }}</td>
                                                                                <td>
                                                                                    <span
                                                                                        class="badge bg-light-info  rounded-pill f-14">
                                                                                        {{ $user->type }}</span>
                                                                                </td>
                                                                                <td>{{ $user->gender }}</td>
                                                                                <td>
                                                                                    @if($user->status == 1)
                                                                                    <span
                                                                                        class="badge rounded-pill f-14 bg-light-success">Active</span>
                                                                                    @else
                                                                                    <span
                                                                                        class="badge bg-light-danger rounded-pill f-14">Inactive
                                                                                    </span>
                                                                                    @endif
                                                                                </td>

                                                                                <td class="text-center">
                                                                                    @if(Auth::user()->can('role') ||
                                                                                    (isset($permissions) &&
                                                                                    in_array('teachers_edit',
                                                                                    $permissions)))
                                                                                    <!-- Manage Button -->
                                                                                    <a href="javascript:void(0);"
                                                                                        class="btn btn-sm btn-secondary mx-1 manage-permissions-btn"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#assignPermissionsModal"
                                                                                        data-user-id="{{ $user->id }}">
                                                                                        <i class="ti ti-edit"></i>
                                                                                        Manage
                                                                                    </a>
                                                                                    @endif
                                                                                    @if(Auth::user()->can('role') ||
                                                                                    (isset($permissions) &&
                                                                                    in_array('assign_remove',
                                                                                    $permissions)))
                                                                                    <a href="{{ route('assigned_delete', $user->assignId) }}"
                                                                                        class="btn btn-sm btn-danger"
                                                                                        data-id="{{ $user->id }}"
                                                                                        onclick="return confirmDelete(this)">
                                                                                        Remove
                                                                                    </a>
                                                                                    @endif

                                                                                </td>

                                                                            </tr>
                                                                            @endforeach


                                                                            @else
                                                                            <tr>
                                                                                <td colspan="8" class="text-center">No
                                                                                    Data Found!</td>
                                                                            </tr>
                                                                            @endif

                                                                        </tbody>
                                                                    </table>
                                                                    <div class="datatable-bottom">
                                                                        @if ($data->count() > 0)
                                                                        <div class="datatable-info">
                                                                            Showing {{ $data->firstItem() }} to {{
                                                                            $data->lastItem() }} of {{ $data->total()
                                                                            }}
                                                                            entries
                                                                        </div>



                                                                        <nav class="datatable-pagination">
                                                                            <ul class="datatable-pagination-list">
                                                                                @if ($data->onFirstPage())
                                                                                <li
                                                                                    class="datatable-pagination-list-item datatable-disabled">
                                                                                    <button disabled
                                                                                        aria-label="Previous Page">‹</button>
                                                                                </li>
                                                                                @else
                                                                                <li
                                                                                    class="datatable-pagination-list-item">
                                                                                    <a href="{{ $data->previousPageUrl() }}"
                                                                                        class="datatable-pagination-list-item-link"
                                                                                        aria-label="Previous Page">‹</a>
                                                                                </li>
                                                                                @endif

                                                                                @foreach ($data->getUrlRange(1,
                                                                                $data->lastPage()) as $page => $url)
                                                                                <li
                                                                                    class="datatable-pagination-list-item {{ $data->currentPage() == $page ? 'datatable-active' : '' }}">
                                                                                    <a href="{{ $url }}"
                                                                                        class="datatable-pagination-list-item-link"
                                                                                        aria-label="Page {{ $page }}">{{
                                                                                        $page
                                                                                        }}</a>
                                                                                </li>
                                                                                @endforeach

                                                                                @if ($data->hasMorePages())
                                                                                <li
                                                                                    class="datatable-pagination-list-item">
                                                                                    <a href="{{ $data->nextPageUrl() }}"
                                                                                        class="datatable-pagination-list-item-link"
                                                                                        aria-label="Next Page">›</a>
                                                                                </li>
                                                                                @else
                                                                                <li
                                                                                    class="datatable-pagination-list-item datatable-disabled">
                                                                                    <button disabled
                                                                                        aria-label="Next Page">›</button>
                                                                                </li>
                                                                                @endif
                                                                            </ul>
                                                                        </nav>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>





                                        <div class="tab-pane fade" id="available" role="tabpanel"
                                            aria-labelledby="available-tab">
                                            <div class="row">
                                                <!-- [ sample-page ] start -->
                                                <div class="col-sm-12">
                                                    <div class="card table-card">
                                                        <div class="card-header">
                                                            <div class="row align-items-center g-2">
                                                                <h5>Teachers List Available For This Courses </h5>

                                                                <div class="col-auto"
                                                                    style=" margin-top: -21px; margin-left: 78%">
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="searchInput2"
                                                                            class="form-control"
                                                                            placeholder="Search...">
                                                                    </div>
                                                                </div>

                                                                <script>
                                                                    $(document).ready(function(){
                                                                    $("#searchInput2").on("keyup", function() {
                                                                        var value = $(this).val().toLowerCase();
                                                                        $("#userTableBody2 tr").filter(function() {
                                                                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                                                        });
                                                                    });
                                                                });
                                                                </script>

                                                            </div>
                                                            <hr>
                                                            <div class="card-body pt-0">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover">
                                                                        <thead>
                                                                            <tr id="showtr">
                                                                                <th>#</th>
                                                                                <th>Teachers Profile</th>
                                                                                <th>Username</th>
                                                                                <th>Phone</th>
                                                                                <th>Type</th>
                                                                                <th>Gender</th>
                                                                                <th>Status</th>
                                                                                @if(Auth::user()->can('role') ||
                                                                                (isset($permissions) &&
                                                                                in_array('teachers_edit', $permissions))
                                                                                ||
                                                                                (isset($permissions) &&
                                                                                in_array('teachers_delete',
                                                                                $permissions)))
                                                                                <th class="text-center">Action</th>
                                                                                @endif

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="userTableBody2">


                                                                            @if ($availableTeachers->count() > 0)

                                                                            @foreach ($availableTeachers as $keys=>
                                                                            $user)
                                                                            <tr>
                                                                                <td>{{ ++$keys }}</td>
                                                                                <td>
                                                                                    <div
                                                                                        class="d-flex align-items-center">
                                                                                        <div
                                                                                            class="flex-shrink-0 wid-40">
                                                                                            @if ($user->profile_picture)
                                                                                            <img class="img-radius"
                                                                                                src="{{ asset('storage/' . $user->profile_picture) }}"
                                                                                                alt="User image"
                                                                                                style="height:52px;width: 52px;">
                                                                                            @else
                                                                                            <img class="img-radius"
                                                                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}"
                                                                                                alt="Default image"
                                                                                                style="height:52px;width: 52px;">
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="flex-grow-1 ms-3">
                                                                                            <h5 class="mb-1">{{
                                                                                                $user->name }}</h5>
                                                                                            <p
                                                                                                class="text-muted f-12 mb-0">
                                                                                                {{ $user->email }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>{{ $user->username }}</td>
                                                                                <td>{{ $user->phone }}</td>
                                                                                <td>
                                                                                    <span
                                                                                        class="badge bg-light-info  rounded-pill f-14">
                                                                                        {{ $user->type }}</span>
                                                                                </td>
                                                                                <td>{{ $user->gender }}</td>
                                                                                <td>
                                                                                    @if($user->status == 1)
                                                                                    <span
                                                                                        class="badge rounded-pill f-14 bg-light-success">Active</span>
                                                                                    @else
                                                                                    <span
                                                                                        class="badge bg-light-danger rounded-pill f-14">Inactive
                                                                                    </span>
                                                                                    @endif
                                                                                </td>

                                                                                <td class="text-center">
                                                                                    @if(Auth::user()->can('role') ||
                                                                                    (isset($permissions) &&
                                                                                    in_array('teachers_edit',
                                                                                    $permissions)))
                                                                                    <!-- Manage Button -->
                                                                                    <a href="javascript:void(0);"
                                                                                        class="btn btn-sm btn-secondary mx-1 manage-permissions-btn"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#assignPermissionsModal"
                                                                                        data-user-id="{{ $user->id }}">
                                                                                        <i class="ti ti-edit"></i>
                                                                                        Manage
                                                                                    </a>
                                                                                    @endif

                                                                                    @if(Auth::user()->type ===
                                                                                    'Superadmin' || (isset($permissions)
                                                                                    && in_array('cousers_assign',
                                                                                    $permissions)))
                                                                                    <!-- Assign Button -->
                                                                                    <form
                                                                                        action="{{ route('course.assign') }}"
                                                                                        method="post"
                                                                                        style="display: inline;">
                                                                                        @csrf
                                                                                        <!-- Hidden Input for Course ID -->
                                                                                        <input type="hidden"
                                                                                            name="course_id"
                                                                                            value="{{ $id }}">
                                                                                        <input type="hidden"
                                                                                            name="user_id"
                                                                                            value="{{ $user->id }}">
                                                                                        <button type="submit"
                                                                                            class="btn btn-sm btn-primary mx-1">
                                                                                            <i
                                                                                                class="ti ti-user-plus"></i>
                                                                                            Assign
                                                                                        </button>
                                                                                    </form>
                                                                                    @endif
                                                                                </td>

                                                                            </tr>
                                                                            @endforeach


                                                                            @else
                                                                            <tr>
                                                                                <td colspan="8" class="text-center">No
                                                                                    Data Found!</td>
                                                                            </tr>
                                                                            @endif

                                                                        </tbody>
                                                                    </table>
                                                                    <div class="datatable-bottom">
                                                                        @if ($availableTeachers->count() > 0)
                                                                        <div class="datatable-info">
                                                                            Showing {{ $availableTeachers->firstItem()
                                                                            }} to {{
                                                                            $availableTeachers->lastItem() }} of {{
                                                                            $availableTeachers->total()
                                                                            }}
                                                                            entries
                                                                        </div>



                                                                        <nav class="datatable-pagination">
                                                                            <ul class="datatable-pagination-list">
                                                                                @if ($availableTeachers->onFirstPage())
                                                                                <li
                                                                                    class="datatable-pagination-list-item datatable-disabled">
                                                                                    <button disabled
                                                                                        aria-label="Previous Page">‹</button>
                                                                                </li>
                                                                                @else
                                                                                <li
                                                                                    class="datatable-pagination-list-item">
                                                                                    <a href="{{ $availableTeachers->previousPageUrl() }}"
                                                                                        class="datatable-pagination-list-item-link"
                                                                                        aria-label="Previous Page">‹</a>
                                                                                </li>
                                                                                @endif


                                                                                @foreach($availableTeachers->getUrlRange(1,
                                                                                $availableTeachers->lastPage()) as $page
                                                                                => $url)

                                                                                <li
                                                                                    class="datatable-pagination-list-item {{ $availableTeachers->currentPage() == $page ? 'datatable-active' : '' }}">
                                                                                    <a href="{{ $url }}"
                                                                                        class="datatable-pagination-list-item-link"
                                                                                        aria-label="Page {{ $page }}">{{
                                                                                        $page
                                                                                        }}</a>
                                                                                </li>
                                                                                @endforeach

                                                                                @if ($availableTeachers->hasMorePages())
                                                                                <li
                                                                                    class="datatable-pagination-list-item">
                                                                                    <a href="{{ $availableTeachers->nextPageUrl() }}"
                                                                                        class="datatable-pagination-list-item-link"
                                                                                        aria-label="Next Page">›</a>
                                                                                </li>
                                                                                @else
                                                                                <li
                                                                                    class="datatable-pagination-list-item datatable-disabled">
                                                                                    <button disabled
                                                                                        aria-label="Next Page">›</button>
                                                                                </li>
                                                                                @endif
                                                                            </ul>
                                                                        </nav>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="profile-9" role="tabpanel" aria-labelledby="profile-tab-9">
                                <div class="nested-tabs">
                                    <!-- Nested Tabs Navigation -->
                                    <ul class="nav nav-tabs mb-3" id="nestedTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="usersassigned-tab" data-bs-toggle="tab"
                                                data-bs-target="#assignedusers" type="button" role="tab"
                                                aria-controls="assigned" aria-selected="true">
                                                <i class="ti ti-user-plus f-20"></i> Assigned Students
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="useravailable-tab" data-bs-toggle="tab"
                                                data-bs-target="#usersavailable" type="button" role="tab"
                                                aria-controls="available" aria-selected="false">
                                                <i class="ti ti-user-plus f-20"></i> Available Students
                                            </button>
                                        </li>
                                    </ul>

                                    <!-- Nested Tab Content -->
                                    <div class="tab-content" id="nestedTabsContent">
                                        <div class="tab-pane fade show active" id="assignedusers" role="tabpanel"
                                            aria-labelledby="usersassigned-tab">
                                            <div class="row">
                                                <!-- [ sample-page ] start -->
                                                <div class="col-sm-12">
                                                    <div class="card table-card">
                                                        <div class="card-header">
                                                            <div class="row align-items-center g-2">
                                                                <h5>Students List Assigned For This Courses</h5>

                                                                <div class="col-auto"
                                                                    style=" margin-top: -21px; margin-left: 78%">
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="searchInput3"
                                                                            class="form-control"
                                                                            placeholder="Search...">
                                                                    </div>
                                                                </div>

                                                                <script>
                                                                    $(document).ready(function(){
                                                                    $("#searchInput3").on("keyup", function() {
                                                                        var value = $(this).val().toLowerCase();
                                                                        $("#userTableBody3 tr").filter(function() {
                                                                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                                                        });
                                                                    });
                                                                });
                                                                </script>

                                                            </div>
                                                            <hr>
                                                            <div class="card-body pt-0">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover">
                                                                        <thead>
                                                                            <tr id="showtr">
                                                                                <th>#</th>
                                                                                <th>Students Profile</th>
                                                                                <th>Username</th>
                                                                                <th>Phone</th>
                                                                                <th>Type</th>
                                                                                <th>Gender</th>
                                                                                <th>Status</th>
                                                                                @if(Auth::user()->can('role') ||
                                                                                (isset($permissions) &&
                                                                                in_array('teachers_edit', $permissions))
                                                                                ||
                                                                                (isset($permissions) &&
                                                                                in_array('teachers_delete',
                                                                                $permissions)))
                                                                                <th class="text-center">Action</th>
                                                                                @endif

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="userTableBody3">


                                                                            @if ($userdata->count() > 0)

                                                                            @foreach ($userdata as $keys=> $user)
                                                                            <tr>
                                                                                <td>{{ ++$keys }}</td>
                                                                                <td>
                                                                                    <div
                                                                                        class="d-flex align-items-center">
                                                                                        <div
                                                                                            class="flex-shrink-0 wid-40">
                                                                                            @if ($user->profile_picture)
                                                                                            <img class="img-radius"
                                                                                                src="{{ asset('storage/' . $user->profile_picture) }}"
                                                                                                alt="User image"
                                                                                                style="height:52px;width: 52px;">
                                                                                            @else
                                                                                            <img class="img-radius"
                                                                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}"
                                                                                                alt="Default image"
                                                                                                style="height:52px;width: 52px;">
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="flex-grow-1 ms-3">
                                                                                            <h5 class="mb-1">{{
                                                                                                $user->name }}</h5>
                                                                                            <p
                                                                                                class="text-muted f-12 mb-0">
                                                                                                {{ $user->email }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>{{ $user->username }}</td>
                                                                                <td>{{ $user->phone }}</td>
                                                                                <td>
                                                                                    <span
                                                                                        class="badge bg-light-info  rounded-pill f-14">
                                                                                        {{ $user->type }}</span>
                                                                                </td>
                                                                                <td>{{ $user->gender }}</td>
                                                                                <td>
                                                                                    @if($user->status == 1)
                                                                                    <span
                                                                                        class="badge rounded-pill f-14 bg-light-success">Active</span>
                                                                                    @else
                                                                                    <span
                                                                                        class="badge bg-light-danger rounded-pill f-14">Inactive
                                                                                    </span>
                                                                                    @endif
                                                                                </td>

                                                                                <td class="text-center">
                                                                                    @if(Auth::user()->can('role') ||
                                                                                    (isset($permissions) &&
                                                                                    in_array('teachers_edit',
                                                                                    $permissions)))
                                                                                    @if($user->assignStatus == 1)
                                                                                    <form
                                                                                        action="{{ route('course.pause_users') }}"
                                                                                        method="post"
                                                                                        style="display: inline;">
                                                                                        @csrf
                                                                                        <!-- Hidden Input for Course ID -->
                                                                                        <input type="hidden"
                                                                                            name="assign_id"
                                                                                            value="{{ $user->assignId }}">

                                                                                        <button type="submit"
                                                                                            class="btn btn-sm btn-secondary mx-1">
                                                                                            <i
                                                                                                class="ti ti-user-plus"></i>
                                                                                            Pausa
                                                                                        </button>
                                                                                    </form>
                                                                                    @else
                                                                                    <form
                                                                                        action="{{ route('course.pause_users') }}"
                                                                                        method="post"
                                                                                        style="display: inline;">
                                                                                        @csrf
                                                                                        <!-- Hidden Input for Course ID -->
                                                                                        <input type="hidden"
                                                                                            name="assign_id"
                                                                                            value="{{ $user->assignId }}">

                                                                                        <button type="submit"
                                                                                            class="btn btn-sm btn-success mx-1">
                                                                                            <i
                                                                                                class="ti ti-user-plus"></i>
                                                                                            Active
                                                                                        </button>
                                                                                    </form>
                                                                                    @endif
                                                                                    @endif
                                                                                    {{-- @if(Auth::user()->can('role')
                                                                                    ||
                                                                                    (isset($permissions) &&
                                                                                    in_array('assign_remove',
                                                                                    $permissions)))
                                                                                    <a href="{{ route('assigned_delete', $user->assignId) }}"
                                                                                        class="btn btn-sm btn-danger"
                                                                                        data-id="{{ $user->id }}"
                                                                                        onclick="return confirmDelete(this)">
                                                                                        Remove
                                                                                    </a>
                                                                                    @endif --}}
                                                                                    @if(Auth::user()->can('role') ||
                                                                                    (isset($permissions) &&
                                                                                    in_array('assign_remove',
                                                                                    $permissions)))
                                                                                    <button type="button"
                                                                                        class="btn btn-sm btn-danger open-remark-modal"
                                                                                        data-id="{{ $user->assignId }}"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#remarkModal">
                                                                                        Remove
                                                                                    </button>
                                                                                    @endif



                                                                                </td>

                                                                            </tr>
                                                                            @endforeach


                                                                            @else
                                                                            <tr>
                                                                                <td colspan="8" class="text-center">No
                                                                                    Data Found!</td>
                                                                            </tr>
                                                                            @endif

                                                                        </tbody>
                                                                    </table>
                                                                    <div class="datatable-bottom">
                                                                        @if ($userdata->count() > 0)
                                                                        <div class="datatable-info">
                                                                            Showing {{ $userdata->firstItem() }} to {{
                                                                            $userdata->lastItem() }} of {{
                                                                            $userdata->total()
                                                                            }}
                                                                            entries
                                                                        </div>



                                                                        <nav class="datatable-pagination">
                                                                            <ul class="datatable-pagination-list">
                                                                                @if ($userdata->onFirstPage())
                                                                                <li
                                                                                    class="datatable-pagination-list-item datatable-disabled">
                                                                                    <button disabled
                                                                                        aria-label="Previous Page">‹</button>
                                                                                </li>
                                                                                @else
                                                                                <li
                                                                                    class="datatable-pagination-list-item">
                                                                                    <a href="{{ $userdata->previousPageUrl() }}"
                                                                                        class="datatable-pagination-list-item-link"
                                                                                        aria-label="Previous Page">‹</a>
                                                                                </li>
                                                                                @endif

                                                                                @foreach ($userdata->getUrlRange(1,
                                                                                $userdata->lastPage()) as $page => $url)
                                                                                <li
                                                                                    class="datatable-pagination-list-item {{ $userdata->currentPage() == $page ? 'datatable-active' : '' }}">
                                                                                    <a href="{{ $url }}"
                                                                                        class="datatable-pagination-list-item-link"
                                                                                        aria-label="Page {{ $page }}">{{
                                                                                        $page
                                                                                        }}</a>
                                                                                </li>
                                                                                @endforeach

                                                                                @if ($userdata->hasMorePages())
                                                                                <li
                                                                                    class="datatable-pagination-list-item">
                                                                                    <a href="{{ $userdata->nextPageUrl() }}"
                                                                                        class="datatable-pagination-list-item-link"
                                                                                        aria-label="Next Page">›</a>
                                                                                </li>
                                                                                @else
                                                                                <li
                                                                                    class="datatable-pagination-list-item datatable-disabled">
                                                                                    <button disabled
                                                                                        aria-label="Next Page">›</button>
                                                                                </li>
                                                                                @endif
                                                                            </ul>
                                                                        </nav>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="usersavailable" role="tabpanel"
                                            aria-labelledby="useravailable-tab">
                                            <div class="row">
                                                <!-- [ sample-page ] start -->
                                                <div class="col-sm-12">
                                                    <div class="card table-card">
                                                        <div class="card-header">
                                                            <div class="row align-items-center g-2">
                                                                <h5>Students List Available For This Courses </h5>

                                                                <div class="col-auto"
                                                                    style=" margin-top: -21px; margin-left: 78%">
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="searchInput4"
                                                                            class="form-control"
                                                                            placeholder="Search...">
                                                                    </div>
                                                                </div>

                                                                <script>
                                                                    $(document).ready(function(){
                                                                    $("#searchInput4").on("keyup", function() {
                                                                        var value = $(this).val().toLowerCase();
                                                                        $("#userTableBody4 tr").filter(function() {
                                                                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                                                        });
                                                                    });
                                                                });
                                                                </script>

                                                            </div>
                                                            <hr>
                                                            <div class="card-body pt-0">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover">
                                                                        <thead>
                                                                            <tr id="showtr">
                                                                                <th>#</th>
                                                                                <th>Students Profile</th>
                                                                                <th>Username</th>
                                                                                <th>Phone</th>
                                                                                <th>Type</th>
                                                                                <th>Gender</th>
                                                                                <th>Status</th>
                                                                                @if(Auth::user()->can('role') ||
                                                                                (isset($permissions) &&
                                                                                in_array('teachers_edit', $permissions))
                                                                                ||
                                                                                (isset($permissions) &&
                                                                                in_array('teachers_delete',
                                                                                $permissions)))
                                                                                <th class="text-center">Action</th>
                                                                                @endif

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="userTableBody4">


                                                                            @if ($availableUsers->count() > 0)

                                                                            @foreach ($availableUsers as $keys=>
                                                                            $user)
                                                                            <tr>
                                                                                <td>{{ ++$keys }}</td>
                                                                                <td>
                                                                                    <div
                                                                                        class="d-flex align-items-center">
                                                                                        <div
                                                                                            class="flex-shrink-0 wid-40">
                                                                                            @if ($user->profile_picture)
                                                                                            <img class="img-radius"
                                                                                                src="{{ asset('storage/' . $user->profile_picture) }}"
                                                                                                alt="User image"
                                                                                                style="height:52px;width: 52px;">
                                                                                            @else
                                                                                            <img class="img-radius"
                                                                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}"
                                                                                                alt="Default image"
                                                                                                style="height:52px;width: 52px;">
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="flex-grow-1 ms-3">
                                                                                            <h5 class="mb-1">{{
                                                                                                $user->name }}</h5>
                                                                                            <p
                                                                                                class="text-muted f-12 mb-0">
                                                                                                {{ $user->email }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>{{ $user->username }}</td>
                                                                                <td>{{ $user->phone }}</td>
                                                                                <td>
                                                                                    <span
                                                                                        class="badge bg-light-info  rounded-pill f-14">
                                                                                        {{ $user->type }}</span>
                                                                                </td>
                                                                                <td>{{ $user->gender }}</td>
                                                                                <td>
                                                                                    @if($user->status == 1)
                                                                                    <span
                                                                                        class="badge rounded-pill f-14 bg-light-success">Active</span>
                                                                                    @else
                                                                                    <span
                                                                                        class="badge bg-light-danger rounded-pill f-14">Inactive
                                                                                    </span>
                                                                                    @endif
                                                                                </td>



                                                                                <td class="text-center">
                                                                                    {{-- @if(Auth::user()->can('role')
                                                                                    ||
                                                                                    (isset($permissions) &&
                                                                                    in_array('teachers_edit',
                                                                                    $permissions)))
                                                                                    <!-- Edit Button -->
                                                                                    <a href="{{ route('teacher_edit', $user->id) }}"
                                                                                        class="btn btn-sm btn-secondary mx-1">
                                                                                        <i class="ti ti-edit"></i> Edit
                                                                                    </a>
                                                                                    @endif --}}

                                                                                    @if(Auth::user()->type ===
                                                                                    'Superadmin' || (isset($permissions)
                                                                                    && in_array('cousers_assign',
                                                                                    $permissions)))
                                                                                    <!-- Assign Button -->
                                                                                    <form
                                                                                        action="{{ route('course.assign') }}"
                                                                                        method="post"
                                                                                        style="display: inline;">
                                                                                        @csrf
                                                                                        <!-- Hidden Input for Course ID -->
                                                                                        <input type="hidden"
                                                                                            name="course_id"
                                                                                            value="{{ $id }}">
                                                                                        <input type="hidden"
                                                                                            name="user_id"
                                                                                            value="{{ $user->id }}">
                                                                                        <button type="submit"
                                                                                            class="btn btn-sm btn-primary mx-1">
                                                                                            <i
                                                                                                class="ti ti-user-plus"></i>
                                                                                            Assign
                                                                                        </button>
                                                                                    </form>
                                                                                    @endif
                                                                                </td>

                                                                            </tr>
                                                                            @endforeach


                                                                            @else
                                                                            <tr>
                                                                                <td colspan="8" class="text-center">No
                                                                                    Data Found!</td>
                                                                            </tr>
                                                                            @endif

                                                                        </tbody>
                                                                    </table>
                                                                    <div class="datatable-bottom">
                                                                        @if ($availableUsers->count() > 0)
                                                                        <div class="datatable-info">
                                                                            Showing {{ $availableUsers->firstItem() }}
                                                                            to {{
                                                                            $availableUsers->lastItem() }} of {{
                                                                            $availableUsers->total()
                                                                            }}
                                                                            entries
                                                                        </div>



                                                                        <nav class="datatable-pagination">
                                                                            <ul class="datatable-pagination-list">
                                                                                @if ($availableUsers->onFirstPage())
                                                                                <li
                                                                                    class="datatable-pagination-list-item datatable-disabled">
                                                                                    <button disabled
                                                                                        aria-label="Previous Page">‹</button>
                                                                                </li>
                                                                                @else
                                                                                <li
                                                                                    class="datatable-pagination-list-item">
                                                                                    <a href="{{ $availableUsers->previousPageUrl() }}"
                                                                                        class="datatable-pagination-list-item-link"
                                                                                        aria-label="Previous Page">‹</a>
                                                                                </li>
                                                                                @endif


                                                                                @foreach($availableUsers->getUrlRange(1,
                                                                                $availableUsers->lastPage()) as $page =>
                                                                                $url)
                                                                                <li
                                                                                    class="datatable-pagination-list-item {{ $availableUsers->currentPage() == $page ? 'datatable-active' : '' }}">
                                                                                    <a href="{{ $url }}"
                                                                                        class="datatable-pagination-list-item-link"
                                                                                        aria-label="Page {{ $page }}">{{
                                                                                        $page
                                                                                        }}</a>
                                                                                </li>
                                                                                @endforeach

                                                                                @if ($availableUsers->hasMorePages())
                                                                                <li
                                                                                    class="datatable-pagination-list-item">
                                                                                    <a href="{{ $data->nextPageUrl() }}"
                                                                                        class="datatable-pagination-list-item-link"
                                                                                        aria-label="Next Page">›</a>
                                                                                </li>
                                                                                @else
                                                                                <li
                                                                                    class="datatable-pagination-list-item datatable-disabled">
                                                                                    <button disabled
                                                                                        aria-label="Next Page">›</button>
                                                                                </li>
                                                                                @endif
                                                                            </ul>
                                                                        </nav>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Remark Modal -->
<div class="modal fade" id="remarkModal" tabindex="-1" aria-labelledby="remarkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="remarkForm" action="{{ route('assigned_delete_with_remark') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="remarkModalLabel">Add Remark</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="assign_id" id="assignId">
                    <div class="mb-3">
                        <label for="remark" class="form-label">Remove Remark For This User</label>
                        <textarea class="form-control" name="remark" id="remark" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> --}}
                    <button type="submit" class="btn btn-danger">Submit and Remove</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const remarkModal = document.getElementById('remarkModal');
        const assignIdInput = document.getElementById('assignId');
        const remarkButtons = document.querySelectorAll('.open-remark-modal');

        remarkButtons.forEach(button => {
            button.addEventListener('click', function () {
                const assignId = this.getAttribute('data-id');
                assignIdInput.value = assignId;
            });
        });
    });
</script>

{{-- ...............................model............................ --}}

<div class="modal fade" id="assignPermissionsModal" tabindex="-1" aria-labelledby="assignPermissionsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignPermissionsModalLabel">Assign Permissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignPermissionForm" action="{{ route('course.update_permissions') }}" method="post">
                    @csrf

                    <!-- Hidden Input for User ID -->
                    {{-- <input type="hidden" name="user_id" id="modalUserId"> --}}
                    <input type="hidden" id="modalUserId" name="user_id" value="">
                    <input type="hidden" name="course_id" value="{{ $id }}">

                    <!-- Search Box -->
                    <div class="mb-3">
                        <input type="text" id="searchPermissions" class="form-control"
                            placeholder="Search Permissions...">
                    </div>

                    <!-- Permissions Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Permission Name</th>
                                    <th>Select</th>
                                </tr>
                            </thead>
                            <tbody id="permissionsTable">
                                @foreach ($permissions as $index => $permission)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $permission['display_name'] }}</td>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="permissions[]"
                                                value="{{ $permission['id'] }}" id="permission{{ $permission['id'] }}">
                                            <label class="form-check-label"
                                                for="permission{{ $permission['id'] }}"></label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">Assign Permissions</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
                // Search functionality for permissions
                const searchInput = document.getElementById('searchPermissions');
                const permissionsTable = document.getElementById('permissionsTable');

                searchInput.addEventListener('input', function () {
                const searchTerm = searchInput.value.toLowerCase();
                const rows = permissionsTable.querySelectorAll('tr');

                rows.forEach(row => {
                const permissionName = row.children[1].textContent.toLowerCase();
                row.style.display = permissionName.includes(searchTerm) ? '' : 'none';
                });
                });

                // Update modal user_id dynamically
                const manageButtons = document.querySelectorAll('.manage-permissions-btn');
                const modalUserIdField = document.getElementById('modalUserId');

                manageButtons.forEach(button => {
                button.addEventListener('click', function () {
                const userId = this.getAttribute('data-user-id');
                modalUserIdField.value = userId; // Set the hidden user_id in the modal form
                });
                });
                });


</script> --}}


<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Search functionality for permissions
    const searchInput = document.getElementById('searchPermissions');
    const permissionsTable = document.getElementById('permissionsTable');

    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.toLowerCase();
        const rows = permissionsTable.querySelectorAll('tr');

        rows.forEach(row => {
            const permissionName = row.children[1].textContent.toLowerCase();
            row.style.display = permissionName.includes(searchTerm) ? '' : 'none';
        });
    });

    // Update modal user_id dynamically and fetch user's assigned permissions
    const manageButtons = document.querySelectorAll('.manage-permissions-btn');
    const modalUserIdField = document.getElementById('modalUserId');
    const checkboxes = document.querySelectorAll('input[name="permissions[]"]');

    manageButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-user-id');
            modalUserIdField.value = userId; // Set the hidden user_id in the modal form

            // Reset all checkboxes
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            // Fetch user's assigned permissions
            fetch(`/user/${userId}/permissions`) // Update the endpoint as per your route
                .then(response => response.json())
                .then(assignedPermissions => {
                    // Pre-check the checkboxes for assigned permissions
                    assignedPermissions.forEach(permissionId => {
                        const checkbox = document.querySelector(`input[value="${permissionId}"]`);
                        if (checkbox) {
                            checkbox.checked = true;
                        }
                    });
                })
                .catch(error => console.error('Error fetching permissions:', error));
        });
    });
});

</script>











<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script>
    document.getElementById('createCourseForm').addEventListener('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var courseId = '{{ $course->id }}';
        fetch(`/courses-update/${courseId}`, {
            method: 'post',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
    title: 'Success!',
    text: data.message,
    icon: 'success',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
})

.then(() => {
            // Redirect to the course list page after the success message
            window.location.href = '{{ route("courses") }}';
        });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: data.message || 'There was an issue with your submission.',
                    icon: 'error',
                    showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong. Please try again.',
                icon: 'error',
                showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true
            });
        });
    });
</script> --}}

{{-- <script>
    const browseLink = document.querySelector('.browse-link');
const fileInput = document.getElementById('fileInput');

browseLink.addEventListener('click', () => {
  fileInput.click();
});
</script> --}}

<script>
    $(document).ready(function () {
        // Initialize Summernote on the textarea
        $('#summernote').summernote({
            placeholder: 'Enter course summary here...',
            tabsize: 2,
            height: 90, // Adjust the height as needed
            toolbar: [
                // Custom toolbar options
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                // ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>

<script>
    function showFileName(input) {
        var fileName = input.files[0].name;
        document.getElementById('fileName').textContent = fileName;
    }
</script>




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(element) {
    event.preventDefault(); // Prevent the default link behavior
    const url = element.href;

    Swal.fire({
        title: 'Are you sure? For Remove',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Remove it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, redirect to the delete URL
            window.location.href = url;
        }
    });

    return false; // Prevent immediate navigation
}

</script>




@include('partials.footer')
@endsection
