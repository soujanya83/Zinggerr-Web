@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
@section('pageTitle', ' Roles Create')

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
                            <h5 class="m-b-10">Roles View</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Role Create</li>
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

                    <div class="card-header" style="margin-bottom: -28px;">
                        <div class="row align-items-center g-2">
                            <div class="col">
                                <h5>Create Roles</h5>
                            </div>

                            <div class="card-body">
                                <form id="permissionForm" action="{{ route('roles.store') }}" method="post"
                                    autocomplete="off">
                                    @csrf
                                    <input type="hidden" id="permissionId" name="id" value="">
                                    <!-- Hidden field for the ID -->

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="nameInput">Name</label>
                                                <input type="text" class="form-control" id="nameInput" name="name"
                                                    required placeholder="Enter Name" value="{{ old('name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="display:none">
                                            <div class="mb-3">
                                                <label for="displayNameInput">Role Display
                                                    Name</label>
                                                <input type="text" class="form-control" id="displayNameInput"
                                                    name="displayname"  placeholder="Enter Display Name" value="{{ old('displayname') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="descriptionInput">Description</label>
                                                <textarea class="form-control" id="descriptionInput" name="description"
                                                    required rows="1" placeholder="Enter Text...">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <input type="submit" class="btn btn-shadow btn-primary" value="Submit">
                                        <a href="{{ route('roles.create') }}" class="btn  btn-shadow btn-success">
                                            Reset</a>

                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>


                    @if($roles->count() > 0)
                    <hr>
                    <div class="card-header" style="margin-top: -19px; margin-bottom: -17px;">
                        <div class="row align-items-center g-2">
                            <div class="col">
                                <h5>All Roles</h5>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">


                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        {{-- <th>Role Display Name</th> --}}
                                        <th>Description</th>
                                        @if(Auth::user()->can('role') ||
                                        (isset($permissions) && in_array('roles_edit', $permissions)) ||
                                        (isset($permissions) && in_array('roles_delete', $permissions)))
                                        <th class="text-center">Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>


                                    @foreach ($roles as $index => $role)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $role['name'] }}</td>
                                        {{-- <td>{{ $role['display_name'] }}</td> --}}
                                        <td>
                                            {{Str::limit(strip_tags($role['description'] ), 130, '...') }}
                                        </td>
                                        <td class="text-center">
                                            @if(Auth::user()->can('role') ||
                                            (isset($permissions) && in_array('roles_edit', $permissions)))

                                            <a class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                onclick="editPermission({{ json_encode($role) }})">
                                                <i class="ti ti-edit f-20" style="color: rgb(114, 93, 246);"></i>
                                            </a>
                                            @endif
                                            @if(Auth::user()->can('role') ||

                                            (isset($permissions) && in_array('roles_delete', $permissions)))
                                            <a href="{{ route('role_delete', $role->id) }}"
                                                class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                data-id="{{ $role->id }}" onclick="return confirmDelete(this)">
                                                <i class="ti ti-trash f-20" style="color: red;"></i>
                                            </a>
                                            @endif
                                        </td>

                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>

                    @endif

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
    function editPermission(role) {
        const form = document.getElementById('permissionForm');
        if (!form) {
            console.error('Form not found!');
            return;
        }
        form.action = "{{ route('update.role') }}";

        document.getElementById('permissionId').value = role.id;
        document.getElementById('nameInput').value = role.name;
        document.getElementById('displayNameInput').value = role.display_name;
        document.getElementById('descriptionInput').value = role.description;
        form.scrollIntoView({ behavior: 'smooth' });
    }
    window.editPermission = editPermission;
});
</script>

@include('partials.footer')
@endsection
