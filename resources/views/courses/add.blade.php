<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@extends('layouts.app')

@section('pageTitle', 'Add Course')

@section('content')
@include('partials.sidebar')
@include('partials.headerdashboard')


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



    .css-pht88d {
        /* font-size: 0.875rem; */
        font-weight: 400;
        line-height: 1.4375em;
        font-family: Roboto, sans-serif;
        color: rgb(54, 65, 82);
        box-sizing: border-box;
        cursor: text;
        display: inline-flex;
        align-items: center;
        width: 100%;
        position: relative;
        background: rgb(248, 250, 252);
        border-radius: 8px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Course Create</h5>
                        </div>
                    </div>







                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Course</a></li>
                            <li class="breadcrumb-item" aria-current="page">Create</li>
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


        <div class="row">

            <div class="card" style="width: 98%;margin-left: 12px;">
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


                    </ul>
                </div>



                <div class="card-body">
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="profile-1" role="tabpanel"
                            aria-labelledby="profile-tab-1">
                            <div class="card-body">
                                {{-- <form id="createCourseForm" method="POST" enctype="multipart/form-data"> --}}
                                    <form action="{{ route('courses.create') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">

                                                    <input type="text" name="course_full_name" class="form-control"
                                                        placeholder="Enter Course Full Name" id="floatingShortname"
                                                        required value="{{ old('course_full_name') }}">


                                                    <label style="align-content: center;" class="form-label"
                                                        for="floatingShortname">Course Full
                                                        Name</label>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-6">
                                                <div class="form-floating mb-3">

                                                    <input type="text" name="course_short_name" class="form-control"
                                                        placeholder="Enter Course Short Name" id="floatingShortname"
                                                        required value="{{ old('course_short_name') }}">
                                                    <label style="align-content: center;" class="form-label"
                                                        for="floatingShortname">Course Short
                                                        Name</label>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="course_short_name" class="form-control"
                                                        placeholder="Enter Course Short Name" id="floatingShortname"
                                                        required value="{{ old('course_short_name') }}"
                                                        oninput="this.value = this.value.replace(/\s/g, '')">
                                                    <label style="align-content: center;" class="form-label"
                                                        for="floatingShortname">
                                                        Course Short Name
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="course_category" class="form-select"
                                                        id="floatingShortname">
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->name }}">{{ $category->display_name
                                                            }}</option>
                                                        @endforeach

                                                    </select>
                                                    <label style="align-content: center;" for="floatingShortname">Select
                                                        Course
                                                        Category</label>
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">

                                                    <input type="number" name="course_id_number" class="form-control"
                                                        placeholder="Enter Course ID Number" required
                                                        value="{{ old('course_id_number') }}">
                                                    <label style="align-content: center;" class="form-label">Course
                                                        ID Number</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label">Course Summary</label>
                                                <div class="form-floating mb-3">
                                                    <!-- Textarea for Summernote -->
                                                    <textarea id="summernote" name="course_summary" class="form-control"
                                                        required>{{ old('course_summary') }}

                                                     </textarea>

                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label" style="margin-bottom: 5px;">Course Image
                                                    Upload</label>
                                                <div class="form-floating mb-3">
                                                    <div class="d-flex align-items-center rounded w-100 col-md-12">
                                                        <label for="fileUpload"
                                                            class="file-upload-label w-100 text-center col-md-12">
                                                            <div class="upload-icon mb-3">
                                                                <i
                                                                    class="fas fa-cloud-upload-alt fa-3x text-primary"></i>
                                                            </div>
                                                            <span class="text-muted" style="margin-top: -19px;">Click to
                                                                upload file here</span>
                                                            <span id="fileName" class="ms-2"></span>
                                                            <input type="file" id="fileUpload" name="course_image"
                                                                class="file-upload-input" onchange="showFileName(this)"
                                                                required style="display: none;">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-end">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>


                            </div>
                        </div>


                        <div class="tab-pane fade" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-3">
                            <div class="">
                                <div class="row">


                                    <div class="col-md-3">
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
                                                                value="Custom sections" class="form-check-input me-2">
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
                                                                value="Weekly sections" class="form-check-input me-2"
                                                                checked>
                                                            &nbsp; &nbsp;
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
                                                                value="Single activity" class="form-check-input me-2">
                                                            &nbsp; &nbsp;
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
                                                                class="form-check-input me-2"> &nbsp; &nbsp;
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


                                    {{-- <div class="col-md-4"> --}}
                                        <div class="form-floating mb-3" style="display: none">

                                            <select name="course_layout" class="form-select">

                                                <option value="Hidden sections are shown as not available" cheacked>
                                                    Hidden sections are shown as not available
                                                </option>
                                                <option value="Hidden sections are completely invisible">
                                                    Hidden sections are completely invisible
                                                </option>
                                            </select>
                                            <label style="align-content: center;" for="emailInput"
                                                class="form-label">Course layout</label>
                                        </div>

                                    {{-- </div> --}}




                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="status" style="color: #000">Course
                                                Visibility:</label>
                                            <div>

                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="course_status"
                                                        id="statusshow" value="1" >
                                                    <label class="form-check-label" for="statusshow"
                                                        style="color: #000">Show</label>
                                                </div>


                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="course_status"
                                                        id="statushide" value="0" checked>
                                                    <label class="form-check-label" for="statushide"
                                                        style="color: #000" >Hide</label>
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
                                                    <input class="form-check-input" type="radio" name="downloa_status"
                                                        id="statusyes" value="1" checked>
                                                    <label class="form-check-label" for="statusyes"
                                                        style="color: #000">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="downloa_status"
                                                        id="statusno" value="0">
                                                    <label class="form-check-label" for="statusno"
                                                        style="color: #000">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                    <div class="col-md-3">
                                        <label style="align-content: center;" for="tags"
                                            class="form-label">Tags:</label>
                                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                        <div class="form-floating mb-3">

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="Basic" id="basic"
                                                    name="tags[]">
                                                <label class="form-check-label" for="basic"
                                                    style="color: black">Basic</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="Advanced"
                                                    id="advanced" name="tags[]">
                                                <label class="form-check-label" for="advanced"
                                                    style="color: black">Advanced</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="Intermediate"
                                                    id="intermediate" name="tags[]">
                                                <label class="form-check-label" for="intermediate"
                                                    style="color: black">Intermediate</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    </form>
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
        fetch('{{ route('courses.create') }}', {
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
    //     .catch(error => {
    //         Swal.fire({
    //             title: 'Error!',
    //             text: 'Something went wrong. Please try again.',
    //             icon: 'error',
    //             showConfirmButton: false,
    // timer: 3000,
    // timerProgressBar: true
    //         });
    //     });
    });
</script>






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



@include('partials.footer')
@endsection
