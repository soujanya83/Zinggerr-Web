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
                                            <h5 class="m-b-10" style="font-size: 18px;">Welcome: {{ Auth::user()->name
                                                }}</h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:25px">

                    <div class="col-md-6">
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
                                <h5 class="text-white" style="font-size: 17px;">Total Teachers</h5>
                                <h3 class="text-white" style="font-size: 17px;">{{ $teacher
                                    }}</h3>
                                <p class="m-b-0" style="font-size: 13px;">&nbsp;</p>
                                <i class="material-icons-two-tone d-block f-46 card-icon text-white">account_circle</i>

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
                <div class="card table-card">
                    <div class=""
                        style="border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                        <div class="card-header"
                            style="display: flex; justify-content: space-between; align-items: center;">
                            <h5 id="cardHeaderTitle" style=" font-weight: 500; margin: 0;">To Do List
                            </h5>


                            <div>
                                <button id="prevDateBtn"
                                    style="background-color: #2c3e50; color: white; border: none; padding: 5px 10px; border-radius: 5px; margin-right: 5px;">&lt;</button>
                                <button id="nextDateBtn"
                                    style="background-color: #2c3e50; color: white; border: none; padding: 5px 10px; border-radius: 5px;">&gt;</button>
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
            </div>
            <div class="col-xxl-4">


                <div class="card table-card">
                    <div class="calendar-container">
                        <div id="calendar" style="padding:8px"></div>
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
                    <div class="h-100 bg-light rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h5 class="mb-0">Notifications</h5>
                            <a href=""></a>
                        </div>
                        @foreach($notifications as $notification)
                        <a href="{{ $notification->data['url'] ?? '#' }}" class="text-decoration-none text-dark">
                            <div class="d-flex align-items-center border-bottom py-3">

                                @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="user-image"
                                    class="user-avatar" style="width: 40px; height: 40px;">
                                @else
                                <img src="{{ asset('asset/images/user/download.jpg') }}" alt="image" class="user-avatar"
                                    style="width: 40px; height: 40px;">
                                @endif
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">{{ $notification->data['title'] ?? 'No Title' }}</h6>
                                        <small>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans()
                                            }}</small>
                                    </div>
                                    <span>{{ $notification->data['message'] ?? 'No message' }}</span>
                                </div>
                            </div>
                        </a>
                        @endforeach



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


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js">
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    // Define an array of pastel colors
    const colors = [
      '#bd7910', '#9a0b0b', '#5048c7', '#0b8245', '#bd1995', '#8642ba','#2f979a'

    ];

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: '',
            center: 'title',
            right: 'prev,next'
        },
        events: '/events', // Fetch events from API

        // Customize event rendering
        eventContent: function (arg) {
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            return {
                html: `<div class="event-box" style="background-color: ${randomColor}; padding: 5px; border-radius: 1px;">
                        <strong style='margin-left: -5px;'>${arg.event.title}</strong>
                    </div>`
            };
        },

        eventClick: function (info) {
            if (!info.event.extendedProps || !info.event.extendedProps.events) {
                console.warn('No event data found.');
                return;
            }

            let events = info.event.extendedProps.events;

            let modalContent = `<h5>${events.length} Events on ${formatDate(info.event.start)}</h5>`;

            events.forEach(event => {
                modalContent += `
                    <hr>
                    <p><strong>📌 Title:</strong> ${event.event_topic || 'N/A'}</p>
                    <p><strong>🕒 Start:</strong> ${formatDate(event.event_start)} ${formatTime(event.event_start)}</p>
                    <p><strong>⏳ End:</strong> ${formatDate(event.event_end)} ${formatTime(event.event_end)}</p>
                    <p><strong>📝 Description:</strong> ${event.description || 'No description provided'}</p>
                `;
            });

            // Inject content into the modal
            document.getElementById('eventModalBody').innerHTML = modalContent;

            // Show modal
            var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
            eventModal.show();
        }
    });

    calendar.render();
});

// ✅ Helper functions (Moved Outside)
function formatDate(date) {
    return date ? new Date(date).toLocaleDateString('en-GB', { day: '2-digit', month: 'long', year: 'numeric' }) : 'Invalid Date';
}

function formatTime(date) {
    return date ? new Date(date).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true }) : 'Invalid Time';
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
