@extends('layouts.app')

@section('pageTitle', 'Course - ' . $course->course_full_name)

@section('content')
<style>
    /* Ensure the page takes up the full viewport height and width */
    html,
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        /* Prevent horizontal scrolling */
    }

    /* Main container for the landing page */
    .course-landing-page {
        background-color: #f8f9fa;
        /* Light background for the page */
        padding: 0;
        box-sizing: border-box;
    }

    /* Hero section (course details and image) */
    .course-hero {
        background-color: #000;
        color: white;
        padding: 15px 0;
        /* Reduced padding as requested */
        width: 100%;
        /* Full width for the black background */
        display: flex;
        /* Use flexbox to center the inner container */
        justify-content: center;
        /* Center the inner container horizontally */
    }

    .course-container {
        display: flex;
        width: 90%;
        /* Set the container to 90% of the viewport width */
        max-width: 1200px;
        /* Keep the maximum width constraint */
        background-color: black;
        color: white;
        border-radius: 10px;
        overflow: hidden;
        /* Prevent content from overflowing */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .course-details {
        flex: 1;
        padding: 30px;
        box-sizing: border-box;
    }

    .course-title {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .course-info {
        list-style: none;
        padding: 0;
        margin: 0;
        font-size: 16px;
    }

    .course-info li {
        margin-bottom: 10px;
    }

    .course-info li strong {
        color: #ccc;
    }

    .course-image {
        flex: 0 0 450px;
        /* Fixed width for the image section */
        background-color: #000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        box-sizing: border-box;
    }

    .course-image img {
        width: 100%;
        height: auto;
        max-height: 260px;
        border-radius: 7px;
        object-fit: cover;
    }

    /* Additional sections */
    .course-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .section-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    .course-description,
    .course-features,
    .instructor-info {
        margin-bottom: 40px;
    }

    .course-description p {
        font-size: 16px;
        line-height: 1.6;
        color: #666;
    }

    .course-features ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .course-features li {
        font-size: 16px;
        color: #666;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .course-features li i {
        margin-right: 10px;
        color: #007bff;
    }

    .instructor-info {
        display: flex;
        align-items: center;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .instructor-image {
        flex: 0 0 100px;
        margin-right: 20px;
    }

    .instructor-image img {
        width: 100%;
        height: auto;
        border-radius: 50%;
    }

    .instructor-details h4 {
        font-size: 20px;
        margin-bottom: 5px;
        color: #333;
    }

    .instructor-details p {
        font-size: 16px;
        color: #666;
        margin: 0;
    }

    .cta-section {
        text-align: center;
        padding: 15px 0;
        /* Match the padding of .course-hero */
        background-color: #007bff;
        color: white;
        border-radius: 0;
        width: 100%;
        /* Full width for the blue background */
        display: flex;
        /* Use flexbox to center the content */
        justify-content: center;
        /* Center the content */
        margin-bottom: 40px;
    }

    .cta-section .cta-content {
        width: 90%;
        /* Match the width of .course-container */
        max-width: 1200px;
        /* Match the max-width of .course-container */
    }

    .cta-section h3 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .cta-section .btn {
        font-size: 18px;
        padding: 10px 30px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .course-hero {
            padding: 10px 0;
        }

        .course-container {
            flex-direction: column;
            width: 100%;
            /* On smaller screens, take full width */
        }

        .course-image {
            flex: 0 0 auto;
            width: 100%;
        }

        .course-title {
            font-size: 24px;
        }

        .instructor-info {
            flex-direction: column;
            text-align: center;
        }

        .instructor-image {
            margin-right: 0;
            margin-bottom: 20px;
        }

        .cta-section {
            padding: 10px 0;
        }

        .cta-section .cta-content {
            width: 100%;
            /* On smaller screens, take full width */
        }
    }
</style>

<div class="course-landing-page">
    <!-- Hero Section -->
    <div class="course-hero">
        <div class="course-container">
            <div class="course-details">
                <div class="course-title">{{ $course->course_full_name }}</div>
                <ul class="course-info">
                    {{-- <li><strong>Summary:</strong> {{ strip_tags($course->course_summary) }}</li> --}}
                    <li><strong>Type:</strong> {{ ucfirst($course->course_format) }}</li>
                    {{-- <li><strong>Id:</strong> {{ $course->course_id_number }}</li> --}}
                    <li><strong>Tag:</strong> {{ $course->tags }}</li>
                    <li>
                        <strong>Rating:</strong>
                        @php
                        $rating = round($course->rating * 2) / 2;
                        $fullStars = floor($rating);
                        $halfStar = ($rating - $fullStars == 0.5) ? 1 : 0;
                        $emptyStars = 5 - $fullStars - $halfStar;
                        @endphp
                        @for ($i = 0; $i < $fullStars; $i++) <i class="fas fa-star text-warning"></i>
                            @endfor
                            @if ($halfStar)
                            <i class="fas fa-star-half-alt text-warning"></i>
                            @endif
                            @for ($i = 0; $i < $emptyStars; $i++) <i class="far fa-star text-warning"></i>
                                @endfor
                                <small>({{ number_format($course->total_users) }})</small>
                    </li>
                    <li><strong>Last updated:</strong> {{ \Carbon\Carbon::parse($course->updated_at)->format('M-Y') }}
                    </li>
                </ul>
            </div>
            <div class="course-image">
                <img src="{{ asset('storage/' . $course->course_image) }}" alt="{{ $course->course_full_name }}">
            </div>
        </div>
    </div>

    <!-- Additional Sections -->
    <div class="course-content">
        <!-- Course Description -->
        <div class="course-description">
            <h2 class="section-title">Course Description</h2>
            <p>
                {{ $course->course_summary ?? 'This course provides an in-depth exploration of the subject matter,
                designed to help you master the key concepts and skills. Through a combination of lectures, practical
                exercises, and real-world examples, you’ll gain a comprehensive understanding of the topic.' }}
            </p>
        </div>

        @if($courseAssetsData)
        <div class="course-description">
            <h2 class="section-title">Course Highlight</h2>

            @foreach($courseAssetsData as $assetdata)
            <i class="fas fa-check-circle"></i> {{ ucfirst($assetdata['assets_type']) }}
            : {{
            ucfirst($assetdata['topic_name']) }}.

            @endforeach

        </div>

        @endif
        <!-- Course Features -->
        <div class="course-features">
            <h2 class="section-title">What You'll Learn</h2>
            <ul>
                <li><i class="fas fa-check-circle"></i> Understand the core concepts of {{ $course->course_full_name }}.
                </li>
                <li><i class="fas fa-check-circle"></i> Apply practical skills through hands-on exercises.</li>
                <li><i class="fas fa-check-circle"></i> Gain insights from real-world case studies.</li>
                <li><i class="fas fa-check-circle"></i> Receive a certificate upon completion.</li>
            </ul>
        </div>

        <!-- Instructor Info -->
        <div class="instructor-info">
            @if($userData)
            <div class="instructor-image">
                <img src="{{ asset('storage/'.$userData->profile_picture) }}" alt="Instructor">
            </div>
            @else
            <div class="instructor-image">
                <img src="{{ asset('asset/images/user/download.jpg') }}" alt="image" class="user-avatar">
            </div>
            @endif


            <div class="instructor-details">
                <h4>Instructor Name</h4>
                <p>Expert in {{ $course->course_full_name }} with over 10 years of experience in the field.</p>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="cta-section">
            <div class="cta-content">
                <h3 style="color: #ffffff;">Ready to Start Learning?</h3>
                <a href="{{ route('user.share_link') }}" class="btn btn-light">Enroll Now</a>
            </div>
        </div>
    </div>
</div>

@endsection
