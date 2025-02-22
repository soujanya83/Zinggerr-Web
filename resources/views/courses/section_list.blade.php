<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.2/resumable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs/resumable.js"></script>


@extends('layouts.app')

@section('pageTitle', 'Create Chapter')

@section('content')
@include('partials.sidebar')
@include('partials.headerdashboard')

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

<style>
    .file-upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 2px dashed #fff;
        border-radius: 5px;
        /* padding: 10px; */
        cursor: pointer;
        height: 140px;
        width: 387px;
        transition: background-color 0.3s ease;
    }

    .file-upload-label:hover {
        background-color: #fff;
    }

    .file-upload-input {
        display: none;
    }

    .upload-icon {
        font-size: 2rem;
        color: #007bff;
    }

    .note-editable {
        background-color: #fff
    }
</style>

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Sections List</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Course</a></li>
                            <li class="breadcrumb-item" aria-current="page">Sections List</li>
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
                        <h5>Sections List</h5>

                        <div class="row">

                            <div class="card-body pt-0">
                                <div class="table-responsive">



                                    <div class="container">
                                        @if($sections->count() > 0)
                                        @foreach($sections as $section)
                                        <div class="col-md-12 mt-3 section-row" id="section-row-{{ $section->id }}">
                                            <div class="p-2 border rounded">
                                                <!-- Date Header -->
                                                <h6 class="cursor-pointer bg-light border rounded p-2 d-flex justify-content-between align-items-center"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#section-{{ $section->id }}">
                                                    📅 {{ \Carbon\Carbon::parse($section->date)->format('d/m/Y') }}
                                                    <span>
                                                        <span class="dropdown-icon">⬇️</span>
                                                        <a href="{{ route('section.delete', $section->id) }}"
                                                            class="btn btn-sm" onclick="return confirmDelete(this)">
                                                            <i class="ti ti-trash" style="color:red"></i>
                                                        </a>
                                                    </span>
                                                </h6>

                                                <!-- Section Content -->
                                                <div id="section-{{ $section->id }}"
                                                    class="collapse mt-2 p-3 bg-light rounded">
                                                    <p><span class="badge bg-primary">{{ ucfirst($section->assetstype)
                                                            }}</span></p>

                                                    <!-- Blog Description (Summernote) -->
                                                    @if($section->assetstype == 'blog')
                                                    <div class="mt-3">
                                                        <label><strong>Blog Description:</strong></label>
                                                        <textarea class="summernote" id="editor-{{ $section->id }}"
                                                            data-id="{{ $section->id }}"
                                                            disabled>{{ $section->blog }}</textarea>
                                                    </div>
                                                    @endif

                                                    <!-- URL Input -->
                                                    @if($section->assetstype == 'url')
                                                    <div class="mt-3">
                                                        <label><strong>URL:</strong></label>
                                                        <input type="text" class="form-control url-input"
                                                            id="url-input-{{ $section->id }}"
                                                            value="{{ $section->url }}" disabled>
                                                    </div>
                                                    @endif

                                                    <!-- YouTube Input -->
                                                    @if($section->assetstype == 'youtube')
                                                    <div class="mt-3">
                                                        <label><strong>YouTube Video ID:</strong></label>
                                                        <input type="text" class="form-control youtube-input"
                                                            id="youtube-input-{{ $section->id }}"
                                                            value="{{ $section->youtube }}" disabled>
                                                    </div>
                                                    @endif

                                                    <!-- Video Upload -->
                                                    @if($section->assetstype == 'videos')
                                                    <div class="col-md-12 asset-content mt-3">
                                                        <label class="form-label"><strong>Course Video
                                                                Upload</strong></label>
                                                        <div class="form-floating mb-3" style="background-color:#fff">
                                                            <div
                                                                class="d-flex align-items-center rounded w-100 col-md-12">
                                                                <label for="fileUpload_{{ $section->id }}"
                                                                    class="file-upload-label w-100 text-center col-md-12">
                                                                    <div class="upload-icon mb-3">
                                                                        <i
                                                                            class="fas fa-cloud-upload-alt fa-3x text-primary"></i>
                                                                    </div>
                                                                    <span class="text-muted">Click to upload file</span>
                                                                    <span id="fileName_{{ $section->id }}"
                                                                        class="ms-2"></span>
                                                                    <input type="file"
                                                                        id="fileUpload_{{ $section->id }}" name="video"
                                                                        class="file-upload-input" accept="video/*"
                                                                        disabled>
                                                                </label>
                                                            </div>
                                                            <input type="hidden" id="videoFileName_{{ $section->id }}"
                                                                name="sections[{{ $section->id }}][video]"
                                                                value="{{ $section->video }}">

                                                            <!-- Progress Bar -->
                                                            <div id="progressContainer_{{ $section->id }}"
                                                                class="progress mt-2" style="display: none;">
                                                                <div id="progressBar_{{ $section->id }}"
                                                                    class="progress-bar progress-bar-striped progress-bar-animated"
                                                                    role="progressbar" style="width: 0%;">0%</div>
                                                            </div>
                                                        </div>

                                                        <strong>Video:</strong> {{ $section->video }}

                                                    </div>
                                                    @endif

                                                    {{--
                                                    <div class="text-end mt-3">
                                                        <button class="btn btn-shadow btn-sm btn-primary edit-section"
                                                            data-id="{{ $section->id }}" title="Edit">Edit</button>
                                                        <button class="btn btn-shadow btn-sm btn-success update-section"
                                                            data-id="{{ $section->id }}" title="Update"
                                                            style="display:none;">Update</button>
                                                    </div> --}}

                                                    <div class="text-end mt-3">
                                                        <button class="btn btn-shadow btn-sm btn-primary edit-section"
                                                            data-id="{{ $section->id }}" title="Edit">Edit</button>
                                                        <button class="btn btn-shadow btn-sm btn-success update-section"
                                                            data-id="{{ $section->id }}" title="Update"
                                                            style="display:none;">Update</button>
                                                    </div>





                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="col-md-12 text-center">
                                            <p>No Data Found!</p>
                                        </div>
                                        @endif
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).on('change', '.file-upload-input', function (e) {
    let file = e.target.files[0];
    let id = $(this).attr('id').split('_').pop(); // Extract section ID
    let chunkSize = 2 * 1024 * 1024; // 5MB per chunk
    let totalChunks = Math.ceil(file.size / chunkSize);
    let currentChunk = 0;
    let progressBar = $("#progressBar_" + id);
    let progressContainer = $("#progressContainer_" + id);
    let editButton = $(".edit-section[data-id='" + id + "']");
    let updateButton = $(".update-section[data-id='" + id + "']");
    let fileInput = $("#fileUpload_" + id);

    // Disable Edit button & Hide Update button
    editButton.prop("disabled", true).hide();
    updateButton.hide();
    progressContainer.show();

    function uploadChunk() {
        if (currentChunk >= totalChunks) {
            progressBar.css('width', '100%').text('100%');

            // After upload, wait briefly and then reset UI
            setTimeout(() => {
                progressContainer.hide(); // Hide progress bar
                editButton.prop("disabled", false).show(); // Show Edit button
                updateButton.hide(); // Keep Update hidden
                fileInput.val(''); // Reset file input

                // Show SweetAlert success message
                Swal.fire({
                    icon: 'success',
                    title: 'Upload Complete',
                    text: 'The video has been successfully uploaded and updated!',
                    timer: 3000,
                    showConfirmButton: false
                });

            }, 1000);

            return;
        }

        let start = currentChunk * chunkSize;
        let end = Math.min(start + chunkSize, file.size);
        let chunk = file.slice(start, end);
        let formData = new FormData();

        formData.append('video', chunk);
        formData.append('file_name', file.name);
        formData.append('section_id', id);
        formData.append('chunk_index', currentChunk);
        formData.append('total_chunks', totalChunks);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: '/sections/video/update',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function () {
                let progress = Math.round(((currentChunk + 1) / totalChunks) * 100);
                progressBar.css('width', progress + '%').text(progress + '%');
                currentChunk++;
                uploadChunk();
            },
            error: function (xhr) {
                alert('Upload failed: ' + xhr.responseText);
                editButton.prop("disabled", false).show();
                updateButton.hide();
            }
        });
    }

    uploadChunk();
});

</script>



<script>
    $(document).on('click', '.edit-section', function () {
            let id = $(this).data('id');

            // Enable video file input for editing
            $('#fileUpload_' + id).prop('disabled', false);

            // Hide Edit button, show Update button
            $(this).hide();
            $('.update-section[data-id="' + id + '"]').show();
        });


</script>


<script>
    $(document).ready(function () {
        // Initialize Summernote (Disabled Initially)
        $('.summernote').summernote({
            height: 200,
            minHeight: 100,
            maxHeight: 400,
            focus: true,
            toolbar: [
                ['style', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol']],
                ['view', ['fullscreen']]
            ]
        }).summernote('disable'); // Disable editing initially

        // Enable Edit Mode
        $(document).on('click', '.edit-section', function () {
            let id = $(this).data('id');

            // Enable fields based on asset type
            $('#editor-' + id).summernote('enable'); // Enable Summernote
            $('#url-input-' + id).prop('disabled', false);
            $('#youtube-input-' + id).prop('disabled', false);
            $('#video-file-' + id).prop('disabled', false);

            // Show Update Button, Hide Edit Button
            $(this).hide();
            $('.update-section[data-id="' + id + '"]').show();
        });

        // Handle Update Button Click
        $(document).on('click', '.update-section', function () {
            let id = $(this).data('id');

            let editor = $('#editor-' + id);
            let urlInput = $('#url-input-' + id);
            let youtubeInput = $('#youtube-input-' + id);

            let updatedData = {
                _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
                blog: editor.length ? editor.summernote('code').trim() : null,
                url: urlInput.length ? urlInput.val().trim() : null,
                youtube: youtubeInput.length ? youtubeInput.val().trim() : null
            };
            $.ajax({
                url: '/sections/update/' + id,
                method: 'POST',
                data: updatedData,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated Successfully!',
                        text: 'Your section has been updated.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $('#editor-' + id).summernote('disable');
                    $('#url-input-' + id).prop('disabled', true);
                    $('#youtube-input-' + id).prop('disabled', true);
                    $('#video-file-' + id).prop('disabled', true);

                    // Show Edit Button, Hide Update Button
                    $('.edit-section[data-id="' + id + '"]').show();
                    $('.update-section[data-id="' + id + '"]').hide();
                },
                error: function (xhr, status, error) {
                    console.log('❌ AJAX Error:', xhr.responseText);

                    // Show SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Update Failed!',
                        text: 'Something went wrong. Please try again.',
                    });
                }
            });
        });
    });
</script>



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
    $(document).ready(function () {
        function initializeSummernote() {
            $('.summernote').summernote({
                height: 200,
                minHeight: 100,
                maxHeight: 400,
                focus: true,
                toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
            });
        }

        // Initialize Summernote on page load
        initializeSummernote();

        // Reinitialize when content is loaded dynamically
        $(document).on('click', '.edit-section', function () {
            setTimeout(function () {
                initializeSummernote();
            }, 500);
        });
    });
</script>

@include('partials.footer')
@endsection
