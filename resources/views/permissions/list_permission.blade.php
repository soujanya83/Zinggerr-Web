@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">

@section('pageTitle', 'Roles Create')

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
                            <h5 class="m-b-10">Permissions</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Permissions List</li>
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
                                <h5>All Permissions List</h5>
                            </div>
                            <div class="form-search col-auto">
                                <input type="text" class="form-control" id="searchPermissions"
                                    placeholder="Search Permissions...">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="permissionsTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Display Name</th>
                                        <th>Description</th>
                                        @if(Auth::user()->can('role') ||
                                        (isset($permissions) && in_array('permissions_edit', $permissions)) ||
                                        (isset($permissions) && in_array('permissions_delete', $permissions)))
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissionsdata as $index => $permission)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $permission['name'] }}</td>
                                        <td>{{ $permission['display_name'] }}</td>
                                        <td>
                                            {{Str::limit(strip_tags($permission['description'] ), 65, '...') }}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                @if(Auth::user()->can('role') ||
                                                (isset($permissions) && in_array('permissions_edit', $permissions)))

                                                <a href="{{ route('permission.edit',  $permission['id']) }}"
                                                    class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                    data-id="{{  $permission['id']}}">
                                                    <i class="ti ti-edit f-20"></i>
                                                </a>



                                                @endif
                                                @if(Auth::user()->can('role') ||
                                                (isset($permissions) && in_array('permissions_delete', $permissions)))
                                                &nbsp;&nbsp;
                                                <a href="{{ route('permission.delete', $permission['id']) }}"
                                                    class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                    onclick="return confirmDelete(this)">
                                                    <i class="ti ti-trash f-20" style="color: red;"></i>
                                                </a>


                                                @endif
                                            </div>
                                        </td>
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

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchPermissions');
        const table = document.getElementById('permissionsTable');
        const rows = table.getElementsByTagName('tr');

        searchInput.addEventListener('input', function () {
            const filter = searchInput.value.toLowerCase();

            for (let i = 1; i < rows.length; i++) { // Start from 1 to skip header row
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell) {
                        const text = cell.textContent.toLowerCase();
                        if (text.indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }

                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    });
</script>
@include('partials.footer')
@endsection
