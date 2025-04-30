@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">

<!-- Manually include raw assets -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script>

@section('pageTitle', 'Tasks List')

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
                                <li class="breadcrumb-item" aria-current="page">Meeting List</li>
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
                        <div class="card-header">
                            <div class="row align-items-center g-2">
                                <div class="col">
                                    <h5>Meetings List</h5>
                                </div>
                                <div class="col-auto ms-auto">
                                    <a href="{{ route('meetings.index') }}" class="btn btn-outline-success btn-shadow">
                                        Meeting Create
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Tabs Navigation -->
                                <ul class="nav nav-tabs" id="meetingTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="live-tab" data-bs-toggle="tab"
                                                data-bs-target="#live" type="button" role="tab" aria-controls="live"
                                                aria-selected="true">Live Meetings</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="scheduled-tab" data-bs-toggle="tab"
                                                data-bs-target="#scheduled" type="button" role="tab" aria-controls="scheduled"
                                                aria-selected="false">Scheduled Meetings</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="ended-tab" data-bs-toggle="tab" data-bs-target="#ended"
                                                type="button" role="tab" aria-controls="ended" aria-selected="false">Ended
                                            Meetings</button>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content mt-3" id="meetingTabContent">
                                    <!-- Live Meetings Tab -->
                                    <div class="tab-pane fade show active" id="live" role="tabpanel"
                                         aria-labelledby="live-tab">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>ID</th>
                                                        <th>Scheduled At</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($liveMeetings->isEmpty())
                                                        <tr>
                                                            <td colspan="6" class="text-center">No Live Meetings Found!</td>
                                                        </tr>
                                                    @else
                                                        @foreach ($liveMeetings as $index => $meeting)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $meeting->meeting_name }}</td>
                                                                <td>{{ $meeting->meeting_id }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($meeting->scheduled_at)->format('d M Y h:i A') }}</td>
                                                                <td>
                                                                    <span class="badge bg-success">Running</span>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('meetings.join') }}?meeting_id={{ $meeting->meeting_id }}&full_name={{ Auth::user()->name ?? 'Admin' }}&is_moderator=1"
                                                                       class="btn btn-sm btn-primary">Host Join</a>
                                                                    <form action="{{ route('bbb.end') }}" method="POST"
                                                                          style="display:inline-block;">
                                                                        @csrf
                                                                        <input type="hidden" name="meetingID"
                                                                               value="{{ $meeting->meeting_id }}">
                                                                        <button type="submit"
                                                                                class="btn btn-sm btn-danger">End</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Scheduled Meetings Tab -->
                                    <div class="tab-pane fade" id="scheduled" role="tabpanel" aria-labelledby="scheduled-tab">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>ID</th>
                                                        <th>Scheduled At</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($scheduledMeetings->isEmpty())
                                                        <tr>
                                                            <td colspan="6" class="text-center">No Scheduled Meetings Found!</td>
                                                        </tr>
                                                    @else
                                                        @foreach ($scheduledMeetings as $index => $meeting)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $meeting->meeting_name }}</td>
                                                                <td>{{ $meeting->meeting_id }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($meeting->scheduled_at)->format('d M Y h:i A') }}</td>
                                                                <td>
                                                                    <span class="badge bg-warning">Scheduled</span>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('meetings.start', $meeting->id) }}"
                                                                       class="btn btn-sm btn-primary">Start</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Ended Meetings Tab -->
                                    <div class="tab-pane fade" id="ended" role="tabpanel" aria-labelledby="ended-tab">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>ID</th>
                                                        <th>Scheduled At</th>
                                                        <th>Ended At</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($endedMeetings->isEmpty())
                                                        <tr>
                                                            <td colspan="6" class="text-center">No Ended Meetings Found!</td>
                                                        </tr>
                                                    @else
                                                        @foreach ($endedMeetings as $index => $meeting)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $meeting->meeting_name }}</td>
                                                                <td>{{ $meeting->meeting_id }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($meeting->scheduled_at)->format('d M Y h:i A') }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($meeting->updated_at)->format('d M Y h:i A') }}</td>
                                                                <td>
                                                                    <span class="badge bg-danger">Ended</span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
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
</div>

@include('partials.footer')
@endsection
