@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">

@section('pageTitle', 'Permissions Assigned List')

@section('content')
@include('partials.sidebar')
@include('partials.header')

<style>
    .follower-card {
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .follower-card .friend-btn:not(:hover) {
        border-color: var(--bs-border-color);
        background: var(--bs-card-bg);
    }

    .btn-light-blue {

        border-radius: 4px;
        padding: 8px 16px;
        font-size: 14px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-light-blue:hover {
        background-color: #d0e7fd;
        color: #0056b3;
        border-color: #aed4fc;
    }
</style>

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Permissions Assigned View</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Permissions Assigned List</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row">

            <div class="tab-pane" id="request" role="tabpanel" aria-labelledby="request-tab">
                <div class="card">


                    <div class="row align-items-center g-2">
                        <div class="card-body">
                            <div class="row align-items-center g-2">
                                <div class="col">
                                    <h5>All Permissions Assigned List</h5>
                                </div>
                                <div class="form-search col-auto">
                                    <input type="text" class="form-control" id="searchPermissions"
                                        placeholder="Search Permissions...">
                                </div>
                            </div>
                            <div class="table-responsive mt-2">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Permissions Name</th>
                                            <th>Role Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $index => $permission)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $permission['display_name'] }}</td>
                                            <td>{{ $permission['role_name'] }}</td>
                                            <td> <a href="{{ route('permission_assigned_delete', $permission->id) }}"
                                                    class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                    data-id="{{ $permission->id }}"
                                                    onclick="return confirmDelete(this)">
                                                    <i class="ti ti-trash f-20" style="color: red;"></i>
                                                </a></td>
                                        </tr>
                                        @endforeach
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(element) {
        event.preventDefault(); // Prevent the default link behavior
        const url = element.href;

        Swal.fire({
            title: 'Are you sure? For Delete',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, redirect to the delete URL
                window.location.href = url;
            }
        });

        return false; // Prevent immediate navigation
    }


    document.getElementById('searchPermissions').addEventListener('keyup', function () {
    const searchText = this.value.toLowerCase();
    const rows = document.querySelectorAll('table tbody tr');

    rows.forEach(row => {
        const permissionName = row.cells[1,2].textContent.toLowerCase();
        row.style.display = permissionName.includes(searchText) ? '' : 'none';
    });
});


</script>
@include('partials.footer')
@endsection
