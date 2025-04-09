@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@section('pageTitle', ' Events Update')

@section('content')
@include('partials.sidebar')
@include('partials.header')
<style>

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
                            <h5 class="m-b-10">Events</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Update Event</li>
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
                                <h5>Update Event</h5>
                            </div>

                            <div class="card-body">
                                <form id="permissionForm" action="{{ route('event.update') }}" method="post"
                                    autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label><b>Title</b></label>
                                                <input type="text" class="form-control" name="title"
                                                    placeholder="Enter Title..."
                                                    value="{{ old('title', $event->event_topic) }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <div class="mb-2">
                                                    <label for="background_color"><b>Background Color</b></label>
                                                    <input type="color" class="form-control color-picker"
                                                        name="background_color" id="background_color" value="{{ old('background_color', $event->background_color) }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <div>
                                                    <label for="text_color"><b>Text Color</b></label>
                                                    <input type="color" class="form-control color-picker"
                                                        name="text_color" id="text_color" value="{{ old('text_color', $event->text_color) }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="start_datetime"><b>Start Date & Time</b></label>
                                                <input type="datetime-local" class="form-control" name="start_datetime"
                                                    id="start_datetime" required
                                                    value="{{ old('start_datetime', \Carbon\Carbon::parse($event->event_start)->format('Y-m-d\TH:i')) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label><b>End Date & Time</b></label>
                                                <input type="datetime-local" class="form-control" name="end_datetime"
                                                    required
                                                    value="{{ old('end_datetime', \Carbon\Carbon::parse($event->event_end)->format('Y-m-d\TH:i')) }}">
                                            </div>
                                        </div> --}}


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="start_datetime"><b>Start Date & Time</b></label>
                                                <input type="text" class="form-control faded-placeholder" name="start_datetime" id="start_datetime" required
                                                       value="{{ old('start_datetime', \Carbon\Carbon::parse($event->event_start)->format('d/m/Y H:i')) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label><b>End Date & Time</b></label>
                                                <input type="text" class="form-control faded-placeholder" name="end_datetime" id="end_datetime" required
                                                       value="{{ old('end_datetime', \Carbon\Carbon::parse($event->event_end)->format('d/m/Y H:i')) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label"><b>Description</b></label>
                                            <div class="form-floating mb-3">
                                                <!-- Textarea for Summernote -->
                                                <textarea id="summernote" name="description" class="form-control"
                                                    required placeholder="Enter Description...">{{ old('description', $event->description) }}

                                                 </textarea>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3 mt-4">
                                                <label></label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="active" value="1" {{ old('status', $event->status) == 1 ?
                                                    'checked' : '' }}>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="inactive" value="0" {{ old('status', $event->status) == 0 ?
                                                    'checked' : '' }}>
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="text-end">
                                        <input type="submit" class="btn btn-shadow btn-primary" value="Update">
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
        allowInput: true,
        defaultDate: "{{ old('start_datetime', \Carbon\Carbon::parse($event->event_start)->format('d/m/Y H:i')) }}"
    });

    flatpickr("#end_datetime", {
        enableTime: true,
        dateFormat: "d/m/Y H:i",
        allowInput: true,
        defaultDate: "{{ old('end_datetime', \Carbon\Carbon::parse($event->event_end)->format('d/m/Y H:i')) }}"
    });
</script>
@include('partials.footer')
@endsection
