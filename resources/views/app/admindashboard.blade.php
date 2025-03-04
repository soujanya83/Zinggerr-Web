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
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



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
                                            <h5 class="m-b-10" style="font-size: 18px;">Welcome: {{ Auth::user()->name
                                                }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item" style="color:rgb(5, 18, 109)">
                                                <b>
                                                    <h6> @if ( Auth::user()->type =='Superadmin') SuperAdmin @else {{
                                                        Auth::user()->type }} @endif</h6>
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
                                            <td>{{ $user->phone }}</td>
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
                                    {{-- <input class="form-check-input m-0" type="checkbox"> --}}
                                    <div class="w-100 ms-3">
                                        <div class="d-flex w-100 align-items-center justify-content-between">
                                            <span>Short task goes here...</span>
                                            <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center border-bottom py-2">
                                    {{-- <input class="form-check-input m-0" type="checkbox"> --}}
                                    <div class="w-100 ms-3">
                                        <div class="d-flex w-100 align-items-center justify-content-between">
                                            <span>Short task goes here...</span>
                                            <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center border-bottom py-2">
                                    {{-- <input class="form-check-input m-0" type="checkbox" checked> --}}
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
                            <img class="rounded-circle flex-shrink-0" src="../asset/images/user/download.jpg" alt=""
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
                            <img class="rounded-circle flex-shrink-0" src="../asset/images/user/download.jpg" alt=""
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
                            <img class="rounded-circle flex-shrink-0" src="../asset/images/user/download.jpg" alt=""
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
