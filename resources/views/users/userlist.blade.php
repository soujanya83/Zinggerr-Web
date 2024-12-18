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
                                        <th>Country</th>

                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 wid-40">
                                                    <img class="img-radius img-fluid wid-40"
                                                        src="{{ asset('assets/images/user/') }}"
                                                        alt="User image">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="mb-1">

                                                        <i class="fas fa-check-circle text-success"></i>

                                                    </h5>
                                                    <p class="text-muted f-12 mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td></td>

                                        <td>
                                            <span class="badge rounded-pill f-14 bg-light-}">

                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-link-primary">
                                                <i class="ti ti-message"></i>
                                            </button>
                                            <button type="button" class="btn btn-link-danger">
                                                <i class="ti ti-ban"></i>
                                            </button>
                                        </td>
                                    </tr>

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

@include('partials.footer')
@endsection
