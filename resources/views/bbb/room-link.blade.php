@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Manually include raw assets -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script>

@section('pageTitle', 'Meeting Room')

@section('content')
@include('partials.sidebar')
@include('partials.header')

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
                            <li class="breadcrumb-item" aria-current="page">Meeting Room</li>
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

        <div class="row">
            <div class="tab-pane" id="request" role="tabpanel" aria-labelledby="request-tab">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-2xl font-bold mb-0">Meeting Room</h1>
                    </div>
                    <div class="card-body">
                        <!-- Meeting Details -->
                        <div class="mb-2">
                            <h5 class="mb-2"><strong>Meeting Details</strong></h5>
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <label class="form-label"><strong>Meeting Name:</strong></label>
                                    <p class="form-control-static">{{ $meeting->meeting_name }}</p>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="form-label"><strong>Meeting ID:</strong></label>
                                    <p class="form-control-static">{{ $meeting->meeting_id }}</p>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="form-label"><strong>Scheduled At:</strong></label>
                                    <p class="form-control-static">{{ $meeting->scheduled_at->format('d/m/Y H:i') }}</p>
                                </div>
                                {{-- <div class="col-md-6 mb-1">
                                    <label class="form-label"><strong>Moderator Password:</strong></label>
                                    <p class="form-control-static">{{ $meeting->moderator_pw }}</p>
                                </div> --}}
                                <div class="col-md-6 mb-1">
                                    <label class="form-label"><strong>Attendee Password:</strong></label>
                                    <p class="form-control-static">{{ $meeting->attendee_pw }}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- Moderator Join Link -->
                        <div class="mb-2">
                            {{-- <label class="form-label"><strong>Moderator Join Link</strong></label> --}}
                            <div class="url-container" style="display: none">
                                <input type="text" class="form-control url-input" value="{{ $joinUrl }}"
                                    id="moderatorJoinUrl" readonly>
                                <button type="button" class="btn btn-outline-primary copy-btn"
                                    onclick="copyToClipboard('moderatorJoinUrl')">Copy</button>
                            </div>
                            <a href="{{ $joinUrl }}" class="btn btn-success mt-1" target="_blank">Join as Host</a>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Attendee Join Link</strong></label>
                            <div class="url-container">
                                <input type="text" class="form-control url-input"
                                    value="{{ $attendeeJoinUrl }}" id="attendeeJoinUrl" readonly>
                                <button type="button" class="btn btn-outline-primary copy-btn mt-1"
                                    onclick="copyToClipboard('attendeeJoinUrl')">Copy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    function copyToClipboard(elementId) {
        const input = document.getElementById(elementId);
        input.select();
        document.execCommand('copy');
        alert('Link copied to clipboard!');
    }
</script>
@include('partials.footer')
@endsection
