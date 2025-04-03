@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
@section('pageTitle', 'Assign Tasks List')

@section('content')
@include('partials.sidebar')
@include('partials.header')
<style>
    .green-checkbox {
        accent-color: green;
        /* For modern browsers */
    }

    .red-checkbox {
        accent-color: red;
        /* For modern browsers */
    }

    /* Fallback for older browsers */
    .green-checkbox:checked {
        background-color: green;
        border-color: green;
    }

    .red-checkbox:checked {
        background-color: red;
        border-color: red;
    }
</style>

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Task Assign</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Tasks Assign List</li>
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
                                <h5>Tasks Assign List</h5>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="taskTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="completed-tasks-tab" data-toggle="tab"
                                    href="#completed-tasks" role="tab" aria-controls="completed-tasks"
                                    aria-selected="true">Completed</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pending-tasks-tab" data-toggle="tab" href="#pending-tasks"
                                    role="tab" aria-controls="pending-tasks" aria-selected="false">Pending</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="completed-tasks" role="tabpanel"
                                aria-labelledby="completed-tasks-tab">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">#</th>
                                                <th style="width: 47%;">Task</th>
                                                <th style="width: 11%;">Deadline</th>
                                                {{-- <th style="width: 8%;">Status</th> --}}
                                                <th style="width: 11%;">Completed Date</th>
                                                <th style="width: 13%;">Assign by</th>

                                                <th style="width: 13%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="completedTaskTableBody">
                                            @if($completeTask->count() > 0)
                                            @foreach ($completeTask as $index => $data)
                                            <tr id="taskRow-{{ $data->id }}" class="task-row" data-toggle="modal"
                                                data-target="#taskDetailModal" data-title="{{ $data->task_title }}"
                                                data-description="{!! $data->description !!}"
                                                data-date="{{ \Carbon\Carbon::parse($data->task_completion_date)->format('d F Y') }}"
                                                data-creator="{{ $data->username }}"
                                                data-status="{{ $data->status == 1 ? 'Active' : 'Inactive' }}"
                                                style="cursor: pointer;" title="Click to view details">
                                                <td>{{ ++$index }}</td>
                                                <td>{{ Str::limit(strip_tags($data['task_title']), 130, '...') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($data->task_completion_date)->format('d F
                                                    Y') }}</td>
                                                {{-- <td>Completed</td> --}}
                                                <td>{{ \Carbon\Carbon::parse($data->task_completed_date)->format('d F
                                                    Y') }}</td>
                                                <td>{{ $data->name }}</td>

                                                <td>
                                                    <input type="checkbox"
                                                        class="completed-checkbox {{ \Carbon\Carbon::now()->isAfter($data->task_completion_date) ? 'red-checkbox' : 'green-checkbox' }}"
                                                        disabled checked>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr class="nodata">
                                                <td colspan="6" class="text-center">No Completed Tasks Found!</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pending-tasks" role="tabpanel"
                                aria-labelledby="pending-tasks-tab">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 6%;">#</th>
                                                <th style="width: 47%;">Task</th>
                                                <th style="width: 10%;">Deadline</th>
                                                <th style="width: 13%;">Assign by</th>
                                                {{-- <th style="width: 8%;">Status</th> --}}
                                                <th style="width: 13%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="pendingTaskTableBody">
                                            @if($pendingTask->count() > 0)
                                            @foreach ($pendingTask as $index => $data)
                                            <tr>
                                                <td id="taskRow-{{ $data->id }}" class="task-row" data-toggle="modal"
                                                    data-target="#taskDetailModal" data-title="{{ $data->task_title }}"
                                                    data-description="{!! $data->description !!}"
                                                    data-date="{{ \Carbon\Carbon::parse($data->task_completion_date)->format('d F Y') }}"
                                                    data-creator="{{ $data->username }}"
                                                    data-status="{{ $data->status == 1 ? 'Active' : 'Inactive' }}"
                                                    style="cursor: pointer;" title="Click to view details">{{ ++$index
                                                    }}</td>
                                                <td id="taskRow-{{ $data->id }}" class="task-row" data-toggle="modal"
                                                    data-target="#taskDetailModal" data-title="{{ $data->task_title }}"
                                                    data-description="{!! $data->description !!}"
                                                    data-date="{{ \Carbon\Carbon::parse($data->task_completion_date)->format('d F Y') }}"
                                                    data-creator="{{ $data->username }}"
                                                    data-status="{{ $data->status == 1 ? 'Active' : 'Inactive' }}"
                                                    style="cursor: pointer;" title="Click to view details">{{
                                                    Str::limit(strip_tags($data->task_title), 130, '...') }}</td>
                                                <td id="taskRow-{{ $data->id }}" class="task-row" data-toggle="modal"
                                                    data-target="#taskDetailModal" data-title="{{ $data->task_title }}"
                                                    data-description="{!! $data->description !!}"
                                                    data-date="{{ \Carbon\Carbon::parse($data->task_completion_date)->format('d F Y') }}"
                                                    data-creator="{{ $data->username }}"
                                                    data-status="{{ $data->status == 1 ? 'Active' : 'Inactive' }}"
                                                    style="cursor: pointer;" title="Click to view details">{{
                                                    \Carbon\Carbon::parse($data->task_completion_date)->format('d F
                                                    Y') }}</td>
                                                <td id="taskRow-{{ $data->id }}" class="task-row" data-toggle="modal"
                                                    data-target="#taskDetailModal" data-title="{{ $data->task_title }}"
                                                    data-description="{!! $data->description !!}"
                                                    data-date="{{ \Carbon\Carbon::parse($data->task_completion_date)->format('d F Y') }}"
                                                    data-creator="{{ $data->username }}"
                                                    data-status="{{ $data->status == 1 ? 'Active' : 'Inactive' }}"
                                                    style="cursor: pointer;" title="Click to view details">{{
                                                    $data->name }}</td>
                                                {{-- <td>Pending</td> --}}
                                                <td>
                                                    <input type="checkbox" class="pending-checkbox"
                                                        value="{{ $data->taskId }}">
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr class="nodata">
                                                <td colspan="6" class="text-center">No Pending Tasks Found!</td>
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
                    {{-- <p><strong>Created By:</strong> <span id="modalCreator"></span></p> --}}
                    <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                </div>
            </div>

        </div>
    </div>
</div>



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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
    $('.pending-checkbox').change(function() {
        var taskId = $(this).val();
        var isChecked = $(this).is(':checked');

        if (isChecked) {
            $.ajax({
                url: '{{ route("tasks.complete") }}',
                type: 'POST',
                data: {
                    task_id: taskId,
                    _token: '{{ csrf_token() }}' // Include CSRF token for security
                },
                success: function(response) {
                    if (response.success) {
                        // Show SweetAlert notification
                        Swal.fire({
                            title: 'Task Completed!',
                            text: response.message,
                            icon: 'success',
                            timer: 2000, // Show for 2 seconds
                            showConfirmButton: false // Hide the confirm button
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while marking the task as complete.',
                        icon: 'error',
                        timer: 2000, // Show for 2 seconds
                        showConfirmButton: false // Hide the confirm button
                    });
                }
            });
        }
    });
});
</script>






@include('partials.footer')
@endsection
