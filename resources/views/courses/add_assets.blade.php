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
                            <li class="breadcrumb-item" aria-current="page">Add Assets</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="card">


                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <h5>Add Assets</h5>

                        <div class="row">
                            <div class="card-body">
                                <form id="createCourseForm" method="POST" action="{{ route('assets.submit') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $id }}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Blog Name</label>
                                                <input type="text" name="blog_name" class="form-control"
                                                    placeholder="Enter Blog Name" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Assets Video</label>
                                                <input type="file" name="course_assets_video" class="form-control"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-end">
                                            <button type="submit" class="btn btn-primary">Create Assets</button>
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

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
{{-- <script>
    CKEDITOR.replace('courseDescription', {
        filebrowserUploadUrl: "{{ route('assets.submit', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });
</script> --}}




@include('partials.footer')
@endsection
