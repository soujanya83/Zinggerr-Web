@extends('layouts.app')

@section('pageTitle', 'Dashboard')

@section('content')

@include('partials.sidebar')
@include('partials.headerdashboard')

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
                            <h5 class="m-b-10">Teachers Dashboard View</h5>
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
                    <div class="card-header">

                        <div class="dashboard-card">
                            <div class="card-body">
                                <div class="card-value">
                                    {{ $student }}
                                    <span class="icon-up"><i class="ti ti-arrow-up-right-circle opacity-50"></i></span>
                                </div>
                                <div class="card-title">Total Students</div>
                            </div>
                        </div>

                        <div class="dashboard-card" style="background-color:#0dc878">
                            <div class="card-body">
                                <div class="card-value">
                                    {{ $courses }}
                                    <span class="icon-up"><i class="ti ti-arrow-up-right-circle opacity-50"></i></span>
                                </div>
                                <div class="card-title">Total Courses</div>
                            </div>
                        </div>

                        <div class="dashboard-card" style="background-color:#F6A4EC">
                            <div class="card-body">
                                <div class="card-value">
                                    {{ $teacher }}
                                    <span class="icon-up"><i class="ti ti-arrow-up-right-circle opacity-50"></i></span>
                                </div>
                                <div class="card-title">Total Teachers</div>
                            </div>
                        </div>

                        <div class="dashboard-card" style="background-color:#1CC6FF">
                            <div class="card-body">
                                <div class="card-value">
                                    1350
                                    <span class="icon-up"><i class="ti ti-arrow-up-right-circle opacity-50"></i></span>
                                </div>
                                <div class="card-title">Total Pending Orders</div>
                            </div>
                        </div>

                    </div>




                    <div class="container-fluid pt-4 px-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-6 col-xl-4">
                                <div class="h-100 bg-light rounded p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h6 class="mb-0">Notifications</h6>
                                        <a href="">Show All</a>
                                    </div>
                                    <div class="d-flex align-items-center border-bottom py-3">
                                        <img class="rounded-circle flex-shrink-0" src="../asset/images/stu.jpg" alt=""
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
                                        <img class="rounded-circle flex-shrink-0" src="../asset/images/stu.jpg" alt=""
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
                                        <img class="rounded-circle flex-shrink-0" src="../asset/images/stu.jpg" alt=""
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
                                        <img class="rounded-circle flex-shrink-0" src="../asset/images/stu.jpg" alt=""
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

                            <div class="col-sm-12 col-md-6 col-xl-4">
                                <div class="h-100 bg-light rounded p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <h6 class="mb-0">To Do List</h6>
                                        <a href="">Show All</a>
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
                                    <div class="d-flex align-items-center border-bottom py-2">
                                        <input class="form-check-input m-0" type="checkbox">
                                        <div class="w-100 ms-3">
                                            <div class="d-flex w-100 align-items-center justify-content-between">
                                                <span>Short task goes here...</span>
                                                <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center pt-2">
                                        <input class="form-check-input m-0" type="checkbox">
                                        <div class="w-100 ms-3">
                                            <div class="d-flex w-100 align-items-center justify-content-between">
                                                <span>Short task goes here...</span>
                                                <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Calendar Section -->
                            <div class="col-lg-4">
                                <div class="card p-3">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Widgets Start -->
                    <div class="container-fluid pt-4 px-4">
                        <div class="row g-4">

                            <!-- Recent Sales Start -->
                            <div class="container-fluid col-sm-12 mt-4">
                                <div class="bg-light text-center rounded p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h6 class="mb-0">Course States</h6>
                                        <a href="">Show All</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                                            <thead>
                                                <tr class="text-dark">
                                                    <th scope="col"><input class="form-check-input" type="checkbox">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

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

@include('partials.footer')
@endsection
