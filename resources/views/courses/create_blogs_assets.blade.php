<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.2/resumable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs/resumable.js"></script>


@extends('layouts.app')

@section('pageTitle', 'Add Course')

@section('content')
@include('partials.sidebar')
@include('partials.headerdashboard')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.0/resumable.min.js"></script> --}}
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
                            <li class="breadcrumb-item" aria-current="page">Create Chapters Assets</li>
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


        <div class="row col-12" style="margin-left: 0px;">

            <div class="card">


                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <h5>Create Chapters Assets</h5>

                        <div class="row">
                            <div class="card-body">

                                {{--
                                ..............................................................................................--}}

                                <form id="createCourseForm" method="POST" action="{{ route('assets.submit') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ session('course_id') }}">
                                    {{-- <input type="text" name="course_id"
                                        value="9c9e1d4a-de05-4499-9829-6d6803b1d8cb">
                                    <input type="text" name="chapter_id" value="5f97065d-354f-4d3f-aac2-ef5e9e9eb970">
                                    --}}
                                    <input type="hidden" name="chapter_id" value="{{ session('chapter_id') }}">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="blog_name">Blog Name:</label>
                                                <input type="text" id="blog_name" name="blog_name" class="form-control"
                                                    placeholder="Enter Blog Name" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="blog">No Of Blog:</label>
                                                <select name="blog" id="blog" class="form-select" required>
                                                    @foreach (range('A', 'H') as $letter)
                                                    <option value="{{ $letter }}" {{ $letter=='A' ? 'selected' : '' }}>
                                                        {{ $letter }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="blogstatus">Blog Status:</label>
                                                <select name="blogstatus" id="blogstatus" class="form-select" required>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <h5>Create Assets</h5>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="topic_name">Topic Name:</label>
                                                <input type="text" name="topic_name" id="topic_name"
                                                    class="form-control" placeholder="Enter Topic Name" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="topic_image">Upload Topic Image (Optional):</label>
                                                <input type="file" name="topic_image" id="topic_image"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="video_links">Video Links (Optional):</label>
                                                <input type="url" name="video_links" id="video_links"
                                                    class="form-control" placeholder="Enter Video Links">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="course_assets_video">Assets Video:</label>
                                                <input type="file" id="course_assets_video" name="course_assets_video"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="progressWrapper" style="display: none; margin-top: 20px;">
                                        <div class="progress">
                                            <div id="progressBar"
                                                class="progress-bar progress-bar-striped progress-bar-animated"
                                                role="progressbar" style="width: 0%;" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                        <p id="progressText" class="mt-2 text-center">0%</p>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="assets_discription">Assets Discription:</label>
                                            <textarea id="assets_discription" name="assets_discription"
                                                class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div id="uploadArea" class="upload-area">
                                        <button id="uploadButton" class="btn btn-primary">Upload Video</button>
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

<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('uploadButton').addEventListener('click', function (e) {
        e.preventDefault();

        const uploadButton = document.getElementById('uploadButton');
        const fileInput = document.getElementById('course_assets_video');
        const file = fileInput?.files[0]; // Allow empty file

        const blogName = document.getElementById('blog_name')?.value;
        const blog = document.getElementById('blog')?.value;
        const blogStatus = document.getElementById('blogstatus')?.value;
        const topicName = document.getElementById('topic_name')?.value;
        const videoLinks = document.getElementById('video_links')?.value || ''; // Accept empty value
        const topicImage = document.getElementById('topic_image')?.files[0] || null; // Allow no file
        const assetsDescription = document.getElementById('assets_discription')?.value || ''; // Optional description
        const courseId = document.querySelector('input[name="course_id"]')?.value;
        const chapterId = document.querySelector('input[name="chapter_id"]')?.value;

        // Validate required fields
        if (!blogName || !courseId || !chapterId) {
            Swal.fire('Error', 'Please provide all required fields (Blog Name, Course ID, Chapter ID).', 'error');
            return;
        }

        // Disable the button to prevent multiple uploads
        uploadButton.disabled = true;
        uploadButton.textContent = 'Uploading...';

        const chunkSize = 2 * 1024 * 1024; // 2 MB per chunk
        const totalChunks = file ? Math.ceil(file.size / chunkSize) : 0;
        let currentChunk = 0;

        // Show progress bar if a file is being uploaded
        const progressWrapper = document.getElementById('progressWrapper');
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        if (file) {
            progressWrapper.style.display = 'block';
        }

        function uploadChunk() {
            const start = currentChunk * chunkSize;
            const end = Math.min(start + chunkSize, file.size);
            const chunk = file.slice(start, end);

            const formData = new FormData();
            if (file) formData.append('file', chunk);
            if (topicImage) formData.append('topic_image', topicImage);
            formData.append('fileName', file?.name || '');
            formData.append('chunkNumber', currentChunk + 1);
            formData.append('totalChunks', totalChunks || 1);

            // Include additional fields
            formData.append('course_id', courseId);
            formData.append('topicName', topicName);
            formData.append('chapter_id', chapterId);
            formData.append('blog_name', blogName);
            formData.append('blog', blog);
            formData.append('blogstatus', blogStatus);
            formData.append('video_links', videoLinks);
            formData.append('assets_discription', assetsDescription);

            // Include CSRF token
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('assets.submit') }}', true);

            // Progress event
            xhr.upload.onprogress = function (event) {
                if (event.lengthComputable && file) {
                    const chunkProgress = (event.loaded / event.total) * 100;
                    const overallProgress = ((currentChunk + chunkProgress / 100) / totalChunks) * 100;

                    progressBar.style.width = `${overallProgress.toFixed(2)}%`;
                    progressText.textContent = `${overallProgress.toFixed(2)}%`;
                }
            };

            xhr.onload = function () {
                if (xhr.status === 200) {
                    currentChunk++;
                    if (currentChunk < totalChunks) {
                        uploadChunk();
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Upload Complete',
                            text: 'Your data has been submitted successfully!',
                            showConfirmButton: false,
                            timer: 5000,
                            willClose: () => {
                                location.reload();
                            },
                        });
                        uploadButton.disabled = false;
                        uploadButton.textContent = 'Upload Video';
                    }
                } else {
                    Swal.fire('Error', 'Error uploading chunk', 'error');
                    console.error(xhr.responseText);
                    uploadButton.disabled = false;
                    uploadButton.textContent = 'Upload Video';
                }
            };

            xhr.onerror = function () {
                Swal.fire('Error', 'Error during upload', 'error');
                uploadButton.disabled = false;
                uploadButton.textContent = 'Upload Video';
            };

            xhr.send(formData);
        }

        if (file) {
            uploadChunk();
        } else {
            // Submit form without file upload
            const formData = new FormData();
            formData.append('course_id', courseId);
            formData.append('chapter_id', chapterId);
            formData.append('blog_name', blogName);
            formData.append('topicName', topicName);
            formData.append('blog', blog);
            formData.append('blogstatus', blogStatus);
            formData.append('video_links', videoLinks);
            formData.append('assets_discription', assetsDescription);
            if (topicImage) formData.append('topic_image', topicImage);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            fetch('{{ route('assets.submit') }}', {
                method: 'POST',
                body: formData,
            })
                .then((response) => {
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Submission Complete',
                            text: 'Your data has been submitted successfully!',
                            showConfirmButton: false,
                            timer: 5000,
                            willClose: () => {
                                location.reload();
                            },
                        });
                    } else {
                        Swal.fire('Error', 'Error submitting data', 'error');
                    }
                    uploadButton.disabled = false;
                    uploadButton.textContent = 'Upload Video';
                })
                .catch((error) => {
                    Swal.fire('Error', 'Error during submission', 'error');
                    uploadButton.disabled = false;
                    uploadButton.textContent = 'Upload Video';
                    console.error(error);
                });
        }
    });
});

</script>



@include('partials.footer')
@endsection
