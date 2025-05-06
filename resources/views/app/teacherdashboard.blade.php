@extends('layouts.app')

@section('pageTitle', 'Dashboard')

@section('content')

@include('partials.sidebar')
@include('partials.header')
<!-- Favicon -->
<link href="img/favicon.ico" rel="icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/fullcalendar/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar/main.min.js"></script>
<link href="public/css/bootstrap.min.css" rel="stylesheet">
<link href="public/css/style.css" rel="stylesheet">
{{--
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .fc-button-group {
        padding: 12px;
    }

    .fc-toolbar-title {
        text-transform: uppercase;
        /* Makes it ALL CAPS */
        width: 100%;
        /* Ensures full width for alignment to take effect */
    }

    .fc .fc-toolbar-title {
        font-size: 1.75em;
        margin: 0;
        font-size: 19px;
    }
</style>
<style>
    .fc-daygrid-event {
        display: block !important;
        width: 100% !important;
    }

    .fc-event-title {
        white-space: normal !important;
    }

    .fc-daygrid-event>div {
        width: 100%;
        display: block;
    }
</style>
<style>
    /* Remove FullCalendar default blue border */
    .fc-daygrid-event-harness {
        border: none !important;
    }

    .fc-daygrid-event {
        background-color: transparent !important;
        /* remove default bg */
        border: none !important;
        /* remove default border */
        padding: 0 !important;
    }

    /* Optional: remove hover blue highlight */
    .fc-daygrid-event:hover {
        background-color: transparent !important;
    }


        /* Change color of prev/next buttons */
.fc-button.fc-prev-button,
.fc-button.fc-next-button {
    background-color: #d4e7f9 !important;  /* Example: Amber */
    border: none !important;
    color: #2a19b6  !important; /* Text/icon color */
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(157, 2, 2, 0.1);
}

.fc-button.fc-prev-button:hover,
.fc-button.fc-next-button:hover {
    background-color: #d4e7f9 !important;  /* Darker on hover */
}



    /* Change color of prev/next buttons */
    .fc-button.fc-prev-button,
.fc-button.fc-next-button {
    background-color: #d4e7f9 !important;  /* Example: Amber */
    border: none !important;
    color: #2a19b6  !important; /* Text/icon color */
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(157, 2, 2, 0.1);
}

.fc-button.fc-prev-button:hover,
.fc-button.fc-next-button:hover {
    background-color: #d4e7f9 !important;  /* Darker on hover */
}
.material-icons-two-tone {
    background-color: #2a19b6}
</style>


<div class="pc-container">
    <div class="pc-content">
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-xxl-8">

                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10" style="font-size: 17px;">Welcome: {{ Auth::user()->name
                                                }}</h5>
                                        </div>
                                    </div>
                                    {{-- <div class="col-auto">
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item mt-1">
                                                <b>
                                                    <h4 style="color:#5a63ac"> @if ( Auth::user()->type =='Superadmin')
                                                        SuperAdmin @else {{
                                                        Auth::user()->type }} @endif</h4>
                                                </b>
                                            </li>

                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:25px">


                    <div class="col-md-6">
                        <div class="card dashnum-card dashnum-card-small overflow-hidden"><span
                                class="round bg-primary small"></span> <span class="round bg-primary big"></span>
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <div class="avtar avtar-lg bg-light-primary"><i class="text-primary ti ti-book"></i>
                                    </div>
                                    <div class="ms-2">
                                        <h4 class="mb-1"> {{ $courses
                                            }}</h4>

                                        <p class="mb-0 opacity-75 text-sm">Total Courses</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card dashnum-card dashnum-card-small overflow-hidden"><span
                                class="round bg-primary small"></span> <span class="round bg-primary big"></span>
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <div class="avtar avtar-lg bg-light-primary"><i class="text-primary ti ti-users"></i>
                                    </div>
                                    <div class="ms-2">
                                        <h4 class="mb-1"> {{ $student
                                            }}</h4>

                                        <p class="mb-0 opacity-75 text-sm">Total Students</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-6">
                        <div class="card  order-card" style="background-color: #aa33d4">
                            <div class="card-body">
                                <h5 class="text-white" style="font-size: 17px;">Total Courses</h5>
                                <h3 class="text-white" style="font-size: 17px;">{{ $courses
                                    }}</h3>
                                <p class="m-b-0" style="font-size: 13px;">&nbsp;</p>
                                <i class="material-icons-two-tone d-block f-46 card-icon text-white">note</i>

                            </div>
                        </div>



                    </div>
                    <div class="col-md-6">
                        <div class="card bg-primary order-card">
                            <div class="card-body">
                                <h5 class="text-white" style="font-size: 17px;">Total Students</h5>
                                <h3 class="text-white" style="font-size: 17px;">{{ $student
                                    }}</h3>
                                <p class="m-b-0" style="font-size: 13px;">&nbsp;</p>
                                <i class="material-icons-two-tone d-block f-46 card-icon text-white">account_circle</i>

                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="card table-card" style="display: none">
                    <div class="card-header">
                        <h5>Latest Meetings</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if($bbbmeetings->count()>0)
                            <div class="meetings-scroll" style="height: 310px; position: relative">
                                <table class="table table-hover table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align:center">#</th>
                                            <th scope="col">Meeting Name</th>
                                            <th scope="col">Meeting ID</th>
                                            <th scope="col">Scheduled At</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($bbbmeetings as $keys => $user)
                                        <tr>
                                            <td style="text-align:center">{{ $keys + 1 }}</td>
                                            <td>{{ \Illuminate\Support\Str::title($user->meeting_name) }}</td>
                                            <td>{{ $user->meeting_id }}</td>
                                            <td>{{ $user->scheduled_at->format('d M Y h:i A') }}</td>
                                            <td>
                                                @if($user->status == 'running' && $user->attendee_join_url)
                                                <span class="badge bg-light-success rounded-pill f-14">Running</span>
                                                @elseif($user->status == 'ended')
                                                    <span class="badge bg-light-danger rounded-pill f-14">Ended</span>
                                                @else
                                                    <span class="badge bg-light-warning rounded-pill f-14">Scheduled</span>
                                                @endif
                                            </td>
                                            <td> @if($user->status == 'running' && $user->attendee_join_url)
                                                <a href="{{ route('meetings.join', ['meeting_id' => $user->meeting_id, 'is_moderator' => 0]) }}" class="btn btn-sm btn-success"><span style="border-radius: 46px;">Join</span></a></td>
                                                @else
                                                ---
                                                @endif
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                            @else
                            <div id="no-meetings" class="d-flex align-items-center mt-2"
                                style="margin-left:12px; display: none;">
                                <tr>Data Not found!</tr>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        {{-- <a href="{{ route('meetings.list') }}" class="b-b-primary text-primary">View all</a> --}}
                    </div>
                </div>
                <div class="card table-card">
                    <div class="calendar-container">
                        <div id="calendar" style="padding:0px"></div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="eventModalBody">
                                <!-- Event details will be injected here -->
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card table-card">
                    <div class="card-header">
                        <h5>Latest Courses</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="customers-scroll" style="height: 310px; position: relative">
                                <table class="table table-hover table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align:center">#</th>
                                            <th scope=" col">Course</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Tags</th>
                                            <th scope="col">Rating</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($student_courses as $keys => $course)
                                        <tr>
                                            <td style="padding: 4px;text-align:center">{{ $keys + 1 }}</td>
                                            <td style="padding: 4px;">
                                                <div class="d-flex align-items-center" style="margin-top: -3px;">
                                                    <div class="flex-shrink-0 wid-40">
                                                        @if ($course->course_image)
                                                        <img class="img-radius"
                                                            src="{{ asset('storage/' . $course->course_image) }}"
                                                            alt="User image"
                                                            style="height:45px;width: 45px;margin-top:5px">
                                                        @else
                                                        <img class="img-radius"
                                                            src="{{ asset('asset/images/user/download.jpg') }}"
                                                            alt="Default image"
                                                            style="height:45px;width: 45px;margin-top:5px">
                                                        @endif
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6> {{
                                                            \Illuminate\Support\Str::limit($course->course_full_name,
                                                            30, '...') }}</h6>
                                                        <p class="text-muted f-12 mb-0">{{
                                                            $course->course_short_name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ucfirst($course->course_category) }}</td>
                                            <td>{{ $course->tags }}</td>
                                            <td>
                                                <div class="flex-shrink-0 me-2">
                                                    {{-- <strong class="text-muted">{{
                                                        number_format($course->rating, 1) }}</strong> --}}
                                                </div>

                                                <!-- Star Icons -->
                                                <div class="flex-grow-1">
                                                    @php
                                                    $rating = round($course->rating * 2) / 2;

                                                    $fullStars = floor($rating); // Full stars count
                                                    $halfStar = ($rating - $fullStars == 0.5) ? 1 : 0; // Half
                                                    // star logic
                                                    $emptyStars = 5 - $fullStars - $halfStar; // Empty stars
                                                    // count
                                                    @endphp

                                                    <!-- Full Stars -->
                                                    @for ($i = 0; $i < $fullStars; $i++) <i
                                                        class="fas fa-star text-warning"></i>
                                                        @endfor

                                                        <!-- Half Star -->
                                                        @if ($halfStar)
                                                        <i class="fas fa-star-half-alt text-warning"></i>
                                                        @endif

                                                        <!-- Empty Stars -->
                                                        @for ($i = 0; $i < $emptyStars; $i++) <i
                                                            class="far fa-star text-warning"></i>
                                                            @endfor
                                                            {{-- <small class="text-muted">&nbsp; ({{
                                                                number_format($course->total_users) }})</small> --}}
                                                </div>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end"><a href="{{ route('courses') }}"
                            class="b-b-primary text-primary">View
                            all</a></div>
                </div>




            </div>
            <div class="col-xxl-4">




                <div class="card table-card">
                    <div class="h-100 bg-light rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h5 class="mb-0">Notifications</h5>
                            <a href=""></a>
                        </div>
                        @foreach($notifications as $notification)
                        <a href="{{ $notification->data['url'] ?? '#' }}" class="text-decoration-none text-dark">
                            <div class="d-flex align-items-center border-bottom py-3">

                                <div class="user-avtar bg-light-success ms-2 rounded-circle d-flex justify-content-center align-items-center" style="width: 45px; height: 40px;">
                                    <i class="ti ti-bell"></i>
                                </div>
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">{{ $notification->data['title'] ?? 'No Title' }}</h6>
                                        <small>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans()
                                            }}</small>
                                    </div>
                                    <span>{{ strip_tags($notification->data['message'] ?? 'No message') }}</span>

                                </div>
                            </div>
                        </a>
                        @endforeach



                    </div>
                </div>
                <div class="card table-card">
                    <div class=""
                        style="border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                        <div class="card-header"
                            style="display: flex; justify-content: space-between; align-items: center;">
                            <h5 id="cardHeaderTitle" style=" font-weight: 500; margin: 0;">To Do List
                            </h5>


                            <div>
                                <button id="prevDateBtn" class="btn  btn-shadow"
                                    style="background-color: #d4e7f9; color: #2a19b6; border: none; padding: 6px 10px; border-radius: 5px; margin-right: 5px;"><i class="material-icons-two-tone">navigate_before</i></button>
                                <button id="nextDateBtn" class="btn  btn-shadow"
                                    style="background-color: #d4e7f9; color: #2a19b6; border: none; padding: 6px 10px; border-radius: 5px;"><i class="material-icons-two-tone">navigate_next</i></button>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 5px;">
                            <div class="table-responsive">
                                <div class="customers-scroll">
                                    <!-- Task List Container -->
                                    <div id="taskList">
                                        <!-- Tasks will be dynamically loaded here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer"
                            style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #f8f9fa; border-top: 1px solid #e0e0e0;">
                            <!-- Add Button on the Left -->
                            <a href="#" class="text-primary add-task-link" data-bs-toggle="modal"
                                data-bs-target="#addTaskModal"
                                style=" color: white; padding: 8px 16px; font-size: 0.875rem; text-decoration: none; border-radius: 4px;">Add
                                Task</a>
                            <!-- View All Link on the Right -->
                            <a href="{{ route('to_do_list') }}" class="text-primary"
                                style="font-size: 0.875rem; color: #007bff; text-decoration: none;">View all</a>
                        </div>
                    </div>
                </div>
                <!-- Modal for Adding Task -->
                <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addTaskForm">
                                    <div class="mb-3">
                                        <label for="taskInput" class="form-label">Task</label>
                                        <input type="text" class="form-control" id="taskInput" name="task"
                                            placeholder="Enter task" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dueDate" class="form-label">Due Date</label>
                                        <input type="date" class="form-control" id="dueDate" name="due_date" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button> --}}
                                <button type="button" class="btn btn-primary" onclick="saveTask()">Save Task</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- [ sample-page ] end -->
        </div><!-- [ Main Content ] end -->
    </div>
</div><!-- [ Main Content ] end -->
  <!-- Meeting Modal -->
  <div class="modal fade" id="meetingModal" tabindex="-1" aria-labelledby="meetingModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="meetingModalLabel"><i class="ti ti-video"></i> Meeting Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
          </div>
          <div class="modal-body" id="meetingModalBody">
              <!-- Meeting details will be injected here -->
          </div>
          <div class="modal-footer">
              <a id="meetingJoinLink" href="#" class="btn btn-success">Join</a>
          </div>
      </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js">
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: '',
                center: 'title',
                right: 'prev,next'
            },
            events: '/events',

            eventContent: function (arg) {
                const event = arg.event;
                const eventData = event.toPlainObject();
                console.log('Event Data:', eventData); // Log the full plain object

                // Extract colors from extendedProps with fallbacks
                const bgColor = eventData.extendedProps.background_color || event.get('backgroundColor') || '#bd7910';
                const textColor = eventData.extendedProps.text_color || event.get('textColor') || '#ffffff';
                console.log('Background Color:', bgColor, 'Text Color:', textColor);

                const fullTitle = event.title || '';
                const title = fullTitle.length > 10 ? fullTitle.slice(0, 10) + '…' : fullTitle;

                return {
                    html: `
                        <div style="background-color: ${bgColor} !important; padding: 5px 18px; border-radius: 5px; font-size: 13px; font-weight: 500; color: ${textColor} !important;margin-left: -2px; ">
                            ${title}
                        </div>`
                };
            },

            eventClick: function (info) {
                let event = info.event;
                let modalContent = `
                    <h5>Event on ${formatDate(event.start)}</h5>
                    <hr>
                    <p><strong>📌 Title:</strong> ${event.title}</p>
                    <p><strong>🕒 Start:</strong> ${formatDate(event.start)} ${formatTime(event.start)}</p>
                    <p><strong>⏳ End:</strong> ${event.end ? formatDate(adjustEndDate(event.end)) + ' ' + formatTime(adjustEndDate(event.end)) : 'Same as start'}</p>
                    <p><strong>📝 Description:</strong> ${event.extendedProps.description || 'No description provided'}</p>
                `;

                document.getElementById('eventModalBody').innerHTML = modalContent;
                new bootstrap.Modal(document.getElementById('eventModal')).show();
            }
        });

        calendar.render();
    });

    // Utility functions
    function formatDate(date) {
        return date ? new Date(date).toLocaleDateString('en-GB', {
            day: '2-digit', month: 'long', year: 'numeric'
        }) : 'Invalid Date';
    }

    function formatTime(date) {
        return date ? new Date(date).toLocaleTimeString('en-US', {
            hour: '2-digit', minute: '2-digit', hour12: true
        }) : 'Invalid Time';
    }

    function adjustEndDate(date) {
        if (!date) return null;
        let adjusted = new Date(date);
        adjusted.setDate(adjusted.getDate() - 1);
        return adjusted;
    }
</script> --}}

<script>
    // This route should match: route('meetings.join', ['meeting_id' => 'PLACEHOLDER', 'is_moderator' => 0])
    const meetingJoinRoute = @json(route('meetings.join', ['meeting_id' => 'PLACEHOLDER', 'is_moderator' => 0]));
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    // Meetings data passed from the controller
    const meetings = @json($bbbmeetings);

    // Transform meetings into FullCalendar event format
    const meetingEvents = meetings.map(meeting => ({
        title: meeting.meeting_name,
        start: meeting.scheduled_at,
        extendedProps: {
            type: 'meeting',
            meeting_id: meeting.meeting_id,
            status: meeting.status,
            scheduled_at: meeting.scheduled_at
        },
        backgroundColor: '#28a745', // Green to differentiate from events
        textColor: '#ffffff'
    }));

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: '',
            center: 'title',
            right: 'prev,next'
        },
        events: function(fetchInfo, successCallback, failureCallback) {
            // Fetch events from the /events endpoint
            fetch('/events')
                .then(response => response.json())
                .then(events => {
                    // Combine events and meetings
                    const allEvents = [
                        ...events.map(event => ({
                            ...event,
                            extendedProps: {
                                ...event.extendedProps,
                                type: 'event'
                            }
                        })),
                        ...meetingEvents
                    ];
                    successCallback(allEvents);
                })
                .catch(error => failureCallback(error));
        },

        eventContent: function (arg) {
            const event = arg.event;
            const eventData = event.toPlainObject();
            const isMeeting = eventData.extendedProps.type === 'meeting';

            // Colors for events and meetings
            const bgColor = isMeeting ? '#d4e7f9' : (eventData.extendedProps.background_color || '#d4e7f9');
            const textColor = isMeeting ? '#6141bc' : (eventData.extendedProps.text_color || '#6141bc');

            const fullTitle = event.title || '';
            const title = fullTitle.length > 10 ? fullTitle.slice(0, 10) + '…' : fullTitle;

            return {
                html: `
                    <div style="background-color: ${bgColor} !important; padding: 5px 18px; border-radius: 5px; font-size: 13px; font-weight: 500; color: ${textColor} !important; margin-left: -2px;">
                        ${title}
                    </div>`
            };
        },

        // eventClick: function (info) {
        //     const event = info.event;
        //     const props = event.extendedProps;

        //     if (props.type === 'meeting') {
        //         // Handle meeting click
        //         let modalContent = `
        //             <h5>Meeting on ${formatDate(event.start)}</h5>
        //             <hr>
        //             <p><strong>📌 Meeting Name:</strong> ${event.title}</p>
        //             <p><strong>🆔 Meeting ID:</strong> ${props.meeting_id}</p>
        //             <p><strong>🕒 Scheduled At:</strong> ${formatDateTime(new Date(props.scheduled_at))}</p>
        //             <p><strong>📊 Status:</strong> ${props.status.charAt(0).toUpperCase() + props.status.slice(1)}</p>
        //         `;

        //         document.getElementById('meetingModalBody').innerHTML = modalContent;
        //         const joinLink = document.getElementById('meetingJoinLink');
        //         joinLink.href = `/join-meeting/${props.meeting_id}`; // Adjust the URL as per your routing
        //         joinLink.style.display = props.status === 'running' ? 'inline-block' : 'none'; // Show Join button only if running

        //         new bootstrap.Modal(document.getElementById('meetingModal')).show();
        //     } else {
        //         // Handle event click (existing logic)
        //         let modalContent = `
        //             <h5>Event on ${formatDate(event.start)}</h5>
        //             <hr>
        //             <p><strong>📌 Title:</strong> ${event.title}</p>
        //             <p><strong>🕒 Start:</strong> ${formatDate(event.start)} ${formatTime(event.start)}</p>
        //             <p><strong>⏳ End:</strong> ${event.end ? formatDate(adjustEndDate(event.end)) + ' ' + formatTime(adjustEndDate(event.end)) : 'Same as start'}</p>
        //             <p><strong>📝 Description:</strong> ${props.description || 'No description provided'}</p>
        //         `;

        //         document.getElementById('eventModalBody').innerHTML = modalContent;
        //         new bootstrap.Modal(document.getElementById('eventModal')).show();
        //     }
        // }

        eventClick: function (info) {
const event = info.event;
const props = event.extendedProps;

if (props.type === 'meeting') {
    // Prepare modal content
    let modalContent = `
        <h5>Meeting on ${formatDate(event.start)}</h5>
        <hr>
        <p><strong>📌 Meeting Name:</strong> ${event.title}</p>
        <p><strong>🆔 Meeting ID:</strong> ${props.meeting_id}</p>
        <p><strong>🕒 Scheduled At:</strong> ${formatDateTime(new Date(props.scheduled_at))}</p>
        <p><strong>📊 Status:</strong> ${props.status.charAt(0).toUpperCase() + props.status.slice(1)}</p>
    `;

    // Inject content into modal
    document.getElementById('meetingModalBody').innerHTML = modalContent;

    // Generate full join link from Laravel route
    const joinLink = document.getElementById('meetingJoinLink');
    joinLink.href = meetingJoinRoute.replace('PLACEHOLDER', props.meeting_id);
    joinLink.style.display = props.status === 'running' ? 'inline-block' : 'none'; // Show only if running

    // Show modal
    new bootstrap.Modal(document.getElementById('meetingModal')).show();
} else {
    // Handle event
    let modalContent = `
        <h5>Event on ${formatDate(event.start)}</h5>
        <hr>
        <p><strong>📌 Title:</strong> ${event.title}</p>
        <p><strong>🕒 Start:</strong> ${formatDate(event.start)} ${formatTime(event.start)}</p>
        <p><strong>⏳ End:</strong> ${event.end ? formatDate(adjustEndDate(event.end)) + ' ' + formatTime(adjustEndDate(event.end)) : 'Same as start'}</p>
        <p><strong>📝 Description:</strong> ${props.description || 'No description provided'}</p>
    `;
    document.getElementById('eventModalBody').innerHTML = modalContent;
    new bootstrap.Modal(document.getElementById('eventModal')).show();
}
}
    });

    calendar.render();
});

// Utility functions
function formatDate(date) {
    return date ? new Date(date).toLocaleDateString('en-GB', {
        day: '2-digit', month: 'long', year: 'numeric'
    }) : 'Invalid Date';
}

function formatTime(date) {
    return date ? new Date(date).toLocaleTimeString('en-US', {
        hour: '2-digit', minute: '2-digit', hour12: true
    }) : 'Invalid Time';
}

function formatDateTime(date) {
    return date ? `${formatDate(date)} ${formatTime(date)}` : 'Invalid DateTime';
}

function adjustEndDate(date) {
    if (!date) return null;
    let adjusted = new Date(date);
    adjusted.setDate(adjusted.getDate() - 1);
    return adjusted;
}
</script>


<script>
    $(document).ready(function () {
            // Set up CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Set the default due date to the current date
            let currentDate = new Date();
            $('#dueDate').val(currentDate.toISOString().split('T')[0]);

            // Load tasks for the current date on page load
            loadTasks(currentDate);

            // Previous button click
            $('#prevDateBtn').click(function () {
                currentDate.setDate(currentDate.getDate() - 1);
                loadTasks(currentDate);
            });

            // Next button click
            $('#nextDateBtn').click(function () {
                currentDate.setDate(currentDate.getDate() + 1);
                loadTasks(currentDate);
            });

            // Event delegation for checkbox changes
            $('#taskList').on('change', '.task-checkbox', function () {
                const taskId = $(this).data('id');
                const isChecked = this.checked;
                toggleTaskCompletion(taskId, isChecked);
            });

            // Save a new task
            window.saveTask = function () {
                const task = $('#taskInput').val().trim();
                const dueDate = $('#dueDate').val();

                if (!task || !dueDate) {
                    alert('Please fill in all fields!');
                    return;
                }

                $.ajax({
                    url: '/api/todos',
                    method: 'POST',
                    data: {
                        task: task,
                        due_date: dueDate,
                        completed: 0 // Default to 0 (not completed)
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#addTaskModal').modal('hide');
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                            $('#addTaskForm')[0].reset();
                            $('#dueDate').val(currentDate.toISOString().split('T')[0]); // Reset to current date
                            loadTasks(currentDate);
                        } else {
                            alert('Failed to save task: ' + response.message);
                        }
                    },
                    error: function (xhr) {
                        alert('Error saving task: ' + xhr.responseText);
                    }
                });
            };

            // Load tasks for a specific date
            function loadTasks(date) {
                const formattedDateForApi = date.toISOString().split('T')[0];
                $.ajax({
                    url: '/api/todos',
                    method: 'GET',
                    data: { date: formattedDateForApi }, // Pass the date as a query parameter
                    success: function (response) {
                        const taskList = $('#taskList');
                        taskList.empty();

                        // Update the header with the selected date
                        const formattedDate = date.toLocaleDateString("en-GB", { day: "numeric", month: "long", year: "numeric" });
                        const headerText = `To Do List <span style="font-size: 0.875rem; color: #666; margin-left: 5px;">( ${formattedDate} )</span>`;
                        $('#cardHeaderTitle').html(headerText);

                        if (response.length === 0) {
                            taskList.append('<p style="margin-left: 24px;">No tasks available.</p>');
                            return;
                        }

                        response.forEach(function (task) {
                            const isCompleted = task.completed === 1 || task.completed === true;
                            const taskItem = `
                                        <div style="transition: all 0.3s ease;margin-left: 14px; margin-right: 12px;" class="d-flex align-items-center border-bottom py-2">

                                            <input type="checkbox" class="form-check-input m-0 task-checkbox" data-id="${task.id}" ${isCompleted ? 'checked' : ''} >
                                            <div class="w-100 ms-3">
                                                <div class="d-flex w-100 align-items-center justify-content-between">
                                                    <span style="font-size: 0.875rem; color: ${isCompleted ? '#888' : '#333'}; ${isCompleted ? 'text-decoration: line-through;' : ''}">${task.task}</span>
                                                    <button class="btn btn-sm" onclick="deleteTask('${task.id}')"><i class="fa fa-trash" style="font-size: 0.875rem; color: #888;"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                            taskList.append(taskItem);
                        });

                        // Add hover effects using jQuery
                        $('.fa-trash').hover(
                            function() { $(this).css('color', '#333'); },
                            function() { $(this).css('color', '#888'); }
                        );

                        $('.btn-primary').hover(
                            function() { $(this).css({ 'background-color': '#0056b3', 'border-color': '#004085' }); },
                            function() { $(this).css({ 'background-color': '#007bff', 'border-color': '#007bff' }); }
                        );

                        $('.text-primary').hover(
                            function() { $(this).css('text-decoration', 'underline'); },
                            function() { $(this).css('text-decoration', 'none'); }
                        );
                    },
                    error: function (xhr) {
                        alert('Error loading tasks: ' + xhr.responseText);
                    }
                });
            }

            // Toggle task completion status
            window.toggleTaskCompletion = function (taskId, isChecked) {
                const completedValue = isChecked ? 1 : 0;

                $.ajax({
                    url: `/api/todos/${taskId}/complete`,
                    method: 'PATCH',
                    data: {
                        completed: completedValue
                    },
                    success: function (response) {
                        if (response.success) {
                            loadTasks(currentDate);
                        } else {
                            alert('Failed to update task: ' + response.message);
                        }
                    },
                    error: function (xhr) {
                        alert('Error updating task: ' + xhr.responseText);
                    }
                });
            };

                   // Delete a task with SweetAlert confirmation
                        window.deleteTask = function (taskId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to delete this task?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/api/todos/${taskId}`,
                            method: 'DELETE',
                            success: function (response) {
                                if (response.success) {
                                    loadTasks(currentDate);
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Your task has been deleted.',
                                        icon: 'success',
                                        showConfirmButton: false, // Hide the "OK" button
                                        timer: 1500 // Auto-close after 2 seconds (2000 milliseconds)
                                    });
                                } else {
                                    alert('Failed to delete task: ' + response.message);
                                }
                            },
                            error: function (xhr) {
                                alert('Error deleting task: ' + xhr.responseText);
                            }
                        });
                    }
                });
            };
        });
</script>



@include('partials.footer')
@endsection
