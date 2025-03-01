@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">

@section('pageTitle', 'Roles Create')

@section('content')
@include('partials.sidebar')
@include('partials.header')
{{-- <style>
    .card {
        border-radius: 8px;
        transition: 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-check-input {
        border-color: #333;
    }

    .text-truncate {
        max-width: 100%;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style> --}}


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
                        <div class="tab-pane active show" id="request" role="tabpanel" aria-labelledby="request-tab">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center g-2">
                                        <div class="col">
                                            <h5>Assign Permissions</h5>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">


                                    <form action="{{ route('assign.permissions') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            @foreach($allpermissions as $permission)
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <div class="card shadow-sm border">
                                                        <div class="card-body p-3">
                                                            <div class="d-flex align-items-center">
                                                                <input class="form-check-input me-2" type="checkbox"
                                                                    name="permissions[]" value="{{ $permission->id }}"
                                                                    {{ in_array($permission->id, $assignedPermissions) ? 'checked' : '' }}>
                                                                <label class="mb-0 text-muted text-truncate">{{ $permission->display_name }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <input type="hidden" value="{{ $user->id }}" name="user_id">
                                            <div class="col-12 mt-3 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>






                                </div>
                            </div>
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
