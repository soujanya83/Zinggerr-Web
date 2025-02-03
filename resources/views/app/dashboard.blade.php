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



<div class="pc-container">
    <div class="pc-content">
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-xxl-8">

                <div class="row">
                    <div class="col-md-6">
                        <div class="card  order-card" style="background-color: #aa33d4">
                            <div class="card-body">
                                <h5 class="text-white">Courses Last 7 day`s</h5>
                                <h3 class="text-white">{{ $courseslast7day
                                    }}</h3>
                                <p class="m-b-0">{{ $coursesLastMonth }} Courses Last
                                    Month</p>
                                <i class="material-icons-two-tone d-block f-46 card-icon text-white">note</i>
                            </div>
                        </div>



                    </div>
                    <div class="col-md-6">
                        <div class="card bg-primary order-card">
                            <div class="card-body">
                                <h5 class="text-white">Students Last 7
                                    day`s</h5>
                                <h3 class="text-white">{{ $studentlast7day
                                    }}</h3>
                                <p class="m-b-0">{{ $studentlastmonth }} Students Last
                                    Month</p><i
                                    class="material-icons-two-tone d-block f-46 card-icon text-white">account_circle</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Latest Students</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="customers-scroll" style="height: 310px; position: relative">
                                <table class="table table-hover table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align:center">#</th>
                                            <th scope=" col">Profile</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($latestStudents as $keys => $user)
                                        <tr>
                                            <td style="padding: 4px;text-align:center">{{ $keys + 1 }}</td>
                                            <td style="padding: 4px;">
                                                <div class="d-flex align-items-center" style="margin-top: -3px;">
                                                    <div class="flex-shrink-0 wid-40">
                                                        @if ($user->profile_picture)
                                                        <img class="img-radius"
                                                            src="{{ asset('storage/' . $user->profile_picture) }}"
                                                            alt="User image"
                                                            style="height:45px;width: 45px;margin-top:5px">
                                                        @else
                                                        <img class="img-radius"
                                                            src="{{ asset('asset/images/download.jpg') }}"
                                                            alt="Default image"
                                                            style="height:45px;width: 45px;margin-top:5px">
                                                        @endif
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6>{{ $user->name }}</h6>
                                                        <p class="text-muted f-12 mb-0">{{
                                                            $user->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 4px;">{{ $user->phone }}</td>
                                            <td style="padding: 4px;">{{ $user->gender }}</td>
                                            <td style="padding: 4px;">
                                                @if($user->status == 1)
                                                <span class="badge rounded-pill f-14 bg-light-success">Active</span>
                                                @else
                                                <span class="badge bg-light-danger rounded-pill f-14">Inactive</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end"><a href="{{ route('studentlist') }}"
                            class="b-b-primary text-primary">View
                            all</a></div>
                </div>



                <div class="card table-card">
                    <div class="card-header">
                        <h5>To Do List</h5>
                    </div>
                    <div class="card-body" style="padding:5px">
                        <div class="table-responsive">
                            <div class="customers-scroll">

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
                                            <button class="btn btn-sm text-primary"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-footer text-end"><a href="{{ route('studentlist') }}"
                            class="b-b-primary text-primary">View
                            all</a></div> --}}
                </div>



            </div>
            <div class="col-xxl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body w-50 br">
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="b-icons bg-light-primary"><i
                                            class="material-icons-two-tone text-secondary">person</i>
                                    </div>
                                </div>
                                <div class="col-8 text-md-center">
                                    <h5>{{ $student }}</h5><span class="text-muted">Students</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body w-50">
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="b-icons bg-light-primary"><i
                                            class="material-icons-two-tone text-secondary">person</i>
                                    </div>
                                </div>
                                <div class="col-8 text-md-center">
                                    <h5>{{ $teacher }}</h5><span class="text-muted">Teachers</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-table">
                        <div class="col-sm-6 card-body w-50 br">
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="b-icons bg-light-primary"><i
                                            class="material-icons-two-tone text-secondary">book</i>
                                    </div>
                                </div>
                                <div class="col-8 text-md-center">
                                    <h5>{{ $courses }}</h5><span class="text-muted">Courses</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body w-50">
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="b-icons bg-light-primary"><i
                                            class="material-icons-two-tone text-secondary">local_mall</i>
                                    </div>
                                </div>
                                <div class="col-8 text-md-center">
                                    <h5>100%</h5><span class="text-muted">Order</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="card table-card">
                    <div class="card-header borderless">
                        <h5>Total Revenue</h5>
                    </div>
                    <div class="card-body px-0 py-0">
                        <div class="table-responsive">
                            <div class="revenue-scroll" style="height: 310px; position: relative">
                                <table class="table table-hover mb-0">
                                    <tbody>
                                        <tr>
                                            <td><i class="fas fa-caret-up text-success f-24"></i>
                                            </td>
                                            <td>Bitcoin</td>
                                            <td>
                                                <h6 class="text-success">+ $145.85</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-caret-down text-danger f-24"></i>
                                            </td>
                                            <td>Ethereum</td>
                                            <td>
                                                <h6 class="text-danger">- $6.368</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-caret-up text-success f-24"></i>
                                            </td>
                                            <td>Ripple</td>
                                            <td>
                                                <h6 class="text-success">+ $458.63</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-caret-down text-danger f-24"></i>
                                            </td>
                                            <td>Neo</td>
                                            <td>
                                                <h6 class="text-danger">- $5.631</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-caret-down text-danger f-24"></i>
                                            </td>
                                            <td>Bitcoin</td>
                                            <td>
                                                <h6 class="text-danger">- $75.86</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-caret-up text-success f-24"></i>
                                            </td>
                                            <td>Ethereum</td>
                                            <td>
                                                <h6 class="text-success">+ $453.63</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-caret-down text-danger f-24"></i>
                                            </td>
                                            <td>Ripple</td>
                                            <td>
                                                <h6 class="text-danger">+ $786.63</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-caret-up text-success f-24"></i>
                                            </td>
                                            <td>Neo</td>
                                            <td>
                                                <h6 class="text-success">+ $145.85</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-caret-down text-danger f-24"></i>
                                            </td>
                                            <td>Bitcoin</td>
                                            <td>
                                                <h6 class="text-danger">- $6.368</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-caret-up text-success f-24"></i>
                                            </td>
                                            <td>Ethereum</td>
                                            <td>
                                                <h6 class="text-success">+ $458.63</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-caret-down text-danger f-24"></i>
                                            </td>
                                            <td>Neo</td>
                                            <td>
                                                <h6 class="text-danger">- $5.631</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-caret-down text-danger f-24"></i>
                                            </td>
                                            <td>Ripple</td>
                                            <td>
                                                <h6 class="text-danger">- $75.86</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-caret-up text-success f-24"></i>
                                            </td>
                                            <td>Bitcoin</td>
                                            <td>
                                                <h6 class="text-success">+ $453.63</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-caret-down text-danger f-24"></i>
                                            </td>
                                            <td>Ethereum</td>
                                            <td>
                                                <h6 class="text-danger">+ $786.63</h6>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="card table-card">
                    <div class="calendar-container">
                        <div id="calendar" style="padding:8px"></div>
                    </div>

                </div>


                <div class="card table-card">
                    <div class="h-100 bg-light rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h5 class="mb-0">Notifications</h5>
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

            </div><!-- [ sample-page ] end -->
        </div><!-- [ Main Content ] end -->
    </div>
</div><!-- [ Main Content ] end -->


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
