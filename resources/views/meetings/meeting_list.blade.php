@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">



<!-- Manually include raw assets -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script>

<style>
    .thspace {
        margin-left: 67%;
    }

    .iti {
        width: 100%;
    }

    .eyebutton {
        position: absolute;
        top: 41%;
        right: 0px;
        height: 43px;
    }

    .nav-tabs .nav-link.active {
        border-bottom: 3px solid #007bff;
        color: #007bff;
        font-weight: bold;
        background-color: white
    }

    .nav-tabs .nav-link {
        border: none;
        color: #000000;
        transition: color 0.2s ease-in-out;
    }

    .nav-tabs .nav-link:hover {
        color: #007bff;
    }

    .nav-link.active i {
        background-color: #007bff
    }

    .nav-link:hover i {
        background-color: #007bff;
    }



    .img-radius {
        border-radius: 50%;
    }

    .wid-40 {
        width: 40px;
    }

    .f-12 {
        font-size: 12px;
    }

    .text-muted {
        color: #6c757d !important;
    }
</style>
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

                            <ul class="nav nav-tabs profile-tabs custom-profile-tabs" id="meetingTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="live-tab" data-bs-toggle="tab" href="#live"
                                        data-bs-target="#live" role="tab" aria-controls="live" aria-selected="true">
                                        <i class="material-icons-two-tone me-2">videocam</i>
                                        <span>Live Meetings</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="scheduled-tab" data-bs-toggle="tab" href="#scheduled"
                                        data-bs-target="#scheduled" role="tab" aria-controls="scheduled"
                                        aria-selected="false" tabindex="-1">
                                        <i class="material-icons-two-tone me-2">event</i>
                                        <span>Scheduled Meetings</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="ended-tab" data-bs-toggle="tab" href="#ended"
                                        data-bs-target="#ended" role="tab" aria-controls="ended" aria-selected="false"
                                        tabindex="-1">
                                        <i class="material-icons-two-tone me-2">stop_circle</i>
                                        <span>Ended Meetings</span>
                                    </a>
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
                                                    <td>{{ \Carbon\Carbon::parse($meeting->scheduled_at)->format('d M Y
                                                        h:i A') }}</td>
                                                    <td>
                                                        <span class="badge bg-success">Running</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('meetings.join') }}?meeting_id={{ $meeting->meeting_id }}&full_name={{ Auth::user()->name ?? 'Admin' }}&is_moderator=0"
                                                            class="btn btn-sm btn-success"
                                                            title="for join as users">Join</a>
                                                        <a href="{{ route('meetings.join') }}?meeting_id={{ $meeting->meeting_id }}&full_name={{ Auth::user()->name ?? 'Admin' }}&is_moderator=1"
                                                            class="btn btn-sm btn-primary" title="for join as host">Join
                                                            as Host</a>

                                                        <form action="{{ route('bbb.end') }}" method="POST"
                                                            style="display:inline-block;">
                                                            @csrf
                                                            <input type="hidden" name="meetingID"
                                                                value="{{ $meeting->meeting_id }}">
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                title="meeting end">End</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                                <div class="tab-pane fade" id="scheduled" role="tabpanel"
                                    aria-labelledby="scheduled-tab">
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
                                                    <td colspan="6" class="text-center">No Scheduled Meetings Found!
                                                    </td>
                                                </tr>
                                                @else
                                                @foreach ($scheduledMeetings as $index => $meeting)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $meeting->meeting_name }}</td>
                                                    <td>{{ $meeting->meeting_id }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($meeting->scheduled_at)->format('d M Y
                                                        h:i A') }}</td>
                                                    <td>
                                                        <span class="badge bg-warning">Scheduled</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('meetings.start', $meeting->id) }}"
                                                            class="btn btn-sm btn-primary">Start</a>
                                                        <button type="button" class="btn btn-sm btn-success"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#inviteModal-{{ $meeting->id }}">Invite</button>

                                                        <!-- Modal for Inviting Users -->
                                                        <div class="modal fade" id="inviteModal-{{ $meeting->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="inviteModalLabel-{{ $meeting->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="inviteModalLabel-{{ $meeting->id }}">
                                                                            Invite Users to Meeting: {{
                                                                            $meeting->meeting_name }}</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('meetings.invite', $meeting->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <!-- Search Box -->
                                                                            <div class="mb-3">
                                                                                <input type="text" class="form-control"
                                                                                    id="searchUsers-{{ $meeting->id }}"
                                                                                    placeholder="Search..."
                                                                                    data-meeting-id="{{ $meeting->id }}">
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <div class="form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        id="selectAll-{{ $meeting->id }}"
                                                                                        onclick="toggleCheckboxes('{{ $meeting->id }}')">
                                                                                    <label class="form-check-label"
                                                                                        for="selectAll-{{ $meeting->id }}">Select
                                                                                        All</label>
                                                                                </div>
                                                                            </div>
                                                                            @php
                                                                            $users = App\Models\User::where('id', '!=',
                                                                            Auth::id())->get();
                                                                            @endphp
                                                                            @if($users->isEmpty())
                                                                            <p>No users available to invite.</p>
                                                                            @else
                                                                            <div class="user-list"
                                                                                id="userList-{{ $meeting->id }}"
                                                                                style="max-height: 400px; overflow-y: auto;">
                                                                                @foreach($users as $user)
                                                                                <div
                                                                                    class="d-flex align-items-center mb-3 border-bottom pb-2 user-item">
                                                                                    <div class="flex-shrink-0 wid-40">
                                                                                        @if ($user->profile_picture)
                                                                                        <img class="img-radius"
                                                                                            src="{{ asset('storage/' . $user->profile_picture) }}"
                                                                                            alt="User image"
                                                                                            style="height:45px;width:45px;">
                                                                                        @else
                                                                                        <img class="img-radius"
                                                                                            src="{{ asset('asset/images/user/download.jpg') }}"
                                                                                            alt="Default image"
                                                                                            style="height:45px;width:45px;">
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="flex-grow-1 ms-3">
                                                                                        <h6>{{ $user->name }}</h6>
                                                                                        <p class="text-muted f-12 mb-0">
                                                                                            {{ $user->email }}</p>

                                                                                    </div>
                                                                                    <p class="text-muted f-14 mb-0"
                                                                                        style="margin-right:25px">
                                                                                        {{ $user->type ?? 'N/A' }}
                                                                                    </p>
                                                                                    <div class="form-check">
                                                                                        <input type="checkbox"
                                                                                            class="form-check-input user-checkbox-{{ $meeting->id }}"
                                                                                            name="user_ids[]"
                                                                                            value="{{ $user->id }}">
                                                                                    </div>
                                                                                </div>
                                                                                @endforeach
                                                                            </div>
                                                                            <p id="noResults-{{ $meeting->id }}"
                                                                                class="text-muted mt-3"
                                                                                style="display: none;">No users match
                                                                                your search.</p>
                                                                            @endif
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                          
                                                                            <button type="submit"
                                                                                class="btn btn-primary" {{
                                                                                $users->isEmpty() ? 'disabled' : ''
                                                                                }}>Send Invites</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                    <td>{{ \Carbon\Carbon::parse($meeting->scheduled_at)->format('d M Y
                                                        h:i A') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($meeting->updated_at)->format('d M Y
                                                        h:i A') }}</td>
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
<!-- JavaScript for Select All and AJAX Search -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Object to store debounce timers for each meeting ID
        const debounceTimers = {};

        // Attach event listeners to all search inputs
        const searchInputs = document.querySelectorAll('input[id^="searchUsers-"]');
        searchInputs.forEach(input => {
            input.addEventListener('input', function () {
                const meetingId = this.getAttribute('data-meeting-id');
                const searchTerm = this.value.trim();

                // Clear the previous timer for this meeting ID
                if (debounceTimers[meetingId]) {
                    clearTimeout(debounceTimers[meetingId]);
                }

                // Set a new timer to debounce the search
                debounceTimers[meetingId] = setTimeout(() => {
                    searchUsers(meetingId, searchTerm);
                }, 300); // 300ms delay
            });
        });
        });

        function searchUsers(meetingId, searchTerm) {
        console.log('Searching for meeting ID:', meetingId, 'with term:', searchTerm);

        const userList = document.getElementById('userList-' + meetingId);
        const noResultsMessage = document.getElementById('noResults-' + meetingId);

        if (!userList || !noResultsMessage) {
            console.error('Required elements not found:', {
                userList: !!userList,
                noResultsMessage: !!noResultsMessage
            });
            return;
        }

        // Make AJAX request to fetch filtered users
        fetch('{{ url('/') }}/meetings/invite/search/' + meetingId + '?search=' + encodeURIComponent(searchTerm), {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Received data:', data);

            // Clear the current user list
            userList.innerHTML = '';

            // Check if there are users to display
            if (data.users.length === 0) {
                noResultsMessage.style.display = 'block';
                userList.style.display = 'none';
            } else {
                noResultsMessage.style.display = 'none';
                userList.style.display = 'block';

                // Populate the user list with filtered users
                data.users.forEach(user => {
                    const userItem = document.createElement('div');
                    userItem.className = 'd-flex align-items-center mb-3 border-bottom pb-2 user-item';
                    userItem.innerHTML = `
                        <div class="flex-shrink-0 wid-40">
                            ${user.profile_picture ?
                                `<img class="img-radius" src="{{ url('storage') }}/${user.profile_picture}" alt="User image" style="height:45px;width:45px;">` :
                                `<img class="img-radius" src="{{ url('asset/images/user/download.jpg') }}" alt="Default image" style="height:45px;width:45px;">`
                            }
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6>${user.name || 'N/A'}</h6>
                            <p class="text-muted f-12 mb-0">${user.email || 'N/A'}</p>

                        </div>
                         <p class="text-muted f-14 mb-0" style="margin-right:12px">
                                                                                        {{ $user->type ?? 'N/A' }}
                                                                                    </p>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input user-checkbox-${meetingId}" name="user_ids[]" value="${user.id}">
                        </div>
                    `;
                    userList.appendChild(userItem);
                });
            }

            // Reset "Select All" checkbox
            const selectAllCheckbox = document.getElementById('selectAll-' + meetingId);
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = false;
            }
        })
        .catch(error => {
            console.error('Error fetching users:', error);
            noResultsMessage.style.display = 'block';
            userList.style.display = 'none';
        });
        }

        function toggleCheckboxes(meetingId) {
            console.log('Toggling checkboxes for meeting ID:', meetingId);

        const selectAllCheckbox = document.getElementById('selectAll-' + meetingId);
        const checkboxes = document.getElementsByClassName('user-checkbox-' + meetingId);

        if (!selectAllCheckbox) {
            console.error('Select All checkbox not found for meetingId:', meetingId);
            return;
        }

        for (let i = 0; i < checkboxes.length; i++) {
            const userItem = checkboxes[i].closest('.user-item');
            if (userItem && userItem.style.display !== 'none') {
                checkboxes[i].checked = selectAllCheckbox.checked;
            }
        }
     }
</script>
@include('partials.footer')
@endsection
