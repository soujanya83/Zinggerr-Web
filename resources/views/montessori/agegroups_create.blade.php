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
                            <h5 class="m-b-10">Montessori</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Create Age Group</li>
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
        <div class="row" >
            <div class="tab-pane" id="request" role="tabpanel" aria-labelledby="request-tab">
                <div class="card"   style="background-image: url('{{ asset('asset/zinggerr-web-image.jpg') }}'); background-size: cover; background-position: center;">

                    <div class="card-header" style="margin-bottom: -28px;">
                        <div class="row align-items-center g-2">
                            <div class="col">
                                <h5>Create Montessori Age Group</h5>
                            </div>

                            <div class="card-body">
                                <form id="permissionForm" action="{{ route('montessori.agegroup_store') }}" method="post"
                                    autocomplete="off">
                                    @csrf


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nameInput">Full Name  <span class="text-danger" style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" id="nameInput" name="fullname"
                                                    required placeholder="Enter Full Name" value="{{ old('name') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nameInput">Short Name  <span class="text-danger" style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" id="nameInput" name="shortname"
                                                    required placeholder="Enter Short Name"
                                                    value="{{ old('fullname') }}">
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="descriptionInput">Description  <span class="text-danger" style="font-weight: bold;">*</span></label>
                                                <textarea class="form-control" id="descriptionInput" name="description"
                                                    required rows="1"
                                                    placeholder="Enter Description...">{{ old('description') }}</textarea>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="mb-3 mt-4">
                                                <label for="status" style="color: #000">
                                                   </label>
                                                <div>
                                                    <div class="form-check-inline">
                                                        <input class="form-check-input" type="radio" name="age_status"
                                                            id="statusshow" value="1" checked>
                                                        <label class="form-check-label" for="statusshow"
                                                            style="color: #000">Publish</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="age_status"
                                                            id="statushide" value="0" >
                                                        <label class="form-check-label" for="statushide"
                                                            style="color: #000" >Not-Publish</label>
                                                    </div>
                                                </div>
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
