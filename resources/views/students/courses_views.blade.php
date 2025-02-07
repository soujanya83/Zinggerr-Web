@extends('layouts.app')
@section('pageTitle', 'Courses View')
@section('content')
@include('partials.sidebar')
@include('partials.headerdashboard')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                            <li class="breadcrumb-item" aria-current="page">Courses {{ $pageName }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if($chapters !== null)
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
                                            <li>Id: {{ $course->course_id_number }}</li>
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
                                                @php
                                                $assetsdata =
                                                DB::table('courses_assets')->where('chapter_id',
                                                $user->id)->get();
                                                $assets_count=$assetsdata->count();
                                                @endphp
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
                                                                    <span class="position-absolute end-0  p-2"
                                                                        style="margin-right: 59px;">Lectures: {{
                                                                        $assets_count }}</span>

                                                                </button>
                                                            </h2>
                                                            <div id="collapseChapter{{ $user->id }}"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="headingChapter{{ $user->id }}"
                                                                data-bs-parent="#accordionChapter{{ $user->id }}">
                                                                <div class="accordion-body">

                                                                    <div class="accordion-body">

                                                                        @if($assetsdata->count() > 0)
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    {{-- <th>#</th> --}}
                                                                                    <th style="width: 85%;">Topic</th>
                                                                                    <th style="width: 15%;">Lectures
                                                                                    </th>
                                                                                    {{-- <th>Actions</th> --}}
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($assetsdata as $key => $asset)
                                                                                <tr>
                                                                                    {{-- <td>{{ $key + 1 }} .</td> --}}
                                                                                    <td>&nbsp; {{ $asset->topic_name }}
                                                                                    </td>


                                                                                    <td>

                                                                                        @if ($asset->assets_video)
                                                                                        <i class="ti ti-video"
                                                                                            style="color:aliceblue;background-color: #1862a9;padding: 4px;border-radius: 50px;"></i>&nbsp;
                                                                                        <a href="#"
                                                                                            onclick="playVideo('{{ asset('storage/' . $asset->assets_video) }}', '{{ $asset->topic_name }}')"
                                                                                            class="text-primary">
                                                                                            <u>Preview</u>
                                                                                        </a>

                                                                                        @elseif ($asset->video_url ??
                                                                                        $asset->youtube_links)
                                                                                        <i class="ti ti-link"
                                                                                            style="color:aliceblue;background-color: #1862a9;padding: 4px;border-radius: 50px;"></i>&nbsp;&nbsp;
                                                                                        <a href="{{ $asset->video_url ?? $asset->youtube_links }}"
                                                                                            target="_blank">
                                                                                            <u>View</u>
                                                                                        </a>
                                                                                        @else

                                                                                        <i class="ti ti-notes"
                                                                                            style="color:aliceblue;background-color: #1862a9;padding: 4px;border-radius: 50px;"></i>&nbsp;&nbsp;
                                                                                        <a href="#blogModal"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#blogModal"
                                                                                            data-description="{{ strip_tags($asset->blog_description) }}"
                                                                                            data-topic="{{ $asset->topic_name }}">
                                                                                            <u>Blog</u>
                                                                                        </a>

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
                    @elseif($assetsData != null)
                    <div class="card-header">

                        <h3>Course: {{ $course->course_full_name }}</h3>
                        <div class="text-end"><a href="{{ route('courses') }}" class="btn btn-success"
                                style="margin-top: -56px;">Back</a>
                        </div>
                        <div class="container">

                            @if($assetsData->assets_type == 'blog')
                            <strong style="font-size:20px">{{ $assetsData->topic_name }}</strong> : <span
                                style="font-size:20px">{{ strip_tags($assetsData->blog_description) }}</span>


                            @elseif($assetsData->assets_type == 'url')
                            <p>Click your go to the page...
                                <a href="{{ $assetsData->video_url }}" class="btn btn-primary" target="_blank">Link</a>
                            </p>

                            @elseif($assetsData->assets_type == 'videos')

                            <video id="videoPlayer" controls width="100%" height="600">
                                <source src="{{ asset('storage/' . $assetsData->assets_video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <h3>{{ $assetsData->topic_name }}</h3>



                            @if($quizzes !=null)
                            <!-- Store quiz data as JSON -->
                            <input type="hidden" id="quizData" value='@json($quizzes)'>

                            <!-- Quiz Modal -->
                            <div class="modal fade" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="quizModalLabel">Quiz</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 id="quizQuestion"></h4>
                                            <form id="quizForm">
                                                <div>
                                                    <input type="radio" name="answer" id="option1" value="1">
                                                    <label for="option1"></label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="answer" id="option2" value="2">
                                                    <label for="option2"></label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="answer" id="option3" value="3">
                                                    <label for="option3"></label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="answer" id="option4" value="4">
                                                    <label for="option4"></label>
                                                </div>
                                                <br>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                            <p id="quizResult" class="text-success" style="display:none;"></p>
                                            <p id="quizIncorrect" class="text-danger" style="display:none;"></p>
                                            <button id="continueBtn" class="btn btn-success"
                                                style="display:none;">Continue Video</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            @endif
                            {{-- <script>
                                document.addEventListener("DOMContentLoaded", function () {
                            const video = document.getElementById("videoPlayer");
                            const quizModal = new bootstrap.Modal(document.getElementById("quizModal"));
                            const quizData = JSON.parse(document.getElementById("quizData").value);
                            let currentQuizIndex = 0;
                            let quizzesShown = [];

                            function resetQuizOptions() {
                                document.querySelectorAll('input[name="answer"]').forEach((input) => {
                                    input.checked = false;
                                });

                                document.getElementById("quizResult").style.display = "none";
                                document.getElementById("quizIncorrect").style.display = "none";
                                document.getElementById("quizForm").style.display = "block";
                            }

                            function showQuiz(quiz) {
                                            resetQuizOptions();

                                            document.getElementById("quizQuestion").textContent = quiz.quiz_question;
                                            document.getElementById("option1").nextElementSibling.textContent = quiz.option_1;
                                            document.getElementById("option2").nextElementSibling.textContent = quiz.option_2;
                                            document.getElementById("option3").nextElementSibling.textContent = quiz.option_3;
                                            document.getElementById("option4").nextElementSibling.textContent = quiz.option_4;
                                            document.getElementById("quizForm").dataset.correct = quiz.correct_option;

                                            // ✅ Hide "Continue Video" button for all quizzes except the first one
                                            if (currentQuizIndex === 0) {
                                                document.getElementById("continueBtn").style.display = "none";
                                            } else {
                                                document.getElementById("continueBtn").style.display = "none";
                                            }

                                            video.pause();
                                            quizModal.show();
                                        }

                                    video.addEventListener("timeupdate", function () {
                                        if (currentQuizIndex < quizData.length) {
                                            const quiz = quizData[currentQuizIndex];
                                            if (!quizzesShown.includes(quiz.quiz_time) && video.currentTime >= quiz.quiz_time) {
                                                quizzesShown.push(quiz.quiz_time);
                                                showQuiz(quiz);
                                            }
                                        }
                                    });

                                    // Hide incorrect message when a new option is selected
                                    document.querySelectorAll('input[name="answer"]').forEach((input) => {
                                        input.addEventListener("change", function () {
                                            document.getElementById("quizIncorrect").style.display = "none";
                                        });
                                    });

                                    document.getElementById("quizForm").addEventListener("submit", function (e) {
                                        e.preventDefault();
                                        const selectedOption = document.querySelector('input[name="answer"]:checked');

                                        if (!selectedOption) {
                                            document.getElementById("quizIncorrect").textContent = "⚠️ Please select an answer.";
                                            document.getElementById("quizIncorrect").style.display = "block";
                                            return;
                                        }

                                        const correctAnswer = this.dataset.correct;
                                        if (selectedOption.value === correctAnswer) {
                                            document.getElementById("quizResult").textContent = "✅ Correct! Well done!";
                                            document.getElementById("quizResult").style.display = "block";
                                            document.getElementById("continueBtn").style.display = "block";
                                        } else {
                                            document.getElementById("quizIncorrect").textContent = "❌ Incorrect! Try again.";
                                            document.getElementById("quizIncorrect").style.display = "block";
                                        }
                                    });

                                    document.getElementById("continueBtn").addEventListener("click", function () {
                                        quizModal.hide();
                                        video.play();
                                        currentQuizIndex++;
                                    });
                                });
                            </script> --}}

                            {{-- <script>
                                document.addEventListener("DOMContentLoaded", function () {
    const video = document.getElementById("videoPlayer");
    const quizModal = new bootstrap.Modal(document.getElementById("quizModal"));
    const quizData = JSON.parse(document.getElementById("quizData").value);
    let quizzesShown = new Set(); // Keep track of quizzes shown

    function resetQuizOptions() {
        document.querySelectorAll('input[name="answer"]').forEach((input) => {
            input.checked = false;
        });

        document.getElementById("quizResult").style.display = "none";
        document.getElementById("quizIncorrect").style.display = "none";
        document.getElementById("quizForm").style.display = "block";
    }

    function showQuiz(quiz) {
        resetQuizOptions();

        document.getElementById("quizQuestion").textContent = quiz.quiz_question;
        document.getElementById("option1").nextElementSibling.textContent = quiz.option_1;
        document.getElementById("option2").nextElementSibling.textContent = quiz.option_2;
        document.getElementById("option3").nextElementSibling.textContent = quiz.option_3;
        document.getElementById("option4").nextElementSibling.textContent = quiz.option_4;
        document.getElementById("quizForm").dataset.correct = quiz.correct_option;

        // Hide the "Continue Video" button for all quizzes
        document.getElementById("continueBtn").style.display = "none";

        video.pause();
        quizModal.show();
    }

    video.addEventListener("timeupdate", function () {
        quizData.forEach((quiz) => {
            if (video.currentTime >= quiz.quiz_time && !quizzesShown.has(quiz.quiz_time)) {
                quizzesShown.add(quiz.quiz_time);
                showQuiz(quiz);
            }
        });
    });

    // Hide incorrect message when a new option is selected
    document.querySelectorAll('input[name="answer"]').forEach((input) => {
        input.addEventListener("change", function () {
            document.getElementById("quizIncorrect").style.display = "none";
        });
    });

    document.getElementById("quizForm").addEventListener("submit", function (e) {
        e.preventDefault();
        const selectedOption = document.querySelector('input[name="answer"]:checked');

        if (!selectedOption) {
            document.getElementById("quizIncorrect").textContent = "⚠️ Please select an answer.";
            document.getElementById("quizIncorrect").style.display = "block";
            return;
        }

        const correctAnswer = this.dataset.correct;
        if (selectedOption.value === correctAnswer) {
            document.getElementById("quizResult").textContent = "✅ Correct! Well done!";
            document.getElementById("quizResult").style.display = "block";
            document.getElementById("continueBtn").style.display = "block";
        } else {
            document.getElementById("quizIncorrect").textContent = "❌ Incorrect! Try again.";
            document.getElementById("quizIncorrect").style.display = "block";
        }
    });

    document.getElementById("continueBtn").addEventListener("click", function () {
        quizModal.hide();
        video.play();
    });
});

                            </script> --}}

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
    const video = document.getElementById("videoPlayer");
    const quizModal = new bootstrap.Modal(document.getElementById("quizModal"));
    const quizData = JSON.parse(document.getElementById("quizData").value);
    let quizzesShown = new Set();
    let lastTime = 0; // Track last video time to detect seeking

    function resetQuizOptions() {
        document.querySelectorAll('input[name="answer"]').forEach((input) => {
            input.checked = false;
        });

        document.getElementById("quizResult").style.display = "none";
        document.getElementById("quizIncorrect").style.display = "none";
        document.getElementById("quizForm").style.display = "block";
    }

    function showQuiz(quiz) {
        resetQuizOptions();

        document.getElementById("quizQuestion").textContent = quiz.quiz_question;
        document.getElementById("option1").nextElementSibling.textContent = quiz.option_1;
        document.getElementById("option2").nextElementSibling.textContent = quiz.option_2;
        document.getElementById("option3").nextElementSibling.textContent = quiz.option_3;
        document.getElementById("option4").nextElementSibling.textContent = quiz.option_4;
        document.getElementById("quizForm").dataset.correct = quiz.correct_option;

        document.getElementById("continueBtn").style.display = "none";

        video.pause();
        quizModal.show();
    }

    video.addEventListener("timeupdate", function () {
        let currentTime = video.currentTime;

        // If user seeks backwards, reset quizzesShown to allow showing them again
        if (currentTime < lastTime) {
            quizzesShown.clear();
        }
        lastTime = currentTime;

        quizData.forEach((quiz) => {
            if (video.currentTime >= quiz.quiz_time && !quizzesShown.has(quiz.quiz_time)) {
                quizzesShown.add(quiz.quiz_time);
                showQuiz(quiz);
            }
        });
    });

    document.querySelectorAll('input[name="answer"]').forEach((input) => {
        input.addEventListener("change", function () {
            document.getElementById("quizIncorrect").style.display = "none";
        });
    });

    document.getElementById("quizForm").addEventListener("submit", function (e) {
        e.preventDefault();
        const selectedOption = document.querySelector('input[name="answer"]:checked');

        if (!selectedOption) {
            document.getElementById("quizIncorrect").textContent = "⚠️ Please select an answer.";
            document.getElementById("quizIncorrect").style.display = "block";
            return;
        }

        const correctAnswer = this.dataset.correct;
        if (selectedOption.value === correctAnswer) {
            document.getElementById("quizResult").textContent = "✅ Correct! Well done!";
            document.getElementById("quizResult").style.display = "block";
            document.getElementById("continueBtn").style.display = "block";
        } else {
            document.getElementById("quizIncorrect").textContent = "❌ Incorrect! Try again.";
            document.getElementById("quizIncorrect").style.display = "block";
        }
    });

    document.getElementById("continueBtn").addEventListener("click", function () {
        quizModal.hide();
        video.play();
    });
});

                            </script>







                            @else

                            @php
                            // Use $assetsData->youtube_links for the YouTube URL
                            $youtubeUrl = $assetsData->youtube_links;
                            preg_match('/(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/',
                            $youtubeUrl, $matches);
                            $videoId = $matches[1] ?? null;
                            @endphp

                            @if($videoId)

                            <iframe width="100%" height="600" src="https://www.youtube.com/embed/{{ $videoId }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                            <h3>{{ $assetsData->topic_name }}</h3>
                            @else
                            <p>Invalid YouTube URL or unsupported video type.</p>
                            @endif
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="card-header">
                        No data found!
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!--blog description Modal -->

<div class="modal fade" id="blogModal" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ececec">
                <h5 class="modal-title" id="blogModalLabel"></h5> <!-- Header will be dynamically updated -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modalBlogDescription" style="font-size: 16px"></p>
                <!-- Blog description will be dynamically updated -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Video Modal -->
<div id="videoModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lecture Videos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <video id="videoPlayer" width="100%" controls>
                    <source src="" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <h4 id="videoTopic" class="mt-0"></h4> <!-- Display topic name dynamically here -->
            </div>
            <div class="modal-footer">

                {{-- <button class="btn btn-warning"
                    onclick="openEditModal('{{ asset('storage/' . $asset->assets_video) }}', '{{ $asset->topic_name }}')">
                    Add interactives
                </button> --}}

            </div>
        </div>
    </div>
</div>


<div id="videoEditModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-xl" style="height: 600px;width:900px;">
        <!-- Set your desired height here -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Interactive Video Editor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height:600px;overflow-y:auto;">
                <button class="btn btn-primary mt-3" onclick="addQuiz()">Add Quiz &nbsp;<i
                        class="fa-solid fa-bars fa-fade" style="vertical-align: bottom;"></i> </button>
                <div id="quizContainer" style="position: relative; width: 100%; height: auto;"></div>
                <video id="editVideoPlayer" width="100%" controls>
                    <source src="" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <h4 id="editVideoTopic" class="mt-3"></h4>



            </div>
        </div>
    </div>
</div>



<script>
    function playVideo(videoPath, topicName) {
        // Set the video source
        const videoPlayer = document.getElementById('videoPlayer');
        videoPlayer.src = videoPath;

        // Set the topic name below the video
        const videoTopic = document.getElementById('videoTopic');
        videoTopic.textContent = topicName;

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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const blogModal = document.getElementById('blogModal');
        blogModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const description = button.getAttribute('data-description'); // Extract blog description
            const topic = button.getAttribute('data-topic'); // Extract topic name

            // Update modal content
            const modalDescription = document.getElementById('modalBlogDescription');
            const modalTitle = document.getElementById('blogModalLabel');
            modalDescription.textContent = description; // Set blog description
            modalTitle.textContent = topic; // Set topic name as modal header
        });
    });
</script>

<script>
    let quizzes = []; // Store quizzes locally before saving
let videoPlayer;

function openEditModal(videoPath, topicName) {
    videoPlayer = document.getElementById('editVideoPlayer');
    videoPlayer.src = videoPath;
    document.getElementById('editVideoTopic').textContent = topicName;

    // Show modal
    const videoModal = new bootstrap.Modal(document.getElementById('videoEditModal'));
    videoModal.show();
}

// Function to add quiz when button is clicked
function addQuiz() {
    if (!videoPlayer.paused) {
        alert("Pause the video first to add a quiz.");
        return;
    }

    const timePosition = videoPlayer.currentTime;

    // Create quiz div
    const quizDiv = document.createElement("div");
    quizDiv.classList.add("quiz-box");
    quizDiv.style.position = "absolute";
    quizDiv.style.zIndex = "10000";
    quizDiv.style.background = "rgba(255,255,255,0.9)";
    quizDiv.style.padding = "10px";
    quizDiv.style.border = "2px solid #007bff";
    quizDiv.style.borderRadius = "5px";
    quizDiv.style.cursor = "move";

    // Quiz Form
    quizDiv.innerHTML = `
        <strong>Quiz at ${timePosition.toFixed(2)}s</strong><br>
        <input type="text" placeholder="Enter question" class="form-control mt-2" id="quiz-question"><br>
        <input type="text" placeholder="Option 1" class="form-control mt-1">
        <input type="text" placeholder="Option 2" class="form-control mt-1">
        <input type="text" placeholder="Option 3" class="form-control mt-1">
        <input type="text" placeholder="Option 4" class="form-control mt-1">
        <button class="btn btn-success btn-sm mt-2" onclick="saveQuiz(this, ${timePosition})">Save</button>
    `;

    // Append to quiz container
    document.getElementById("quizContainer").appendChild(quizDiv);

    // Make it draggable
    makeDraggable(quizDiv);
}

// Make quiz div draggable
function makeDraggable(element) {
    element.onmousedown = function(event) {
        let shiftX = event.clientX - element.getBoundingClientRect().left;
        let shiftY = event.clientY - element.getBoundingClientRect().top;

        document.body.append(element);

        function moveAt(pageX, pageY) {
            element.style.left = pageX - shiftX + "px";
            element.style.top = pageY - shiftY + "px";
        }

        function onMouseMove(event) {
            moveAt(event.pageX, event.pageY);
        }

        document.addEventListener("mousemove", onMouseMove);

        element.onmouseup = function() {
            document.removeEventListener("mousemove", onMouseMove);
            element.onmouseup = null;
        };
    };

    element.ondragstart = function() {
        return false;
    };
}

// Save quiz
function saveQuiz(button, timePosition) {
    const quizDiv = button.parentElement;
    const question = quizDiv.querySelector("#quiz-question").value;
    const options = Array.from(quizDiv.querySelectorAll("input[type='text']")).slice(1).map(opt => opt.value);

    // Get position
    const position = quizDiv.getBoundingClientRect();
    const videoContainer = document.getElementById("quizContainer").getBoundingClientRect();

    const posX = position.left - videoContainer.left;
    const posY = position.top - videoContainer.top;

    // Store in array
    quizzes.push({
        time: timePosition,
        question,
        options,
        x: posX,
        y: posY
    });

    // Hide form after saving
    quizDiv.innerHTML = `<strong>Quiz:</strong> ${question}`;
    quizDiv.style.border = "2px solid green";
}

// Fetch quizzes when video reaches time
videoPlayer.addEventListener("timeupdate", function() {
    quizzes.forEach(quiz => {
        if (Math.abs(videoPlayer.currentTime - quiz.time) < 0.5) {
            showQuiz(quiz);
        }
    });
});

// Show quiz popup
function showQuiz(quiz) {
    const quizDiv = document.createElement("div");
    quizDiv.classList.add("quiz-popup");
    quizDiv.style.position = "absolute";
    quizDiv.style.left = quiz.x + "px";
    quizDiv.style.top = quiz.y + "px";
    quizDiv.style.background = "white";
    quizDiv.style.padding = "10px";
    quizDiv.style.border = "2px solid #ff0000";
    quizDiv.style.borderRadius = "5px";

    quizDiv.innerHTML = `
        <strong>${quiz.question}</strong><br>
        ${quiz.options.map(opt => `<input type="radio" name="quiz-${quiz.time}"> ${opt}<br>`).join("")}
    `;

    document.getElementById("quizContainer").appendChild(quizDiv);
}

</script>



@include('partials.footer')
@endsection
