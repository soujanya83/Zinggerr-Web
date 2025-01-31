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
    .card-custom {
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .dropdown-custom {
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 5px 15px;
        cursor: pointer;
        background-color: #fff;
    }

    .chart-container {
        position: relative;
        width: 100%;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    .rounded {
        border-radius: 10px !important;
    }

    .p-4 {
        padding: 20px !important;
    }

    .icon-settings {
        font-size: 18px;
        color: #6c757d;
        cursor: pointer;
    }

    .chart-container {
        background: #f8f9fa;
        /* Light background */
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .chart-legend {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    .chart-legend span {
        margin-right: 15px;
        font-size: 14px;
    }

    .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }
</style>

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





    .css-xas8z8 svg {
        width: 50px;
        height: 50px;
        color: rgb(103, 58, 183);
        border-radius: 14px;
        padding: 10px;
        background-color: rgb(227, 242, 253);
    }
</style>
<style>
    .stats-card {
        background: #f9fafb;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 22px;
        font-weight: bold;
    }

    .stat-label {
        font-size: 14px;
        color: gray;
        text-transform: uppercase;
    }


    .css-2yksad {
        box-shadow: none;
        background-image: none;
        background-color: rgb(103, 58, 183);
        position: relative;
        color: rgb(255, 255, 255);
        transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 8px;
        overflow: hidden;
    }


    .test11 {
        width: 50px;
        height: 50px;
        color: rgb(103, 58, 183);
        border-radius: 14px;
        padding: 10px;
        background-color: rgb(227, 242, 253);

    }

    .card {
        background-color: #fff;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        /* Ensures SVG stays within card bounds */
    }

    .card-content {
        display: flex;
        flex-direction: column;
        /* Stack icon and text vertically */
        align-items: flex-start;
        /* Align items to the left */
        padding: 16px;
    }

    .icon {
        display: flex;
        justify-content: center;
        /* Center the SVG horizontally */
        align-items: center;
        /* Center the SVG vertically */
        width: 100%;
        /* Make sure the icon container takes full width */
        margin-bottom: 10px;
        /* Add some space below the icon */
    }

    .icon svg {
        width: 100px;
        /* Set the desired SVG width */
        height: 100px;
        /* Set the desired SVG height */
        fill: #b39ddb;
        /* Example: Gray icon color */
    }

    .icon2 svg {

        fill: #90cbf9;
        /* Example: Gray icon color */
    }

    .text-content {
        width: 100%;
        /* Ensure text content takes full width */
    }

    .title {
        font-size: 1rem;
        color: #555;
        margin-bottom: 4px;
    }

    .value {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 4px;
    }

    .comparison {
        font-size: 0.875rem;
        color: #757575;
    }

    /* Optional: Add some padding to the text content */
    .text-content {
        padding: 0 10px;
        /* Add left and right padding */
    }
</style>
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard View</h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row" style="width: 100%;margin-left: 0px;">
            {{-- <div class="col-12"> --}}

                {{-- <div class="card-header"> --}}
                    <div class="container-fluid">
                        <div class="card" style="width: 905px;    margin-left: -13px;">
                            <div class="content">
                                <div class="container-fluid" style="width: 1335px;">
                                    <div class="row">
                                        <!-- Ensure both cards are in one row -->
                                        <!-- First Card -->
                                        <div class="col-sm-6 col-xl-4" style="margin-top:20px">
                                            <div class="card">
                                                <div class="card-content"
                                                    style="border-radius: 5px; background-color: rgb(103, 58, 183);">
                                                    <div class="icon">
                                                        <div class="text-content">
                                                            <h5 class="title" style="color:#dee2e6">Courses Last 7 day`s
                                                            </h5>
                                                            <h3 class="value" style="color:#dee2e6">{{ $courseslast7day
                                                                }}</h3>
                                                            <h6 class="comparison" style="color:#dee2e6">{{
                                                                $coursesLastMonth }} Courses Last
                                                                Month</h6>
                                                        </div>
                                                        <svg width="100" height="100" viewBox="0 0 24 24" fill="none"
                                                            stroke="purple" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path
                                                                d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z">
                                                            </path>
                                                            <path d="M9 7h6"></path>
                                                            <path d="M9 11h6"></path>
                                                            <path d="M9 15h3"></path>
                                                        </svg>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Second Card -->
                                        <div class="col-sm-6 col-xl-4" style="margin-top:20px">
                                            <div class="card">
                                                <div class="card-content"
                                                    style="border-radius: 5px; background-color: rgb(33, 150, 243);">
                                                    <div class="icon2 icon">
                                                        <div class="text-content">
                                                            <h5 class="title" style="color:#dee2e6">Students Last 7
                                                                day`s</h5>
                                                            <h3 class="value" style="color:#dee2e6">{{ $studentlast7day
                                                                }}</h3>
                                                            <h6 class="comparison" style="color:#dee2e6">{{
                                                                $studentlastmonth }} Students Last
                                                                Month
                                                            </h6>
                                                        </div>
                                                        <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeLarge css-6flbmm"
                                                            focusable="false" aria-hidden="true" viewBox="0 0 24 24"
                                                            data-testid="AccountCircleTwoToneIcon">
                                                            <path
                                                                d="M12 4c-4.42 0-8 3.58-8 8 0 1.95.7 3.73 1.86 5.12C7.55 15.8 9.68 15 12 15s4.45.8 6.14 2.12C19.3 15.73 20 13.95 20 12c0-4.42-3.58-8-8-8m0 9c-1.93 0-3.5-1.57-3.5-3.5S10.07 6 12 6s3.5 1.57 3.5 3.5S13.93 13 12 13"
                                                                opacity=".3"></path>
                                                            <path
                                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2m0 18c-1.74 0-3.34-.56-4.65-1.5C8.66 17.56 10.26 17 12 17s3.34.56 4.65 1.5c-1.31.94-2.91 1.5-4.65 1.5m6.14-2.88C16.45 15.8 14.32 15 12 15s-4.45.8-6.14 2.12C4.7 15.73 4 13.95 4 12c0-4.42 3.58-8 8-8s8 3.58 8 8c0 1.95-.7 3.73-1.86 5.12">
                                                            </path>
                                                            <path
                                                                d="M12 5.93c-1.93 0-3.5 1.57-3.5 3.5s1.57 3.5 3.5 3.5 3.5-1.57 3.5-3.5-1.57-3.5-3.5-3.5m0 5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- End of Row -->
                                </div>



                            </div>
                        </div>

                        <!-- Sale & Revenue End -->
                        <div class="container-fluid pt-4 px-4">
                            <div class="row g-4">
                                <!-- Revenue & Sales Chart -->
                                <div class="col-sm-12 col-xl-8">
                                    <div class="card card-custom"
                                        style="width: 904px;    margin-left: -36px;margin-top: -25px;">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <h5 class="mb-0">Statistics</h5>
                                                <small>Revenue and Sales</small>
                                            </div>
                                            <div class="dropdown-custom">
                                                Today <span class="caret"></span>
                                            </div>
                                        </div>
                                        <div class="chart-container">
                                            <canvas id="revenueSalesChart"></canvas>
                                        </div>
                                    </div>
                                </div>





                                <div class="col-sm-12 col-md-6 col-xl-4">


                                    <div class="container">
                                        <div class="card p-3" style="    margin-top: -236px;width: 433px;">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="stats-card">
                                                        {{-- <svg class="stat-icon test11"
                                                            xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                            viewBox="0 0 24 24" fill="none" stroke="purple"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M6 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0">
                                                            </path>
                                                            <path d="M18 6m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0">
                                                            </path>
                                                            <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0">
                                                            </path>
                                                            <path d="M8.7 10.7l6.6 -3.4"></path>
                                                            <path d="M8.7 13.3l6.6 3.4"></path>
                                                        </svg> --}}
                                                        <svg class="stat-icon test11" xmlns="http://www.w3.org/2000/svg"
                                                            width="40" height="40" viewBox="0 0 24 24" fill="none"
                                                            stroke="purple" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <circle cx="12" cy="7" r="4"></circle>
                                                            <path d="M5 21v-2a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v2"></path>
                                                        </svg>



                                                        <div>{{ $student }}</div>
                                                        <div>Students</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="stats-card">
                                                        {{-- <svg class="stat-icon test11"
                                                            xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                            viewBox="0 0 24 24" fill="none" stroke="purple"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M12 12l0 .01"></path>
                                                            <path d="M14.828 9.172a4 4 0 0 1 0 5.656">
                                                            </path>
                                                            <path d="M17.657 6.343a8 8 0 0 1 0 11.314">
                                                            </path>
                                                            <path d="M9.168 14.828a4 4 0 0 1 0 -5.656">
                                                            </path>
                                                            <path d="M6.337 17.657a8 8 0 0 1 0 -11.314">
                                                            </path>
                                                        </svg> --}}
                                                        <svg class="stat-icon test11" xmlns="http://www.w3.org/2000/svg"
                                                            width="40" height="40" viewBox="0 0 24 24" fill="none"
                                                            stroke="purple" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <circle cx="12" cy="7" r="4"></circle>
                                                            <path d="M5 21v-2a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v2"></path>
                                                        </svg>



                                                        <div>{{ $teacher }}</div>
                                                        <div>Teachers</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="stats-card">
                                                        <svg class="stat-icon test11" xmlns="http://www.w3.org/2000/svg"
                                                            width="40" height="40" viewBox="0 0 24 24" fill="none"
                                                            stroke="purple" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path
                                                                d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z">
                                                            </path>
                                                            <path d="M3 10l18 0"></path>
                                                            <path d="M7 15l.01 0"></path>
                                                            <path d="M11 15l2 0"></path>
                                                        </svg>
                                                        <div>{{ $courses }}</div>
                                                        <div>Courses</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="stats-card">
                                                        <svg class="stat-icon test11" xmlns="http://www.w3.org/2000/svg"
                                                            width="40" height="40" viewBox="0 0 24 24" fill="none"
                                                            stroke="purple" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path
                                                                d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z">
                                                            </path>
                                                            <path d="M3 10l18 0"></path>
                                                            <path d="M7 15l.01 0"></path>
                                                            <path d="M11 15l2 0"></path>
                                                        </svg>
                                                        <div>100%</div>
                                                        <div>Order</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Calendar Section -->
                                    <div class="col-lg-12">
                                        <div class="card p-2" style="width: 431px;">
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>






                        </div>

                    </div>



                    <!-- Widgets Start -->
                    <div class="container-fluid pt-4 px-4">
                        <div class="row g-4">


                            {{-- <div class="container-fluid col-sm-8">
                                <div class="bg-light text-center rounded p-4"
                                    style="margin-top: -222px; width: 903px; margin-left: -20px;margin-top:-238px;">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h6 class="mb-0">Latest Students</h6>
                                        <a href="{{ route('studentlist') }}">Show All</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                                            <thead>
                                                <tr class="text-dark">

                                                    <th scope="col">#</th>
                                                    <th scope="col">Profile</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">Gender</th>
                                                    <th scope="col">Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($latestStudents as $keys=> $user)
                                                <tr>
                                                    <td>{{ $keys + 1 }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 wid-40">
                                                                @if ($user->profile_picture)
                                                                <img class="img-radius"
                                                                    src="{{ asset('storage/' . $user->profile_picture) }}"
                                                                    alt="User image" style="height:52px;width: 52px;">
                                                                @else
                                                                <img class="img-radius"
                                                                    src="{{ asset('asset/images/download.jpg') }}"
                                                                    alt="Default image"
                                                                    style="height:52px;width: 52px;">
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

                                                    <td>{{ $user->gender }}</td>
                                                    <td>
                                                        @if($user->status == 1)
                                                        <span
                                                            class="badge rounded-pill f-14 bg-light-success">Active</span>
                                                        @else
                                                        <span class="badge bg-light-danger rounded-pill f-14">Inactive
                                                        </span>
                                                        @endif
                                                    </td>



                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="container-fluid col-sm-8">
                                <div class="card"
                                    style="margin-top: -222px; width: 903px; margin-left: -20px;margin-top:-245px;">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Latest Students</h6>
                                        <a href="{{ route('studentlist') }}">Show All</a>
                                    </div>
                                    <div class="card-body p-0"
                                        style="max-height: 300px; overflow-y: auto;    margin-top: 1px;">
                                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Profile</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">Gender</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($latestStudents as $keys => $user)
                                                <tr>
                                                    <td>{{ $keys + 1 }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 wid-40">
                                                                @if ($user->profile_picture)
                                                                <img class="img-radius"
                                                                    src="{{ asset('storage/' . $user->profile_picture) }}"
                                                                    alt="User image" style="height:52px;width: 52px;">
                                                                @else
                                                                <img class="img-radius"
                                                                    src="{{ asset('asset/images/download.jpg') }}"
                                                                    alt="Default image"
                                                                    style="height:52px;width: 52px;">
                                                                @endif
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6>{{ $user->name }}</h6>
                                                                <p class="text-muted f-12 mb-0">{{ $user->email }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $user->username }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ $user->gender }}</td>
                                                    <td>
                                                        @if($user->status == 1)
                                                        <span
                                                            class="badge rounded-pill f-14 bg-light-success">Active</span>
                                                        @else
                                                        <span
                                                            class="badge bg-light-danger rounded-pill f-14">Inactive</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>



                            {{-- --}}

                            <div class="col-sm-12 col-md-6 col-xl-4" style="    margin-bottom: 22px;margin-top:0px">
                                <div class="h-100 bg-light rounded p-4" style="margin-left: 11px; width: 429px;">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h6 class="mb-0">Notifications</h6>
                                        <a href="">Show All</a>
                                    </div>
                                    <div class="d-flex align-items-center border-bottom py-3">
                                        <img class="rounded-circle flex-shrink-0" src="asset/images/stu.jpg" alt=""
                                            style="width: 40px; height: 40px;">
                                        <div class="w-100 ms-3">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-0">Jhon Doe</h6>
                                                <small>15 minutes ago</small>
                                            </div>
                                            <span>Short message goes here...</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center border-bottom py-3">
                                        <img class="rounded-circle flex-shrink-0" src="asset/images/stu.jpg" alt=""
                                            style="width: 40px; height: 40px;">
                                        <div class="w-100 ms-3">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-0">Jhon Doe</h6>
                                                <small>15 minutes ago</small>
                                            </div>
                                            <span>Short message goes here...</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center border-bottom py-3">
                                        <img class="rounded-circle flex-shrink-0" src="asset/images/stu.jpg" alt=""
                                            style="width: 40px; height: 40px;">
                                        <div class="w-100 ms-3">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-0">Jhon Doe</h6>
                                                <small>15 minutes ago</small>
                                            </div>
                                            <span>Short message goes here...</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center pt-3">
                                        <img class="rounded-circle flex-shrink-0" src="asset/images/stu.jpg" alt=""
                                            style="width: 40px; height: 40px;">
                                        <div class="w-100 ms-3">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-0">Jhon Doe</h6>
                                                <small>15 minutes ago</small>
                                            </div>
                                            <span>Short message goes here...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-xl-8" style="margin-top: -251px;    margin-bottom: 22px">
                                <div class="h-100 bg-light rounded p-4" style="width: 901px; margin-left: -18px;">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h6 class="mb-0">To Do List</h6>
                                        {{-- <a href="">Show All</a> --}}
                                    </div>
                                    <div class="d-flex mb-2">
                                        <input class="form-control bg-transparent" type="text" placeholder="Enter task">
                                        <button type="button" class="btn btn-primary ms-2">Add</button>
                                    </div>
                                    <div class="d-flex align-items-center border-bottom py-2">
                                        <input class="form-check-input m-0" type="checkbox">
                                        <div class="w-100 ms-3">
                                            <div class="d-flex w-100 align-items-center justify-content-between">
                                                <span>Short task goes here...</span>
                                                <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center border-bottom py-2">
                                        <input class="form-check-input m-0" type="checkbox">
                                        <div class="w-100 ms-3">
                                            <div class="d-flex w-100 align-items-center justify-content-between">
                                                <span>Short task goes here...</span>
                                                <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center border-bottom py-2">
                                        <input class="form-check-input m-0" type="checkbox" checked>
                                        <div class="w-100 ms-3">
                                            <div class="d-flex w-100 align-items-center justify-content-between">
                                                <span><del>Short task goes here...</del></span>
                                                <button class="btn btn-sm text-primary"><i
                                                        class="fa fa-times"></i></button>
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
    </div>
</div>
</div>
</div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js">
</script>
<!-- Chart.js Script -->
<script>
    const ctx = document.getElementById('activityChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['1', '2', '3', '4', '5', '6', '7'],
        datasets: [{
                label: 'Free Course',
                data: [60, 90, 30, 70, 50, 40, 20],
                borderColor: 'green',
                fill: false,
            },
            {
                label: 'Subscription',
                data: [30, 20, 40, 50, 80, 90, 70],
                borderColor: 'blue',
                fill: false,
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});
</script>



<script>
    const ctx = document.getElementById('revenueSalesChart').getContext('2d');
const revenueSalesChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16],
        datasets: [{
                label: 'Revenue',
                data: [200, 250, 300, 350, 400, 370, 300, 320, 380, 420, 450, 400, 370, 390, 410, 450],
                borderColor: '#f0ad4e',
                backgroundColor: 'rgba(240, 173, 78, 0.1)',
                fill: true,
                tension: 0.4
            },
            {
                label: 'Sales',
                data: [220, 260, 290, 310, 380, 360, 330, 300, 370, 410, 430, 390, 350, 370, 400, 420],
                borderColor: '#0275d8',
                backgroundColor: 'rgba(2, 117, 216, 0.1)',
                fill: true,
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Days'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Amount ($)'
                },
                beginAtZero: true
            }
        }
    }
});
</script>


<script>
    // Earnings Chart
const earningsCtx = document.getElementById('earningsChart').getContext('2d');
const earningsChart = new Chart(earningsCtx, {
    type: 'bar',
    data: {
        labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
        datasets: [{
                label: 'Net Profit',
                data: [12, 19, 3, 5, 2, 3, 9, 12, 14, 16, 10, 15],
                backgroundColor: '#36a2eb',
            },
            {
                label: 'Revenue',
                data: [15, 25, 6, 10, 4, 6, 12, 15, 18, 20, 13, 18],
                backgroundColor: '#ffce56',
            }
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: true
        },
        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>



<script>
    // Worldwide Sales Chart
const worldwideSalesCtx = document.getElementById('worldwide-sales').getContext('2d');
const worldwideSalesChart = new Chart(worldwideSalesCtx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Sales',
            data: [200, 300, 250, 400, 450, 350, 300, 320, 380, 420, 450, 400],
            backgroundColor: '#0275d8',
            borderColor: '#0275d8',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Months'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Sales ($)'
                },
                beginAtZero: true
            }
        }
    }
});

// Sales & Revenue Chart
const earningsCtx = document.getElementById('earningsChart').getContext('2d');
const earningsChart = new Chart(earningsCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
                label: 'Revenue',
                data: [300, 400, 350, 450, 500, 550, 600, 650, 700, 750, 800, 850],
                borderColor: '#f0ad4e',
                backgroundColor: 'rgba(240, 173, 78, 0.1)',
                fill: true,
                tension: 0.4
            },
            {
                label: 'Sales',
                data: [280, 390, 340, 440, 490, 540, 590, 640, 690, 740, 790, 840],
                borderColor: '#0275d8',
                backgroundColor: 'rgba(2, 117, 216, 0.1)',
                fill: true,
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Months'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Amount ($)'
                },
                beginAtZero: true
            }
        }
    }
});
</script>


<!-- FullCalendar Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: '',
            center: 'title',
            right: 'prev,next'
        },
        selectable: true
    });
    calendar.render();
});
</script>
</script>

<script>
    const ctx = document.getElementById('studentChart').getContext('2d');
const studentChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Total Signups', 'Active Student'],
        datasets: [{
            data: [100, 30], // Example data
            backgroundColor: ['#36a2eb', '#ff6384'],
            hoverOffset: 4
        }]
    },
    options: {
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return `${context.label}: ${context.raw}`;
                    }
                }
            }
        },
        maintainAspectRatio: false,
    }
});
</script>

<script>
    // Revenue and Sales Chart
    const revenueCtx = document.getElementById('revenueSalesChart').getContext('2d');
    const revenueSalesChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16],
            datasets: [
                {
                    label: 'Revenue',
                    data: [200, 250, 300, 350, 400, 370, 300, 320, 380, 420, 450, 400, 370, 390, 410, 450],
                    borderColor: '#f0ad4e',
                    backgroundColor: 'rgba(240, 173, 78, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Sales',
                    data: [220, 260, 290, 310, 380, 360, 330, 300, 370, 410, 430, 390, 350, 370, 400, 420],
                    borderColor: '#0275d8',
                    backgroundColor: 'rgba(2, 117, 216, 0.1)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Days'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Amount ($)'
                    },
                    beginAtZero: true
                }
            }
        }
    });

    // Earnings Chart
    const earningsCtx = document.getElementById('earningsChart').getContext('2d');
    const earningsChart = new Chart(earningsCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    label: 'Earnings',
                    data: [500, 600, 550, 650, 700, 750, 720, 800, 850, 900, 950, 1000],
                    backgroundColor: 'rgba(40, 167, 69, 0.5)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Months'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Earnings ($)'
                    },
                    beginAtZero: true
                }
            }
        }
    });
</script>

@include('partials.footer')
@endsection
