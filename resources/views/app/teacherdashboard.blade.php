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
                                            <li class="breadcrumb-item mt-1">
                                                <b>
                                                    <h4 style="color:#0707c2"> @if ( Auth::user()->type =='Superadmin') SuperAdmin @else {{
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
                                <h5 class="text-white" style="font-size: 17px;">Total Courses</h5>
                                <h3 class="text-white" style="font-size: 17px;">{{ $courses
                                    }}</h3>
                                <p class="m-b-0" style="font-size: 13px;">&nbsp;</p>
                                <i class="material-icons-two-tone d-block f-46 card-icon text-white">note</i>

                            </div>
                        </div>



                    </div>
                    <div class="col-md-6">
                        <div class="card bg-primary order-card">
                            <div class="card-body">
                                <h5 class="text-white" style="font-size: 17px;">Total Students</h5>
                                <h3 class="text-white" style="font-size: 17px;">{{ $student
                                    }}</h3>
                                <p class="m-b-0" style="font-size: 13px;">&nbsp;</p>
                                <i class="material-icons-two-tone d-block f-46 card-icon text-white">account_circle</i>

                            </div>
                        </div>
                    </div>




                </div>
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Latest Courses</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="customers-scroll" style="height: 310px; position: relative">
                                <table class="table table-hover table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align:center">#</th>
                                            <th scope=" col">Course</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Tags</th>
                                            <th scope="col">Rating</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($student_courses as $keys => $course)
                                        <tr>
                                            <td style="padding: 4px;text-align:center">{{ $keys + 1 }}</td>
                                            <td style="padding: 4px;">
                                                <div class="d-flex align-items-center" style="margin-top: -3px;">
                                                    <div class="flex-shrink-0 wid-40">
                                                        @if ($course->course_image)
                                                        <img class="img-radius"
                                                            src="{{ asset('storage/' . $course->course_image) }}"
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
                                                        <h6> {{
                                                            \Illuminate\Support\Str::limit($course->course_full_name,
                                                            30, '...') }}</h6>
                                                        <p class="text-muted f-12 mb-0">{{
                                                            $course->course_short_name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ucfirst($course->course_category) }}</td>
                                            <td>{{ $course->tags }}</td>
                                            <td>
                                                <div class="flex-shrink-0 me-2">
                                                    {{-- <strong class="text-muted">{{
                                                        number_format($course->rating, 1) }}</strong> --}}
                                                </div>

                                                <!-- Star Icons -->
                                                <div class="flex-grow-1">
                                                    @php
                                                    $rating = round($course->rating * 2) / 2;

                                                    $fullStars = floor($rating); // Full stars count
                                                    $halfStar = ($rating - $fullStars == 0.5) ? 1 : 0; // Half
                                                    // star logic
                                                    $emptyStars = 5 - $fullStars - $halfStar; // Empty stars
                                                    // count
                                                    @endphp

                                                    <!-- Full Stars -->
                                                    @for ($i = 0; $i < $fullStars; $i++) <i
                                                        class="fas fa-star text-warning"></i>
                                                        @endfor

                                                        <!-- Half Star -->
                                                        @if ($halfStar)
                                                        <i class="fas fa-star-half-alt text-warning"></i>
                                                        @endif

                                                        <!-- Empty Stars -->
                                                        @for ($i = 0; $i < $emptyStars; $i++) <i
                                                            class="far fa-star text-warning"></i>
                                                            @endfor
                                                            {{-- <small class="text-muted">&nbsp; ({{
                                                                number_format($course->total_users) }})</small> --}}
                                                </div>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end"><a href="{{ route('courses') }}"
                            class="b-b-primary text-primary">View
                            all</a></div>
                </div>

            </div>
            <div class="col-xxl-4">


                <div class="card table-card">
                    <div class="calendar-container">
                        <div id="calendar" style="padding:8px"></div>
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
