@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
@section('pageTitle', ' Events Update')

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
                            <h5 class="m-b-10">Events</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Update Event</li>
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
                                <h5>Update Event</h5>
                            </div>

                            <div class="card-body">
                                <form id="permissionForm" action="{{route('event.update')  }}" method="post" autocomplete="off">
                                    @csrf

                                    <input type="hidden" name="event_id" value="{{$event->id}}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label>Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    placeholder="Enter Title.."
                                                    value="{{ old('title', $event->event_topic) }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label>Start Date</label>
                                                <input type="date" class="form-control" name="start_date" required
                                                    value="{{ old('start_date', $event->event_start_date) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label>Start Time</label>
                                                <input type="time" class="form-control" name="start_time" required
                                                    value="{{ old('start_time', $event->event_start_time) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label>End Date</label>
                                                <input type="date" class="form-control" name="end_date" required
                                                    value="{{ old('end_date', $event->event_end_date) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label>End Time</label>
                                                <input type="time" class="form-control" name="end_time" required
                                                    value="{{ old('end_time', $event->event_end_time) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3 mt-4">
                                                <label></label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="active" value="1" {{ old('status', $event->status) == 1 ?
                                                    'checked' : '' }}>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="inactive" value="0" {{ old('status', $event->status) == 0 ?
                                                    'checked' : '' }}>
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="descriptionInput">Description</label>
                                                <textarea class="form-control" id="descriptionInput" name="description"
                                                    required rows="1"
                                                    placeholder="Enter Description...">{{ old('description', $event->description) }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <input type="submit" class="btn btn-shadow btn-primary" value="Update">
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
