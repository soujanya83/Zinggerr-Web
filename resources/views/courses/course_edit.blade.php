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
        bottom: -2px;
        left: 0;
        right: 0;
        height: 3px;
        background-color: #007bff;
        border-radius: 2px;

    }

    /* Active tab pane content styling */
    .tab-pane.active {
        color: #007bff;
        /* Matches the line color */
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

    .nav-tabs .nav-link.active {
        border-bottom: 3px solid #007bff;
        color: #007bff;
        font-weight: bold;
        background-color: white
    }

    .nav-link.active {
        color: #007bff !important;


    }
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


<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>




<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Course Edit</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Course</a></li>
                            <li class="breadcrumb-item" aria-current="page">Edit</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

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

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header  pb-0">
                        <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                            @if (Request::is('course/*/format'))
                            <!-- Do not render this tab if the URL matches -->
                            @else
                            <li class="nav-item " role="presentation">
                                <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1"
                                    role="tab" aria-selected="true" style="background-color: white;">
                                    <i class="material-icons-two-tone me-2">account_circle</i>
                                    General
                                </a>
                            </li>

                            @endif

                            {{-- <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-3" data-bs-toggle="tab" href="#profile-3" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">book</i>
                                    Course format
                                </a>
                            </li> --}}


                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ Request::is('course/*/format') ? 'active' : '' }}"
                                    id="profile-tab-3" data-bs-toggle="tab" href="#profile-3" role="tab"
                                    aria-selected="{{ Request::is('course/*/format') ? 'true' : 'false' }}"
                                    tabindex="-1" style="background-color: white;">
                                    <i class="material-icons-two-tone me-2">book</i>
                                    Course format
                                </a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-8" data-bs-toggle="tab" href="#profile-8" role="tab"
                                    aria-selected="false" tabindex="-1" style="    background-color: white;">
                                    <i class="material-icons-two-tone me-2">group</i>
                                    Faculties Assign
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-9" data-bs-toggle="tab" href="#profile-9" role="tab"
                                    aria-selected="false" tabindex="-1" style="    background-color: white;">
                                    <i class="material-icons-two-tone me-2">group</i>
                                    Students Assign
                                </a>
                            </li>


                        </ul>
                    </div>


                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active {{ Request::is('course/*/format') ? 'd-none' : '' }}"
                                id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
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
                                                            id="floatingShortname"
                                                            oninput="this.value = this.value.replace(/\s/g, '')">
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

                                                        <div class="d-flex align-items-center  rounded col-md-12">

                                                            <div class="d-flex align-items-center col-md-12">

                                                                <label for="fileUpload"
                                                                    class="file-upload-label col-md-12">
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
                                                            class="border rounded" style="margin-top: -7px">
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


                            <div class="tab-pane fade mt-3 {{ Request::is('course/*/format') ? 'show active' : '' }}"
                                id="profile-3" role="tabpanel" aria-labelledby="profile-tab-3">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-4" style="display:none">
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
                                            <div class="form-floating mb-3">
                                                <div class="dropdown">
                                                    <label style="align-content: center;" for="emailInput"
                                                        class="form-label">Format:
                                                        &nbsp&nbsp&nbsp</label>
                                                    <button class="btn btn-shadow btn-primary-line dropdown-toggle"
                                                        type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        Select Format
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


                                                    </ul>
                                                    <a href="{{ route('add_assets', $course->slug) }}"
                                                        id="createChapterButton" class="btn btn-shadow btn-success mt-3"
                                                        style="display: none;width: 158px; margin-left: 63px;">
                                                        Manage Assets
                                                    </a>

                                                    <a href="{{ route('create_section', $course->slug) }}"
                                                        id="createsectionButton" class="btn btn-shadow btn-success mt-3"
                                                        style="display: none;width: 158px; margin-left: 63px;">
                                                        Create Sections
                                                    </a>
                                                    <a href="{{ route('manage_activity', $course->slug) }}"
                                                        id="createactivityButton"
                                                        class="btn btn-shadow btn-success mt-3"
                                                        style="display: none;width: 158px; margin-left: 63px;">
                                                        Manage Activity
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Interactive List Button -->
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <div class="dropdown">
                                                    <label for="emailInput" class="form-label">InterActive:
                                                        &nbsp;&nbsp;</label>
                                                    <button class="btn btn-shadow btn-primary" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#assetsModal">
                                                        InterActive
                                                    </button>
                                                </div>
                                            </div>
                                        </div>








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

                                        </div>


                                        <div class="col-md-2">
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




                                        <div class="col-md-12 mt-5" style="margin-left: 85%;">
                                            <button type="submit" class="btn btn-shadow btn-primary">Update
                                                Course</button>
                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div>



                            {{-- ..............this use for faculty(teachers) list assigned and avaliable for this
                            courses................ --}}

                            @include('courses.faculty_assigned_avaliable')

                            {{-- ..............this use for students list assigned and avaliable for this
                            courses................ --}}
                            @include('courses.students_assigned_available_list')


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap Modal for Assets Data -->
<div class="modal fade" id="assetsModal" tabindex="-1" aria-labelledby="assetsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assetsModalLabel">Assets List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Asset Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(!empty($assetsData) && count($assetsData) > 0)
                        @foreach($assetsData as $index => $asset)
                        <tr
                            onclick="openAssetModal(event, '{{ $asset['assets_type'] }}', '{{ asset('storage/' .  $asset['assets_path']) }}', '{{ strip_tags($asset['topic_name']) }}')">
                            <td>{{ $index + 1 }}</td>
                            <td style="padding:5px">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        @if ($asset['thumbnail'])
                                        <img src="{{'https://assets.zinggerr.com/storage/' .  $asset['thumbnail'] }}" alt="User image"
                                            style="height:50px;width: 50px;">
                                        @else
                                        <img src="{{ asset('asset/images/user/download.jpg') }}"
                                            alt="Default image" style="height:50px;width: 50px;">
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-1">{{ Str::limit (strip_tags( $asset['topic_name']),40, '...') }}</h5>
                                        <p class="text-muted f-12">{{ Str::limit(strip_tags( $asset['about']), 45, '...') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ ucfirst( $asset['assets_type']) }}</td>
                            {{-- <td>{{  $asset['topic_name'] }}</td> --}}
                            <td>
                                @if ($asset['asset_status'] == '0')
                                <span class="badge rounded-pill f-14 bg-light-danger">Inactive</span>
                                @elseif($asset['asset_status'] == '1')
                                <span class="badge bg-light-success rounded-pill f-14">Active</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($asset['created_at'])->format('d-M-Y') }}</td>
                            <td>

                                <a href="{{ route('api.assetsdelete', $asset['asset_id']) }}"
                                    class="avtar avtar-xs btn-link-secondary read-more-btn"
                                    data-id="{{ $asset['asset_id'] }}" onclick="return confirmDelete(this)">
                                    <i class="ti ti-trash f-20" style="color: red;"></i>
                                </a>
                            </td>

                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center text-danger">No
                                Data Available</td>
                        </tr>
                        @endif
                    </tbody>



                </table>
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
                    <button type="submit" class="btn  btn-shadow btn-danger">Submit and Remove</button>
                </div>
            </div>
        </form>
    </div>
</div>



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
                                @foreach ($permissionsdata as $index => $permission)
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
                        <button type="submit" class="btn btn-shadow btn-primary">Assigndd Permissions</button>
                    </div>
                </form>
            </div>
        </div>
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


<script>
    document.addEventListener('DOMContentLoaded', function () {
const radioButtons = document.querySelectorAll('input[name="course_format"]');
const createsectionButton = document.getElementById('createsectionButton');

radioButtons.forEach(radio => {
radio.addEventListener('change', function () {
if (this.value === 'Weekly sections') {
createsectionButton.style.display = 'block'; // Show the button
} else {
createsectionButton.style.display = 'none'; // Hide the button
}
});
});

// Initialize the button state based on the current selection
const selectedRadio = document.querySelector('input[name="course_format"]:checked');
if (selectedRadio && selectedRadio.value === 'Weekly sections') {
createsectionButton.style.display = 'block';
}
});

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
const radioButtons = document.querySelectorAll('input[name="course_format"]');
const createactivityButton = document.getElementById('createactivityButton');

radioButtons.forEach(radio => {
radio.addEventListener('change', function () {
if (this.value === 'Single activity') {
createactivityButton.style.display = 'block'; // Show the button
} else {
createactivityButton.style.display = 'none'; // Hide the button
}
});
});

// Initialize the button state based on the current selection
const selectedRadio = document.querySelector('input[name="course_format"]:checked');
if (selectedRadio && selectedRadio.value === 'Single activity') {
createactivityButton.style.display = 'block';
}
});

</script>





<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
