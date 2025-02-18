<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.2/resumable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs/resumable.js"></script>


@extends('layouts.app')

@section('pageTitle', 'Create Chapter')

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
                                                <h6 class="cursor-pointer bg-light border rounded p-2 d-flex justify-content-between align-items-center"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#section-{{ $section->id }}">
                                                    📅 {{ $section->course_start_date }}
                                                    <span>
                                                        <span class="dropdown-icon">⬇️</span>

                                                        <a href="{{ route('section.delete', $section->id) }}"
                                                            class="btn btn-sm"
                                                            onclick="return confirmDelete(this)">
                                                            <i class="ti ti-trash" style="color:red"></i>
                                                        </a>
                                                    </span>
                                                </h6>
                                                <div id="section-{{ $section->id }}" class="collapse mt-2">
                                                    <textarea class="summernote" id="editor-{{ $section->id }}"
                                                        data-id="{{ $section->id }}">{{ $section->sections_remark }}</textarea>

                                                    <div class="text-end mt-2">
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
<script>
    $(document).ready(function () {
        // Initialize Summernote for all sections (Initially disabled)
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
            ],
            disableResizeEditor: true
        }).summernote('disable');

        // Handle dropdown icon toggle
        $(".cursor-pointer").on("click", function () {
            let icon = $(this).find(".dropdown-icon");
            icon.text(icon.text() === "⬇️" ? "⬆️" : "⬇️");
        });

        // Edit Section: Enable Summernote Editing
        $(".edit-section").on("click", function () {
            let sectionId = $(this).data("id");
            $("#editor-" + sectionId).summernote('enable');
            $(this).hide();
            $(".update-section[data-id='" + sectionId + "']").show();
        });

        // Update Section: Save Changes via AJAX
        $(".update-section").on("click", function () {
            let sectionId = $(this).data("id");
            let content = $("#editor-" + sectionId).val();

            $.ajax({
                url: "{{ route('section.update') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: sectionId,
                    sections_remark: content
                },
                success: function (response) {
                    alert("Section Updated Successfully!");
                    $("#editor-" + sectionId).summernote('disable');
                    $(".edit-section[data-id='" + sectionId + "']").show();
                    $(".update-section[data-id='" + sectionId + "']").hide();
                },
                error: function () {
                    alert("Error updating section.");
                }
            });
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


@include('partials.footer')
@endsection
