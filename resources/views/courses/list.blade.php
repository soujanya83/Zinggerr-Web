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
                            <li class="breadcrumb-item"><a href="/app">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Courses List</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Course</h5>

                            <form method="get" action="{{ route('courses') }}" class="">
                                @csrf
                                <div>
                                    <input type="text" id="name" class="form-control" name="name"
                                        placeholder="Course Name" value="{{ request('name') }}"
                                        style="margin-top: -10px;width: 216px;margin-left: -185px;" />
                                    <input type="text" id="teacher_name" class="form-control" name="teacher_name"
                                        placeholder="Course Category" value="{{ request('teacher_name') }}"
                                        style="margin-top: -42px; margin-left: 47px;width: 216px;" />
                                </div>
                                <div style="margin-left: 276px;    margin-top: -42px;">
                                    <button type="submit" class="btn btn-primary">Filter</button>

                                    <span style="    margin-left: 35px;"> <a
                                            href="{{ route('courses') }}">Refresh</a></span>
                                </div>

                            </form>

                            <div><a href="{{ route('addCourse') }}" class="btn btn-success">Add New Course</a></div>
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
                                            <img src="{{ asset('storage/courses/' . $course->course_image) }}"
                                                alt="Course Image" class="img-fluid w-100"
                                                style="width: 210px;height:200px">
                                            {{-- <div class="position-absolute top-0 end-0 p-2">
                                                <span class="badge text-bg-light text-uppercase">
                                                    @if($course->status == '1') Active @else Inactive @endif
                                                </span>
                                            </div> --}}

                                            {{-- <div class="position-absolute top-0 end-0 p-2">
                                                <button
                                                    class="btn btn-sm {{ $course->status == '1' ? 'btn-success' : 'btn-danger' }}"
                                                    onclick="toggleStatus({{ $course->id }})">
                                                    {{ $course->status == '1' ? 'Active' : 'Inactive' }}
                                                </button>
                                            </div> --}}



                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0 py-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 me-2">
                                                        <h6 class="mb-1">{{ $course->course_name }}</h6>
                                                        <p class="mb-0 f-w-600"><i class="fas fa-star text-warning"></i>
                                                            4.8</p>
                                                    </div>

                                                    {{-- @can('role',Auth::user()) --}}



                                                    <div class="flex-shrink-0">
                                                        @if(Auth::user()->type === 'Superadmin')
                                                        <a href="{{ route('course_edit', $course->id) }}"
                                                            class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                            data-id="{{ $course->id }}">
                                                            <i class="ti ti-edit f-20"></i>
                                                        </a>
                                                        @elseif(isset($permissions) && in_array('courses_edit',
                                                        $permissions))
                                                        <a href="{{ route('course_edit', $course->id) }}"
                                                            class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                            data-id="{{ $course->id }}">
                                                            <i class="ti ti-edit f-20"></i>
                                                        </a>
                                                        @endif

                                                        @if(Auth::user()->type === 'Superadmin')
                                                        {{-- Super admin sees everything --}}
                                                        <a href="{{ route('course_delete', $course->id) }}"
                                                            class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                            data-id="{{ $course->id }}"
                                                            onclick="return confirmDelete(this)">
                                                            <i class="ti ti-trash f-20" style="color: red;"></i>
                                                        </a>
                                                        @elseif(isset($permissions) && in_array('cousers_delete',
                                                        $permissions))
                                                        {{-- Other roles see the button only if they have the "delete"
                                                        permission --}}
                                                        <a href="{{ route('course_delete', $course->id) }}"
                                                            class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                            data-id="{{ $course->id }}"
                                                            onclick="return confirmDelete(this)">
                                                            <i class="ti ti-trash f-20" style="color: red;"></i>
                                                        </a>
                                                        @endif


                                                        {{-- @endcan --}}


                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0 py-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 me-2">
                                                        <p class="mb-0">Course:</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <p class="text-muted mb-0">{{ $course->course_full_name }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0 py-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 me-2">
                                                        <p class="mb-0">Time</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <p class="text-muted mb-0">{{ $course->course_start_date }} <strong>To</strong> {{ $course->course_end_date }} </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0 py-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 me-2">
                                                        <p class="mb-0">Category</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <p class="text-muted mb-0">{{ $course->course_category }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        <a href="{{ route('course_details', $course->id) }}"
                                            class="btn btn-sm btn-outline-primary mb-2">Read More</a>

                                        @if(Auth::user()->type === 'Superadmin')

                                        <form action="{{ route('coursechangeStatus') }}" method="get"
                                            style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $course->id }}">
                                            <input type="hidden" name="status"
                                                value="{{ $course->course_status == 1 ? 0 : 1 }}">
                                            <div class="d-flex justify-content-end" style="margin-top: -42px;">
                                                <button type="submit" style="padding: 5px"
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
                                            <div class="d-flex justify-content-end" style="margin-top: -42px;">
                                                <button type="submit" style="padding: 5px"
                                                    class="btn {{ $course->course_status == 1 ? 'btn-success' : 'btn-danger' }}">
                                                    {{ $course->course_status == 1 ? 'Active' : 'Inactive' }}
                                                </button>
                                            </div>
                                        </form>
                                        @endif


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
