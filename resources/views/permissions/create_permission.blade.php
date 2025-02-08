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
                            <li class="breadcrumb-item" aria-current="page">Permissions Create</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
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

                    <div class="card-header" style="margin-bottom: -28px;">
                        <div class="row align-items-center g-2">
                            <div class="col">
                                <h5>Create Permissions</h5>
                            </div>

                            <div class="card-body">
                                <form id="permissionForm" action="{{ route('submit.permission') }}" method="post"
                                    autocomplete="off">
                                    @csrf
                                    <input type="hidden" id="permissionId" name="id" value="">
                                    <!-- Hidden field for the ID -->

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="nameInput">Permission Name</label>
                                                <input type="text" class="form-control" id="nameInput" name="name"
                                                    required placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="displayNameInput">Permission Display Name</label>
                                                <input type="text" class="form-control" id="displayNameInput"
                                                    name="displayname" required placeholder="Enter Display Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="descriptionInput">Description</label>
                                                <textarea class="form-control" id="descriptionInput" name="description"
                                                    required rows="1" placeholder="Enter Text..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <input type="submit" class="btn  btn-shadow btn-primary" value="Submit">

                                        <a href="{{ route('permissions.create') }}" class="btn  btn-shadow btn-success">Reset</a>

                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>
                    <hr>
                    <div class="card-header" style="margin-top: -19px; margin-bottom: -17px;">
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
                        {{-- <div class="row">

                            @foreach ($permissions as $permission)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="card follower-card">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-3">

                                            <div class="flex-grow-1 mx-2">
                                                <h5 class="mb-1 text-truncate">{{ $permission['display_name'] }}</h5>

                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                        href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="ti ti-dots f-16"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item "
                                                            onclick="editPermission({{ json_encode($permission) }})"><i
                                                                class="material-icons-two-tone">edit</i>
                                                            Edit</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('permission.delete', $permission['id']) }}">
                                                            <i class="material-icons-two-tone">delete</i>
                                                            Delete</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="flex-shrink-0">
                                                    <button class="btn btn-link text-primary btn btn-light-blue"
                                                        onclick="editPermission({{ json_encode($permission) }})">Edit</button>
                                                </div>



                                            </div>
                                            <div class="col-6">
                                                <div class="d-grid">
                                                    <a href="{{ route('permission.delete', $permission['id']) }}"
                                                        class="btn friend-btn btn-link-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div> --}}

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Permissions Name</th>
                                        <th>Permissions Display Name</th>
                                        <th>Description</th>
                                        @if(Auth::user()->can('role') ||
                                        (isset($permissions) && in_array('permissions_edit', $permissions)) ||
                                        (isset($permissions) && in_array('permissions_delete', $permissions)))
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $index => $permission)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $permission['name'] }}</td>
                                        <td>{{ $permission['display_name'] }}</td>
                                        <td>{{ $permission['description'] }}</td>
                                        <td>
                                            <div class="btn-group">
                                                @if(Auth::user()->can('role') ||
                                                (isset($permissions) && in_array('permissions_edit', $permissions)))
                                                <a class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                    onclick="editPermission({{ json_encode($permission) }})">
                                                    <i class="ti ti-edit f-20" style="color: rgb(114, 93, 246);"></i>
                                                </a>
                                                @endif
                                                @if(Auth::user()->can('role') ||
                                                (isset($permissions) && in_array('permissions_delete', $permissions)))
                                                &nbsp &nbsp
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
    document.addEventListener('DOMContentLoaded', function () {
    function editPermission(permission) {
        const form = document.getElementById('permissionForm');
        if (!form) {
            console.error('Form not found!');
            return;
        }
        form.action = "{{ route('update.permission') }}";

        document.getElementById('permissionId').value = permission.id;
        document.getElementById('nameInput').value = permission.name;
        document.getElementById('displayNameInput').value = permission.display_name;
        document.getElementById('descriptionInput').value = permission.description;
        form.scrollIntoView({ behavior: 'smooth' });
    }
    window.editPermission = editPermission;
});


document.getElementById('searchPermissions').addEventListener('keyup', function () {
    const searchText = this.value.toLowerCase();
    const rows = document.querySelectorAll('table tbody tr');

    rows.forEach(row => {
        const cellsToSearch = [row.cells[3], row.cells[1], row.cells[2]];
        const matches = cellsToSearch.some(cell => cell.textContent.toLowerCase().includes(searchText));
        row.style.display = matches ? '' : 'none';
    });
});
</script>

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


@include('partials.footer')
@endsection
