<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.2/resumable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs/resumable.js"></script>


@extends('layouts.app')

@section('pageTitle', 'Create Chapter')

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
                            <li class="breadcrumb-item" aria-current="page">Create Chapters</li>
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
                        <h5>Create Chapters</h5>

                        <div class="row">
                            <div class="card-body">

                                {{--
                                ..............................................................................................--}}

                                <form action="{{ route('chepter.submit')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $id }}">
                                    <div class="row">

                                        <!-- Form Fields -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="chepter_name">Chapter Name:</label>
                                                <input type="text" id="chepter_name" name="chepter_name"
                                                    class="form-control" placeholder="Enter Chepter Name" required
                                                    value="{{ old('chepter_name') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="chepter_discription">Chapter Description:</label>
                                                <textarea id="chepter_discription" name="chepter_discription"
                                                    class="form-control" placeholder="Enter Chepter Description"
                                                    required cols="3">{{ old('chepter_discription') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="no_of_chepter" class="form-label">Number of
                                                    Chapters:</label>
                                                <select name="no_of_chepter" class="form-select" required>
                                                    @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}" {{ $i==1
                                                        ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="status">Chapter Status:</label>
                                                <div style="margin-top: 10px;">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="yesmode" value="1" checked>
                                                        <label class="form-check-label" for="yesmode">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="nostatus" value="0">
                                                        <label class="form-check-label" for="nostatus">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="mode">Chapter Mode:</label>
                                                <div style="margin-top: 10px;">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="mode"
                                                            id="modepublic" value="1" checked>
                                                        <label class="form-check-label" for="modepublic">Public</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="mode"
                                                            id="modeprivate" value="0">
                                                        <label class="form-check-label"
                                                            for="modeprivate">Private</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Add Assets Button -->
                                        <div class="upload-area text-end p-2">
                                            <input id="uploadButton_form" type="Submit" class="btn btn-primary" value="Submit">
                                        </div>

                                    </div>

                                </form>


                            </div>









                            {{-- <form id="createCourseForm" method="POST" action="{{ route('assets.submit') }}"
                                enctype="multipart/form-data">
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
                                    <div id="progressWrapper" style="display: none; margin-top: 20px;">
                                        <div class="progress">
                                            <div id="progressBar"
                                                class="progress-bar progress-bar-striped progress-bar-animated"
                                                role="progressbar" style="width: 0%;" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                        <p id="progressText" class="mt-2 text-center">0%</p>
                                    </div>
                                    <div id="uploadArea" class="upload-area">
                                        <button id="uploadButton" class="btn btn-primary">Upload Video</button>
                                    </div>
                                </div>
                            </form> --}}


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        ClassicEditor
            .create(document.querySelector('#assets_discription'))
            .catch(error => {
                console.error(error);
            });
    });
</script>


{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
    const blogAssetContainer = document.querySelector('#blogAssetContainer');

    // Add Blog (with Assets)
    blogAssetContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('add-blog')) {
            const blogAssetBlock = event.target.closest('.blog-asset-block');
            const clone = blogAssetBlock.cloneNode(true);

            // Clear input values in the cloned block
            clone.querySelectorAll('input, textarea, select').forEach(input => input.value = '');
            clone.querySelectorAll('input[type="radio"]').forEach(radio => (radio.checked = radio.defaultChecked));

            // Assign unique IDs to any CKEditor fields in the cloned block
            const newDescriptionField = clone.querySelector('textarea[name="assets_discription[]"]');
            const uniqueId = 'assets_discription_' + Date.now();
            newDescriptionField.id = uniqueId;

            // Initialize CKEditor for the new field
            setTimeout(() => CKEDITOR.replace(uniqueId), 0);

            // Show the remove button for the cloned block
            clone.querySelector('.remove-blog').classList.remove('d-none');
            blogAssetContainer.appendChild(clone);
        }

        // Remove Blog (and its Assets)
        if (event.target.classList.contains('remove-blog')) {
            const blogAssetBlock = event.target.closest('.blog-asset-block');
            blogAssetBlock.remove();
        }
    });

    // Add Individual Topic (only Assets Fields)
    blogAssetContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('add-topic')) {
            const blogAssetBlock = event.target.closest('.blog-asset-block');
            const topicContainer = blogAssetBlock.querySelector('.topic-item');
            const topicItem = topicContainer.cloneNode(true);

            // Clear input values in the cloned topic item
            topicItem.querySelectorAll('input, textarea, select').forEach(input => input.value = '');

            // Assign unique IDs to any CKEditor fields in the cloned topic
            const newDescriptionField = topicItem.querySelector('textarea[name="assets_discription[]"]');
            const uniqueId = 'assets_discription_' + Date.now();
            newDescriptionField.id = uniqueId;

            // Initialize CKEditor for the new field
            setTimeout(() => CKEDITOR.replace(uniqueId), 0);

            // Show the remove button for the cloned topic
            topicItem.querySelector('.remove-topic').classList.remove('d-none');

            // Append the cloned topic item (only asset fields)
            blogAssetBlock.querySelector('.topic-item').parentNode.appendChild(topicItem);
        }

        // Remove Individual Topic
        if (event.target.classList.contains('remove-topic')) {
            const topicItem = event.target.closest('.topic-item');
            topicItem.remove();
        }
    });
});
</script> --}}

{{-- .............model................................................ --}}
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Get the select element for assets materials
    const assetsMetarialSelect = document.querySelector('[name="assets_metarial[]"]');
    const assetsVideoModal = new bootstrap.Modal(document.getElementById('assetsVideoModal'));

    // Add an event listener to detect changes in the dropdown
    assetsMetarialSelect.addEventListener('change', function () {
        if (assetsMetarialSelect.value === "Assets Videos") {
            // Open the modal if "Assets Videos" is selected
            assetsVideoModal.show();
        }
    });
});
</script> --}}



{{-- <script>
    document.getElementById('uploadButton_form').addEventListener('click', function (e) {
        // Prevent form submission
        e.preventDefault();

        // Toggle the dropdown fields
        const dropdown = document.getElementById('dropdownFields');
        if (dropdown.style.display === 'none') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    });
</script> --}}


{{-- <script>
    document.getElementById('uploadButton').addEventListener('click', function (e) {
        e.preventDefault();

        const uploadButton = document.getElementById('uploadButton');
        const fileInput = document.getElementById('course_assets_video');
        const file = fileInput.files[0];
        if (!file) {
            Swal.fire('Error', 'Please select a file to upload', 'error');
            return;
        }

        const blogName = document.getElementById('blog_name').value; // Get blog_name field
        const courseId = document.querySelector('input[name="course_id"]').value; // Get course_id field

        if (!blogName || !courseId) {
            Swal.fire('Error', 'Please provide the Blog Name and Course ID', 'error');
            return;
        }

        // Disable the upload button to prevent multiple clicks
        uploadButton.disabled = true;
        uploadButton.textContent = 'Uploading...';

        const chunkSize = 2 * 1024 * 1024; // 2 MB per chunk
        const totalChunks = Math.ceil(file.size / chunkSize);
        let currentChunk = 0;

        // Show progress bar
        const progressWrapper = document.getElementById('progressWrapper');
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        progressWrapper.style.display = 'block';

        function uploadChunk() {
            const start = currentChunk * chunkSize;
            const end = Math.min(start + chunkSize, file.size);
            const chunk = file.slice(start, end);

            const formData = new FormData();
            formData.append('file', chunk);
            formData.append('fileName', file.name);
            formData.append('chunkNumber', currentChunk + 1);
            formData.append('totalChunks', totalChunks);

            // Include additional form fields
            formData.append('course_id', courseId);
            formData.append('blog_name', blogName);

            // Include CSRF token
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('assets.submit') }}', true);

            // Progress event for the upload
            xhr.upload.onprogress = function (event) {
                if (event.lengthComputable) {
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
                            text: 'Your video has been uploaded successfully!',
                            showConfirmButton: false,
                            timer: 5000,
                            willClose: () => {
                                location.reload();
                            },
                        });
                        // Re-enable the upload button after completion
                        uploadButton.disabled = false;
                        uploadButton.textContent = 'Upload Video';
                    }
                } else {
                    Swal.fire('Error', 'Error uploading chunk', 'error');
                    console.error(xhr.responseText);
                    // Re-enable the button in case of an error
                    uploadButton.disabled = false;
                    uploadButton.textContent = 'Upload Video';
                }
            };

            xhr.onerror = function () {
                Swal.fire('Error', 'Error during upload', 'error');
                // Re-enable the button in case of an error
                uploadButton.disabled = false;
                uploadButton.textContent = 'Upload Video';
            };

            xhr.send(formData);
        }

        uploadChunk();
    });
</script> --}}



@include('partials.footer')
@endsection
