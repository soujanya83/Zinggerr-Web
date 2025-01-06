@extends('layouts.app')
@section('pageTitle', 'Courses')
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
                            <li class="breadcrumb-item" aria-current="page">Courses Details</li>
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



                            <div class="col-sm-6 col-lg-12 col-xxl-12">
                                <div class="card border">
                                    <div class="card-body d-flex align-items-start p-6">
                                        <!-- Image Section -->
                                        <div style="width: 30%; margin-right: 20px;">
                                            <img src="{{ asset('storage/courses/' . $course->course_image) }}"
                                                alt="Course Image" class="img-fluid" style="width: 330px;height:230px">
                                            {{-- <div class="position-absolute top-0 end-0 p-2"> --}}
                                                <span class="badge text-bg-light text-uppercase">
                                                    Status: @if($course->course_status == '1') <span
                                                        style="color: green">Active</span> @else <span
                                                        style="color: red">Inactive</span> @endif
                                                </span>
                                                {{--
                                            </div> --}}
                                        </div>


                                        <div style="width: 50%;">

                                            <ul class="list-group list-group-flush mb-3">
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span class="fw-bold">Course Name:</span>
                                                        <span class="text-muted">{{ $course->course_full_name }}</span>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span class="fw-bold">Couser Short Name:</span>
                                                        <span class="text-muted">{{ $course->course_short_name }}</span>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span class="fw-bold">Course Start Date:</span>
                                                        <span class="text-muted">{{ $course->course_start_date }}</span>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span class="fw-bold">Course End Date:</span>
                                                        <span class="text-muted">{{ $course->course_end_date }}</span>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span class="fw-bold">Course Category:</span>
                                                        <span class="text-muted">{{ $course->course_category }}</span>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span class="fw-bold">Course Section:</span>
                                                        <span class="text-muted">{{ $course->course_sections }}</span>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span class="fw-bold">File Uploads Size:</span>
                                                        <span class="text-muted">{{ $course->file_uploads_size }}</span>
                                                    </div>
                                                </li>
                                            </ul>


                                        </div>
                                    </div>

                                    <!-- Description Section (Below Image and Details) -->
                                    <div class="card-footer bg-light">
                                        <p><strong>Description:</strong> {{ $course->course_summary }}</p>
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
@include('partials.footer')
@endsection
