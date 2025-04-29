@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@section('pageTitle', ' Roles Create')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('content')
@include('partials.sidebar')
@include('partials.header')
<style>
    .required-asterisk {
        color: red;
        font-weight: bold;
    }
</style>
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Meetings</h5>
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
                                <h1 class="text-2xl font-bold mb-4">Meeting Created Successfully</h1>
                            </div>

                            <div class="card-body">

                                <h5 class="card-title">Meeting Details</h5>
                                <p><strong>Meeting ID:</strong> {{ $meetingId }}</p>
                                <p><strong>Meeting Name:</strong> {{ $meeting->meeting_name }}</p>
                                <p><strong>Status:</strong> {{ $meeting->status }}</p>
                                <p><strong>Scheduled At:</strong> {{ \Carbon\Carbon::parse($meeting->scheduled_at)->format('d/M/Y h:i A') }}</p>

                                <div class="mt-3">
                                    <a href="{{ $joinUrl }}" class="btn btn-primary" target="_blank">Join as Host</a>
                                </div>
                                <div class="mt-3">
                                    <p><strong>Attendee Join Link:</strong></p>
                                    <input type="text" class="form-control" value="{{ $attendeeJoinUrl }}" readonly>
                                    <button class="btn btn-secondary mt-2" onclick="navigator.clipboard.writeText('{{ $attendeeJoinUrl }}')">Copy join Link</button>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@include('partials.footer')
@endsection
