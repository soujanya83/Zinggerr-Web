@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
@section('pageTitle', ' Roles List')

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
                            <h5 class="m-b-10">Roles</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Roles List</li>
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
                <div class="card"   style="background-image: url('{{ asset('asset/zinggerr-web-image.jpg') }}'); background-size: cover; background-position: center;">




                    @if($roles->count() > 0)

                    <div class="card-header" >
                        <div class="row align-items-center g-2">
                            <div class="col">
                                <h5>Roles List</h5>
                            </div>
                            <div class="form-search col-auto">
                                <input type="text" class="form-control" id="searchPermissions"
                                    placeholder="Search Roles...">
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
                                        <td>{{ $role['display_name'] }}</td>
                                        {{-- <td>{{ $role['display_name'] }}</td> --}}
                                        <td>
                                            {{Str::limit(strip_tags($role['description'] ), 130, '...') }}
                                        </td>
                                        <td class="text-center">
                                            @if(
                                            Auth::user()->can('role') ||
                                            (isset($permissions) && in_array('roles_edit', $permissions)))


                                            <a href="{{ route('roles.edit',$role->id) }}"
                                                class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                data-id="{{  $role->id}}">
                                                <i class="ti ti-edit f-20"></i>
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
