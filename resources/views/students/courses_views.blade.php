@extends('layouts.app')
@section('pageTitle', 'Courses')
@section('content')
@include('partials.sidebar')
@include('partials.headerdashboard')

<style>
    .course-container {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        background-color: black;
        color: white;
        height: 300px;
    }

    .course-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .course-title {
        font-size: 20px;
        font-weight: bold;
    }

    .course-info {
        color: #666;
    }

    .course-details {
        margin-bottom: 15px;
    }

    .course-details ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .course-details li {
        margin-bottom: 5px;
    }

    .course-features {
        display: flex;
        justify-content: space-between;
    }

    .course-features ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .course-features li {
        margin-bottom: 5px;
    }

    .course-actions {
        display: flex;
        justify-content: space-between;
    }

    .course-price {
        font-size: 18px;
        font-weight: bold;
    }

    .course-buttons {
        display: flex;
    }

    .course-buttons button {
        margin-left: 10px;
    }
</style>

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Courses View</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Courses Views</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">


                        <div class="container">
                            <div class="row">

                                <div class="course-container">
                                    <div class="course-header">
                                        <div class="course-title">{{ $course->course_full_name }}
                                        </div>

                                    </div>

                                    <div class="course-details">
                                        <ul>
                                            <li> <strong>Summary:</strong> {{ strip_tags($course->course_summary) }}
                                            </li>
                                            <li><strong>Category:</strong> {{ ucfirst($course->course_category) }}</li>
                                            <li>Id:{{ $course->course_id_number }}</li>
                                            <li>{{ $course->tags }}</li>
                                            <li>
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
                                                        <small>({{
                                                            number_format($course->total_users) }})</small>



                                            </li>
                                            <li>Last updated : {{
                                                \Carbon\Carbon::parse($course->updated_at)->format('M-Y') }}</li>


                                        </ul>
                                    </div>




                                    <div class="position-absolute end-0 top-0 p-2">
                                        <img src="{{ asset('storage/' . $course->course_image) }}" alt="image"
                                            style="margin:36px; width: 262px; height: 262px;border-radius: 7px;">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="mt-5">

                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <h3>Chapters List</h3>
                                    <table class="table table-hover">
                                        {{-- <thead>
                                            <tr id="showtr">
                                                <th style="width:5%">#</th>
                                                <th style="width:50%">Chapter Name</th>
                                                <th style="width:2%">Status</th>
                                                <th style="width:5%">Action</th>
                                            </tr>
                                        </thead> --}}
                                        <tbody id="userTableBody">
                                            @if ($chapters->count() > 0)
                                            @foreach ($chapters as $keys => $user)
                                            <tr>

                                                <td>
                                                    <div class="accordion" id="accordionChapter{{ $user->id }}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="headingChapter{{ $user->id }}">
                                                                <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#collapseChapter{{ $user->id }}"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapseChapter{{ $user->id }}">
                                                                    <span>{{ $user->chepter_name }}</span>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseChapter{{ $user->id }}"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="headingChapter{{ $user->id }}"
                                                                data-bs-parent="#accordionChapter{{ $user->id }}">
                                                                <div class="accordion-body">

                                                                    <div class="accordion-body">
                                                                        @php
                                                                        $assetsdata =
                                                                        DB::table('courses_assets')->where('chapter_id',
                                                                        $user->id)->get();
                                                                        @endphp
                                                                        @if($assetsdata->count() > 0)
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    {{-- <th>#</th> --}}
                                                                                    <th style="width: 85%;">Topic</th>
                                                                                    <th style="width: 15%;">Assets</th>
                                                                                    {{-- <th>Actions</th> --}}
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($assetsdata as $key => $asset)
                                                                                <tr>
                                                                                    {{-- <td>{{ $key + 1 }} .</td> --}}
                                                                                    <td>&nbsp; {{ $asset->topic_name }}</td>


                                                                                    <td>

                                                                                        @if ($asset->assets_video)
                                                                                        <i class="ti ti-video"  style="background-color: #c1d3e2;padding: 4px;border-radius: 50px;"></i> &nbsp;&nbsp;
                                                                                        <a href="#"
                                                                                            onclick="playVideo('{{ asset('storage/' . $asset->assets_video) }}')"
                                                                                            class="text-primary">
                                                                                          <u>Preview</u>
                                                                                        </a>

                                                                                        @elseif ($asset->video_url ??
                                                                                        $asset->youtube_links)
                                                                                        <i class="ti ti-link"  style="background-color: #c1d3e2;padding: 4px;border-radius: 50px;"></i>&nbsp;&nbsp;
                                                                                        <a href="{{ $asset->video_url ?? $asset->youtube_links }}"
                                                                                            target="_blank">
                                                                                           <u>View</u>
                                                                                        </a>
                                                                                        @else
                                                                                        <i class="ti ti-notes" style="background-color: #c1d3e2;padding: 4px;border-radius: 50px;"></i>&nbsp;&nbsp; <u>Blog</u>
                                                                                        @endif
                                                                                    </td>

                                                                                </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        @else
                                                                        <p>No assets found for this chapter.</p>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>




                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="8" class="text-center">No Data Found!</td>
                                            </tr>
                                            @endif
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


<!-- Video Modal -->
<div id="videoModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Course Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <video id="videoPlayer" width="100%" controls>
                    <source src="" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <h4>{{ $course->course_full_name }}</h4>
            </div>
        </div>
    </div>
</div>

<script>
    function playVideo(videoPath) {
        // Set the video source
        const videoPlayer = document.getElementById('videoPlayer');
        videoPlayer.src = videoPath;

        // Show the modal
        const videoModal = new bootstrap.Modal(document.getElementById('videoModal'));
        videoModal.show();
    }

    // Stop video playback when the modal is closed
    document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
        const videoPlayer = document.getElementById('videoPlayer');
        videoPlayer.pause(); // Pause the video
        videoPlayer.currentTime = 0; // Reset video playback to the beginning
    });
</script>







@include('partials.footer')
@endsection
