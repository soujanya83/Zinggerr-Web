<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@extends('layouts.app')

@section('pageTitle', 'Add Course')

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
                            <li class="breadcrumb-item" aria-current="page">Add</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

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

                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        {{--
                        ........................................................................................................................
                        --}}

                        <div class="tab-pane fade show active" id="profile-1" role="tabpanel"
                            aria-labelledby="profile-tab-1">
                            <div class="row">
                                <div class="card-body">
                                    <form id="createCourseForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Course Full Name</label>
                                                    <input type="text" name="course_name" class="form-control"
                                                        placeholder="Enter Course Full Name" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Course Short Name</label>
                                                    <input type="text" name="course_code" class="form-control"
                                                        placeholder="Enter Course Short Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Select Course
                                                        Category</label>
                                                    <select name="course_category" class="form-select" required>
                                                        <option value=""></option>
                                                        {{-- @foreach($role as $roledata)
                                                        <option value="{{ $roledata->name }}">{{ $roledata->display_name
                                                            }}</option>
                                                        @endforeach --}}

                                                        <option value="Art">Art</option>
                                                        <option value="Science">Science</option>
                                                        <option value="Math">Math</option>
                                                        <option value="History">History</option>


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Course Start Date</label>
                                                    <input type="date" name="course_start_date" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Course End Date</label>
                                                    <input type="date" name="coursr_end_date" class="form-control"
                                                        required>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Course ID Number</label>
                                                    <input type="number" name="course_id_number" class="form-control"
                                                        placeholder="Enter Course ID Number" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="status">Course Visibility:</label>
                                                    <div style="margin-top: 10px;">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="course_status" id="statusshow" value="1">
                                                            <label class="form-check-label"
                                                                for="statusshow">Show</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="course_status" id="statushide" value="0">
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
                                                                name="downloa_status" id="statusyes" value="1">
                                                            <label class="form-check-label" for="statusyes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="downloa_status" id="statusno" value="0">
                                                            <label class="form-check-label" for="statusno">No</label>
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
                                                placeholder="Enter Course Summary" required cols="6"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Course image</label>
                                            <input type="file" name="course_image" class="form-control" placeholder=""
                                                required cols="6">
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
                                                <option value="shown_not_available">Hidden sections are shown as not
                                                    available</option>
                                                <option value="completely_invisible">Hidden sections are completely
                                                    invisible</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Course layout</label>
                                            <select name="course_layout" class="form-select" required>
                                                <option value="shown_not_available">Hidden sections are shown as not
                                                    available</option>
                                                <option value="completely_invisible">Hidden sections are completely
                                                    invisible</option>
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
                                                                value="Custom sections" class="form-check-input me-2">
                                                            <div>
                                                                <strong>Custom sections</strong><br>
                                                                <span class="text-muted">The course is divided
                                                                    into
                                                                    customizable sections.</span>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item d-flex align-items-start">
                                                            <input type="radio" name="course_format"
                                                                value="Weekly sections" class="form-check-input me-2"
                                                                checked>
                                                            <div>
                                                                <strong>Weekly sections</strong><br>
                                                                <span class="text-muted">The course is divided
                                                                    into
                                                                    sections
                                                                    corresponding to each week, beginning from
                                                                    the
                                                                    course
                                                                    start date.</span>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item d-flex align-items-start">
                                                            <input type="radio" name="course_format"
                                                                value="Single activity" class="form-check-input me-2">
                                                            <div>
                                                                <strong>Single activity</strong><br>
                                                                <span class="text-muted">The course contains
                                                                    only
                                                                    one
                                                                    activity or resource.</span>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item d-flex align-items-start">
                                                            <input type="radio" name="course_format" value="Social"
                                                                class="form-check-input me-2">
                                                            <div>
                                                                <strong>Social</strong><br>
                                                                <span class="text-muted">The course is centred
                                                                    around a main
                                                                    forum on the course page. Additional
                                                                    activities
                                                                    and
                                                                    resources can be added using the Social
                                                                    activities
                                                                    block.</span>
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

                                                @for ($i = 0; $i <= 52; $i++) <option value="{{ $i }}" {{ $i==10
                                                    ? 'selected' : '' }}>
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
                                            <select id="themeSelect" name="force_theme" class="form-select" required>
                                                <option value="do_not_force" selected>Do not force</option>
                                                <option value="boost">Boost</option>
                                                <option value="classic">Classic</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="select_language" class="form-label">Force Language:</label>
                                            <select id="select_language" name="force_them" class="form-select" required>
                                                <option value="do_not_force" selected>Do not force</option>
                                                <option value="boost">Boost</option>
                                                <option value="classic">Classic</option>
                                                <option value="am">Amharic</option>
                                                <option value="om">Afaan Oromoo</option>
                                                <option value="af">Afrikaans</option>
                                                <option value="an">Aragonese</option>
                                                <option value="oc_es">Aranese</option>
                                                <option value="ast">Asturian</option>
                                                <option value="az">Azerbaijani</option>
                                                <option value="id">Bahasa Indonesia</option>
                                                <option value="ms">Bahasa Melayu</option>
                                                <option value="bm">Bamanankan</option>
                                                <option value="bi">Bislama</option>
                                                <option value="bs">Bosnian</option>
                                                <option value="br">Breton</option>
                                                <option value="ca">Catalan</option>
                                                <option value="ca_valencia">Catalan (Valencian)</option>
                                                <option value="cs">Czech</option>
                                                <option value="mis">Montenegrin</option>
                                                <option value="cy">Welsh</option>
                                                <option value="da">Danish</option>
                                                <option value="se">Northern Sami</option>
                                                <option value="de">German</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Number of announcements:</label>
                                            <select name="no_announcements" id="emailInput" class="form-select"
                                                required>

                                                @for ($i = 0; $i <= 10; $i++) <option value="{{ $i }}" {{ $i==5
                                                    ? 'selected' : '' }}>
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
                                            <select name="gradebook_student" id="gradebook_student" class="form-select"
                                                required>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="activity_report" class="form-label">Show activity
                                                reports:</label>
                                            <select name="activity_report" id="activity_report" class="form-select"
                                                required>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="activity_date" class="form-label">Show activity dates:</label>
                                            <select name="activity_date" id="activity_date" class="form-select"
                                                required>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
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
                                            <select id="file_uploads_size" name="file_uploads_size" class="form-select"
                                                required>
                                                <option value="" selected>Site upload limit(256MB)</option>

                                                <option value="256MB">256 MB</option>
                                                <option value="250MB">250 MB</option>
                                                <option value="100MB">100 MB</option>
                                                <option value="50MB">50 MB</option>
                                                <option value="20MB">20 MB</option>
                                                <option value="10MB">10 MB</option>
                                                <option value="5MB">5 MB</option>
                                                <option value="2MB">2 MB</option>
                                                <option value="1MB">1 MB</option>
                                                <option value="500KB">500 KB</option>
                                                <option value="100KB">100 KB</option>
                                                <option value="50KB">50 KB</option>
                                                <option value="10KB">10 KB</option>
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
                                            <select name="completion_tracking" id="completion_tracking"
                                                class="form-select" required>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="activity_completion_conditions" class="form-label">Show activity
                                                completion conditions</label>
                                            <select name="activity_completion_conditions"
                                                id="activity_completion_conditions" class="form-select" required>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
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
                                                <option value="No Group">No Groups</option>
                                                <option value="Separate Group">Separate Groups</option>
                                                <option value="Visible Group">Visible Groups</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="force_group_mode" class="form-label">Force group
                                                mode
                                            </label>
                                            <select name="force_group_mode" id="force_group_mode" class="form-select"
                                                required>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="default_group" class="form-label">Default grouping
                                            </label>
                                            <select name="default_group" id="default_group" class="form-select"
                                                required>
                                                <option value="None">None</option>
                                            </select>
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
                                                <input class="form-check-input" type="checkbox" value="Basic" id="basic"
                                                    name="tags[]">
                                                <label class="form-check-label" for="basic">Basic</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Advanced"
                                                    id="advanced" name="tags[]">
                                                <label class="form-check-label" for="advanced">Advanced</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Intermediate"
                                                    id="intermediate" name="tags[]">
                                                <label class="form-check-label" for="intermediate">Intermediate</label>
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

                                            <input type="text" class="form-control" id="credits" name="module_credit"
                                                value="25">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-end">
                                        <button type="submit" class="btn btn-primary">Submit Course</button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('createCourseForm').addEventListener('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        fetch('{{ route('courses_create') }}', {
            method: 'POST',
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
    timer: 2000,
    timerProgressBar: true
})
.then(() => {

            window.location.href = '{{ route("courses") }}';
        });

                // document.getElementById('createCourseForm').reset();   //// if course create form empty

            } else {
                Swal.fire({
                    title: 'Error!',
                    text: data.message || 'There was an issue with your submission.',
                    icon: 'error',
                    showConfirmButton: false,
    timer: 3000,
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
    timer: 3000,
    timerProgressBar: true
            });
        });
    });
</script>




@include('partials.footer')
@endsection
