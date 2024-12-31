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
                                    <div class="row g-4" style="    margin-top: -10px;">
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="rounded d-flex align-items-center justify-content-between p-4"
                                                style="background-color:#00c853; height: 88px;color:#fff">

                                                <div class="ms-3">
                                                    <p class="mb-2">
                                                        <i class="ti ti-users f-24"></i> Total Students
                                                    </p>
                                                    <h6 class="mb-0">&nbsp&nbsp&nbsp&nbsp&nbsp {{ $student }}</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xl-3">
                                            <div class="rounded d-flex align-items-center justify-content-between p-4"
                                                style="height: 88px;background-color:#5be8e1;color:#fff">

                                                <div class="ms-3">
                                                    <i class="ti ti-notebook f-24"></i> Total Course <h6 class="mb-0">
                                                        &nbsp&nbsp&nbsp&nbsp&nbsp {{ $courses }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="rounded d-flex align-items-center justify-content-between p-4"
                                                style="height: 88px;background-color:#F6A4EC;color:#fff">

                                                <div class="ms-3">
                                                    <i class="ti ti-coin f-24"></i> Today Revenue
                                                    <h6 class="mb-0">&nbsp&nbsp&nbsp&nbsp&nbsp $1234</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-3">
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
                                        <div class="col-sm-12 col-xl-6">
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

                                        <!-- Sales & Revenue Chart -->
                                        <div class="col-sm-12 col-xl-6">
                                            <div class="bg-light text-center rounded p-4">
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <h6 class="mb-0">Sales & Revenue</h6>
                                                    <a href="#">Show All</a>
                                                </div>
                                                <canvas id="earningsChart"></canvas>
                                                <i class="icon-settings">&#9881;</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Widgets Start -->
                                <div class="container-fluid pt-4 px-4">
                                    <div class="row g-4">
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
                                        <div class="col-sm-12 col-md-6 col-xl-4">
                                            <div class="h-100 bg-light rounded p-4">
                                                <div class="d-flex align-items-center justify-content-between mb-4">
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
                                <!-- Widgets End -->



                                <div class="row">
                                    <!-- Chart Section -->
                                    <div class="col-lg-8 mb-3">
                                        <div class="card p-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5>Activity</h5>
                                                <select class="form-select form-select-sm w-auto">
                                                    <option selected>Monthly</option>
                                                    <option>Weekly</option>
                                                    <option>Daily</option>
                                                </select>
                                            </div>
                                            <canvas id="activityChart" height="200"></canvas>
                                        </div>
                                    </div>
                                    <!-- Calendar Section -->
                                    <div class="col-lg-4 mb-3">
                                        <div class="card p-3">
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Recent Sales Start -->
                            <div class="container-fluid pt-4 px-4">
                                <div class="bg-light text-center rounded p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
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
                                                    <td><input class="form-check-input" type="checkbox"></td>
                                                    <td>01 Jan 2045</td>
                                                    <td>INV-0123</td>
                                                    <td>* 4.8</td>
                                                    <td>$123</td>
                                                    <td>Paid</td>
                                                    <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-check-input" type="checkbox"></td>
                                                    <td>01 Jan 2045</td>
                                                    <td>INV-0123</td>
                                                    <td>* 4.8</td>
                                                    <td>$123</td>
                                                    <td>Paid</td>
                                                    <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-check-input" type="checkbox"></td>
                                                    <td>01 Jan 2045</td>
                                                    <td>INV-0123</td>
                                                    <td>* 4.8</td>
                                                    <td>$123</td>
                                                    <td>Paid</td>
                                                    <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-check-input" type="checkbox"></td>
                                                    <td>01 Jan 2045</td>
                                                    <td>INV-0123</td>
                                                    <td>* 4.8</td>
                                                    <td>$123</td>
                                                    <td>Paid</td>
                                                    <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-check-input" type="checkbox"></td>
                                                    <td>01 Jan 2045</td>
                                                    <td>INV-0123</td>
                                                    <td>* 4.8</td>
                                                    <td>$123</td>
                                                    <td>Paid</td>
                                                    <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{--
                    </div> --}}
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
