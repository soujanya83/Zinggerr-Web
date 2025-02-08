<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.2/resumable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs/resumable.js"></script>


@extends('layouts.app')

@section('pageTitle', 'Create Sections')

@section('content')
@include('partials.sidebar')
@include('partials.headerdashboard')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>


<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Create Section</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Course</a></li>
                            <li class="breadcrumb-item" aria-current="page">Create Section</li>
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
                        <h5>Create Sections</h5>
                        <button class="btn btn-shadow btn-sm btn-outline-success align-items-start" style="margin-left: 92%;"
                            onclick="window.location.href='{{ route('section.list', ['slug' => $slug]) }}';">
                            Sections List
                        </button>
                        <div class="row">
                            <div class="card-body">


                                <form action="{{ route('section.submit')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $id }}">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <h5 class="p-2 bg-light border rounded">📅 Select Course Start Date</h5>
                                                <input type="date" id="course_start_date" name="course_start_date"
                                                    class="form-control" required
                                                    value="{{ old('course_start_date') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mt-4">
                                            <div class="mb-3">
                                                <label for="status">Section Visible:</label>
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
                                    </div>
                                    <div id="sections-container" class="row mt-3"></div>

                                    <div class="upload-area text-end p-2">
                                        <input id="uploadButton_form" type="Submit" class="btn btn-primary"
                                            value="Submit">
                                        <button type="button" id="restoreButton"
                                            class="btn btn-shadow btn-outline-secondary">Restore
                                            Removed Dates</button>

                                    </div>
                                </form>
                            </div>

                            {{-- <script>
                                $(document).ready(function () {
                                    $("#course_start_date").on("change", function () {
                                        let startDate = new Date($(this).val());
                                        let container = $("#sections-container");
                                        container.empty(); // Clear previous sections

                                        if (!isNaN(startDate)) {
                                            for (let i = 0; i < 7; i++) {
                                                let newDate = new Date(startDate);
                                                newDate.setDate(startDate.getDate() + i);
                                                let formattedDate = newDate.toISOString().split('T')[0];

                                                // Create collapsible section with delete button
                                                let sectionHtml = `
                                                    <div class="col-md-12 mt-2 section-item" id="section-wrapper-${i}">
                                                        <div class="p-2 border rounded">
                                                            <h6 class="cursor-pointer p-2 bg-light border rounded d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#section-${i}">
                                                                📅 ${formattedDate}
                                                                <span class="d-flex">
                                                                    <span class="dropdown-icon">⬇️</span>
                                                                    <span class="delete-section text-danger ms-2" data-target="#section-wrapper-${i}" style="cursor: pointer;">❌</span>
                                                                </span>
                                                            </h6>
                                                            <div id="section-${i}" class="collapse">
                                                                <textarea class="summernote" name="sections[${formattedDate}]"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                `;

                                                container.append(sectionHtml);
                                            }

                                            // Initialize Summernote for newly added textareas
                                            $(".summernote").summernote({
                                                height: 150,
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

                                            // Handle dropdown icon toggle (⬇️/⬆️)
                                            $(".cursor-pointer").on("click", function () {
                                                let icon = $(this).find(".dropdown-icon");
                                                if (icon.text() === "⬇️") {
                                                    icon.text("⬆️");
                                                } else {
                                                    icon.text("⬇️");
                                                }
                                            });

                                            // Handle section delete
                                            $(".delete-section").on("click", function () {
                                                let target = $(this).data("target");
                                                $(target).remove();
                                            });
                                        }
                                    });
                                });
                            </script> --}}
                            <script>
                                $(document).ready(function () {
                                            let removedDates = JSON.parse(localStorage.getItem("removedDates")) || []; // Store removed dates

                                            $("#course_start_date").on("change", function () {
                                                let startDate = new Date($(this).val());
                                                let container = $("#sections-container");
                                                container.empty(); // Clear previous sections

                                                if (!isNaN(startDate)) {
                                                    for (let i = 0; i < 7; i++) {
                                                        let newDate = new Date(startDate);
                                                        newDate.setDate(startDate.getDate() + i);
                                                        let formattedDate = newDate.toISOString().split('T')[0];

                                                        // Skip removed dates
                                                        if (removedDates.includes(formattedDate)) continue;

                                                        let sectionHtml = `
                                                            <div class="col-md-12 mt-2 section-item" id="section-wrapper-${formattedDate}">
                                                                <div class="p-2 border rounded">
                                                                    <h6 class="cursor-pointer p-2 bg-light border rounded d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#section-${formattedDate}">
                                                                        📅 ${formattedDate}
                                                                        <span class="d-flex">
                                                                            <span class="dropdown-icon">⬇️</span>
                                                                            <span class="delete-section text-danger ms-2" data-date="${formattedDate}" style="cursor: pointer;">❌</span>
                                                                        </span>
                                                                    </h6>
                                                                    <div id="section-${formattedDate}" class="collapse">
                                                                        <textarea class="summernote" name="sections[${formattedDate}]"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        `;

                                                        container.append(sectionHtml);
                                                    }

                                                    // Initialize Summernote
                                                    $(".summernote").summernote({
                                                        height: 150,
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

                                                    // Toggle dropdown icon
                                                    $(".cursor-pointer").on("click", function () {
                                                        let icon = $(this).find(".dropdown-icon");
                                                        icon.text(icon.text() === "⬇️" ? "⬆️" : "⬇️");
                                                    });

                                                    // Handle section delete
                                                    $(".delete-section").on("click", function () {
                                                        let date = $(this).data("date");
                                                        removedDates.push(date);
                                                        localStorage.setItem("removedDates", JSON.stringify(removedDates));
                                                        $("#section-wrapper-" + date).remove();
                                                    });
                                                }
                                            });

                                            // Restore removed dates
                                            $("#restoreButton").on("click", function () {
                                                removedDates = [];
                                                localStorage.setItem("removedDates", JSON.stringify(removedDates));
                                                $("#course_start_date").trigger("change"); // Refresh sections
                                            });
                                        });

                            </script>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="blogModal" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ececec">
                <h5 class="modal-title" id="blogModalLabel"></h5> <!-- Header will be dynamically updated -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modalBlogDescription" style="font-size: 16px"></p>
                <!-- Blog description will be dynamically updated -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Video Modal -->
<div id="videoModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lecture Videos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <video id="videoPlayer" width="100%" controls>
                    <source src="" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <h4 id="videoTopic" class="mt-0"></h4> <!-- Display topic name dynamically here -->
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="editChapterModal" tabindex="-1" aria-labelledby="editChapterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('chapter.update') }}" method="post">
                @csrf
                <input type="hidden" name="id" id="editChapterId">
                <div class="modal-header">
                    <h5 class="modal-title" id="editChapterModalLabel">Edit Chapter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editChapterName">Chapter Name:</label>
                        <input type="text" id="editChapterName" name="chepter_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editChapterStatus">Chapter Visible:</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="editStatusYes" value="1">
                                <label class="form-check-label" for="editStatusYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="editStatusNo" value="0">
                                <label class="form-check-label" for="editStatusNo">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> --}}
                    <button type="submit" class="btn btn-shadow btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.editButton');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const chapterId = this.getAttribute('data-id');
            const chapterName = this.getAttribute('data-name');
            const chapterStatus = this.getAttribute('data-status');

            // Populate modal fields
            document.getElementById('editChapterId').value = chapterId;
            document.getElementById('editChapterName').value = chapterName;
            document.getElementById(chapterStatus == 1 ? 'editStatusYes' : 'editStatusNo').checked = true;
        });
    });
});

</script>

<script>
    function playVideo(videoPath, topicName) {
        // Set the video source
        const videoPlayer = document.getElementById('videoPlayer');
        videoPlayer.src = videoPath;

        // Set the topic name below the video
        const videoTopic = document.getElementById('videoTopic');
        videoTopic.textContent = topicName;

        // Show the modal
        const videoModal = new bootstrap.Modal(document.getElementById('videoModal'));
        videoModal.show();
    }

    // Stop video playback when the modal is closed
    document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
        const videoPlayer = document.getElementById('videoPlayer');
        videoPlayer.pause(); // Pause the video
        videoPlayer.currentTime = 0; // Reset video playback to the beginning
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const blogModal = document.getElementById('blogModal');
        blogModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const description = button.getAttribute('data-description'); // Extract blog description
            const topic = button.getAttribute('data-topic'); // Extract topic name

            // Update modal content
            const modalDescription = document.getElementById('modalBlogDescription');
            const modalTitle = document.getElementById('blogModalLabel');
            modalDescription.textContent = description; // Set blog description
            modalTitle.textContent = topic; // Set topic name as modal header
        });
    });
</script>


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
