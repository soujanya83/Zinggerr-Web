@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
@section('pageTitle', 'Courses')

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
                            <h5 class="m-b-10">Courses View</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Courses List</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Courses List</h5>

                            <form method="get" action="{{ route('courses') }}" class="">
                                @csrf
                                <div>
                                    <input type="text" id="name" class="form-control" name="name"
                                        placeholder="Course Name" value="{{ request('name') }}"
                                        style="margin-top: -10px;width: 216px;margin-left: -185px;" />
                                    <select id="category" class="form-select" name="category"
                                        style="margin-top: -42px; margin-left: 47px;width: 216px;">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->name }}"
                                                {{ request('category') == $category->name ? 'selected' : '' }}>
                                                {{ $category->display_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="margin-left: 276px; margin-top: -42px;">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <span style="margin-left: 35px;">
                                        <a href="{{ route('courses') }}">Refresh</a>
                                    </span>
                                </div>
                            </form>

                            {{-- <div><a href="{{ route('addCourse') }}" class="btn btn-success">Add New Course</a>
                            </div> --}}
                        </div>
                    </div>





                    <div class="card-body">
                        <div class="row">
                            @if ($courses->count() > 0)
                            @foreach($courses as $course)
                            <div class="col-sm-6 col-lg-4 col-xxl-3">
                                <div class="card border">
                                    <div class="card-body p-2">
                                        <div class="position-relative">

                                            <div class="position-absolute top-0 p-2">
                                                @if(Auth::user()->type === 'Superadmin')

                                                <form action="{{ route('coursechangeStatus') }}" method="get"
                                                    style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $course->id }}">
                                                    <input type="hidden" name="status"
                                                        value="{{ $course->course_status == 1 ? 0 : 1 }}">
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" style="padding: 2px"
                                                            class="btn {{ $course->course_status == 1 ? 'btn-success' : 'btn-danger' }}">
                                                            {{ $course->course_status == 1 ? 'Active' : 'Inactive' }}
                                                        </button>
                                                    </div>
                                                </form>
                                                @elseif(isset($permissions) && in_array('courses_status',
                                                $permissions))
                                                <form action="{{ route('coursechangeStatus') }}" method="get"
                                                    style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $course->id }}">
                                                    <input type="hidden" name="status"
                                                        value="{{ $course->course_status == 1 ? 0 : 1 }}">
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" style="padding: 2px"
                                                            class="btn {{ $course->course_status == 1 ? 'btn-success' : 'btn-danger' }}">
                                                            {{ $course->course_status == 1 ? 'Active' : 'Inactive' }}
                                                        </button>
                                                    </div>
                                                </form>
                                                @endif
                                            </div>

                                            <div class="position-absolute end-0 top-0 p-2"
                                                style="background-color: white; border-radius: 50px;margin: 6px;">

                                                <div class="flex-shrink-0">
                                                    <div class="dropdown">
                                                        <!-- Dropdown toggle button -->
                                                        <a class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                            href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" style="color: black !important">
                                                            <i class="ti ti-dots f-20"></i>
                                                        </a>

                                                        <!-- Dropdown menu -->
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            {{-- @if(Auth::user()->type === 'Superadmin' ||
                                                            (isset($permissions) && in_array('cousers_assign',
                                                            $permissions)))
                                                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#assignUsersModal"
                                                                data-course-id="{{ $course->id }}" data-type="users">
                                                                <i class="ti ti-user-plus f-20"></i> Assign Students
                                                            </a>
                                                            @endif

                                                            <!-- Assign Teachers Option -->
                                                            @if(Auth::user()->type === 'Superadmin' ||
                                                            (isset($permissions) && in_array('cousers_assign',
                                                            $permissions)))
                                                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#assignUsersModal"
                                                                data-course-id="{{ $course->id }}" data-type="teachers">
                                                                <i class="ti ti-user-check f-20"></i> Assign Teachers
                                                            </a>
                                                            @endif --}}




                                                            @if(Auth::user()->type === 'Superadmin' ||
                                                            (isset($permissions) && in_array('courses_edit',
                                                            $permissions)))
                                                            <a href="{{ route('course_edit', $course->id) }}"
                                                                class="dropdown-item">
                                                                <i class="ti ti-edit f-20"></i> Edit
                                                            </a>
                                                            @endif

                                                            <!-- Delete option -->
                                                            @if(Auth::user()->type === 'Superadmin' ||
                                                            (isset($permissions) && in_array('cousers_delete',
                                                            $permissions)))
                                                            <a href="{{ route('course_delete', $course->id) }}"
                                                                class="dropdown-item"
                                                                onclick="return confirmDelete(this)">
                                                                <i class="ti ti-trash f-20 text-danger"></i> Delete
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>




                                            </div>


                                            <img src="{{ asset('storage/' . $course->course_image) }}"
                                                alt="Course Image" class="img-fluid w-100"
                                                style="width: 210px;height:200px">


                                        </div>
                                        <ul class="list-group list-group-flush">

                                            <li class="list-group-item px-0 py-2">
                                                <div class="d-flex align-items-center">

                                                    <div class="flex-shrink-0">
                                                        <h3 class="text-muted mb-0" style="color:black !important">{{
                                                            $course->course_full_name }}</h3>
                                                    </div>

                                                </div>
                                                <div class="d-flex align-items-center mt-2">
                                                    <div class="flex-grow-1 me-2">
                                                        <p class="mb-0">{{ $course->course_category }}</p>
                                                    </div>


                                                </div>

                                                <div class="d-flex align-items-center mt-2">

                                                    <!-- Star Rating Value -->
                                                    <div class="flex-shrink-0 me-2">
                                                        <strong class="text-muted">{{
                                                            number_format($course->rating, 1) }}</strong>
                                                    </div>

                                                    <!-- Star Icons -->
                                                    <div class="flex-grow-1">
                                                        @php
                                                        $rating = round($course->rating * 2) / 2;

                                                        $fullStars = floor($rating); // Full stars count
                                                        $halfStar = ($rating - $fullStars == 0.5) ? 1 : 0; // Half
                                                        // star logic
                                                        $emptyStars = 5 - $fullStars - $halfStar; // Empty stars
                                                        // count
                                                        @endphp

                                                        <!-- Full Stars -->
                                                        @for ($i = 0; $i < $fullStars; $i++) <i
                                                            class="fas fa-star text-warning"></i>
                                                            @endfor

                                                            <!-- Half Star -->
                                                            @if ($halfStar)
                                                            <i class="fas fa-star-half-alt text-warning"></i>
                                                            @endif

                                                            <!-- Empty Stars -->
                                                            @for ($i = 0; $i < $emptyStars; $i++) <i
                                                                class="far fa-star text-warning"></i>
                                                                @endfor
                                                                <small class="text-muted">({{
                                                                    number_format($course->total_users) }})</small>
                                                    </div>
                                                    <a href="{{ route('course_details', $course->id) }}"
                                                        class="btn btn-sm btn-outline-primary mb-2 position-absolute end-0">Read
                                                        More</a>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="modal fade" id="assignUsersModal" tabindex="-1"
                                            aria-labelledby="assignUsersModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="assignUsersModalLabel">Assign
                                                            Users
                                                            to Course</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>


                                                    <form id="assignUsersForm" action="{{ route('course.assign') }}"
                                                        method="post">
                                                        @csrf
                                                        <div class="modal-body" style="margin-top: -20px;">

                                                            <!-- Hidden Input for Course ID -->
                                                            <input type="hidden" name="course_id" id="course_id"
                                                                value="">

                                                            <!-- Search Box -->
                                                            <input type="text" id="userSearch" class="form-control mb-3"
                                                                placeholder="Search users...">

                                                            <!-- Users List -->
                                                            <div id="userList"
                                                                style="max-height: 300px; overflow-y: auto;">
                                                                <p>Loading users...</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            {{-- <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button> --}}


                                                            <button type="submit" class="btn btn-primary">Couser Assign
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                const userList = document.getElementById('userList');
                                                const userSearch = document.getElementById('userSearch');
                                                const assignUsersForm = document.getElementById('assignUsersForm');

                                                $('#assignUsersModal').on('show.bs.modal', function (event) {
                                                    const button = event.relatedTarget; // Button that triggered the modal
                                                    const courseId = button.getAttribute('data-course-id'); // Extract course ID
                                                    const type = button.getAttribute('data-type'); // Determine if assigning users or teachers
                                                    document.getElementById('course_id').value = courseId; // Set course ID in form

                                                    userList.innerHTML = 'Loading...';

                                                    // Fetch users or teachers based on type
                                                    fetch(`/api/${type}`)
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            const checkboxes = data.map(item => `
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="${type}-${item.id}" name="${type}[]" value="${item.id}">
                                                                    <label class="form-check-label" for="${type}-${item.id}">${item.name}</label>
                                                                    <span class="badge rounded-pill f-14 ${
                                                                        item.type === 'Superadmin' ? 'bg-light-success' :
                                                                        item.type === 'Admin' ? 'bg-light-danger' :
                                                                        item.type === 'Student' ? 'bg-light-primary' :
                                                                        item.type === 'Staff' ? 'bg-light-warning' :
                                                                        item.type === 'Teacher' ? 'bg-light-info' : 'bg-light-secondary'
                                                                    }">${item.type}</span>
                                                                </div>
                                                            `).join('');
                                                            userList.innerHTML = checkboxes;
                                                        })
                                                        .catch(() => {
                                                            userList.innerHTML = '<p>Error loading data</p>';
                                                        });
                                                });

                                                // Search functionality
                                                userSearch.addEventListener('input', function () {
                                                    const searchTerm = this.value.toLowerCase();
                                                    document.querySelectorAll('#userList .form-check').forEach(item => {
                                                        const label = item.querySelector('label').textContent.toLowerCase();
                                                        item.style.display = label.includes(searchTerm) ? 'block' : 'none';
                                                    });
                                                });
                                            });
                                        </script>





                                        {{-- //////////////////////////////////////////////////////// --}}









                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else

                            <div>
                                No Data Found!
                            </div>
                            @endif

                        </div>
                        <div class="datatable-bottom">
                            <div class="datatable-info">
                                Showing {{ $courses->firstItem() }} to {{ $courses->lastItem() }} of {{
                                $courses->total() }} entries
                            </div>

                            <nav class="datatable-pagination">
                                <ul class="datatable-pagination-list">
                                    {{-- Previous Page Link --}}
                                    @if ($courses->onFirstPage())
                                    <li class="datatable-pagination-list-item datatable-disabled">
                                        <button disabled aria-label="Previous Page">‹</button>
                                    </li>
                                    @else
                                    <li class="datatable-pagination-list-item">
                                        <a href="{{ $courses->previousPageUrl() }}"
                                            class="datatable-pagination-list-item-link" aria-label="Previous Page">‹</a>
                                    </li>
                                    @endif

                                    {{-- Pagination Links --}}
                                    @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                                    <li
                                        class="datatable-pagination-list-item {{ $courses->currentPage() == $page ? 'datatable-active' : '' }}">
                                        <a href="{{ $url }}" class="datatable-pagination-list-item-link"
                                            aria-label="Page {{ $page }}">{{ $page }}</a>
                                    </li>
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($courses->hasMorePages())
                                    <li class="datatable-pagination-list-item">
                                        <a href="{{ $courses->nextPageUrl() }}"
                                            class="datatable-pagination-list-item-link" aria-label="Next Page">›</a>
                                    </li>
                                    @else
                                    <li class="datatable-pagination-list-item datatable-disabled">
                                        <button disabled aria-label="Next Page">›</button>
                                    </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(element) {
    event.preventDefault(); // Prevent the default link behavior
    const url = element.href;

    Swal.fire({
        title: 'Are you sure? For Delete',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
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
