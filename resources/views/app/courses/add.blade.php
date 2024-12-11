@extends('layouts.app')

@section('pageTitle', 'Add Course')

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
                            <li class="breadcrumb-item"><a href="#">Courses</a></li>
                            <li class="breadcrumb-item" aria-current="page">Add</li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Course Add</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3"><label class="form-label">Course Name</label> <input type="text" class="form-control" placeholder="Enter first name"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3"><label class="form-label">Course Code</label> <input type="text" class="form-control" placeholder="Enter Course Code"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3"><label class="form-label">Start Form</label> <input type="date" class="form-control"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3"><label class="form-label">Course Duration</label> <input type="text" class="form-control" placeholder="Enter Course Duration"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3"><label class="form-label">Course Price</label> <input type="number" class="form-control" placeholder="Enter course price"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3"><label class="form-label">Teacher Name</label> <input type="text" class="form-control" placeholder="Enter Teacher name"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3"><label class="form-label">Maximum Students</label> <input type="number" class="form-control" placeholder="Enter maximum students"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Status</label> 
                                        <select class="form-select">
                                            <option>Deactive</option>
                                            <option>Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3"><label class="form-label">Course Details</label> <textarea class="form-control" rows="3" placeholder="Enter course details"></textarea></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <form action="../assets/json/file-upload.php" class="dropzone">
                                            <div class="fallback"><input name="file" type="file" multiple="multiple"></div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-12 text-end"><button class="btn btn-primary">Create Course</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
@endsection