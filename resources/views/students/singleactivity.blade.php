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
