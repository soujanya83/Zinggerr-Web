@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
{{--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@section('pageTitle', ' Roles Create')
{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script>
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
                                <h5>Create Meeting</h5>
                            </div>

                            <div class="card-body">

                                <form id="createMeetingForm" action="{{ route('meetings.create_store') }}" method="POST"
                                    autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="meetingNameInput">Meeting Name <span class="text-danger"
                                                        style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" id="meetingNameInput"
                                                    name="meeting_name" placeholder="Enter Meeting Name"
                                                    value="{{ old('meeting_name') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="meetingIdInput">Meeting ID <span class="text-danger"
                                                        style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" id="meetingIdInput"
                                                    name="meeting_id" placeholder="Enter Meeting ID"
                                                    value="{{ old('meeting_id', Str::random(10)) }}" required
                                                    oninput="this.value = this.value.replace(/\s/g, '')">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="meetingTypeInput">Meeting Type <span class="text-danger"
                                                        style="font-weight: bold;">*</span></label>
                                                <select class="form-control" id="meetingTypeInput" name="meeting_type"
                                                    required>
                                                    <option value="instant" {{ old('meeting_type', 'instant'
                                                        )=='instant' ? 'selected' : '' }}>Instant</option>
                                                    <option value="scheduled" {{ old('meeting_type')=='scheduled'
                                                        ? 'selected' : '' }}>Scheduled</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-4" id="scheduledAtContainer" style="display: none;">
                                            <div class="mb-3">
                                                <label for="scheduled_at">Scheduled At <span class="text-danger"
                                                        style="font-weight: bold;">*</span></label>
                                                <input type="text" id="scheduled_at" name="scheduled_at"
                                                    class="form-control" disabled>

                                            </div>
                                        </div>--}}

                                        <div class="col-md-4" id="scheduledAtContainer" style="display: none;">
                                            <div class="mb-3">
                                                <label for="scheduled_at"><b>Start Date & Time</b> <span
                                                        class="text-danger" style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control faded-placeholder" disabled
                                                    id="scheduled_at" name="scheduled_at"
                                                    placeholder="dd/mm/yyyy HH:mm AM/PM"
                                                    value="{{ old('scheduled_at') }}">
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="meetingAdminPwInput">Moderator Password <span
                                                        class="text-danger" style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" id="meetingAdminPwInput"
                                                    name="meeting_admin_pw" placeholder="Enter Moderator Password"
                                                    value="{{ old('meeting_admin_pw') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="meetingAttenduserPwInput">Attendee Password <span
                                                        class="text-danger" style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" id="meetingAttenduserPwInput"
                                                    name="meeting_attenduser_pw" placeholder="Enter Attendee Password"
                                                    value="{{ old('meeting_attenduser_pw') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-shadow btn-primary">Create Meeting</button>
                                    </div>
                                </form>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        let isPickerOpened = false;

                                        const scheduledAtPicker = flatpickr("#scheduled_at", {
                                            enableTime: true,
                                            dateFormat: "d/m/Y H:i",
                                            defaultDate: new Date(),
                                            time_24hr: false,
                                            minuteIncrement: 1,
                                            disableMobile: true,
                                            clickOpens: true,
                                            allowInput: true,
                                            onReady: function(selectedDates, dateStr, instance) {
                                                const now = new Date();
                                                instance.setDate(now);
                                                instance.input.value = instance.formatDate(now, "d/m/Y H:i");
                                            },
                                            onChange: function(selectedDates, dateStr, instance) {
                                                if (selectedDates.length > 0) {
                                                    let formattedDate = instance.formatDate(selectedDates[0], "d/m/Y H:i");
                                                    instance.input.value = formattedDate;
                                                }
                                            }
                                        });

                                        const meetingTypeInput = document.getElementById('meetingTypeInput');
                                        const scheduledAtContainer = document.getElementById('scheduledAtContainer');
                                        const scheduledAtInput = document.getElementById('scheduled_at');

                                        function toggleScheduledAtField() {
                                            if (meetingTypeInput.value === 'scheduled') {
                                                scheduledAtContainer.style.display = 'block';
                                                scheduledAtInput.removeAttribute('disabled');
                                                scheduledAtInput.setAttribute('required', 'required');
                                                if (!isPickerOpened) {
                                                    scheduledAtPicker.open();
                                                    isPickerOpened = true;
                                                }
                                            } else {
                                                scheduledAtContainer.style.display = 'none';
                                                scheduledAtInput.setAttribute('disabled', 'disabled');
                                                scheduledAtInput.removeAttribute('required');
                                                scheduledAtInput.value = '';
                                                scheduledAtPicker.close();
                                                isPickerOpened = false;
                                            }
                                        }

                                        toggleScheduledAtField();
                                        meetingTypeInput.addEventListener('change', toggleScheduledAtField);

                                        document.getElementById('createMeetingForm').addEventListener('submit', function(e) {
                                            if (meetingTypeInput.value === 'scheduled') {
                                                const scheduledValue = scheduledAtInput.value.trim();
                                                if (!scheduledValue) {
                                                    e.preventDefault();
                                                    alert('Scheduled At is required.');
                                                    scheduledAtInput.focus();
                                                    return;
                                                }

                                                const parsedDate = scheduledAtPicker.parseDate(scheduledValue, "d/m/Y h:i A");

                                                if (!parsedDate) {
                                                    e.preventDefault();
                                                    alert('Scheduled At must match the format dd/mm/yyyy hh:mm AM/PM.');
                                                    scheduledAtInput.focus();
                                                    return;
                                                }
                                            }
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
</div>


@include('partials.footer')
@endsection
