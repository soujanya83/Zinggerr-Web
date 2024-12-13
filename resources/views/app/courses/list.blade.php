@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@section('pageTitle', 'Courses')

@section('content')
@include('partials.sidebar')
@include('partials.header')


<style>
    .pagination-info {
        font-size: 14px;
        margin-bottom: 15px;
    }

    .pagination .page-link {
        font-size: 14px;
        padding: 8px 12px;
    }
</style>
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
                                        placeholder="Teacher Name" value="{{ request('teacher_name') }}"
                                        style="margin-top: -42px; margin-left: 47px;width: 216px;" />
                                </div>
                                <div style="margin-left: 276px;    margin-top: -42px;">
                                    <button type="submit" class="btn btn-primary">Filter</button>

                                    <span style="    margin-left: 35px;"> <a
                                            href="{{ route('courses') }}">Refresh</a></span>
                                </div>

                            </form>

                            <div><a href="{{ route('addCourse') }}" class="btn btn-primary">Add New Course</a></div>
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
                                            <img src="{{ asset('storage/' . $course->course_image) }}"
                                                alt="Course Image" class="img-fluid w-100">
                                            <div class="position-absolute top-0 end-0 p-2">
                                                <span class="badge text-bg-light text-uppercase">
                                                    @if($course->status == '1') Active @else Inactive @endif
                                                </span>
                                            </div>
                                        </div>
                                        <ul class="list-group list-group-flush my-2">
                                            <li class="list-group-item px-0 py-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 me-2">
                                                        <h6 class="mb-1">{{ $course->course_name }}</h6>
                                                        <p class="mb-0 f-w-600"><i class="fas fa-star text-warning"></i>
                                                            4.8</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <a href="#"
                                                            class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                            data-id="{{ $course->id }}">
                                                            <i class="ti ti-edit f-20"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0 py-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 me-2">
                                                        <p class="mb-0">Duration</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <p class="text-muted mb-0">{{ $course->duration }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0 py-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 me-2">
                                                        <p class="mb-0">Teacher</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <p class="text-muted mb-0">{{ $course->teacher_name }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0 py-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 me-2">
                                                        <p class="mb-0">Students</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <p class="text-muted mb-0">{{ $course->max_students }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <a href="{{ route('course_details', $course->id) }}"
                                            class="btn btn-sm btn-outline-primary mb-2">Read More</a>

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


                    </div>

                </div>

            </div>
        </div>
    </div>
    @if ($courses->hasPages())
    <div class="pagination-info text-center mb-3">
        <p>
            Showing {{ $courses->firstItem() }} to {{ $courses->lastItem() }}
            of {{ $courses->total() }} results (Page {{ $courses->currentPage() }} of {{ $courses->lastPage() }})
        </p>
    </div>

    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($courses->onFirstPage())
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">Previous</span>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $courses->previousPageUrl() }}" rel="prev">Previous</a>
            </li>
            @endif

            {{-- Next Page Link --}}
            @if ($courses->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $courses->nextPageUrl() }}" rel="next">Next</a>
            </li>
            @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">Next</span>
            </li>
            @endif
        </ul>
    </nav>
    @endif
</div>
@include('partials.footer')
@endsection
