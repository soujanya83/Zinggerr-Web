@extends('layouts.app')

@section('pageTitle', 'Dashboard')

@section('content')

@include('partials.sidebar')
@include('partials.header')

<!-- Favicon -->
<link href="img/favicon.ico" rel="icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/fullcalendar/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar/main.min.js"></script>
<link href="public/css/bootstrap.min.css" rel="stylesheet">
<link href="public/css/style.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .dashboard-card {
        background-color: #663399;
        /* Purple background */
        border-radius: 8px;
        padding: 20px;
        color: #fff;
        width: 24%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-icon {
        font-size: 24px;
    }

    .card-actions {
        font-size: 20px;
    }

    .card-body {
        text-align: center;
        margin-top: 20px;
    }

    .card-value {
        font-size: 36px;
        font-weight: bold;
    }

    .icon-up {
        color: #00ff00;
        /* Green for upward trend */
        margin-left: 5px;
    }
</style>

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Students Dashboard View</h5>
                        </div>
                    </div>
                    {{-- <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Students</a></li>
                            <li class="breadcrumb-item" aria-current="page">Add New</li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row">
            {{-- <div class="col-12"> --}}
                <div class="card">
                    <div class="card-header">

                        <div class="dashboard-card">
                            <div class="card-body">
                                <div class="card-value">
                                    1350
                                    <span class="icon-up"><i class="ti ti-arrow-up-right-circle opacity-50"></i></span>
                                </div>
                                <div class="card-title">Total Pending Orders</div>
                            </div>
                        </div>

                        <div class="dashboard-card" style="background-color:#97FBD1">
                            <div class="card-body">
                                <div class="card-value">
                                    1350
                                    <span class="icon-up"><i class="ti ti-arrow-up-right-circle opacity-50"></i></span>
                                </div>
                                <div class="card-title">Total Pending Orders</div>
                            </div>
                        </div>

                        <div class="dashboard-card" style="background-color:#F6A4EC">
                            <div class="card-body">
                                <div class="card-value">
                                    1350
                                    <span class="icon-up"><i class="ti ti-arrow-up-right-circle opacity-50"></i></span>
                                </div>
                                <div class="card-title">Total Pending Orders</div>
                            </div>
                        </div>

                        <div class="dashboard-card"  style="background-color:#1CC6FF">
                            <div class="card-body">
                                <div class="card-value">
                                    1350
                                    <span class="icon-up"><i class="ti ti-arrow-up-right-circle opacity-50"></i></span>
                                </div>
                                <div class="card-title">Total Pending Orders</div>
                            </div>
                        </div>

                    </div>
                </div>
                {{--
            </div> --}}
        </div>
    </div>
</div>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>


@include('partials.footer')
@endsection
