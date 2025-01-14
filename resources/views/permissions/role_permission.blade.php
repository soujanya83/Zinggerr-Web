@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">

@section('pageTitle', 'Permissions Assign')

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
                            <h5 class="m-b-10">Permissions Assign View</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Permissions Assign</li>
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


                    <div class="row align-items-center g-2 mt-3">
                        <div class="col">
                            <h5> &nbsp&nbspCreate Permissions</h5>
                        </div>

                        <div class="card-body">
                            <form id="permissionForm" action="{{ route('role.permission.assign') }}" method="post"
                                autocomplete="off">
                                @csrf

                                <!-- Hidden field for the ID -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="nameInput">Select Role</label>
                                            <select type="text" class="form-control" id="nameInput" name="role_id"
                                                required>
                                                <option></option>
                                                @foreach ($role as $roledata)
                                                <option value="{{ $roledata['id'] }}">{{ $roledata['display_name'] }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Permissions Checkboxes -->
                                <div class="row align-items-center g-2">
                                    <div class="col">
                                        <h5>All Permissions List</h5>
                                    </div>
                                    <div class="form-search col-auto">
                                        <input type="text" class="form-control" id="searchPermissions"
                                            placeholder="Search Permissions...">
                                    </div>
                                </div>
                                {{-- <div class="row mt-4">
                                    @foreach ($permissions as $permission)
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                {{-- <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">{{ $permission['display_name'] }}
                                                        </h5>
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        value="{{ $permission['id'] }}"
                                                        id="permission{{ $permission['id'] }}">
                                                    <label class="form-check-label"
                                                        for="permission{{ $permission['id'] }}">
                                                        {{ $permission['display_name'] }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach --}}
                                    {{--
                                </div> --}}


                                <div class="table-responsive mt-4">

                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Permission Name</th>
                                                <th>Select</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permissions as $index => $permission)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $permission['display_name'] }}</td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="permissions[]" value="{{ $permission['id'] }}"
                                                            id="permission{{ $permission['id'] }}">
                                                        <label class="form-check-label"
                                                            for="permission{{ $permission['id'] }}"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-end mt-3">
                                    <input type="submit" class="btn btn-primary" value="Assign">
                                </div>
                            </form>
                        </div>



                    </div>
                    {{-- <div class="card-header">
                        <div class="row align-items-center g-2">
                            <div class="col">
                                <h5>All Permissions</h5>
                            </div>

                        </div>


                        <div class="row">

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

                        </div>

                    </div> --}}
                </div>


            </div>
        </div>
    </div>
</div>
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
        const permissionName = row.cells[1].textContent.toLowerCase();
        row.style.display = permissionName.includes(searchText) ? '' : 'none';
    });
});


</script>




@include('partials.footer')
@endsection
