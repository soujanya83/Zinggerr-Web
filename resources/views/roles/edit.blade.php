@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
@section('pageTitle', ' Roles Update')

@section('content')
@include('partials.sidebar')
@include('partials.header')
<style>
    .required-asterisk {
     color: red;
     font-weight: bold;
 }
</style>
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
                            <li class="breadcrumb-item" aria-current="page">Update Role</li>
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
                                <h5>Update Role</h5>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('roles.update') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="role_id" value="{{ $roles->id }}">
                                    <!-- Hidden field for the ID -->

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="displayNameInput">Display
                                                    Name  <span class="text-danger" style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" id="displayNameInput"
                                                    name="displayname" required placeholder="Enter Display Name"
                                                    value="{{ $roles->display_name }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="nameInput">Name  <span class="text-danger" style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" id="nameInput" name="name"
                                                    required placeholder="Enter Name" value="{{ $roles->name }}"
                                                    oninput="this.value = this.value.replace(/\s/g, '')">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="descriptionInput">Description  <span class="text-danger" style="font-weight: bold;">*</span></label>
                                                <textarea class="form-control" id="descriptionInput" name="description"
                                                    required rows="1"
                                                    placeholder="Enter Description...">{{ $roles->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <input type="submit" class="btn btn-shadow btn-primary" value="Submit">


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


@include('partials.footer')
@endsection
