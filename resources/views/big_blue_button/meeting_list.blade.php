@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
@section('pageTitle', ' Tasks List')

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
                            <div class="col-auto ms-auto"> {{-- Push this column to the right --}}
                                <a href="{{ route('bbb.create.form') }}" class="btn btn-outline-success btn-shadow">
                                    Meeting Create
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <h5>Live Meetings (Instant)</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>ID</th>
                                        <th>Participants</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($bbbMeetings) > 0)
                                        @forelse ($bbbMeetings as $index => $meeting)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $meeting->getMeetingName() }}</td>
                                                <td>{{ $meeting->getMeetingID() }}</td>
                                                <td>{{ $meeting->getParticipantCount() }}</td>
                                                <td>
                                                    <span class="badge {{ $meeting->isRunning() ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $meeting->isRunning() ? 'Running' : 'Ended' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{-- @if($meeting->isRunning()) --}}
                                                        <a href="{{ route('bbb.join', ['meetingID' => $meeting->getMeetingID(), 'userName' => Auth::user()->name]) }}?isModerator=1" class="btn btn-sm btn-primary">Join</a>
                                                        <form action="{{ route('bbb.end') }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            <input type="hidden" name="meetingID" value="{{ $meeting->getMeetingID() }}">
                                                            <button type="submit" class="btn btn-sm btn-danger">End</button>
                                                        </form>
                                                    {{-- @else
                                                        <span class="text-muted">Meeting Ended</span>
                                                    @endif --}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="6" class="text-center">No Live Meetings Found!</td></tr>
                                        @endforelse
                                    @else
                                        <tr class="nodata">
                                            <td colspan="6" class="text-center">No Meetings Found!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <h5 class="mt-4">Scheduled Meetings</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>ID</th>
                                        <th>Scheduled At</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($scheduledMeetings) > 0)
                                        @forelse ($scheduledMeetings as $index => $meeting)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $meeting->meeting_name }}</td>
                                                <td>{{ $meeting->meeting_id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($meeting->scheduled_at)->format('d M Y h:i A') }}</td>
                                                <td>
                                                    <span class="badge bg-warning">Scheduled</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="5" class="text-center">No Scheduled Meetings</td></tr>
                                        @endforelse
                                    @else
                                        <tr class="nodata">
                                            <td colspan="5" class="text-center">No Meetings Found!</td>
                                        </tr>
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
<!-- Task Details Modal -->
<div class="modal fade" id="taskDetailModal" tabindex="-1" role="dialog" aria-labelledby="taskDetailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskDetailModalLabel">Task Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalContent">
                    <p><strong>Title:</strong> <span id="modalTitle"></span></p>
                    <p><strong>Description:</strong> <span id="modalDescription"></span></p>
                    <p><strong>Deadline:</strong> <span id="modalDate"></span></p>
                    <p><strong>Created By:</strong> <span id="modalCreator"></span></p>
                    <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div> --}}
        </div>
    </div>
</div>

<div class="modal fade" id="assignedUsersModal" tabindex="-1" role="dialog" aria-labelledby="assignedUsersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignedUsersModalLabel">Assigned Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="text" id="userSearch" style="width:90%;margin-left: 23px;" class="form-control"
                placeholder="Search roles or users..." />

            <div class="modal-body">
                <ul id="assignedUsersList">
                    <!-- User list will be loaded here dynamically -->
                </ul>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on("click", ".delete-task", function (e) {
    e.preventDefault();
    let taskId = $(this).data("id");

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('task.delete', ':id') }}".replace(':id', taskId),
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Task has been deleted.",
                            icon: "success",
                            timer: 1500, // Show for 1.5 seconds
                            showConfirmButton: false
                        });

                        // Find the closest <tr> of the clicked delete button and fade out
                        $("a.delete-task[data-id='" + taskId + "']").closest("tr").fadeOut(300, function () {
                            $(this).remove();
                        });

                    } else {
                        Swal.fire("Error!", "Task could not be deleted.", "error");
                    }
                },
                error: function () {
                    Swal.fire("Error!", "Something went wrong. Try again.", "error");
                }
            });
        }
    });
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
    $('.task-row').click(function(e) {

        var title = $(this).data('title');
        var description = $(this).data('description');
        var date = $(this).data('date');
        var creator = $(this).data('creator');
        var status = $(this).data('status');

        // Populate modal with data
        $('#modalTitle').text(title);
        $('#modalDescription').html(description);
        $('#modalDate').text(date);
        $('#modalCreator').text(creator);
        $('#modalStatus').text(status);

        // Show the modal
        $('#taskDetailModal').modal('show');
    });

    // Fix black screen issue by removing the backdrop when the modal is hidden
    $('#taskDetailModal').on('hidden.bs.modal', function () {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
    });
});
</script>

<script>
    $(document).ready(function () {
        $(".status-badge").click(function () {
            let badge = $(this);
            let eventId = badge.data("id");
            let currentStatus = badge.data("status");

            // Toggle status
            let newStatus = currentStatus == 1 ? 0 : 1;

            $.ajax({
                url: "{{ route('task.status.update') }}", // Define this route in web.php
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: eventId,
                    status: newStatus
                },
                success: function (response) {
                    if (response.success) {
                        // Update badge color and text
                        badge.data("status", newStatus);
                        badge.removeClass("bg-success bg-danger")
                            .addClass(newStatus == 1 ? "bg-success" : "bg-danger")
                            .text(newStatus == 1 ? "Active" : "Inactive");

                        // Show SweetAlert notification for 2 seconds
                        Swal.fire({
                            icon: "success",
                            title: "Status Updated",
                            text: "The task status has been updated successfully!",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire("Error", "Failed to update status!", "error");
                    }
                },
                error: function () {
                    Swal.fire("Error", "Something went wrong!", "error");
                }
            });
        });
    });
</script>



<script>
    function filterUsers(input) {
        var filter = input.value.toLowerCase();
        $('.user-list-container label').each(function() {
            var text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(filter));
        });
    }

    $(document).ready(function() {
        // Prevent dropdown from closing when clicking inside it
        $('.keep-open-dropdown').on('click', function(event) {
            event.stopPropagation();
        });

        // Keep dropdown open when selecting checkboxes
        $('.assign-checkbox, .task-checkbox, #selectAllUsers, #selectAllTasks').on('click', function(event) {
            event.stopPropagation();
        });

        // Select All Users
        $('#selectAllUsers').on('change', function() {
            $('.user-checkbox').prop('checked', $(this).prop('checked'));
        });

        // Select All Tasks
        $('#selectAllTasks').on('change', function() {
            $('.task-checkbox').prop('checked', $(this).prop('checked'));
            toggleAssignButton();
        });

        // Ensure Assign Button is Enabled
        $('.task-checkbox, .assign-checkbox').on('change', function() {
            toggleAssignButton();
        });

        function toggleAssignButton() {
            let selectedTasks = $('.task-checkbox:checked').length > 0;
            let selectedUsers = $('.assign-checkbox:checked').length > 0;
            $('#bulkAssignBtn').prop('disabled', !(selectedTasks && selectedUsers));
        }

        // Assign Task Button Click
        $('#bulkAssignBtn').on('click', function() {
            let selectedTasks = $('.task-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            let selectedUsers = $('.assign-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedTasks.length === 0 || selectedUsers.length === 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Oops...",
                    text: "Please select at least one task and one user!"
                });
                return;
            }

            $.ajax({
                url: "{{ route('task.assign') }}", // Ensure this is your actual route
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    tasks: selectedTasks,
                    user_ids: selectedUsers
                },
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Tasks assigned successfully!",
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); // Reload page after 2 sec
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Something went wrong. Please try again."
                    });
                }
            });
        });
    });
</script>


<script>
    $(document).on("click", ".view-assigned-users", function () {
    let taskId = $(this).data("id");

    $.ajax({
        url: "{{ route('task.assigned_users', ':id') }}".replace(':id', taskId),
        type: "GET",
        success: function (response) {
            let usersList = $("#assignedUsersList");
            usersList.empty();

            if (response.success) {
                let usersData = response.users; // Store user data for filtering

                usersData.forEach(user => {
                    let formattedName = user.name.replace(/\b\w/g, char => char.toUpperCase()); // Capitalize name
                    let formattedRole = user.type.charAt(0).toUpperCase() + user.type.slice(1); // Capitalize role

                    let profileImage = user.profile_picture
                        ? `{{ asset('storage/') }}/${user.profile_picture}`
                        : `{{ asset('asset/images/download.jpg') }}`;

                    let listItem = `
                        <li class="user-item"
                            data-name="${formattedName.toLowerCase()}"
                            data-role="${formattedRole.toLowerCase()}"
                            style="display: flex; align-items: center; margin-bottom: 10px;">
                            <img class="img-radius" src="${profileImage}" alt="User image"
                                style="height: 40px; width: 40px; border-radius: 50%; margin-right: 10px;">
                            <span>${formattedName} (${formattedRole}) - Assigned: ${user.assignData}</span>
                        </li>
                    `;
                    usersList.append(listItem);
                });

                // Attach filter event after users are loaded
                $("#userSearch").on("keyup", function () {
                    let searchText = $(this).val().toLowerCase();
                    $(".user-item").each(function () {
                        let userName = $(this).data("name");
                        let userRole = $(this).data("role");

                        if (userName.includes(searchText) || userRole.includes(searchText)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            } else {
                usersList.append("<li>No users assigned to this task.</li>");
            }
        },
        error: function () {
            $("#assignedUsersList").html("<li>Error fetching assigned users.</li>");
        }
    });
});



</script>

@include('partials.footer')
@endsection
