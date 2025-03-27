@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
@section('pageTitle', ' Events List')

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
                            <h5 class="m-b-10">Events</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Events List</li>
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
                                <h5>Events List</h5>
                            </div>
                            <div class="form-search col-auto">
                                <form id="eventFilterForm">
                                    <input type="date" name="date" id="dateFilter" class="form-control"
                                        style="width: 200px; display: inline-block;">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div id="eventTableDiv">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="width:42%">Title</th>
                                            <th>Start Date/Time</th>
                                            <th>End Date/Time</th>
                                            @if(Auth::user()->can('role') || (isset($permissions) &&
                                            in_array('events_status', $permissions))) <th>Status</th>@endif
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($events->count() > 0)
                                        @foreach ($events as $index => $data)
                                        <tr id="eventRow-{{ $data->id }}"
                                            data-start-date="{{ $data->event_start_date }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $data->event_topic }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($data->event_start_date)->format('d F Y') }} /
                                                {{ \Carbon\Carbon::parse($data->event_start_time)->format('g:i A') }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($data->event_end_date)->format('d F Y') }} /
                                                {{ \Carbon\Carbon::parse($data->event_end_time)->format('g:i A') }}
                                            </td>

                                            @if(Auth::user()->can('role') || (isset($permissions) &&
                                            in_array('events_status', $permissions)))
                                            <td>
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
                                                in_array('events_edit', $permissions)))
                                                <a href="{{ route('event_edit', $data->id) }}"
                                                    class="avtar avtar-xs btn-link-secondary">
                                                    <i class="ti ti-edit f-20"></i>
                                                </a>
                                                @endif
                                                @if(Auth::user()->can('role') || (isset($permissions) &&
                                                in_array('events_delete', $permissions)))
                                                <a href="javascript:void(0);"
                                                    class="delete-event avtar avtar-xs btn-link-secondary"
                                                    data-id="{{ $data->id }}" title="Event Delete">
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
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on("click", ".delete-event", function (e) {
        e.preventDefault();
        let eventId = $(this).data("id");

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
                    url: "{{ route('event.delete', ':id') }}".replace(':id', eventId),
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Event has been deleted.",
                                icon: "success",
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // **Remove Row Without Page Reload**
                            $("#eventRow-" + eventId).fadeOut(300, function () {
                                $(this).remove();
                            });

                        } else {
                            Swal.fire("Error!", "Event could not be deleted.", "error");
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

<script>
    $(document).ready(function() {
        // Initial check for data
        if ($('table tbody tr').length === 0) {
            $('table tbody').append('<tr class="no-data"><td colspan="6" class="text-center">No Data Found.</td></tr>');
        }

        $('#dateFilter').on('change', function() {
            let selectedDate = $(this).val();
            let rowCount = 0;

            $('table tbody tr').each(function() {
                let startDate = $(this).data('start-date');

                if (selectedDate === '' || startDate.startsWith(selectedDate)) {
                    $(this).show();
                    rowCount++;
                } else {
                    $(this).hide();
                }
            });
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
                url: "{{ route('event.status.update') }}", // Define this route in web.php
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
                            text: "The event status has been updated successfully!",
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



@include('partials.footer')
@endsection
