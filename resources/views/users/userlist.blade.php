@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
@section('pageTitle', 'Courses')

@section('content')
@include('partials.sidebar')
@include('partials.header')


<style>
    .pagination-info {
        font-size: 14px;
        margin-bottom: 15px;
    }

    .pagination .page-link {
        font-size: 14px;
        padding: 8px 12px;
    }
</style>
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Users View</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/app">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Users List</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="card table-card">
                    <div class="card-header">
                        <div class="row align-items-center g-2">
                            <div class="col">
                                <h5>List</h5>
                            </div>
                            <div class="col-auto">
                                <div class="form-search">
                                    <i class="ti ti-search"></i>
                                    <input type="search" class="form-control" placeholder="Search Followers">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Profile</th>
                                        <th>User Name</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Gender</th>

                                        <th>Status</th>
                                        @can('role',Auth::user()) <th class="text-center">Actions</th> @endcan

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $keys=> $user)
                                    <tr>
                                        <td>{{ $keys + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 wid-40">
                                                    @if ($user->profile_picture)
                                                    <img class="img-radius img-fluid wid-56"
                                                        src="{{ asset('storage/' . $user->profile_picture) }}"
                                                        alt="User image"  style="margin-left: -18px; height:51px;width: 49px;"  >
                                                    @else
                                                    <img class="img-radius img-fluid wid-40"
                                                        src="{{ asset('assets/images/default-avatar.png') }}"
                                                        alt="Default image">
                                                    @endif
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="mb-1">{{ $user->name }}</h5>
                                                    <p class="text-muted f-12 mb-0">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->type }}</td>
                                        <td>{{ $user->gender }}</td>
                                        {{-- <td>{{ $user->id }}</td> --}}
                                        <td>
                                            @if ($user->status == 1)
                                            <span class="badge rounded-pill f-14 bg-light-success">
                                                Active </span> @else <span
                                                class="badge bg-light-danger rounded-pill f-14"> Inactive </span>
                                            @endif

                                        </td>
                                        <td class="text-center">
                                            {{-- <button type="button" class="btn btn-link-primary">
                                                <i class="ti ti-message"></i>
                                            </button>
                                            <button type="button" class="btn btn-link-danger">
                                                <i class="ti ti-ban"></i>
                                            </button> --}}
                                            @can('role',Auth::user())
                                            <a href="{{ route('user_edit', $user->id) }}"
                                                class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                data-id="{{ $user->id }}">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            <a href="{{ route('user_delete', $user->id) }}"
                                                class="avtar avtar-xs btn-link-secondary read-more-btn"
                                                data-id="{{ $user->id }}"
                                                onclick="confirmDelete(event, this)">
                                                <i class="ti ti-trash f-20" style="color: red;"></i>
                                             </a>




                                            @endcan



                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>


    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(event, element) {
        event.preventDefault(); // Prevent the default link behavior

        const url = element.href || element.action; // Handle both anchor tags and form submissions

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
                // If confirmed, redirect to the delete URL (for anchor) or submit the form (for form)
                if (element.tagName === 'FORM') {
                    element.submit(); // For forms, submit the form
                } else {
                    window.location.href = url; // For links, use the href
                }
            }
        });
        return false; // Prevent immediate navigation
    }
</script>

@include('partials.footer')
@endsection
