@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">


@section('pageTitle', ' Task Create')

@section('content')
@include('partials.sidebar')
@include('partials.header')
<style>
    /* Ensure the dropdown menu aligns properly with the input */
    .dropdown {
        position: relative;
    }

    /* Optional: Add some styling to match the image */
    .form-control-sm {
        border-radius: 0.25rem;
        border: 1px solid #ced4da;
    }

    .dropdown-menu {
        border-radius: 0.25rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Create Task</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Create Task</li>
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
            <div class="tab-pane" id="request" role="tabpanel" aria-labelledby="request-tab">
                <div class="card">

                    <div class="card-header" style="margin-bottom: -28px;">
                        <div class="row align-items-center g-2">
                            <div class="col">
                                <h5>Create Task</h5>
                            </div>

                            <div class="card-body">
                                <form id="permissionForm" action="{{ route('task.store') }}" method="post"
                                    autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    placeholder="Enter Task Title.." value="{{ old('title') }}"
                                                    required>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task_date">Deadline</label>
                                                <input type="date" class="form-control" name="task_date" id="task_date"
                                                    required value="{{ old('task_date') }}">
                                            </div>
                                        </div> --}}

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task_date">Deadline</label>
                                                <input type="text" class="form-control" name="task_date" id="task_date"
                                                    required value="{{ old('task_date') }}" placeholder="dd/mm/yyyy">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Description</label>
                                            <div class="form-floating mb-3">
                                                <!-- Textarea for Summernote -->
                                                <textarea id="summernote" name="description" class="form-control"
                                                    required>{{ old('description') }}
                                                 </textarea>
                                            </div>
                                        </div>

                                        <!-- Assign To User -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="assign_users">Assign To User</label>
                                                <div class="dropdown">
                                                    <input type="text" class="form-control  user-search"
                                                        placeholder="Search user..." onkeyup="filterUsers(this)"
                                                        onclick="toggleDropdown(this)">
                                                    <div class="dropdown-menu p-2 keep-open-dropdown"
                                                        aria-labelledby="userDropdown"
                                                        style="width: 100%; z-index: 1050; position: absolute;">
                                                        <!-- Scrollable User List -->
                                                        <div class="user-list-container"
                                                            style="max-height: 180px; overflow-y: auto; display: none;">
                                                            @foreach($users as $user)
                                                            <label class="dropdown-item">
                                                                <input type="checkbox" class="assign-checkbox"
                                                                    name="assign_users[]" value="{{ $user->id }}">&nbsp;
                                                                {{ $user->name }}
                                                            </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Assign To Role -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="assign_roles">Assign To Role</label>
                                                <div class="dropdown">
                                                    <input type="text" class="form-control  role-search"
                                                        placeholder="Search role..." onkeyup="filterRoles(this)"
                                                        onclick="toggleDropdown(this)">
                                                    <div class="dropdown-menu p-2 keep-open-dropdown"
                                                        aria-labelledby="roleDropdown"
                                                        style="width: 100%; z-index: 1050; position: absolute;">
                                                        <!-- Scrollable Role List -->
                                                        <div class="role-list-container"
                                                            style="max-height: 180px; overflow-y: auto; display: none;">
                                                            @foreach($roles as $role)
                                                            <label class="dropdown-item">
                                                                <input type="checkbox" class="assign-checkbox"
                                                                    name="assign_roles[]" value="{{ $role->id }}">&nbsp;
                                                                {{ $role->display_name }}
                                                            </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Assign To Course -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="assign_courses">Assign To Course</label>
                                                <div class="dropdown">
                                                    <input type="text" class="form-control  course-search"
                                                        placeholder="Search course..." onkeyup="filterCourses(this)"
                                                        onclick="toggleDropdown(this)">
                                                    <div class="dropdown-menu p-2 keep-open-dropdown"
                                                        aria-labelledby="courseDropdown"
                                                        style="width: 100%; z-index: 1050; position: absolute;">
                                                        <!-- Scrollable Course List -->
                                                        <div class="course-list-container"
                                                            style="max-height: 180px; overflow-y: auto; display: none;">
                                                            @foreach($courses as $course)
                                                            <label class="dropdown-item">
                                                                <input type="checkbox" class="assign-checkbox"
                                                                    name="assign_courses[]"
                                                                    value="{{ $course->id }}">&nbsp;
                                                                {{ $course->course_full_name }}
                                                            </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3 mt-4">
                                                <label></label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="active" value="1" checked>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="inactive" value="0">
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <input type="submit" class="btn btn-shadow btn-primary" value="Submit">
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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
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
    // Toggle dropdown list visibility on search input click
    function toggleDropdown(input) {
        const listContainer = $(input).siblings('.dropdown-menu').find('.user-list-container, .role-list-container, .course-list-container');
        listContainer.toggle();
        $(input).siblings('.dropdown-menu').toggle();
    }

    // Filter functions for each section
    function filterUsers(input) {
        var filter = input.value.toLowerCase();
        $('.user-list-container label').each(function() {
            var text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(filter));
        });
    }

    function filterRoles(input) {
        var filter = input.value.toLowerCase();
        $('.role-list-container label').each(function() {
            var text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(filter));
        });
    }

    function filterCourses(input) {
        var filter = input.value.toLowerCase();
        $('.course-list-container label').each(function() {
            var text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(filter));
        });
    }

    // Prevent clicks inside from bubbling up and close on outside click
    $(document).ready(function() {
        $('.keep-open-dropdown').on('click', function(e) {
            e.stopPropagation();
        });

        // Close dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.keep-open-dropdown').length && !$(e.target).is('.user-search, .role-search, .course-search')) {
                $('.dropdown-menu').hide();
                $('.user-list-container, .role-list-container, .course-list-container').hide();
            }
        });
    });
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        flatpickr("#task_date", {
            dateFormat: "d/m/Y", // Sets the format to dd/mm/yyyy
            defaultDate: "{{ old('task_date') }}", // Keeps the old value if present
        });
    });
</script>

@include('partials.footer')
@endsection
