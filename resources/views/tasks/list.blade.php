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
                            <h5 class="m-b-10">Tasks</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Tasks List</li>
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
                                <h5>Tasks List</h5>
                            </div>
                            {{-- <div class="form-search col-auto">
                                <form>
                                    <input type="date" name="date" id="dateFilter" class="form-control"
                                        style="width: 200px; display: inline-block;">
                                </form>
                            </div> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- User Assignment Dropdown (Top-Right) -->
                        <div class="d-flex justify-content-between mb-2">

                            <div class="dropdown d-inline">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="userDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-users"></i> Assign Users
                                </button>
                                <div class="dropdown-menu p-2 keep-open-dropdown" aria-labelledby="userDropdown"
                                    style="width: 220px; z-index: 1050; ">
                                    <!-- Search Input -->
                                    <input type="text" class="form-control form-control-sm mb-2 user-search"
                                        placeholder="Search user..." onkeyup="filterUsers(this)"
                                        style="position: sticky; top: 0; z-index: 1051; background: white;">

                                    <!-- Scrollable User List -->
                                    <div class="user-list-container" style="max-height: 180px; overflow-y: auto;">
                                        @foreach($users as $user)
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="assign-checkbox"
                                                value="{{ $user->id }}">&nbsp;
                                            {{ $user->name }}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                                <button id="bulkAssignBtn" class="btn btn-primary btn-sm" disabled>Assign Tasks</button>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 6%;">
                                            <input type="checkbox" id="selectAllTasks"> All
                                        </th>
                                        <th style="width: 63%;">Task</th>
                                        <th style="width: 13%;">Deadline</th>
                                        <th style="width: 8%;">Status</th>
                                        <th style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="taskTableBody">
                                    @if($tasks->count() > 0)
                                    @foreach ($tasks as $index => $data)
                                    <tr id="taskRow-{{ $data->id }}" title="Description: {{ $data->description }}">

                                        <td>
                                            <input type="checkbox" class="task-checkbox" value="{{ $data->id }}"> {{
                                            ++$index }}
                                        </td>
                                        <td>{{ Str::limit(strip_tags($data['task_title']), 130, '...') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->task_completion_date)->format('d F Y') }}
                                        </td>

                                        @if(Auth::user()->can('role') || (isset($permissions) && in_array('task_status',
                                        $permissions)))
                                        <td title="Task Status">
                                            <span
                                                class="badge status-badge {{ $data->status == 1 ? 'bg-success' : 'bg-danger' }}"
                                                data-id="{{ $data->id }}" data-status="{{ $data->status }}"
                                                style="cursor: pointer;padding:6px">
                                                {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        @endif
                                        <td>
                                            @if(Auth::user()->can('role') || (isset($permissions) &&
                                            in_array('tasks_edit', $permissions)))
                                            <a href="{{ route('task.edit', $data->id) }}"
                                                class="avtar avtar-xs btn-link-secondary" title="Task Edit/Update">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            @endif
                                            @if(Auth::user()->can('role') || (isset($permissions) &&
                                            in_array('tasks_delete', $permissions)))
                                            <a href="#" class="delete-task avtar avtar-xs btn-link-secondary"
                                                data-id="{{ $data->id }}" title="Task Delete">
                                                <i class="ti ti-trash f-20" style="color: red;"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="nodata">
                                        <td colspan="6" class="text-center">No Data Found!</td>
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
                            timer: 1500, // Show for 2 seconds
                            showConfirmButton: false
                        });

                        // **Remove Row Without Page Reload**
                        $("#taskRow-" + taskId).fadeOut(300, function () {
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


@include('partials.footer')
@endsection
