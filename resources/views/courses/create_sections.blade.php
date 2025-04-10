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



    .css-pht88d {
        /* font-size: 0.875rem; */
        font-weight: 400;
        line-height: 1.4375em;
        font-family: Roboto, sans-serif;
        color: rgb(54, 65, 82);
        box-sizing: border-box;
        cursor: text;
        display: inline-flex;
        align-items: center;
        width: 100%;
        position: relative;
        background: rgb(248, 250, 252);
        border-radius: 8px;
    }

    .nav-link.active i {
        background-color: #007bff
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
                        <h5>Create Sections</h5>
                        <button class="btn btn-shadow btn-sm btn-outline-success align-items-start"
                            style="margin-left: 88%;"
                            onclick="window.location.href='{{ route('section.list', ['slug' => $slug]) }}';">
                            Sections List
                        </button>
                        <div class="row">


                            <div class="card-body">
                                {{-- <form action="{{ route('section.submit')}}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $id }}"> --}}

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <h5 class="p-2 bg-light border rounded">📅 Select Course Start Date <span class="text-danger" style="font-weight: bold;">*</span></h5>
                                                <input type="date" id="course_start_date" name="course_start_date"
                                                    class="form-control"
                                                    value="{{ old('course_start_date') }}">
                                            </div>
                                        </div>

                                    </div>


                                    <div id="sections-container" class="row mt-3"></div>
                                    <div class="upload-area text-end p-2">
                                        {{-- <input id="uploadButton_form" type="Submit" class="btn btn-primary"
                                            value="Submit"> --}}
                                        <button type="button" id="restoreButton"
                                            class="btn btn-shadow btn-outline-secondary">Restore Removed Dates</button>
                                    </div>
                                    {{--
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

<script>
    $(document).ready(function () {
    // ✅ Listen for form submission
    $(document).on("submit", "form", function (e) {
        e.preventDefault(); // Prevent default form submission

        let form = $(this);
        let formData = new FormData(this);
        let submitButton = form.find("button[type=submit]");

        // Disable button to prevent duplicate submissions
        submitButton.prop("disabled", true).text("Submitting...");

        $.ajax({
            url: form.attr("action"),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // ✅ Show success alert
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Section submitted successfully.",
                    timer: 2000,
                    showConfirmButton: false,
                });

                // ✅ Remove the corresponding section div
                let sectionDiv = form.closest(".section-item");
                sectionDiv.fadeOut(500, function () {
                    $(this).remove();
                });

                // Enable the button again
                submitButton.prop("disabled", false).text("Submit");
            },
            error: function (xhr) {
                let errorMsg = "Something went wrong!";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }

                // ❌ Show error alert
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: errorMsg,
                });

                submitButton.prop("disabled", false).text("Submit");
            },
        });
    });
});

</script>



<script>
  document.addEventListener("change", function (event) {
    if (event.target.classList.contains("file-upload-input")) {
        let input = event.target;
        let sectionDate = input.id.split("_")[1];
        let file = input.files[0];

        if (file) {
            let fileName = file.name.replace(/\s+/g, "_");
            let chunkSize = 2 * 1024 * 1024; // 2MB per chunk
            let totalChunks = Math.ceil(file.size / chunkSize);
            let currentChunk = 0;

            let progressBar = document.getElementById(`progressBar_${sectionDate}`);
            let progressContainer = document.getElementById(`progressContainer_${sectionDate}`);
            let currentForm = input.closest("form"); // ✅ Get the form of the current upload
            let submitButton = currentForm.querySelector("button[type='submit']"); // ✅ Find submit button in the current form
            let dateDiv = document.getElementById(`dateDiv_${sectionDate}`);

            progressContainer.style.display = "block";

            // ✅ Hide only the submit button of the current form
            if (submitButton) {
                submitButton.style.display = "none";
            }

            function uploadChunk() {
                if (currentChunk >= totalChunks) {
                    return;
                }

                let start = currentChunk * chunkSize;
                let end = Math.min(start + chunkSize, file.size);
                let chunk = file.slice(start, end);

                let formData = new FormData();
                formData.append("video", chunk);
                formData.append("course_id", document.querySelector('input[name="course_id"]').value);
                formData.append("date", sectionDate);
                formData.append("chunkIndex", currentChunk);
                formData.append("totalChunks", totalChunks);
                formData.append("fileName", fileName);

                fetch("{{ route('upload.video.chunk') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    currentChunk++;
                    let progress = Math.round((currentChunk / totalChunks) * 100);
                    progressBar.style.width = progress + "%";
                    progressBar.innerText = progress + "%";

                    if (data.message === "Upload complete") {
                        document.getElementById(`fileName_${sectionDate}`).innerText = fileName;

                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            html: "<b>Videos uploaded successfully!</b><br>Sections created successfully!",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        }).then(() => {
                            // ✅ Remove only the current section
                            let sectionDiv = currentForm.closest(".section-item");
                            if (sectionDiv) {
                                sectionDiv.style.transition = "opacity 0.5s ease-out";
                                sectionDiv.style.opacity = "0";
                                setTimeout(() => sectionDiv.remove(), 500);
                            }

                            if (dateDiv) dateDiv.style.display = "none"; // Hide date div
                            if (submitButton) submitButton.style.display = "block"; // Show submit button again
                        });
                    }

                    if (currentChunk < totalChunks) {
                        uploadChunk(); // Upload next chunk
                    }
                })
                .catch(error => {
                    console.error("Upload error:", error);

                    // ❌ Show error message & re-enable submit button
                    Swal.fire({
                        icon: "error",
                        title: "Upload Failed",
                        text: "Something went wrong while uploading your video!",
                        confirmButtonColor: "#d33",
                        confirmButtonText: "Try Again"
                    });

                    if (submitButton) submitButton.style.display = "block"; // Show submit button in case of error
                });
            }

            uploadChunk(); // Start uploading
        }
    }
});


</script>


<script>
    $(document).ready(function () {
    let removedDates = JSON.parse(localStorage.getItem("removedDates")) || [];

    $("#course_start_date").on("change", function () {
    let startDate = new Date($(this).val());
    let container = $("#sections-container");
    container.empty();

    if (!isNaN(startDate)) {
        for (let i = 0; i < 7; i++) {
            let newDate = new Date(startDate);
            newDate.setDate(startDate.getDate() + i);
            let formattedDate = newDate.toISOString().split("T")[0];

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
                        <div id="section-${formattedDate}" class="collapse" style="background-color:#dff0ff;padding:10px">
                            <form action="{{ route('section.submit')}}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $id }}">
                                <input type="hidden" name="date" value="${formattedDate}">
                                <input type="hidden" name="status" value="1">

                                <div class="mb-3">
                                    <label for="assetstype_${formattedDate}" class="form-label">Assets Type: <span class="text-danger" style="font-weight: bold;">*</span></label>
                                    <select name="assetstype" id="assetstype_${formattedDate}" class="form-select asset-selector" required>
                                        <option value="">Select</option>
                                        <option value="blog">Blog</option>
                                        <option value="url">Video Link</option>
                                        <option value="videos">Videos Uploads</option>
                                        <option value="youtube">YouTube Videos Link</option>
                                    </select>
                                </div>

                                <div id="content_${formattedDate}" class="asset-content-container">
                                    <div id="blogContent_${formattedDate}" class="asset-content" style="display: none;">
                                        <label>Blog Description:</label>
                                        <textarea name="blog" class="form-control summernote"></textarea>
                                    </div>

                                    <div id="urlContent_${formattedDate}" class="asset-content" style="display: none;">
                                        <label>Enter URL:</label>
                                        <input type="url" name="url" class="form-control" placeholder="Enter URL">
                                    </div>

                               <div class="col-md-12 asset-content" id="videosContent_${formattedDate}" style="display: none;">
                                    <label class="form-label">Course Video Upload</label>
                                    <div class="form-floating mb-3" style="background-color:#fff">
                                        <div class="d-flex align-items-center rounded w-100 col-md-12">
                                            <label for="fileUpload_${formattedDate}" class="file-upload-label w-100 text-center col-md-12">
                                                <div class="upload-icon mb-3">
                                                    <i class="fas fa-cloud-upload-alt fa-3x text-primary"></i>
                                                </div>
                                                <span class="text-muted">Click to upload file</span>
                                                <span id="fileName_${formattedDate}" class="ms-2"></span>
                                                <input type="file" id="fileUpload_${formattedDate}" name="video"
                                                    class="file-upload-input" accept="video/*">
                                            </label>
                                        </div>
                                        <input type="hidden" id="videoFileName_${formattedDate}" name="sections[${formattedDate}][video]">

                                        <!-- Progress Bar -->
                                        <div id="progressContainer_${formattedDate}" class="progress mt-2" style="display: none;">
                                            <div id="progressBar_${formattedDate}" class="progress-bar progress-bar-striped progress-bar-animated"
                                                role="progressbar" style="width: 0%;">0%</div>
                                        </div>
                                    </div>
                                </div>




                                    <div id="youtubeContent_${formattedDate}" class="asset-content" style="display: none;">
                                        <label>YouTube Video Link:</label>
                                        <input type="text" name="youtube" class="form-control" placeholder="Enter YouTube Link">
                                    </div>
                                </div>

                                <div class="text-end mt-3">
                                    <button type="submit"  class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            `;
                container.append(sectionHtml);
            }

            $(".asset-selector").on("change", function () {
                let sectionDate = $(this).attr("id").split("_")[1];
                let selectedValue = $(this).val();
                let contentContainer = $("#content_" + sectionDate);

                contentContainer.find(".asset-content").hide();

                if (selectedValue) {
                    $("#" + selectedValue + "Content_" + sectionDate).show();

                    if (selectedValue === "blog") {
                        $("#blogContent_" + sectionDate + " .summernote").summernote({
                            height: 200,
                            placeholder: "Write your blog here...",
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
                }
            });

            $(".delete-section").on("click", function () {
                let date = $(this).data("date");
                removedDates.push(date);
                localStorage.setItem("removedDates", JSON.stringify(removedDates));
                $("#section-wrapper-" + date).remove();
            });
        }
    });

    $("#restoreButton").on("click", function () {
        removedDates = [];
        localStorage.setItem("removedDates", JSON.stringify(removedDates));
        $("#course_start_date").trigger("change");
    });

    // ✅ Form Validation Before Submission
    $("form").on("submit", function (e) {
        let isValid = true;

        if ($("#course_start_date").val() === "") {
            alert("Please select a course start date.");
            isValid = false;
        }

        $(".asset-selector").each(function () {
            let sectionDate = $(this).attr("id").split("_")[1];
            let selectedValue = $(this).val();

            if (selectedValue === "") {
                alert(`Please select an asset type for ${sectionDate}`);
                isValid = false;
            }

            if (selectedValue === "videos") {
                let fileInput = $(`#fileUpload_${sectionDate}`);
                if (fileInput.length && fileInput[0].files.length === 0) {
                    alert(`Please upload a video for ${sectionDate}`);
                    isValid = false;
                }
            }

            if (selectedValue === "url") {
                let urlInput = $(`input[name="sections[${sectionDate}][url]"]`);
                if (urlInput.length && urlInput.val().trim() === "") {
                    alert(`Please enter a valid URL for ${sectionDate}`);
                    isValid = false;
                }
            }

            if (selectedValue === "youtube") {
                let youtubeInput = $(`input[name="sections[${sectionDate}][youtube]"]`);
                if (youtubeInput.length && youtubeInput.val().trim() === "") {
                    alert(`Please enter a YouTube link for ${sectionDate}`);
                    isValid = false;
                }
            }
        });

        if (!isValid) {
            e.preventDefault(); // Stop form submission if validation fails
        }
    });
                        });


            function showFileName(input, sectionDate) {
                let file = input.files[0];
                if (file) {
                    document.getElementById(`fileName_${sectionDate}`).innerText = file.name;
                }
            }

</script>



@include('partials.footer')
@endsection
