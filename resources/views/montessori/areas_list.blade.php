@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
@section('pageTitle', ' Montessori Areas List')

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
                            <h5 class="m-b-10">Montessori</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Areas List</li>
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


                            <div class="row align-items-center g-2">
                                <div class="col">
                                    <h5>Montessori Areas List</h5>
                                </div>
                                <div class="col-auto ms-auto d-flex align-items-center gap-2">
                                    {{-- <input type="text" class="form-control" id="searchPermissions"
                                        placeholder="Search Roles..."> --}}
                                    <button class="btn btn-sm btn-shadow btn-success"
                                        onclick="window.location.href='{{ route('montessori.areas_create') }}';"
                                        style="padding: 7px;    border-radius: 5px;">
                                        Create Area
                                    </button>
                                </div>
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

                                        <th>Description</th>
                                        @if(Auth::user()->can('role') ||
                                        (isset($permissions) && in_array('areas_edit', $permissions)) ||
                                        (isset($permissions) && in_array('areas_delete', $permissions)))
                                        @endif

                                        <th class="text-center">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_areas as $index => $data)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ ucfirst($data['full_name']) }}</td>

                                        <td>
                                            {{Str::limit(strip_tags($data['description'] ), 90, '...') }}
                                        </td>

                                        <td class="text-center">
                                            @if($data->created_at != null)
                                            @if(
                                            Auth::user()->can('role') ||
                                            (isset($permissions) && in_array('areas_edit', $permissions)))
                                            <a href="{{ route('montessori.areas_edit',$data->slug) }}"
                                                class="avtar avtar-xs btn-link-secondary read-more-btn">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            @endif
                                            @if(Auth::user()->can('role') ||

                                            (isset($permissions) && in_array('areas_delete', $permissions)))
                                            <a href="{{ route('montessori.areas_delete', $data->id) }}"
                                                class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                data-id="{{ $data->id }}" onclick="return confirmDelete(this)">
                                                <i class="ti ti-trash f-20" style="color: red;"></i>
                                            </a>
                                            @endif
                                            @else
                                            Default
                                            @endif
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
