<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.2/resumable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs/resumable.js"></script>

<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>



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
</style>
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Course Assets</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Courses</a></li>
                            <li class="breadcrumb-item" aria-current="page">Create Assets</li>
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
                                    <input type="hidden" name="course_id" value="{{$courseId }}">
                                    <input type="hidden" name="chapter_id" value="{{$chapterId }}">
                                    <div class="row align-items-center">
                                        <!-- Assets Type -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="assetstype" class="form-label">Assets Type:</label>
                                                <select name="assetstype" id="blog" class="form-select" required>
                                                    <option value="">Select</option>
                                                    <option value="blog">Blog</option>
                                                    <option value="url">Url</option>
                                                    <option value="videos">Videos</option>
                                                    <option value="youtube">Youtube Videos Link</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Topic Name -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="topicname" class="form-label">Topic Name:</label>
                                                <input type="text" id="topicname" name="topicname" class="form-control"
                                                    required placeholder="Enter Topic Name ">
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status:</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            value="1" id="status" checked>
                                                        <label class="form-check-label" for="statusYes">Yes</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            value="0" id="status">
                                                        <label class="form-check-label" for="statusNo">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="blogContent" class="asset-content" style="display: none;">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="assets_discription">Blog Description:</label>
                                                <textarea id="assets_discription" name="assets_discription"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="urlContent" class="asset-content" style="display: none;">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="videourl">Video Url:</label>
                                                <input type="text" id="videourl" name="videourl" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="videosContent" class="asset-content" style="display: none;">
                                        <label for="course_assets_video">Assets Video:</label>
                                        <div class="form-floating mb-3">

                                            <div class="d-flex align-items-center  rounded">

                                                <div class="d-flex align-items-center">

                                                    <label for="fileUpload" class="file-upload-label"
                                                        style="width:1270px">
                                                        <div class="upload-icon mb-3">
                                                            <i class="fas fa-cloud-upload-alt fa-3x text-primary"></i>
                                                        </div>
                                                        <span class="text-muted" style="    margin-top: -19px;">Click to
                                                            upload
                                                            file here</span>
                                                        <span id="fileName" class="ms-2"></span>
                                                        <input type="file" id="fileUpload" name="course_assets_video"
                                                            class="file-upload-input" onchange="showFileName(this)">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="progressWrapper" style="display: none; margin-top: 20px;">
                                            <div class="progress">
                                                <div id="progressBar"
                                                    class="progress-bar progress-bar-striped progress-bar-animated"
                                                    role="progressbar" style="width: 0%;" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <p id="progressText" class="mt-2 text-center">0%</p>
                                        </div>
                                    </div>

                                    <div id="youtubeContent" class="asset-content" style="display: none;">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="youtubelink">Youtube Video Link:</label>
                                                <input type="text" id="youtubelink" name="youtubelink"
                                                    class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" id="uploadButton" class="btn btn-shadow btn-primary"
                                        style="margin-left: 87%;">Submit</button>
                                </form>
                            </div>




                            <hr>
                            <h4>Assets List</h4>
                            <div class="accordion-body">

                                @if($assetsdata->count() > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Assets Topic</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($assetsdata as $key => $asset)
                                        <tr>
                                            <td>{{ $key + 1 }} .</td>
                                            <td>{{ $asset->topic_name }}</td>
                                            <td>
                                                <form action="{{ route('assetsStatus') }}" method="post"
                                                    style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="asset_id" value="{{ $asset->id }}">
                                                    <input type="hidden" name="status"
                                                        value="{{ $asset->status == 1 ? 0 : 1 }}">

                                                    <button type="submit"
                                                        class="btn {{ $asset->status == 1 ? 'btn-success' : 'btn-danger' }}"
                                                        style="padding:4px">
                                                        {{ $asset->status == 1 ? 'Active' : 'Inactive' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>

                                                <form action="{{ route('edit_assets')}}" method="post"
                                                    style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="assets_id" value="{{ $asset->id }}">
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="ti ti-edit" style="color: #f0f8ff"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('assets_delete', $asset->id) }}"
                                                    class="btn btn-sm btn-danger" onclick="return confirmDelete(this)">
                                                    <i style="color: #f0f8ff" class="ti ti-trash"></i></a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <p>No assets found for this chapter.</p>
                                @endif
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Show corresponding div based on selected option
    document.getElementById('blog').addEventListener('change', function () {
        var value = this.value;
        // Hide all contents first
        document.querySelectorAll('.asset-content').forEach(function (div) {
            div.style.display = 'none';
        });
        // Show selected content
        if (value === 'blog') {
            document.getElementById('blogContent').style.display = 'block';
        } else if (value === 'url') {
            document.getElementById('urlContent').style.display = 'block';
        } else if (value === 'videos') {
            document.getElementById('videosContent').style.display = 'block';
        } else if (value === 'youtube') {
            document.getElementById('youtubeContent').style.display = 'block';
        }
    });
</script>

<script>
    function showFileName(input) {
    var fileName = input.files[0].name;
    document.getElementById('fileName').textContent = fileName;
}
</script>


<script>
    // Initialize Summernote with a custom toolbar (removing image and video options)
    $(document).ready(function() {
        $('#assets_discription').summernote({
            height: 200, // You can adjust the height as needed
            placeholder: 'Enter description here...',
            tabsize: 2,
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('uploadButton').addEventListener('click', function (e) {
        e.preventDefault();

        const uploadButton = document.getElementById('uploadButton');
        const fileInput = document.getElementById('fileUpload');
        const file = fileInput?.files[0]; // Allow empty file

        const status = document.querySelector('input[name="status"]:checked')?.value;

        const assetstype = document.getElementById('blog')?.value; // Updated ID
        const topicName = document.getElementById('topicname')?.value;
        const youtubelink = document.getElementById('youtubelink')?.value || ''; // Accept empty value
        const videourl = document.getElementById('videourl')?.value || ''; // Accept empty value
        const assetsDescription = document.getElementById('assets_discription')?.value || ''; // Optional description
        const courseId = document.querySelector('input[name="course_id"]')?.value;
        const chapterId = document.querySelector('input[name="chapter_id"]')?.value;

        // Validate required fields
        if (!courseId || !chapterId || !assetstype || !topicName) {
            Swal.fire('Error', 'Please provide all required fields.', 'error');
            return;
        }

        // Disable the button to prevent multiple uploads
        uploadButton.disabled = true;
        uploadButton.textContent = 'Submit';

        const chunkSize = 2 * 1024 * 1024; // 2 MB per chunk
        const totalChunks = file ? Math.ceil(file.size / chunkSize) : 0;
        let currentChunk = 0;

        // Show progress bar if a file is being uploaded
        const progressWrapper = document.getElementById('progressWrapper');
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');

        if (file && assetstype === 'videos') {
            progressWrapper.style.display = 'block';
        }

        function uploadChunk() {
            const start = currentChunk * chunkSize;
            const end = Math.min(start + chunkSize, file.size);
            const chunk = file.slice(start, end);

            const formData = new FormData();
            if (file && assetstype === 'videos') {
                formData.append('file', chunk);
                formData.append('fileName', file.name);
                formData.append('chunkNumber', currentChunk + 1);
                formData.append('totalChunks', totalChunks);
            }

            // Add additional fields
            formData.append('course_id', courseId);
            formData.append('assetstype', assetstype);
            formData.append('topicName', topicName);
            formData.append('chapter_id', chapterId);
            formData.append('status', status);
            formData.append('videourl', videourl);
            formData.append('youtubelink', youtubelink);
            formData.append('assets_discription', assetsDescription);

            // Include CSRF token
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('assets.submit') }}', true);

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
                            timer: 2000,
                            willClose: () => {
                                location.reload();
                            },
                        });
                        uploadButton.disabled = false;
                        uploadButton.textContent = 'Submit';
                    }
                } else {
                    Swal.fire('Error', 'Error uploading chunk.', 'error');
                    console.error(xhr.responseText);
                    uploadButton.disabled = false;
                    uploadButton.textContent = 'Submit';
                }
            };

            xhr.onerror = function () {
                Swal.fire('Error', 'Error during upload.', 'error');
                uploadButton.disabled = false;
                uploadButton.textContent = 'Submit';
            };

            xhr.send(formData);
        }

        if (file && assetstype === 'videos') {
            uploadChunk();
        } else {
            // Submit form without file upload
            const formData = new FormData();
            formData.append('course_id', courseId);
            formData.append('chapter_id', chapterId);
            formData.append('assetstype', assetstype);
            formData.append('topicName', topicName);
            formData.append('youtubelink', youtubelink);
            formData.append('status', status);
            formData.append('videourl', videourl);
            formData.append('assets_discription', assetsDescription);
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
                            timer: 2000,
                            willClose: () => {
                                location.reload();
                            },
                        });
                    } else {
                        Swal.fire('Error', 'Error submitting data.', 'error');
                    }
                    uploadButton.disabled = false;
                    uploadButton.textContent = 'Submit';
                })
                .catch((error) => {
                    Swal.fire('Error', 'Error during submission.', 'error');
                    uploadButton.disabled = false;
                    uploadButton.textContent = 'Submit';
                    console.error(error);
                });
        }
    });
});

</script>




@include('partials.footer')
@endsection
