@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@section('pageTitle', ' Events Create')

@section('content')
@include('partials.sidebar')
@include('partials.header')
<style>
    .faded-placeholder::placeholder {
        color: rgba(0, 0, 0, 0.5);
        /* light gray */
        transition: opacity 0.3s ease;
    }

    .faded-placeholder:focus::placeholder {
        opacity: 0.3;
    }


    .faded-placeholder::placeholder {
        color: #888;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .faded-placeholder:focus::placeholder {
        opacity: 0.4;
    }

    .color-picker {
        padding: 5px;
        width: 100%;
        /* Ensures the color input takes full width */
        height: 40px;
        /* Adjust height for better visibility */
        border: 1px solid #ccc;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Optional: Customize the appearance of the color input (limited by browser support) */
    .color-picker::-webkit-color-swatch {
        border-radius: 4px;
        border: none;
    }

    .color-picker::-moz-color-swatch {
        border-radius: 4px;
        border: none;
    }
</style>

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Create Event</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Create Event</li>
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
        <div class="row">
            <div class="tab-pane" id="request" role="tabpanel" aria-labelledby="request-tab">
                <div class="card">

                    <div class="card-header" style="margin-bottom: -28px;">
                        <div class="row align-items-center g-2">
                            <div class="col">
                                <h5>Create Event</h5>
                            </div>

                            <div class="card-body">

                                <form id="permissionForm" action="{{ route('event.store') }}" method="post"
                                    autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label><b>Title</b> <span class="text-danger" style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" name="title"
                                                    placeholder="Enter Title.." value="{{ old('title') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <div class="mb-2">
                                                    <label for="background_color"><b>Background Color</b> <span class="text-danger" style="font-weight: bold;">*</span></label>
                                                    <input type="color" class="form-control color-picker"
                                                        name="background_color" id="background_color" value="#732b2b"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <div>
                                                    <label for="text_color"><b>Text Color</b> <span class="text-danger" style="font-weight: bold;">*</span></label>
                                                    <input type="color" class="form-control color-picker"
                                                        name="text_color" id="text_color" value="#d8d0d0" required>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="start_datetime"><b>Start Date & Time</b> <span class="text-danger" style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control faded-placeholder" required
                                                    name="start_datetime" id="start_datetime"
                                                    placeholder="dd/mm/yyyy --:--" value="{{ old('start_datetime') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="end_datetime"><b>End Date & Time</b> <span class="text-danger" style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control faded-placeholder" required
                                                    name="end_datetime" id="end_datetime" placeholder="dd/mm/yyyy --:--"
                                                    value="{{ old('end_datetime')}}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label"><b>Description</b> <span class="text-danger" style="font-weight: bold;">*</span></label>
                                            <div class="form-floating">
                                                <textarea id="summernote" name="description" class="form-control"
                                                    required>{{ old('description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="display: none">
                                            <div class="mb-3 mt-4">
                                                <label></label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="active" value="1" checked>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="inactive" value="0">
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="text-end">
                                        <input type="submit" class="btn btn-shadow btn-primary" value="Submit">
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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function () {
        // Initialize Summernote on the textarea
        $('#summernote').summernote({
            placeholder: 'Enter course summary here...',
            tabsize: 2,
            height: 90, // Adjust the height as needed
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
<script>
    flatpickr("#start_datetime", {
        enableTime: true,
        dateFormat: "d/m/Y H:i",
        allowInput: true
    });

    flatpickr("#end_datetime", {
        enableTime: true,
        dateFormat: "d/m/Y H:i",
        allowInput: true
    });
</script>
@include('partials.footer')
@endsection
