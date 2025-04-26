@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('pageTitle', 'Meeting create')

@section('content')
@include('partials.sidebar')
@include('partials.headerdashboard')

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Create Meeting</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Create Meeting</li>
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
                                <h5>Create Meeting</h5>
                            </div>

                            <div class="card-body">

                                <form id="permissionForm" action="{{ route('bbb.create') }}" method="post"
                                    autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Meeting Name: <span class="text-danger"
                                                        style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" name="meeting_name"
                                                    placeholder="Enter Name" value="{{ old('meeting_name') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Meeting ID: <span class="text-danger"
                                                        style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" name="meeting_id"
                                                    placeholder="Enter ID" value="{{ old('meeting_id') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Meeting Type:</label>
                                                <select name="meeting_type" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <option value="scheduled">Schedule</option>
                                                    <option value="instant">Instant</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 scheduled-fields" style="display: none;">
                                                <label>Schedule Date & Time:</label>
                                                <input type="datetime-local" name="scheduled_datetime"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Meeting Host password <span class="text-danger"
                                                        style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" name="meeting_admin_pw"
                                                    placeholder="Enter Host password...."
                                                    value="{{ old('meeting_admin_pw') }}" required>
                                            </div>
                                        </div>
                                        <script>
                                            document.querySelector('[name="meeting_type"]').addEventListener('change', function () {
                                                document.querySelector('.scheduled-fields').style.display = this.value === 'scheduled' ? 'block' : 'none';
                                            });
                                        </script>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Meeting Attend Password <span class="text-danger"
                                                        style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" name="meeting_attenduser_pw"
                                                    placeholder="Enter User Password"
                                                    value="{{ old('meeting_attenduser_pw') }}" required>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('#permissionForm').on('submit', function (e) {
        e.preventDefault(); // prevent default form submission

        let form = $(this);
        let url = form.attr('action');
        let formData = form.serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    confirmButtonText: 'OK'
                });

                // Optional: reset form or redirect
                form.trigger('reset');
            },
            error: function (xhr) {
                let errorMsg = "Something went wrong!";
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMsg = xhr.responseJSON.error;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMsg,
                    confirmButtonText: 'Close'
                });
            }
        });
    });
</script>



@include('partials.footer')
@endsection
