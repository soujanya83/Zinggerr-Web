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

    .icon-box {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: #eaf1ff;
        margin: auto;
    }

    .stat-value {
        font-size: 22px;
        font-weight: bold;
        margin-top: 10px;
    }

    .stat-label {
        font-size: 14px;
        color: gray;
        text-transform: uppercase;
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

        <div class="row" style="width: 100%;margin-left: 0px;">
            {{-- <div class="col-12"> --}}
                <div class="card">
                    {{-- <div class="card-header"> --}}
                        <div class="container-fluid">

                            <div class="content">

                                <div class="container-fluid">
                                    <div class="row g-4" style="margin-top:-10px">
                                        <div class="col-sm-6 col-xl-2">
                                            <div class="rounded d-flex align-items-center justify-content-between p-4"
                                                style="background-color:#3bcd78; height: 88px;color:#fff">

                                                <div class="ms-3">
                                                    <p class="mb-2">
                                                        <i class="ti ti-users f-24"></i> Total Students
                                                    </p>
                                                    <h6 class="mb-0">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp {{ $student }}</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xl-2">
                                            <div class="rounded d-flex align-items-center justify-content-between p-4"
                                                style="background-color:#ba5dd8; height: 88px;color:#fff">

                                                <div class="ms-3">
                                                    <p class="mb-2">
                                                        <i class="ti ti-users f-24"></i> Total Students
                                                    </p>
                                                    <h6 class="mb-0">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp {{ $student }}</h6>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm-6 col-xl-2">
                                            <div class="rounded d-flex align-items-center justify-content-between p-4"
                                                style="height: 88px;background-color:#5be8e1;color:#fff">

                                                <div class="ms-3">
                                                    <i class="ti ti-notebook f-24"></i> Total Course <h6 class="mb-0">
                                                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp {{ $courses }}</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xl-2">
                                            <div class="rounded d-flex align-items-center justify-content-between p-4"
                                                style="height: 88px;background-color:#f469a5;color:#fff">

                                                <div class="ms-3">
                                                    <i class="ti ti-notebook f-24"></i> Total <h6 class="mb-0">
                                                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 1234</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xl-2">
                                            <div class="rounded d-flex align-items-center justify-content-between p-4"
                                                style="height: 88px;background-color:#F6A4EC;color:#fff">

                                                <div class="ms-3">
                                                    <i class="ti ti-coin f-24"></i> Money
                                                    <h6 class="mb-0">&nbsp&nbsp&nbsp&nbsp&nbsp $1234</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-2">
                                            <div class="rounded d-flex align-items-center justify-content-between p-4"
                                                style="height: 88px;background-color:#1CC6FF;color:#fff ">

                                                <div class="ms-3">
                                                    <i class="ti ti-eye f-24"></i> New Visitor
                                                    <h6 class="mb-0">&nbsp&nbsp&nbsp&nbsp&nbsp $1234</h6>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- Sale & Revenue End -->
                                <div class="container-fluid pt-4 px-4">
                                    <div class="row g-4">
                                        <!-- Revenue & Sales Chart -->
                                        <div class="col-sm-12 col-xl-8">
                                            <div class="card card-custom">
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



                                        <div class="col-lg-4">
                                            {{-- <div class="card p-3"> --}}

                                                <div class="container mt-5">
                                                    <div class="card p-4">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <div class="stats-card">
                                                                    <div class="icon-box">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="30" height="30" viewBox="0 0 24 24"
                                                                            fill="none" stroke="purple" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path
                                                                                d="M6 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0">
                                                                            </path>
                                                                            <path
                                                                                d="M18 6m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0">
                                                                            </path>
                                                                            <path
                                                                                d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0">
                                                                            </path>
                                                                            <path d="M8.7 10.7l6.6 -3.4"></path>
                                                                            <path d="M8.7 13.3l6.6 3.4"></path>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="stat-value">1000</div>
                                                                    <div class="stat-label">Shares</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="stats-card">
                                                                    <div class="icon-box">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="30" height="30" viewBox="0 0 24 24"
                                                                            fill="none" stroke="purple" stroke-width="2"
                                                                            stroke-linecap="round"
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
                                                                        </svg>
                                                                    </div>
                                                                    <div class="stat-value">600</div>
                                                                    <div class="stat-label">Network</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="stats-card">
                                                                    <div class="icon-box">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="30" height="30" viewBox="0 0 24 24"
                                                                            fill="none" stroke="purple" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path
                                                                                d="M12 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0">
                                                                            </path>
                                                                            <path
                                                                                d="M6.5 17m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0">
                                                                            </path>
                                                                            <path
                                                                                d="M17.5 17m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0">
                                                                            </path>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="stat-value">3550</div>
                                                                    <div class="stat-label">Returns</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="stats-card">
                                                                    <div class="icon-box">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="30" height="30" viewBox="0 0 24 24"
                                                                            fill="none" stroke="purple" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path
                                                                                d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z">
                                                                            </path>
                                                                            <path d="M3 10l18 0"></path>
                                                                            <path d="M7 15l.01 0"></path>
                                                                            <path d="M11 15l2 0"></path>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="stat-value">100%</div>
                                                                    <div class="stat-label">Order</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--
                                            </div> --}}
                                        </div>



                                        {{-- <div class="col-lg-4">
                                            <div class="card p-3">
                                                <div
                                                    class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation0 MuiCard-root css-xas8z8">
                                                    <div class="MuiGrid-root MuiGrid-container css-v3z1wi">
                                                        <div
                                                            class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-6 css-cz50lb">
                                                            <div
                                                                class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-1 css-1lguhm4">
                                                                <div class="MuiGrid-root MuiGrid-item css-1wxaqej"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="tabler-icon tabler-icon-share">
                                                                        <path
                                                                            d="M6 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0">
                                                                        </path>
                                                                        <path
                                                                            d="M18 6m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0">
                                                                        </path>
                                                                        <path
                                                                            d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0">
                                                                        </path>
                                                                        <path d="M8.7 10.7l6.6 -3.4"></path>
                                                                        <path d="M8.7 13.3l6.6 3.4"></path>
                                                                    </svg></div>
                                                                <div
                                                                    class="MuiGrid-root MuiGrid-item MuiGrid-zeroMinWidth MuiGrid-grid-sm-true css-1p1r6xg">
                                                                    <h5
                                                                        class="MuiTypography-root MuiTypography-h5 MuiTypography-alignCenter css-zbq3wc">
                                                                        1000</h5>
                                                                    <h6
                                                                        class="MuiTypography-root MuiTypography-subtitle2 MuiTypography-alignCenter css-2br1w7">
                                                                        SHARES</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-6 css-cz50lb">
                                                            <div
                                                                class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-1 css-1lguhm4">
                                                                <div class="MuiGrid-root MuiGrid-item css-1wxaqej"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="tabler-icon tabler-icon-access-point">
                                                                        <path d="M12 12l0 .01"></path>
                                                                        <path d="M14.828 9.172a4 4 0 0 1 0 5.656">
                                                                        </path>
                                                                        <path d="M17.657 6.343a8 8 0 0 1 0 11.314">
                                                                        </path>
                                                                        <path d="M9.168 14.828a4 4 0 0 1 0 -5.656">
                                                                        </path>
                                                                        <path d="M6.337 17.657a8 8 0 0 1 0 -11.314">
                                                                        </path>
                                                                    </svg></div>
                                                                <div
                                                                    class="MuiGrid-root MuiGrid-item MuiGrid-zeroMinWidth MuiGrid-grid-sm-true css-1p1r6xg">
                                                                    <h5
                                                                        class="MuiTypography-root MuiTypography-h5 MuiTypography-alignCenter css-zbq3wc">
                                                                        600</h5>
                                                                    <h6
                                                                        class="MuiTypography-root MuiTypography-subtitle2 MuiTypography-alignCenter css-2br1w7">
                                                                        NETWORK</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="MuiGrid-root MuiGrid-container css-v3z1wi">
                                                        <div
                                                            class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-6 css-cz50lb">
                                                            <div
                                                                class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-1 css-1lguhm4">
                                                                <div class="MuiGrid-root MuiGrid-item css-1wxaqej"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="tabler-icon tabler-icon-circles">
                                                                        <path
                                                                            d="M12 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0">
                                                                        </path>
                                                                        <path
                                                                            d="M6.5 17m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0">
                                                                        </path>
                                                                        <path
                                                                            d="M17.5 17m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0">
                                                                        </path>
                                                                    </svg></div>
                                                                <div
                                                                    class="MuiGrid-root MuiGrid-item MuiGrid-zeroMinWidth MuiGrid-grid-sm-true css-1p1r6xg">
                                                                    <h5
                                                                        class="MuiTypography-root MuiTypography-h5 MuiTypography-alignCenter css-zbq3wc">
                                                                        3550</h5>
                                                                    <h6
                                                                        class="MuiTypography-root MuiTypography-subtitle2 MuiTypography-alignCenter css-2br1w7">
                                                                        RETURNS</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-6 css-cz50lb">
                                                            <div
                                                                class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-1 css-1lguhm4">
                                                                <div class="MuiGrid-root MuiGrid-item css-1wxaqej"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="tabler-icon tabler-icon-credit-card">
                                                                        <path
                                                                            d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z">
                                                                        </path>
                                                                        <path d="M3 10l18 0"></path>
                                                                        <path d="M7 15l.01 0"></path>
                                                                        <path d="M11 15l2 0"></path>
                                                                    </svg></div>
                                                                <div
                                                                    class="MuiGrid-root MuiGrid-item MuiGrid-zeroMinWidth MuiGrid-grid-sm-true css-1p1r6xg">
                                                                    <h5
                                                                        class="MuiTypography-root MuiTypography-h5 MuiTypography-alignCenter css-zbq3wc">
                                                                        100%</h5>
                                                                    <h6
                                                                        class="MuiTypography-root MuiTypography-subtitle2 MuiTypography-alignCenter css-2br1w7">
                                                                        ORDER</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div> --}}



                                        <!-- Calendar Section -->
                                        {{-- <div class="col-lg-4">
                                            <div class="card p-3">
                                                <div id="calendar"></div>
                                            </div>
                                        </div> --}}

                                    </div>

                                </div>



                                <!-- Widgets Start -->
                                <div class="container-fluid pt-4 px-4">
                                    <div class="row g-4">

                                        <!-- Sales & Revenue Chart -->
                                        <div class="col-sm-12 col-xl-8" style="margin-top: -70px;">
                                            <div class="bg-light text-center rounded p-4">
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <h6 class="mb-0">Sales & Revenue</h6>
                                                    <a href="#">Show All</a>
                                                </div>
                                                <canvas id="earningsChart"></canvas>
                                                <i class="icon-settings">&#9881;</i>
                                            </div>
                                        </div>




                                        <div class="col-sm-12 col-md-6 col-xl-4">
                                            <div class="h-100 bg-light rounded p-4">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <h6 class="mb-0">Notifications</h6>
                                                    <a href="">Show All</a>
                                                </div>
                                                <div class="d-flex align-items-center border-bottom py-3">
                                                    <img class="rounded-circle flex-shrink-0" src="asset/images/stu.jpg"
                                                        alt="" style="width: 40px; height: 40px;">
                                                    <div class="w-100 ms-3">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h6 class="mb-0">Jhon Doe</h6>
                                                            <small>15 minutes ago</small>
                                                        </div>
                                                        <span>Short message goes here...</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center border-bottom py-3">
                                                    <img class="rounded-circle flex-shrink-0" src="asset/images/stu.jpg"
                                                        alt="" style="width: 40px; height: 40px;">
                                                    <div class="w-100 ms-3">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h6 class="mb-0">Jhon Doe</h6>
                                                            <small>15 minutes ago</small>
                                                        </div>
                                                        <span>Short message goes here...</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center border-bottom py-3">
                                                    <img class="rounded-circle flex-shrink-0" src="asset/images/stu.jpg"
                                                        alt="" style="width: 40px; height: 40px;">
                                                    <div class="w-100 ms-3">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h6 class="mb-0">Jhon Doe</h6>
                                                            <small>15 minutes ago</small>
                                                        </div>
                                                        <span>Short message goes here...</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center pt-3">
                                                    <img class="rounded-circle flex-shrink-0" src="asset/images/stu.jpg"
                                                        alt="" style="width: 40px; height: 40px;">
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

                                        <div class="row">
                                            <!-- Chart Section -->
                                            <div class="col-lg-8 mb-3">
                                                <div class="card p-3">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h5>Activitys</h5>
                                                        <select class="form-select form-select-sm w-auto">
                                                            <option selected>Monthly</option>
                                                            <option>Weekly</option>
                                                            <option>Daily</option>
                                                        </select>
                                                    </div>
                                                    <canvas id="activityChart" height="200"></canvas>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-6 col-xl-4">
                                                <div class="h-100 bg-light rounded p-4">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h6 class="mb-0">Calender</h6>
                                                        <a href="">Show All</a>
                                                    </div>
                                                    <div class="chart-container text-center">
                                                        <h6 class="mb-3">Student States</h6>
                                                        <canvas id="studentChart"></canvas>
                                                        <div class="chart-legend mt-3">
                                                            <span><span class="dot"
                                                                    style="background-color: #36a2eb;"></span>Total
                                                                Signups</span>
                                                            <span><span class="dot"
                                                                    style="background-color: #ff6384;"></span>Active
                                                                Student</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>




                                        <!-- Recent Sales Start -->
                                        <div class="container-fluid col-sm-8">
                                            <div class="bg-light text-center rounded p-4">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <h6 class="mb-0">Course States</h6>
                                                    <a href="">Show All</a>
                                                </div>
                                                <div class="table-responsive">
                                                    <table
                                                        class="table text-start align-middle table-bordered table-hover mb-0">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th scope="col"><input class="form-check-input"
                                                                        type="checkbox">
                                                                </th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Teacher</th>
                                                                <th scope="col">Rating</th>
                                                                <th scope="col">Earring</th>
                                                                <th scope="col">Sale</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input class="form-check-input" type="checkbox">
                                                                </td>
                                                                <td>01 Jan 2045</td>
                                                                <td>INV-0123</td>
                                                                <td>* 4.8</td>
                                                                <td>$123</td>
                                                                <td>Paid</td>
                                                                <td><a class="btn btn-sm btn-primary" href="">Detail</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input class="form-check-input" type="checkbox">
                                                                </td>
                                                                <td>01 Jan 2045</td>
                                                                <td>INV-0123</td>
                                                                <td>* 4.8</td>
                                                                <td>$123</td>
                                                                <td>Paid</td>
                                                                <td><a class="btn btn-sm btn-primary" href="">Detail</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input class="form-check-input" type="checkbox">
                                                                </td>
                                                                <td>01 Jan 2045</td>
                                                                <td>INV-0123</td>
                                                                <td>* 4.8</td>
                                                                <td>$123</td>
                                                                <td>Paid</td>
                                                                <td><a class="btn btn-sm btn-primary" href="">Detail</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input class="form-check-input" type="checkbox">
                                                                </td>
                                                                <td>01 Jan 2045</td>
                                                                <td>INV-0123</td>
                                                                <td>* 4.8</td>
                                                                <td>$123</td>
                                                                <td>Paid</td>
                                                                <td><a class="btn btn-sm btn-primary" href="">Detail</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input class="form-check-input" type="checkbox">
                                                                </td>
                                                                <td>01 Jan 2045</td>
                                                                <td>INV-0123</td>
                                                                <td>* 4.8</td>
                                                                <td>$123</td>
                                                                <td>Paid</td>
                                                                <td><a class="btn btn-sm btn-primary" href="">Detail</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm-12 col-md-6 col-xl-4">
                                            <div class="h-100 bg-light rounded p-4">
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <h6 class="mb-0">To Do List</h6>
                                                    <a href="">Show All</a>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <input class="form-control bg-transparent" type="text"
                                                        placeholder="Enter task">
                                                    <button type="button" class="btn btn-primary ms-2">Add</button>
                                                </div>
                                                <div class="d-flex align-items-center border-bottom py-2">
                                                    <input class="form-check-input m-0" type="checkbox">
                                                    <div class="w-100 ms-3">
                                                        <div
                                                            class="d-flex w-100 align-items-center justify-content-between">
                                                            <span>Short task goes here...</span>
                                                            <button class="btn btn-sm"><i
                                                                    class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center border-bottom py-2">
                                                    <input class="form-check-input m-0" type="checkbox">
                                                    <div class="w-100 ms-3">
                                                        <div
                                                            class="d-flex w-100 align-items-center justify-content-between">
                                                            <span>Short task goes here...</span>
                                                            <button class="btn btn-sm"><i
                                                                    class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center border-bottom py-2">
                                                    <input class="form-check-input m-0" type="checkbox" checked>
                                                    <div class="w-100 ms-3">
                                                        <div
                                                            class="d-flex w-100 align-items-center justify-content-between">
                                                            <span><del>Short task goes here...</del></span>
                                                            <button class="btn btn-sm text-primary"><i
                                                                    class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center border-bottom py-2">
                                                    <input class="form-check-input m-0" type="checkbox">
                                                    <div class="w-100 ms-3">
                                                        <div
                                                            class="d-flex w-100 align-items-center justify-content-between">
                                                            <span>Short task goes here...</span>
                                                            <button class="btn btn-sm"><i
                                                                    class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center pt-2">
                                                    <input class="form-check-input m-0" type="checkbox">
                                                    <div class="w-100 ms-3">
                                                        <div
                                                            class="d-flex w-100 align-items-center justify-content-between">
                                                            <span>Short task goes here...</span>
                                                            <button class="btn btn-sm"><i
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
