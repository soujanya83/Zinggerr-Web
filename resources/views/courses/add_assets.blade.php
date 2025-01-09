<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.2/resumable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs/resumable.js"></script>


@extends('layouts.app')

@section('pageTitle', 'Add Course')

@section('content')
@include('partials.sidebar')
@include('partials.headerdashboard')
<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.0/resumable.min.js"></script>
<style>
    #uploadProgress {
        width: 100%;
        height: 20px;
        background-color: #e0e0e0;
        margin: 10px 0;
        position: relative;
    }

    #uploadProgress div {
        width: 0%;
        height: 100%;
        background-color: #4caf50;
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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Courses</a></li>
                            <li class="breadcrumb-item" aria-current="page">Add Assets</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <div class="row">

            <div class="card">


                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <h5>Add Assets</h5>

                        <div class="row">
                            <div class="card-body">

                                <form id="createCourseForm" method="POST" action="{{ route('assets.submit') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $id }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="blog_name">Blog Name:</label>
                                                <input type="text" id="blog_name" name="blog_name" class="form-control"
                                                    placeholder="Enter Blog Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="course_assets_video">Assets Video:</label>
                                                <input type="file" id="course_assets_video" name="course_assets_video"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div id="uploadArea" class="upload-area">
                                            <button id="uploadButton" class="btn btn-primary">Upload Video</button>
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

<script>

document.addEventListener('DOMContentLoaded', () => {
    const uploadArea = document.getElementById('uploadArea');
    const resumable = new Resumable({
        target: '/upload-chunk', // Laravel route to handle chunk upload
        query: { _token: document.querySelector('meta[name="csrf-token"]').content },
        chunkSize: 2 * 1024 * 1024, // 2 MB per chunk
        simultaneousUploads: 3,    // Number of parallel uploads
        testChunks: true,
        throttleProgressCallbacks: 1,
    });

    resumable.assignBrowse(uploadArea);

    resumable.on('fileAdded', function () {
        resumable.upload();
    });

    resumable.on('fileProgress', function (file) {
        console.log(`Progress: ${Math.floor(file.progress() * 100)}%`);
    });

    resumable.on('fileSuccess', function (file, response) {
        console.log('Upload complete:', response);
    });

    resumable.on('fileError', function (file, error) {
        console.error('Error uploading file:', error);
    });
});

</script>

@include('partials.footer')
@endsection
