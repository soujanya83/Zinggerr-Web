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
                            <div class="form-search col-auto">
                                <form>
                                    <input type="date" name="date" id="dateFilter" class="form-control"
                                        style="width: 200px; display: inline-block;">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <th style="width: 61%;">Task</th>
                                        <th style="width: 13%;">Date</th>
                                        <th style="width: 12%;">Status</th>
                                        <th style="width: 9%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="taskTableBody">
                                    @if($todos->count() > 0)
                                    @foreach ($todos as $index => $data)
                                    <tr id="taskRow-{{ $data->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ Str::limit(strip_tags($data['task']), 130, '...') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->date)->format('d F Y') }}</td>
                                        <td>
                                            {{ $data->completed == 1 ? 'Complete' : 'Incomplete' }}
                                        </td>
                                        <td>
                                            @if(
                                            Auth::user()->can('role') ||
                                            (isset($permissions) && in_array('tasks_edit', $permissions)))
                                            <a href="{{ route('tasks_edit', $data->id) }}"
                                                class="avtar avtar-xs btn-link-secondary">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            @endif
                                            @if(
                                            Auth::user()->can('role') ||
                                            (isset($permissions) && in_array('tasks_delete', $permissions)))
                                            <a href="#" class="delete-task avtar avtar-xs btn-link-secondary"
                                                data-id="{{ $data->id }}">
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
                url: "{{ route('to_do_tasks_delete', ':id') }}".replace(':id', taskId),
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
    $('#dateFilter').on('change', function () {
        var selectedDate = $(this).val();

        $.ajax({
            url: "{{ route('to_do_list') }}",
            type: "GET",
            data: { date: selectedDate },
            success: function (response) {
                var rows = '';
                if (response.todos.length > 0) {
                    $.each(response.todos, function (index, task) {
                        let taskText = task.task.length > 130 ? task.task.substring(0, 130) + '...' : task.task;

                        rows += `
                            <tr id="taskRow-${task.id}">
                                <td>${index + 1}</td>
                                <td>${task.task.length > 130 ? task.task.substring(0, 130) + "..." : task.task}</td>
                                <td>${new Date(task.date).toLocaleDateString('en-GB', { day: '2-digit', month: 'long', year: 'numeric' })}</td>
                                <td>${task.completed == 1 ? 'Complete' : 'Incomplete'}</td>
                                <td>
                                    <a href="/tasks_edit/${task.id}" class="avtar avtar-xs btn-link-secondary">
                                        <i class="ti ti-edit f-20"></i>
                                    </a>
                                    <a href="#" class="delete-task avtar avtar-xs btn-link-secondary" data-id="${task.id}">
                                        <i class="ti ti-trash f-20" style="color: red;"></i>
                                    </a>
                                </td>
                            </tr>`;


                    });

                } else {
                    rows = '<tr><td colspan="5" class="text-center">No tasks found</td></tr>';
                }
                $('#taskTableBody').html(rows);
            }
        });
    });
});
</script>
@include('partials.footer')
@endsection
