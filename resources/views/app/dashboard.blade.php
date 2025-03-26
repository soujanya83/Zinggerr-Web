@extends('layouts.app')

@section('pageTitle', 'Dashboard')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
{{--
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- <style>
    .table-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-header h5 {
        font-size: 1.25rem;
        font-weight: 500;
        margin: 0;
    }

    .card-header .task-date {
        font-size: 0.875rem;
        color: #666;
        margin-left: 5px;
    }

    .card-body {
        padding: 5px;
    }

    .task-item {
        transition: all 0.3s ease;
    }

    .task-item span {
        font-size: 0.875rem;
        color: #333;
    }

    .task-completed span {
        text-decoration: line-through;
        color: #888;
    }

    .btn-sm i {
        font-size: 0.875rem;
        color: #888;
    }

    .btn-sm i:hover {
        color: #333;
    }

    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: #f8f9fa;
        border-top: 1px solid #e0e0e0;
    }

    .card-footer .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 8px 16px;
        font-size: 0.875rem;
    }

    .card-footer .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .card-footer a {
        font-size: 0.875rem;
        color: #007bff;
        text-decoration: none;
    }

    .card-footer a:hover {
        text-decoration: underline;
    }
</style> --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="pc-container">
    <div class="pc-content">
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-xxl-8">

                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10" style="font-size: 18px;">Welcome: {{
                                                Str::title(Auth::user()->name)
                                                }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item mt-1">
                                                <b>
                                                    <h4 style="color:#5a63ac"> @if ( Auth::user()->type =='Superadmin')
                                                        SuperAdmin @else {{
                                                        Auth::user()->type }} @endif</h4>
                                                </b>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:25px">
                    <div class="col-md-6">
                        <div class="card  order-card" style="background-color: #aa33d4">
                            <div class="card-body">
                                <h5 class="text-white" style="font-size: 17px;">Courses Last 7 day`s</h5>
                                <h3 class="text-white" style="font-size: 17px;">{{ $courseslast7day
                                    }}</h3>
                                <p class="m-b-0" style="font-size: 13px;">{{ $coursesLastMonth }} Courses Last
                                    Month</p>
                                <i class="material-icons-two-tone d-block f-46 card-icon text-white">note</i>
                            </div>
                        </div>



                    </div>
                    <div class="col-md-6">
                        <div class="card bg-primary order-card">
                            <div class="card-body">
                                <h5 class="text-white" style="font-size: 17px;">Students Last 7
                                    day`s</h5>
                                <h3 class="text-white" style="font-size: 17px;">{{ $studentlast7day
                                    }}</h3>
                                <p class="m-b-0" style="font-size: 13px;">{{ $studentlastmonth }} Students Last
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
                                @if($latestStudents->count()>0)
                                <table class="table table-hover table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align:center">#</th>
                                            <th scope="col"><span style="margin-left: 47px">Profile</span> </th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($latestStudents as $keys => $user)
                                        <tr>
                                            <td style="text-align:center">{{ $keys + 1 }}</td>
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
                                                            src="{{ asset('asset/images/user/download.jpg') }}"
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
                                            <td>{{ $user->country_code }}{{ $user->phone }}</td>
                                            <td>{{ $user->gender }}</td>
                                            <td>
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

                                @else
                                <div class="d-flex align-items-center mt-2" style="margin-left:12px">
                                    <tr>Data Not found!</tr>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end"><a href="{{ route('studentlist') }}"
                            class="b-b-primary text-primary">View
                            all</a></div>
                </div>



                <div class="card table-card">
                    <div class=""
                        style="border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                        <div class="card-header"
                            style="display: flex; justify-content: space-between; align-items: center;">
                            <h5 id="cardHeaderTitle" style="font-size: 1.25rem; font-weight: 500; margin: 0;">To Do List
                            </h5>
                            <div>
                                <button id="prevDateBtn"
                                    style="background-color: #2c3e50; color: white; border: none; padding: 5px 10px; border-radius: 5px; margin-right: 5px;">&lt;</button>
                                <button id="nextDateBtn"
                                    style="background-color: #2c3e50; color: white; border: none; padding: 5px 10px; border-radius: 5px;">&gt;</button>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 5px;">
                            <div class="table-responsive">
                                <div class="customers-scroll">
                                    <!-- Task List Container -->
                                    <div id="taskList">
                                        <!-- Tasks will be dynamically loaded here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer"
                            style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #f8f9fa; border-top: 1px solid #e0e0e0;">
                            <!-- Add Button on the Left -->
                            <a href="#" class="text-primary add-task-link" data-bs-toggle="modal"
                                data-bs-target="#addTaskModal"
                                style=" color: white; padding: 8px 16px; font-size: 0.875rem; text-decoration: none; border-radius: 4px;">Add
                                Task</a>
                            <!-- View All Link on the Right -->
                            <a href="{{ route('to_do_list') }}" class="text-primary"
                                style="font-size: 0.875rem; color: #007bff; text-decoration: none;">View all</a>
                        </div>
                    </div>
                </div>






                <!-- Modal for Adding Task -->
                <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addTaskForm">
                                    <div class="mb-3">
                                        <label for="taskInput" class="form-label">Task</label>
                                        <input type="text" class="form-control" id="taskInput" name="task"
                                            placeholder="Enter task" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dueDate" class="form-label">Due Date</label>
                                        <input type="date" class="form-control" id="dueDate" name="due_date" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button> --}}
                                <button type="button" class="btn btn-primary" onclick="saveTask()">Save Task</button>
                            </div>
                        </div>
                    </div>
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
                                    <h6>{{ $student }}</h6><span class="text-muted">Students</span>
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
                                    <h6>{{ $teacher }}</h6><span class="text-muted">Faculty</span>
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
                                    <h6>{{ $courses }}</h6><span class="text-muted">Courses</span>
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
                                    <h6>100%</h6><span class="text-muted">Order</span>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
            // Set up CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Set the default due date to the current date
            let currentDate = new Date();
            $('#dueDate').val(currentDate.toISOString().split('T')[0]);

            // Load tasks for the current date on page load
            loadTasks(currentDate);

            // Previous button click
            $('#prevDateBtn').click(function () {
                currentDate.setDate(currentDate.getDate() - 1);
                loadTasks(currentDate);
            });

            // Next button click
            $('#nextDateBtn').click(function () {
                currentDate.setDate(currentDate.getDate() + 1);
                loadTasks(currentDate);
            });

            // Event delegation for checkbox changes
            $('#taskList').on('change', '.task-checkbox', function () {
                const taskId = $(this).data('id');
                const isChecked = this.checked;
                toggleTaskCompletion(taskId, isChecked);
            });

            // Save a new task
            window.saveTask = function () {
                const task = $('#taskInput').val().trim();
                const dueDate = $('#dueDate').val();

                if (!task || !dueDate) {
                    alert('Please fill in all fields!');
                    return;
                }

                $.ajax({
                    url: '/api/todos',
                    method: 'POST',
                    data: {
                        task: task,
                        due_date: dueDate,
                        completed: 0 // Default to 0 (not completed)
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#addTaskModal').modal('hide');
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                            $('#addTaskForm')[0].reset();
                            $('#dueDate').val(currentDate.toISOString().split('T')[0]); // Reset to current date
                            loadTasks(currentDate);
                        } else {
                            alert('Failed to save task: ' + response.message);
                        }
                    },
                    error: function (xhr) {
                        alert('Error saving task: ' + xhr.responseText);
                    }
                });
            };

            // Load tasks for a specific date
            function loadTasks(date) {
                const formattedDateForApi = date.toISOString().split('T')[0];
                $.ajax({
                    url: '/api/todos',
                    method: 'GET',
                    data: { date: formattedDateForApi }, // Pass the date as a query parameter
                    success: function (response) {
                        const taskList = $('#taskList');
                        taskList.empty();

                        // Update the header with the selected date
                        const formattedDate = date.toLocaleDateString("en-GB", { day: "numeric", month: "long", year: "numeric" });
                        const headerText = `To Do List <span style="font-size: 0.875rem; color: #666; margin-left: 5px;">( ${formattedDate} )</span>`;
                        $('#cardHeaderTitle').html(headerText);

                        if (response.length === 0) {
                            taskList.append('<p>No tasks available.</p>');
                            return;
                        }

                        response.forEach(function (task) {
                            const isCompleted = task.completed === 1 || task.completed === true;
                            const taskItem = `
                                        <div style="transition: all 0.3s ease;margin-left: 14px; margin-right: 12px;" class="d-flex align-items-center border-bottom py-2">

                                            <input type="checkbox" class="form-check-input m-0 task-checkbox" data-id="${task.id}" ${isCompleted ? 'checked' : ''} >
                                            <div class="w-100 ms-3">
                                                <div class="d-flex w-100 align-items-center justify-content-between">
                                                    <span style="font-size: 0.875rem; color: ${isCompleted ? '#888' : '#333'}; ${isCompleted ? 'text-decoration: line-through;' : ''}">${task.task}</span>
                                                    <button class="btn btn-sm" onclick="deleteTask('${task.id}')"><i class="fa fa-trash" style="font-size: 0.875rem; color: #888;"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                            taskList.append(taskItem);
                        });

                        // Add hover effects using jQuery
                        $('.fa-trash').hover(
                            function() { $(this).css('color', '#333'); },
                            function() { $(this).css('color', '#888'); }
                        );

                        $('.btn-primary').hover(
                            function() { $(this).css({ 'background-color': '#0056b3', 'border-color': '#004085' }); },
                            function() { $(this).css({ 'background-color': '#007bff', 'border-color': '#007bff' }); }
                        );

                        $('.text-primary').hover(
                            function() { $(this).css('text-decoration', 'underline'); },
                            function() { $(this).css('text-decoration', 'none'); }
                        );
                    },
                    error: function (xhr) {
                        alert('Error loading tasks: ' + xhr.responseText);
                    }
                });
            }

            // Toggle task completion status
            window.toggleTaskCompletion = function (taskId, isChecked) {
                const completedValue = isChecked ? 1 : 0;

                $.ajax({
                    url: `/api/todos/${taskId}/complete`,
                    method: 'PATCH',
                    data: {
                        completed: completedValue
                    },
                    success: function (response) {
                        if (response.success) {
                            loadTasks(currentDate);
                        } else {
                            alert('Failed to update task: ' + response.message);
                        }
                    },
                    error: function (xhr) {
                        alert('Error updating task: ' + xhr.responseText);
                    }
                });
            };

                   // Delete a task with SweetAlert confirmation
                        window.deleteTask = function (taskId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to delete this task?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/api/todos/${taskId}`,
                            method: 'DELETE',
                            success: function (response) {
                                if (response.success) {
                                    loadTasks(currentDate);
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Your task has been deleted.',
                                        icon: 'success',
                                        showConfirmButton: false, // Hide the "OK" button
                                        timer: 1500 // Auto-close after 2 seconds (2000 milliseconds)
                                    });
                                } else {
                                    alert('Failed to delete task: ' + response.message);
                                }
                            },
                            error: function (xhr) {
                                alert('Error deleting task: ' + xhr.responseText);
                            }
                        });
                    }
                });
            };
        });
</script>

@include('partials.footer')
@endsection
