<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@extends('layouts.app')

@section('pageTitle', 'Course Update')

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
        {{-- <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Course Edit</h5>
                    </div>
                    <div class="card-body">
                        <form id="createCourseForm" method="POST" enctype="multipart/form-data"
                            action="{{ route('course_update', $course->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Name</label>
                                        <input type="text" name="course_name" class="form-control"
                                            placeholder="Enter Course Name" required value="{{ $course->course_name }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Code</label>
                                        <input type="text" name="course_code" class="form-control"
                                            placeholder="Enter Course Code" required value="{{ $course->code }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" name="start_date" class="form-control" required
                                            value="{{ $course->start_date }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Duration</label>
                                        <input type="text" name="duration" class="form-control"
                                            placeholder="Enter Course Duration" required
                                            value="{{ $course->duration }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Price</label>
                                        <input type="number" name="price" class="form-control"
                                            placeholder="Enter Course Price" required value="{{ $course->price }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Teacher Name</label>
                                        <input type="text" name="teacher_name" class="form-control"
                                            placeholder="Enter Teacher Name" required
                                            value="{{ $course->teacher_name }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Maximum Students</label>
                                        <input type="number" name="max_students" class="form-control"
                                            placeholder="Enter Maximum Students" required
                                            value="{{ $course->max_students }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Status</label>
                                        <select name="status" class="form-select" required>
                                            <option value="0" {{ $course->status == 0 ? 'selected' : '' }}>Deactive
                                            </option>
                                            <option value="1" {{ $course->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Details</label>
                                        <textarea name="details" class="form-control" rows="3"
                                            placeholder="Enter Course Details">{{ $course->details }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Image</label>
                                        <input type="file" name="course_image" class="form-control" accept="image/*">
                                        @if($course->course_image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $course->course_image) }}"
                                                alt="Course Image" class="img-fluid"
                                                style="max-width: 150px; height: auto;">
                                        </div>
                                        @endif
                                        <!-- File input for uploading a new image -->

                                    </div>
                                </div>

                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header  pb-0" style="    margin-left: -29px;">
                        <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                            <li class="nav-item " role="presentation">
                                <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1"
                                    role="tab" aria-selected="true">
                                    <i class="material-icons-two-tone me-2">account_circle</i>
                                    General
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">book</i>
                                    Description
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
                                <a class="nav-link" id="profile-tab-4" data-bs-toggle="tab" href="#profile-4" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">book</i>
                                    Appearance
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-5" data-bs-toggle="tab" href="#profile-5" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">book</i>
                                    Files and uploads
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-6" data-bs-toggle="tab" href="#profile-6" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">book</i>
                                    Completion tracking
                                </a>
                            </li>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-7" data-bs-toggle="tab" href="#profile-7" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">book</i>
                                    Groups
                                </a>
                            </li>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-8" data-bs-toggle="tab" href="#profile-8" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">book</i>
                                    Tags
                                </a>
                            </li>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-9" data-bs-toggle="tab" href="#profile-9" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="material-icons-two-tone me-2">book</i>
                                    Course custom fields
                                </a>
                            </li>
                        </ul>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            {{--
                            ..............................................................................................................
                            --}}

                            <div class="tab-pane fade show active" id="profile-1" role="tabpanel"
                                aria-labelledby="profile-tab-1">
                                <div class="row">
                                    <div class="card-body">
                                        <form id="createCourseForm" method="post" enctype="multipart/form-data"
                                            action="{{ route('course_update', $course->id) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Course Full Name</label>
                                                        <input type="text" name="course_full_name" class="form-control"
                                                            placeholder="Enter Course Full Name" required
                                                            value="{{ old('course_full_name'). $course->course_full_name }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Course Short Name</label>
                                                        <input type="text" name="course_short_name" class="form-control"
                                                            placeholder="Enter Course Short Name" required
                                                            value="{{ old('course_short_name'). $course->course_short_name }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="emailInput" class="form-label">Select Course
                                                            Category</label>
                                                        <select name="course_category" class="form-select" required>

                                                            {{-- @foreach($role as $roledata)
                                                            <option value="{{ $roledata->name }}">{{
                                                                $roledata->display_name
                                                                }}</option>
                                                            @endforeach --}}


                                                            <option value="Art" {{ old('course_category', $course->
                                                                course_category ?? '') == 'Art' ? 'selected' : ''
                                                                }}>Art</option>
                                                            <option value="Science" {{ old('course_category', $course->
                                                                course_category ?? '') == 'Science' ?
                                                                'selected' : '' }}>Science</option>
                                                            <option value="Math" {{ old('course_category', $course->
                                                                course_category ?? '') == 'Math' ? 'selected' : ''
                                                                }}>Math</option>
                                                            <option value="History" {{ old('course_category', $course->
                                                                course_category ?? '') == 'History' ?
                                                                'selected' : '' }}>History</option>



                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Course Start Date</label>
                                                        <input type="date" name="course_start_date" class="form-control"
                                                            required
                                                            value="{{ old('course_start_date', $course->course_start_date ?? '') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Course End Date</label>
                                                        <input type="date" name="course_end_date" class="form-control"
                                                            required
                                                            value="{{ old('course_start_date', $course->course_end_date ?? '') }}">
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Course ID Number</label>
                                                        <input type="number" name="course_id_number"
                                                            class="form-control" placeholder="Enter Course ID Number"
                                                            required
                                                            value="{{ old('course_id_number', $course->course_id_number ?? '') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="status">Course Visibility:</label>
                                                        <div style="margin-top: 10px;">



                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="course_status" id="statusshow" value="1" {{
                                                                    old('course_status', $course->course_status) == 1 ?
                                                                'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="statusshow">Show</label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="course_status" id="statushide" value="0" {{
                                                                    old('course_status', $course->course_status) == 0 ?
                                                                'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="statushide">Hide</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="status">Enabal Download Course Content:</label>
                                                        <div style="margin-top: 10px;">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="downloa_status" id="statusyes" value="1" {{
                                                                    old('course_status', $course->downloa_status) == 1 ?
                                                                'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="statusyes">Yes</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="downloa_status" id="statusno" value="0" {{
                                                                    old('course_status', $course->downloa_status) == 0 ?
                                                                'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="statusno">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <div class="col-md-12 text-end">

                                                    <button type="submit" class="btn btn-primary">Create Course</button>
                                                </div> --}}
                                            </div>
                                            {{--
                                        </form> --}}

                                    </div>
                                </div>
                            </div>

                            {{--
                            ........................................................................................................................
                            --}}

                            <div class="tab-pane fade" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                                <div class="card">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Course Summary</label>
                                                <textarea type="text" name="course_summary" class="form-control"
                                                    placeholder="Enter Course Summary" required cols="6"
                                                    value="{{ old('course_summary') }}">
                                                    {{$course->course_summary}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Course image</label>
                                                <input type="file" name="course_image" class="form-control"
                                                    placeholder="" cols="6">
                                                <img src="{{ url('storage/'.$course->course_image) }}"
                                                    alt="image" width="100px" height="100px" class="mt-2">

                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            {{--
                            ........................................................................................................................
                            --}}


                            <div class="tab-pane fade" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-3">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Hidden sections</label>
                                                <select name="hidden_section" class="form-select" required>
                                                    <option value="Hidden sections are shown as not available" {{
                                                        old('hidden_section', $course->hidden_section) == 'Hidden
                                                        sections are shown as not available' ? 'selected' : '' }}>
                                                        Hidden sections are shown as not available
                                                    </option>
                                                    <option value="Hidden sections are completely invisible" {{
                                                        old('hidden_section', $course->hidden_section) == 'Hidden
                                                        sections are completely invisible' ? 'selected' : '' }}>
                                                        Hidden sections are completely invisible
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Course layout</label>
                                                <select name="course_layout" class="form-select" required>
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
                                            </div>

                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <div class="dropdown">
                                                    <label for="emailInput" class="form-label">Format:
                                                        &nbsp&nbsp&nbsp</label>
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        Weekly sections
                                                    </button>
                                                    <ul class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton">
                                                        <li>
                                                            <label class="dropdown-item d-flex align-items-start">
                                                                <input type="radio" name="course_format"
                                                                    value="Custom sections"
                                                                    class="form-check-input me-2" {{
                                                                    old('course_format', $course->course_format) ==
                                                                'Custom sections' ? 'checked' : '' }}>
                                                                <div>
                                                                    <strong>Custom sections</strong><br>
                                                                    <span class="text-muted">The course is divided into
                                                                        customizable sections.</span>
                                                                </div>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label class="dropdown-item d-flex align-items-start">
                                                                <input type="radio" name="course_format"
                                                                    value="Weekly sections"
                                                                    class="form-check-input me-2" {{
                                                                    old('course_format', $course->course_format) ==
                                                                'Weekly sections' ? 'checked' : '' }}>
                                                                <div>
                                                                    <strong>Weekly sections</strong><br>
                                                                    <span class="text-muted">The course is divided into
                                                                        sections corresponding to each week, beginning
                                                                        from the course start date.</span>
                                                                </div>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label class="dropdown-item d-flex align-items-start">
                                                                <input type="radio" name="course_format"
                                                                    value="Single activity"
                                                                    class="form-check-input me-2" {{
                                                                    old('course_format', $course->course_format) ==
                                                                'Single activity' ? 'checked' : '' }}>
                                                                <div>
                                                                    <strong>Single activity</strong><br>
                                                                    <span class="text-muted">The course contains only
                                                                        one activity or resource.</span>
                                                                </div>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label class="dropdown-item d-flex align-items-start">
                                                                <input type="radio" name="course_format" value="Social"
                                                                    class="form-check-input me-2" {{
                                                                    old('course_format', $course->course_format) ==
                                                                'Social' ? 'checked' : '' }}>
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

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Number of sections:</label>
                                                <select name="course_sections" class="form-select" required>
                                                    @for ($i = 0; $i <= 52; $i++) <option value="{{ $i }}" {{
                                                        old('course_sections', $course->course_sections) == $i ?
                                                        'selected' : '' }}>
                                                        {{ $i }}
                                                        </option>
                                                        @endfor
                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                            </div>

                            {{--
                            ........................................................................................................................
                            --}}

                            <div class="tab-pane fade" id="profile-4" role="tabpanel" aria-labelledby="profile-tab-4">
                                <div class="card">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="themeSelect" class="form-label">Force theme:</label>
                                                <select id="themeSelect" name="force_theme" class="form-select"
                                                    required>
                                                    <option value="do_not_force" {{ old('force_theme', $course->
                                                        force_theme) == 'do_not_force' ? 'selected' : '' }}>
                                                        Do not force
                                                    </option>
                                                    <option value="boost" {{ old('force_theme', $course->force_theme) ==
                                                        'boost' ? 'selected' : '' }}>
                                                        Boost
                                                    </option>
                                                    <option value="classic" {{ old('force_theme', $course->force_theme)
                                                        == 'classic' ? 'selected' : '' }}>
                                                        Classic
                                                    </option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="select_language" class="form-label">Force Language:</label>
                                                <select id="select_language" name="force_language" class="form-select"
                                                    required>
                                                    <option value="do_not_force" {{ old('force_language', $course->
                                                        force_language) == 'do_not_force' ? 'selected' : '' }}>
                                                        Do not force
                                                    </option>
                                                    <option value="boost" {{ old('force_language', $course->
                                                        force_language) == 'boost' ? 'selected' : '' }}>
                                                        Boost
                                                    </option>
                                                    <option value="classic" {{ old('force_language', $course->
                                                        force_language) == 'classic' ? 'selected' : '' }}>
                                                        Classic
                                                    </option>
                                                    <option value="am" {{ old('force_language', $course->force_language)
                                                        == 'am' ? 'selected' : '' }}>
                                                        Amharic
                                                    </option>
                                                    <option value="om" {{ old('force_language', $course->force_language)
                                                        == 'om' ? 'selected' : '' }}>
                                                        Afaan Oromoo
                                                    </option>
                                                    <option value="af" {{ old('force_language', $course->force_language)
                                                        == 'af' ? 'selected' : '' }}>
                                                        Afrikaans
                                                    </option>
                                                    <option value="an" {{ old('force_language', $course->force_language)
                                                        == 'an' ? 'selected' : '' }}>
                                                        Aragonese
                                                    </option>
                                                    <option value="oc_es" {{ old('force_language', $course->
                                                        force_language) == 'oc_es' ? 'selected' : '' }}>
                                                        Aranese
                                                    </option>
                                                    <option value="ast" {{ old('force_language', $course->
                                                        force_language) == 'ast' ? 'selected' : '' }}>
                                                        Asturian
                                                    </option>
                                                    <option value="az" {{ old('force_language', $course->force_language)
                                                        == 'az' ? 'selected' : '' }}>
                                                        Azerbaijani
                                                    </option>
                                                    <option value="id" {{ old('force_language', $course->force_language)
                                                        == 'id' ? 'selected' : '' }}>
                                                        Bahasa Indonesia
                                                    </option>
                                                    <option value="ms" {{ old('force_language', $course->force_language)
                                                        == 'ms' ? 'selected' : '' }}>
                                                        Bahasa Melayu
                                                    </option>
                                                    <option value="bm" {{ old('force_language', $course->force_language)
                                                        == 'bm' ? 'selected' : '' }}>
                                                        Bamanankan
                                                    </option>
                                                    <option value="bi" {{ old('force_language', $course->force_language)
                                                        == 'bi' ? 'selected' : '' }}>
                                                        Bislama
                                                    </option>
                                                    <option value="bs" {{ old('force_language', $course->force_language)
                                                        == 'bs' ? 'selected' : '' }}>
                                                        Bosnian
                                                    </option>
                                                    <option value="br" {{ old('force_language', $course->force_language)
                                                        == 'br' ? 'selected' : '' }}>
                                                        Breton
                                                    </option>
                                                    <option value="ca" {{ old('force_language', $course->force_language)
                                                        == 'ca' ? 'selected' : '' }}>
                                                        Catalan
                                                    </option>
                                                    <option value="ca_valencia" {{ old('force_language', $course->
                                                        force_language) == 'ca_valencia' ? 'selected' : '' }}>
                                                        Catalan (Valencian)
                                                    </option>
                                                    <option value="cs" {{ old('force_language', $course->force_language)
                                                        == 'cs' ? 'selected' : '' }}>
                                                        Czech
                                                    </option>
                                                    <option value="mis" {{ old('force_language', $course->
                                                        force_language) == 'mis' ? 'selected' : '' }}>
                                                        Montenegrin
                                                    </option>
                                                    <option value="cy" {{ old('force_language', $course->force_language)
                                                        == 'cy' ? 'selected' : '' }}>
                                                        Welsh
                                                    </option>
                                                    <option value="da" {{ old('force_language', $course->force_language)
                                                        == 'da' ? 'selected' : '' }}>
                                                        Danish
                                                    </option>
                                                    <option value="se" {{ old('force_language', $course->force_language)
                                                        == 'se' ? 'selected' : '' }}>
                                                        Northern Sami
                                                    </option>
                                                    <option value="de" {{ old('force_language', $course->force_language)
                                                        == 'de' ? 'selected' : '' }}>
                                                        German
                                                    </option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Number of
                                                    announcements:</label>
                                                <select name="no_announcements" id="emailInput" class="form-select"
                                                    required>
                                                    @for ($i = 0; $i <= 10; $i++) <option value="{{ $i }}" {{
                                                        old('no_announcements', $course->no_announcements) == $i ?
                                                        'selected' : '' }}>
                                                        {{ $i }}
                                                        </option>
                                                        @endfor
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="gradebook_student" class="form-label">Show gradebook to
                                                    students:</label>
                                                <br>
                                                <input class="form-check-input" type="radio" name="gradebook_student"
                                                    id="gradebook_yes" value="1" required {{ old('gradebook_student',
                                                    $course->gradebook_student) == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gradebook_yes">Yes</label>
                                                &nbsp;&nbsp;

                                                <input class="form-check-input" type="radio" name="gradebook_student"
                                                    id="gradebook_no" value="0" {{ old('gradebook_student',
                                                    $course->gradebook_student) == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gradebook_no">No</label>
                                            </div>

                                        </div>


                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="activity_report" class="form-label">Show activity
                                                    reports:</label>
                                                <br>
                                                <input class="form-check-input" type="radio" name="activity_report"
                                                    id="activity_report_yes" value="1" required {{
                                                    old('activity_report', $course->activity_report) == '1' ? 'checked'
                                                : '' }}>
                                                <label class="form-check-label" for="activity_report_yes">Yes</label>
                                                &nbsp;&nbsp;
                                                <input class="form-check-input" type="radio" name="activity_report"
                                                    id="activity_report_no" value="0" {{ old('activity_report',
                                                    $course->activity_report) == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="activity_report_no">No</label>

                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="activity_date" class="form-label">Show activity
                                                    dates:</label>
                                                <br>
                                                <input class="form-check-input" type="radio" name="activity_date"
                                                    id="activity_date_yes" value="1" required {{ old('activity_date',
                                                    $course->activity_date) == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="activity_date_yes">Yes</label>
                                                &nbsp;&nbsp;
                                                <input class="form-check-input" type="radio" name="activity_date"
                                                    id="activity_date_no" value="0" {{ old('activity_date',
                                                    $course->activity_date) == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="activity_date_no">No</label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--
                            ........................................................................................................................
                            --}}

                            <div class="tab-pane fade" id="profile-5" role="tabpanel" aria-labelledby="profile-tab-5">
                                <div class="card">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="file_uploads_size" class="form-label">Maximum upload
                                                    size:</label>
                                                <select id="file_uploads_size" name="file_uploads_size"
                                                    class="form-select" required>
                                                    <option value="" {{ old('file_uploads_size', $course->
                                                        file_uploads_size) == '' ? 'selected' : '' }}>
                                                        Site upload limit (256MB)
                                                    </option>
                                                    <option value="256MB" {{ old('file_uploads_size', $course->
                                                        file_uploads_size) == '256MB' ? 'selected' : '' }}>
                                                        256 MB
                                                    </option>
                                                    <option value="250MB" {{ old('file_uploads_size', $course->
                                                        file_uploads_size) == '250MB' ? 'selected' : '' }}>
                                                        250 MB
                                                    </option>
                                                    <option value="100MB" {{ old('file_uploads_size', $course->
                                                        file_uploads_size) == '100MB' ? 'selected' : '' }}>
                                                        100 MB
                                                    </option>
                                                    <option value="50MB" {{ old('file_uploads_size', $course->
                                                        file_uploads_size) == '50MB' ? 'selected' : '' }}>
                                                        50 MB
                                                    </option>
                                                    <option value="20MB" {{ old('file_uploads_size', $course->
                                                        file_uploads_size) == '20MB' ? 'selected' : '' }}>
                                                        20 MB
                                                    </option>
                                                    <option value="10MB" {{ old('file_uploads_size', $course->
                                                        file_uploads_size) == '10MB' ? 'selected' : '' }}>
                                                        10 MB
                                                    </option>
                                                    <option value="5MB" {{ old('file_uploads_size', $course->
                                                        file_uploads_size) == '5MB' ? 'selected' : '' }}>
                                                        5 MB
                                                    </option>
                                                    <option value="2MB" {{ old('file_uploads_size', $course->
                                                        file_uploads_size) == '2MB' ? 'selected' : '' }}>
                                                        2 MB
                                                    </option>
                                                    <option value="1MB" {{ old('file_uploads_size', $course->
                                                        file_uploads_size) == '1MB' ? 'selected' : '' }}>
                                                        1 MB
                                                    </option>
                                                    <option value="500KB" {{ old('file_uploads_size', $course->
                                                        file_uploads_size) == '500KB' ? 'selected' : '' }}>
                                                        500 KB
                                                    </option>
                                                    <option value="100KB" {{ old('file_uploads_size', $course->
                                                        file_uploads_size) == '100KB' ? 'selected' : '' }}>
                                                        100 KB
                                                    </option>
                                                    <option value="50KB" {{ old('file_uploads_size', $course->
                                                        file_uploads_size) == '50KB' ? 'selected' : '' }}>
                                                        50 KB
                                                    </option>
                                                    <option value="10KB" {{ old('file_uploads_size', $course->
                                                        file_uploads_size) == '10KB' ? 'selected' : '' }}>
                                                        10 KB
                                                    </option>
                                                </select>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--
                            ........................................................................................................................
                            --}}

                            <div class="tab-pane fade" id="profile-6" role="tabpanel" aria-labelledby="profile-tab-6">
                                <div class="card">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="completion_tracking" class="form-label">Enable completion
                                                    tracking:</label>
                                                <br>
                                                <input class="form-check-input" type="radio" name="completion_tracking"
                                                    id="completion_tracking_yes" value="1" required {{
                                                    old('completion_tracking', $course->completion_tracking) == '1' ?
                                                'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="completion_tracking_yes">Yes</label>
                                                &nbsp;&nbsp;
                                                <input class="form-check-input" type="radio" name="completion_tracking"
                                                    id="completion_tracking_no" value="0" {{ old('completion_tracking',
                                                    $course->completion_tracking) == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="completion_tracking_no">No</label>

                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Show activity completion conditions:</label>
                                                <br>
                                                <input class="form-check-input" type="radio"
                                                    name="activity_completion_conditions" id="completion_conditions_yes"
                                                    value="1" required {{ old('activity_completion_conditions',
                                                    $course->activity_completion_conditions) == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="completion_conditions_yes">Yes</label>
                                                &nbsp;&nbsp;
                                                <input class="form-check-input" type="radio"
                                                    name="activity_completion_conditions" id="completion_conditions_no"
                                                    value="0" {{ old('activity_completion_conditions',
                                                    $course->activity_completion_conditions) == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="completion_conditions_no">No</label>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{--
                            ........................................................................................................................
                            --}}

                            <div class="tab-pane fade" id="profile-7" role="tabpanel" aria-labelledby="profile-tab-7">
                                <div class="card">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="group_mode" class="form-label">Group mode:</label>
                                                <select name="group_mode" id="group_mode" class="form-select" required>
                                                    <option value="No Group" {{ old('group_mode', $course->group_mode)
                                                        == 'No Group' ? 'selected' : '' }}>No Groups</option>
                                                    <option value="Separate Group" {{ old('group_mode', $course->
                                                        group_mode) == 'Separate Group' ? 'selected' : '' }}>Separate
                                                        Groups</option>
                                                    <option value="Visible Group" {{ old('group_mode', $course->
                                                        group_mode) == 'Visible Group' ? 'selected' : '' }}>Visible
                                                        Groups</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Force group mode:</label>
                                                <br>
                                                <input class="form-check-input" type="radio" name="force_group_mode"
                                                    id="force_group_mode_yes" value="1" required {{
                                                    old('force_group_mode', $course->force_group_mode) == '1' ?
                                                'checked' : '' }}>
                                                <label class="form-check-label" for="force_group_mode_yes">Yes</label>
                                                &nbsp;&nbsp;
                                                <input class="form-check-input" type="radio" name="force_group_mode"
                                                    id="force_group_mode_no" value="0" {{ old('force_group_mode',
                                                    $course->force_group_mode) == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="force_group_mode_no">No</label>

                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Default grouping:</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="default_group"
                                                        id="default_group_none" value="None" required {{
                                                        old('default_group', $course->default_group) == 'None' ?
                                                    'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="default_group_none">None</label>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{--
                            ........................................................................................................................
                            --}}

                            <div class="tab-pane fade" id="profile-8" role="tabpanel" aria-labelledby="profile-tab-8">
                                <div class="card">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="tags" class="form-label">Tags:</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Basic"
                                                        id="basic" name="tags[]" {{ in_array('Basic', explode(',',
                                                        old('tags', $course->tags ?? ''))) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="basic">Basic</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Advanced"
                                                        id="advanced" name="tags[]" {{ in_array('Advanced', explode(',',
                                                        old('tags', $course->tags ?? ''))) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="advanced">Advanced</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Intermediate"
                                                        id="intermediate" name="tags[]" {{ in_array('Intermediate',
                                                        explode(',', old('tags', $course->tags ?? ''))) ? 'checked' : ''
                                                    }}>
                                                    <label class="form-check-label"
                                                        for="intermediate">Intermediate</label>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{--
                            ........................................................................................................................
                            --}}
                            <div class="tab-pane fade" id="profile-9" role="tabpanel" aria-labelledby="profile-tab-9">
                                <div class="card">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="credits" class="form-label">Module credits:</label>

                                                <input type="text" class="form-control" id="credits"
                                                    name="module_credit"
                                                    value="{{ old('module_credit'). $course->module_credit }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-end">
                                            <button type="submit" class="btn btn-primary">Update Course</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
</script>
@include('partials.footer')
@endsection
