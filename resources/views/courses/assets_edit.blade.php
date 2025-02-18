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
                            <h5 class="m-b-10">Assets Edit</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Course</a></li>
                            <li class="breadcrumb-item" aria-current="page">Assets Edit</li>
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
                        <h5>Update Chapters Assets</h5>

                        <div class="row">
                            <div class="card-body">

                                {{--
                                ..............................................................................................--}}

                                <form id="createCourseForm" method="POST" action="{{ route('assets.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="assets_id" value="{{ $data->id }}">
                                    <input type="hidden" name="course_id" value="{{$data->course_id }}">
                                    <input type="hidden" name="chapter_id" value="{{$data->chapter_id }}">
                                    <div class="row align-items-center">
                                        <!-- Assets Type -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="assetstype" class="form-label">Assets Type:</label>
                                                <select name="assetstype" id="assetstype" class="form-select" required
                                                    onchange="toggleAssetContent()">
                                                    <option value="">Select</option>
                                                    <option value="blog" {{ old('assetstype', $data->assets_type) ==
                                                        'blog' ? 'selected' : '' }}>Blog</option>
                                                    <option value="url" {{ old('assetstype', $data->assets_type) ==
                                                        'url' ? 'selected' : '' }}>Url</option>
                                                    <option value="videos" {{ old('assetstype', $data->assets_type) ==
                                                        'videos' ? 'selected' : '' }}>Videos</option>
                                                    <option value="youtube" {{ old('assetstype', $data->assets_type) ==
                                                        'youtube' ? 'selected' : '' }}>Youtube Videos Link</option>
                                                </select>
                                            </div>
                                        </div>


                                        <!-- Topic Name -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="topicname" class="form-label">Topic Name:</label>
                                                <input type="text" id="topicname" name="topicname" class="form-control"
                                                    required placeholder="Enter Topic Name "
                                                    value="{{ old('topicname', $data->topic_name)}}">
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status:</label>
                                                <div class="d-flex align-items-center">
                                                    <!-- Yes Option -->
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="radio" name="status" value="1" id="statusYes"
                                                            {{ old('status', $data->status) == '1' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="statusYes">Yes</label>
                                                    </div>
                                                    <!-- No Option -->
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status" value="0" id="statusNo"
                                                            {{ old('status', $data->status) == '0' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="statusNo">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>



                                    <!-- Blog Content -->
                                    <div id="blogContent" class="asset-content" style="display: none;">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="assets_discription">Blog Description:</label>
                                                <textarea id="assets_discription" name="assets_discription"
                                                    class="form-control">{{ old('assets_discription', $data->blog_description) }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- URL Content -->
                                    <div id="urlContent" class="asset-content" style="display: none;">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="videourl">Video Url:</label>
                                                <input type="text" id="videourl" name="videourl" class="form-control"
                                                    value="{{ old('videourl', $data->video_url) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Videos Content -->
                                    <div id="videosContent" class="asset-content" style="display: none;">
                                        <label for="course_assets_video">Assets Video:</label>
                                        <div class="form-floating mb-3">

                                            <div class="d-flex align-items-center rounded">
                                                <label for="fileUpload" class="file-upload-label" style="width: 100%; height:0%">
                                                    <div class="upload-icon mb-3 text-center">
                                                        <i class="fas fa-cloud-upload-alt fa-3x text-primary"></i>
                                                    </div>
                                                    <span class="text-muted d-block text-center">Click to upload a
                                                        file</span>
                                                    <span id="fileName" class="ms-2 text-center d-block"></span>
                                                    <input type="file" id="fileUpload" name="course_assets_video"
                                                        class="file-upload-input" onchange="showFileName(this)">
                                                </label>
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


                                            <!-- Show the current video file if it exists -->
                                            @if (!empty($data->assets_video))
                                            <div class="mt-3">
                                                <label class="form-label">Current Video:</label>

                                                <p class="mt-2"><strong>File Name:</strong> {{ $data->assets_video }}
                                                </p>
                                            </div>
                                            @endif
                                        </div>





                                    </div>


                                    <!-- Youtube Content -->
                                    <div id="youtubeContent" class="asset-content" style="display: none;">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="youtubelink">Youtube Video Link:</label>
                                                <input type="text" id="youtubelink" name="youtubelink"
                                                    class="form-control"
                                                    value="{{ old('youtubelink', $data->youtube_links) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" id="uploadButton" class="btn  btn-shadow btn-primary"
                                        style="margin-left: 87%;">Update</button>
                                </form>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showFileName(input) {
        const fileName = input.files[0]?.name || "No file selected";
        document.getElementById('fileName').textContent = fileName;
    }
</script>

<script>
    // Show/hide content based on the selected asset type
    function toggleAssetContent() {
        const assetType = document.getElementById('assetstype').value;
        const contents = document.querySelectorAll('.asset-content');

        contents.forEach(content => content.style.display = 'none');

        if (assetType === 'blog') {
            document.getElementById('blogContent').style.display = 'block';
        } else if (assetType === 'url') {
            document.getElementById('urlContent').style.display = 'block';
        } else if (assetType === 'videos') {
            document.getElementById('videosContent').style.display = 'block';
        } else if (assetType === 'youtube') {
            document.getElementById('youtubeContent').style.display = 'block';
        }
    }

    // Trigger toggle on page load for editing
    document.addEventListener('DOMContentLoaded', () => {
        toggleAssetContent();
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
    document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('uploadButton').addEventListener('click', function (e) {
        e.preventDefault();

        const uploadButton = document.getElementById('uploadButton');
        const fileInput = document.getElementById('fileUpload');
        const file = fileInput?.files[0]; // Allow empty file

        const status = document.querySelector('input[name="status"]:checked')?.value;
        const assetstype = document.getElementById('assetstype')?.value; // Updated ID
        const topicName = document.getElementById('topicname')?.value;
        const youtubelink = document.getElementById('youtubelink')?.value || ''; // Accept empty value
        const videourl = document.getElementById('videourl')?.value || ''; // Accept empty value
        const assetsDescription = document.getElementById('assets_discription')?.value || ''; // Optional description
        const courseId = document.querySelector('input[name="course_id"]')?.value;
        const chapterId = document.querySelector('input[name="chapter_id"]')?.value;
        const assetsId = document.querySelector('input[name="assets_id"]')?.value;

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
            formData.append('assets_id', assetsId);
            formData.append('status', status);
            formData.append('videourl', videourl);
            formData.append('youtubelink', youtubelink);
            formData.append('assets_discription', assetsDescription);

            // Include CSRF token
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('assets.update') }}', true);

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
                            text: 'Your data has been Updated successfully!',
                            showConfirmButton: false,
                            timer: 2000,
                            willClose: () => {
                                // location.reload();
                                // window.location.href = '/cousers/chapter-assets';
                                window.history.back();

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
            formData.append('assets_id', assetsId);
            formData.append('chapter_id', chapterId);
            formData.append('assetstype', assetstype);
            formData.append('topicName', topicName);
            formData.append('youtubelink', youtubelink);
            formData.append('status', status);
            formData.append('videourl', videourl);
            formData.append('assets_discription', assetsDescription);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            fetch('{{ route('assets.update') }}', {
                method: 'POST',
                body: formData,
            })
                .then((response) => {
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Update Complete',
                            text: 'Your data has been submitted successfully!',
                            showConfirmButton: false,
                            timer: 2000,
                            willClose: () => {
                                // location.reload();
                                // window.location.href = '/cousers/chapter-assets';
                                window.history.back();
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
