@extends('partials.master')

@push('styles')
    <style>
        body {
            overflow-x: hidden;
        }

        /* Reusable heading styles */
        .pricing-head h2,
        .testimonials .section-title h2,
        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 600;
            font-family: var(--heading-font);
            text-align: center;
            margin-top: 1rem;
            margin-bottom: 0.75rem;
        }

        .button-section {
            margin-top: 2rem;
        }

        /* Specific heading colors */
        .pricing-head h2 {
            color: #333;
        }

        .pricing-head p {

            font-weight: 700;
            font-family: var(--nav-font);
        }

        .testimonials .section-title h2 {
            color: #28a745;
            /* Your success color */
        }

        .section-title h2 {
            color: #28a745;
            /* Inherit color if not pricing or testimonials */
            max-width: 100%;
            /* Ensure full width if needed */
        }

        /* Reusable paragraph styles */
        .pricing-head p.lead.text-muted,
        .testimonials .section-title p.lead.text-muted,
        .section-title p {
            max-width: 700px;
            text-align: center;
            margin: 0 auto;
            font-size: 1.5rem;
            opacity: 0.9;
            color: #6c757d;
        }


        .cta-btn {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 1rem 1.5rem;
            border-radius: 2rem;
            color: black;
            font-family: var(--nav-font);
        }

        .cta-btn:hover {
            background-color: var(--accent-color);
            color: white;
        }

        /* pricing-section styles */
        .pricing-section {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 10px;
            background-color: #f8f9fa;

            text-align: center;
        }

        .pricing-section .img-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pricing-section img {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            /* max-height: 400px; */
            height: 100%;
            max-width: 100%;
            object-fit: cover;
            border-radius: 8px;
            /* margin-bottom: 1.5rem; */
        }

        .pricing-section h4 {
            color: #343a40;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .pricing-section .list-unstyled {
            color: #495057;
            padding-left: 0;
        }

        .pricing-section .list-unstyled li {
            padding: 0.75rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .pricing-section .list-unstyled li:last-child {
            border-bottom: none;
        }

        .pricing-section .list-unstyled i {
            color: #28a745;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .pricing-section .list-unstyled strong {
            font-weight: 600;
            color: #212529;
        }

        .pricing-section h5 {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            font-size: 1.25rem;
            color: #28a745;
        }

        .pricing-section h5 strong {
            font-size: 1.4rem;
        }

        .pricing-section .cta,
        .pricing-section .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            color: white;
            background-color: transparent;
            background-color: #28a745;

            border: 1px solid #28a745;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.15s ease-in-out, border-color 0.15s ease-in-out;
            width: 90%;
            margin: 0.5rem auto;
        }

        .pricing-section .cta:hover,
        .pricing-section .btn:hover {
            transform: scale(0.97)
        }

        .pricing-section .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .pricing-section .btn-success:hover {
            background-color: #1e7e34;
            border-color: #1c7430;
        }

        .pricing-section .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .pricing-section .btn-secondary:hover {
            background-color: #545b62;
            border-color: #4e555b;
        }

        .pricing-section .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .pricing-section .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }

        .pricing-section .text-white {
            color: #343a40 !important;
        }

        .pricing-section .list-unstyled.text-white li,
        .pricing-section .list-unstyled.text-white strong,
        .pricing-section .list-unstyled.text-white i,
        .pricing-section h5.text-white {
            color: inherit !important;
        }

        /* why-choose-us card hover effect (applied to .card directly) */
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }



        .testimonial-slider-section .section-title h2 {
            font-size: 2.5rem;
            font-weight: 600;
            font-family: var(--nav-font);
            color: var(--bs-success);
            /* Adjust to your preferred success color */
            margin-bottom: 0.75rem;
        }

        .testimonial-slider-section .section-title p {
            font-size: 0.9rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.95;
        }

        .testimonial-slide {
            border: none;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.08);
            /* Lighter shadow */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .testimonial-slide:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.12);
            /* Slightly stronger hover shadow */
        }

        .testimonial-avatar {
            overflow: hidden;
        }

        .testimonial-avatar img {
            object-fit: cover;
        }

        .testimonial-slide h6 {
            color: #333;
            font-size: 1rem;
            font-weight: 600;
            font-family: var(--body-font);
            /* Ensure this variable is defined */
            margin-bottom: 0.2rem;
        }

        .testimonial-slide p {
            color: #6c757d;
            font-size: 0.85rem;
            line-height: 1.6;
        }

        .testimonial-slide .rating i {
            font-size: 1rem;
            margin-right: 0.1rem;
            color: #ffc107;
            /* Bootstrap warning color for stars */
        }

        /* Swiper styles */
        .swiper {
            width: 100%;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .swiper-slide {
            width: 80%;
            /* Adjust slide width as needed */
            margin: 0 auto;
            /* Center the slides */
        }



        /* Responsive adjustments */
        @media (max-width: 768px) {
            .swiper {
                padding-top: 10px;
            }

            .testimonial-slider-section .section-title h2 {
                font-size: 2rem;
            }

            .testimonial-slider-section .section-title p {
                font-size: 1rem;
            }

            .swiper-slide {
                width: 95%;
                margin-top: 0.2rem;
            }

            .swiper-nav-button {
                font-size: 1.2rem;
                width: 30px;
                height: 30px;
            }
        }

        .swiper-nav-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.05);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 10;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .swiper-nav-button:hover {
            background-color: var(--accent-color);
            color: white;
        }

        .swiper-button-prev {
            left: 10px;
        }

        .swiper-button-next {
            right: 10px;
        }

        /* Hide default Swiper arrows */
        .swiper-button-prev::after,
        .swiper-button-next::after {
            content: '';
        }

        /* Add Bootstrap Icons */
        .swiper-button-prev::before {
            content: '\f284';
            /* bi-chevron-left */
            font-family: 'bootstrap-icons';
            font-size: 1.5rem;
        }

        .swiper-button-next::before {
            content: '\f285';
            /* bi-chevron-right */
            font-family: 'bootstrap-icons';
            font-size: 1.5rem;
        }

        .section-title {
            padding-bottom: 10px !important;
        }

        /* Responsive adjustments */
        @media (max-width:1084px) {
            .pricing-section {
                max-width: 1000px;
                width: 100%
            }
        }

        @media (max-width: 768px) {

            .pricing-section {
                max-width: 700px;
                width: 100%;
            }

            .pricing-section .img-container {
                width: 100%;

            }

            .pricing-head h2,
            .testimonial-slider-section .section-title h2,
            .section-title h2 {
                font-size: 2rem;
            }

            .pricing-head p.lead.text-muted,
            .testimonial-slider-section .section-title p.lead.text-muted,
            .section-title p {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .pricing-section {
                max-width: 500px;
            }

            .pricing-head h2,
            .testimonial-slider-section .section-title h2,
            .section-title h2 {
                font-size: 1.75rem;
            }

            .pricing-head p,
            .testimonial-slider-section .section-title p.lead.text-muted,
            .section-title p {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {
            .pricing-section {
                max-width: 400px;
            }


        }

        .cta-btn-course {
            padding: 0.8rem 2rem;
            border-radius: 3px;
            border: 1px solid rgba(0, 0, 0, 0.164);
            transition: all 0.3s ease;
            background-color: #343a40;
            color: white
        }

        .cta-btn-course:hover {
            background-color: var(--accent-color);
            color: white
        }

        .img-fluid {
            max-height: 500px;
        }

        .about-back {
            /* background-color: #0dcc3a1e */
        }

        .course-details {
            max-width: 1200px;
            margin: 0 auto;
        }

        .why-info-p {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center
        }
    </style>
@endpush

@section('main')
    <main class="main">
        @if (auth()->check() && auth()->user()->purchasedCourses->contains($course))
        <section class="course-hero"
        style="background-image: url('{{ asset('frontend/img/whitetruck.jpg') }}'); background-size: cover; background-position: center 80%; background-repeat:no-repeat;  padding: 100px 0; position: relative;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color:#0a3d1ab0;"></div>
        <div class="container" style="position: relative; z-index: 1;">
            <div class="row align-items-center">
                <div class="col-md-8 text-white">
                    <h1 class="mb-4" style="font-size: 2.5rem; font-weight: bold;  color:var(--accent-color)  ;">
                        {{ $course->title }}</h1>
                    <p class="lead mb-4">
                        {{ $course->short_description }}
                    </p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"
                                    class="text-white text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item active" style="  color:var(--accent-color);" aria-current="page">
                                {{ $course->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4 text-md-end button-section">
                    @guest
                        {{-- <a href="{{ route('register') }}" class="cta-btn">Login to Enroll</a> --}}
                        <a href="{{ route('register') }}?course_id={{ $course->id }}" class="cta-btn">Login to Enroll</a>
                    @else
                        @if (auth()->user()->hasApprovedCourse($course->id))
                            <button class="btn btn-success " disabled>Already Enrolled</button>
                        @else
                            @if ($course->status === 'upcoming')
                                <button class="btn btn-secondary " disabled>Up Coming</button>
                            @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="btn btn-warning">Continue Payment</a>
                            @else
                                <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="cta-btn">Enroll Now</a>
                            @endif
                        @endif
                    @endguest
                </div>
            </div>
        </div>
    </section>

    @if($course->isTierCourse())
    <section class="container my-4">
        <div class="alert alert-success border-0 shadow-sm">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="mb-2"><i class="bi bi-gift me-2"></i><strong>Start Learning FREE Today!</strong></h5>
                    <p class="mb-0 small">Enroll now at no cost and upgrade anytime to unlock premium content and mentorship.</p>
                </div>
                <div class="col-md-4 text-md-end mt-2 mt-md-0">
                    <div class="d-flex flex-column gap-1">
                        <small class="text-muted"><i class="bi bi-check-circle-fill text-success"></i> <strong>FREE</strong> tier included</small>
                        <small class="text-muted"><i class="bi bi-star-fill text-primary"></i> <strong>Premium</strong> ${{ number_format($course->premium_price ?? 150, 0) }}</small>
                        <small class="text-muted"><i class="bi bi-trophy-fill text-warning"></i> <strong>Mentorship</strong> ${{ number_format($course->mentorship_price ?? 297, 0) }}</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="row container mx-auto bg-light">
        <div class="col-lg-12">
            <div class="course-curriculum">
                <h3 class="mb-3">Course Curriculum</h3>
                <div class="accordion" id="curriculumAccordion">
                    @php
                        $chapters = $course->chapters;
                        $chapters = $chapters->sortBy('order');
                    @endphp

                    @forelse ($chapters as $index => $chapter)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="chapterHeading{{ $index }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#chapterCollapse{{ $index }}" aria-expanded="false"
                                    aria-controls="chapterCollapse{{ $index }}">
                                    {{ $chapter->title }}
                                </button>
                            </h2>
                            <div id="chapterCollapse{{ $index }}" class="accordion-collapse collapse"
                                aria-labelledby="chapterHeading{{ $index }}"
                                data-bs-parent="#curriculumAccordion">
                                <div class="accordion-body">
                                    @if ($chapter->topics->count() > 0)
                                        <ul class="list-group">
                                            @foreach ($chapter->topics as $topic)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>{{ $topic->title }}</strong>
                                                        @if ($topic->type === 'video')
                                                            <span class="badge bg-primary ms-2">Video</span>
                                                        @elseif ($topic->type === 'voice')
                                                            <span class="badge bg-info ms-2">Audio</span>
                                                        @elseif ($topic->type === 'pdf')
                                                            <span class="badge bg-warning ms-2">PDF</span>
                                                        @else
                                                            <span class="badge bg-success ms-2">Reading</span>
                                                        @endif
                                                    </div>

                                                    @php
                                                        $user = auth()->user();
                                                        $hasAccess = $user && $user->hasApprovedCourse($course->id);
                                                    @endphp

                                                    @if ($hasAccess)
                                                        @if ($topic->type === 'voice' && $topic->voice)
                                                            <!-- Button to Open Modal -->
                                                            <button class="btn btn-sm btn-outline-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#audioModal{{ $topic->id }}">
                                                                <i class="bi bi-volume-up"></i>
                                                                Play Audio
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="audioModal{{ $topic->id }}" tabindex="-1"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">
                                                                                {{ $topic->title }}</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <!-- Audio Player -->
                                                                            <audio
                                                                                id="audio-player-{{ $topic->id }}"
                                                                                controls style="width: 100%;"
                                                                                class="audio-player">
                                                                                <source
                                                                                    src="{{ asset('storage/' . $topic->voice) }}"
                                                                                    type="audio/mpeg">
                                                                                Your browser does not support
                                                                                the audio tag.
                                                                            </audio>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @elseif($topic->type === 'pdf' && $topic->pdf)
                                                            <!-- Open PDF in a new tab -->
                                                            <span>


                                                                <a href="{{ asset('storage/' . $topic->pdf) }}"
                                                                    target="_blank"
                                                                    class="btn btn-sm btn-outline-primary">
                                                                    <i class="bi bi-file-earmark-pdf"></i> View
                                                                    PDF
                                                                </a>

                                                                <!-- Open PDF in Modal -->
                                                                <button class="btn btn-sm btn-outline-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#pdfModal{{ $topic->id }}">
                                                                    <i class="bi bi-eye"></i> Preview PDF
                                                                </button>
                                                            </span>
                                                            <!-- PDF Modal -->
                                                            <div class="modal fade" id="pdfModal{{ $topic->id }}"
                                                                tabindex="-1" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">
                                                                                {{ $topic->title }}</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <iframe
                                                                                src="{{ asset('storage/' . $topic->pdf) }}"
                                                                                width="100%"
                                                                                height="500px"></iframe>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @elseif($topic->type === 'video')
                                                            {{-- Check source (local, youtube, vimeo, etc.) --}}
                                                            @if ($topic->source_from === 'local' && $topic->local_video)
                                                                <!-- Button to open a modal or new page with the Plyr player -->
                                                                <button class="btn btn-sm btn-outline-success"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#videoModal{{ $topic->id }}">
                                                                    <i class="bi bi-play-circle"></i>
                                                                    Play Video

                                                                </button>

                                                                <!-- Modal with Plyr for local video -->
                                                                <div class="modal fade"
                                                                    id="videoModal{{ $topic->id }}" tabindex="-1"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    {{ $topic->title }}</h5>
                                                                                <button type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <video
                                                                                    id="player-local-{{ $topic->id }}"
                                                                                    class="plyr__video-player" controls
                                                                                    style="width: 100%">
                                                                                    <source
                                                                                        src="{{ asset('storage/' . $topic->local_video) }}"
                                                                                        type="video/mp4">
                                                                                    Your browser does not
                                                                                    support the video tag.
                                                                                </video>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif($topic->source_from === 'youtube' && $topic->video_url)
                                                                <!-- Use Plyr embed for YouTube -->
                                                                <button class="btn btn-sm btn-outline-success"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#videoModal{{ $topic->id }}">
                                                                    <i class="bi bi-play-circle"></i>
                                                                    Play Video
                                                                </button>

                                                                <!-- Modal for embedded YouTube -->
                                                                <div class="modal fade"
                                                                    id="videoModal{{ $topic->id }}" tabindex="-1"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    {{ $topic->title }}</h5>
                                                                                <button type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="plyr__video-embed"
                                                                                    id="player-embed-{{ $topic->id }}">
                                                                                    <iframe
                                                                                        src="{{ $topic->video_url }}?origin={{ url('/') }}&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0"
                                                                                        allowfullscreen
                                                                                        allowtransparency
                                                                                        allow="autoplay"></iframe>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif($topic->source_from === 'vimeo' && $topic->video_url)
                                                                <!-- Similar embed logic for Vimeo -->
                                                                <button class="btn btn-sm btn-outline-success"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#videoModal{{ $topic->id }}">
                                                                    <i class="bi bi-play-circle"></i>
                                                                    Play Video
                                                                </button>

                                                                <div class="modal fade"
                                                                    id="videoModal{{ $topic->id }}" tabindex="-1"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    {{ $topic->title }}</h5>
                                                                                <button type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="plyr__video-embed"
                                                                                    id="player-embed-{{ $topic->id }}">
                                                                                    <iframe
                                                                                        src="{{ $topic->video_url }}"
                                                                                        allowfullscreen
                                                                                        allowtransparency
                                                                                        allow="autoplay"></iframe>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <!-- If 'other' or no recognized source -->
                                                                <a href="{{ $topic->video_url }}" target="_blank"
                                                                    class="btn btn-sm btn-outline-success"><i
                                                                        class="bi bi-play-circle"></i>Play
                                                                    Video</a>
                                                            @endif
                                                        @else
                                                            {{-- Reading type --}}
                                                            @if ($topic->description)
                                                                <!-- If it's textual reading, you can show it in a modal or link to a PDF -->
                                                                <button class="btn btn-sm btn-outline-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#readingModal{{ $topic->id }}">
                                                                    <i class="bi bi-book"></i>
                                                                    Open Reading
                                                                </button>

                                                                <!-- Modal for reading content -->
                                                                <div class="modal fade"
                                                                    id="readingModal{{ $topic->id }}"
                                                                    tabindex="-1" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    {{ $topic->title }}</h5>
                                                                                <button type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                {!! $topic->description !!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <!-- If it's a PDF stored locally, you can link or embed it. For example: -->
                                                                <a href="{{ asset('storage/' . $topic->pdf_file) }}"
                                                                    target="_blank"
                                                                    class="btn btn-sm btn-outline-primary">Open
                                                                    PDF</a>
                                                            @endif
                                                        @endif
                                                    @else
                                                        <button class="btn btn-sm btn-secondary"
                                                            disabled>Locked</button>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted">No topics in this chapter.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No chapters found for this course.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </section>

        @else
      


        <section class="course-hero"
            style="background-image: url('{{ asset('frontend/img/whitetruck.jpg') }}'); background-size: cover; background-position: center 80%; background-repeat:no-repeat;  padding: 100px 0; position: relative;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color:#0a3d1ab0;"></div>
            <div class="container" style="position: relative; z-index: 1;">
                <div class="row align-items-center">
                    <div class="col-md-8 text-white">
                        <h1 class="mb-4" style="font-size: 2.5rem; font-weight: bold;  color:var(--accent-color)  ;">
                            {{ $course->title }}</h1>
                        <p class="lead mb-4">
                            {{ $course->short_description }}
                        </p>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}"
                                        class="text-white text-decoration-none">Home</a></li>
                                <li class="breadcrumb-item active" style="  color:var(--accent-color);" aria-current="page">
                                    {{ $course->title }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-4 text-md-end button-section">
                        @guest
                            {{-- <a href="{{ route('register') }}" class="cta-btn">Login to Enroll</a> --}}
                            <a href="{{ route('register') }}?course_id={{ $course->id }}" class="cta-btn">Login to Enroll</a>
                        @else
                            @if (auth()->user()->hasApprovedCourse($course->id))
                                <button class="btn btn-success " disabled>Already Enrolled</button>
                            @else
                                @if ($course->status === 'upcoming')
                                    <button class="btn btn-secondary " disabled>Up Coming</button>
                                @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                    <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="btn btn-warning w-100">Continue Payment</a>
                                @else
                                    <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="cta-btn">Enroll Now</a>
                                @endif
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        </section>


        <div class="pricing-head">
            <h2 class="mt-4 text-success">Choose Your Plan</h2>

        </div>
        {{-- <h2 class="pricing-heading">Choose Your Plan!</h2> --}}
        <section class="pricing-section mt-4 row justify-content-center ">
            <div class="col-md-6 img-container">

                {{-- <div class="text-center mb-3"> --}}
                <img src="{{ Storage::url($course->image ?? '') }}" alt="{{ $course->title }}"
                    class="img-fluid rounded mb-3" style="object-fit: contain;">
                {{-- </div> --}}
            </div>

            <div class="col-md-6">

                                <h4 class="mb-3">What's Included in This Course:</h4>

                <p class="mb-3">Moving from Canada to the U.S. to drive a truck can be life-changing � but the process can also be confusing. This course and mentorship program simplifies every step, making it easy for Canadian drivers to start their U.S. trucking journey with confidence.</p>

                <p class="mb-3"><strong>You'll learn:</strong></p>
                <ul class="text-start">
                    <li>How to qualify and apply for the right work visa or cross-border permits</li>
                    <li>How to convert your Canadian Class 1 license to a U.S. CDL</li>
                    <li>How to find trusted U.S. trucking companies hiring Canadian drivers</li>
                    <li>What documents you need: passport, medical card, background checks, and insurance</li>
                    <li>How to prepare for your move � housing, taxes, and pay expectations</li>
                    <li>How to avoid mistakes that delay your approval or job offer</li>
                </ul>

                <p class="mb-3">After joining, you'll get access to our private Telegram mentorship group, where you'll receive personal guidance, job leads, and daily support from our mentors who have already gone through the same process.</p>

                <div class="text-center">
                    <h5 class="mb-3">
                        <strong>Price:</strong>
                        @if($course->isTierCourse())
                            <span style="color: #5fcf80;">FREE</span> <small>(+ Premium upgrades available)</small>
                        @else
                            ${{ $course->price }}
                        @endif
                    </h5>

                    @if($course->isTierCourse())
                        <div class="alert alert-info border-0 mb-4 text-start">
                            <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>Flexible Learning Options</h6>
                            <p class="small mb-2"><strong>Start FREE</strong> and upgrade to unlock everything:</p>
                            <ul class="small mb-0">
                                <li><strong>FREE Tier:</strong> Access essential course content</li>
                                <li><strong>Premium Tier (${{ number_format($course->premium_price ?? 150, 0) }}):</strong> Full course access, exclusive videos, PDF resources & Telegram group support</li>
                            </ul>
                            <p class="small text-muted mb-0 mt-2">💡 Enroll for free now, upgrade once to Premium!</p>
                        </div>
                    @endif

                    @guest

                        <a href="{{ route('register') }}?course_id={{ $course->id }}" class="cta w-100 mb-2">Login to
                            Enroll</a>
                    @else
                        @if (auth()->user()->hasApprovedCourse($course->id))
                            <button class="cta   mb-2" disabled>Already Enrolled</button>
                        @else
                            @if ($course->status === 'upcoming')
                                <button class="cta   mb-2" disabled>Up Coming</button>
                            @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="cta mb-2">Continue Payment</a>
                            @else
                                <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="cta w-100">Enroll
                                    Now</a>
                            @endif
                        @endif
                    @endguest
                </div>
            </div>

        </section>

        <section class="bg-light">

            <section class="course-details py-5 bg-light ">
                <div class="container mx-auto">
                    <div class="row">

                        <!-- Left Column: Description + Curriculum -->
                        <div class="col-lg-12 mb-5">

                            <div class="row g-4  align-items-center">
                                <div class="col-md-6 p-4 d-flex flex-column justify-content-between about-back">
                                    <div>

                                        <h2 class="card-title mb-3 fw-bold text-success">About This Course</h2>
                                        <p class="card-text lead text-secondary">
                                            If you're a Canadian driver dreaming of working in the U.S., this course shows you exactly how to do it. Learn the visa options, job requirements, and application process step by step. We'll help you connect with trusted trucking companies and guide you until you start driving in the U.S. Plus, lifetime mentorship via our private Telegram group.
                                        </p>
                                    </div>
                                    <div class="mt-4 ">
                                        @guest
                                            <a href="{{ route('register') }}?course_id={{ $course->id }}"
                                                class="cta-btn-course w-100 mb-2">Login to Enroll</a>
                                        @else
                                            @if (auth()->user()->hasApprovedCourse($course->id))
                                                <button class="cta-btn-course  mb-2" disabled>Already Enrolled</button>
                                            @else
                                                @if ($course->status === 'upcoming')
                                                    <button class="cta-btn-course mb-2" disabled>Up Coming</button>
                                                @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                                    <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="cta-btn-course mb-2">Continue Payment</a>
                                                @else
                                                    <a href="{{ route('front.courses.enrollForm', $course->id) }}"
                                                        class="cta-btn-course mb-2 ">Enroll
                                                        Now</a>
                                                @endif
                                            @endif
                                        @endguest
                                    </div>
                                </div>
                                <div class="col-md-6   ">
                                    <div class="h-100 overflow-hidden">

                                        <img src="{{ asset('frontend/img/training.jpg') }}" alt="Course Image"
                                            class="img-fluid object-fit-cover rounded h-100 shadow-md">
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>

                </div>

            </section>
        </section>


        <section class="why-choose-us py-5 bg-white">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8 text-center">
                        <div class="section-title">
                            <h2 class="fw-bold text-success mb-3">Why Choose USA Truck Path?</h2>
                            <p class="lead text-muted">Your Fast-Track to a Truck Driving Career Starts Here
                                We empower future truck drivers with an easy, effective, and guaranteed way to pass the DMV
                                exam�regardless of language or background.</p>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-primary-subtle text-primary rounded-circle mb-3 mx-auto"
                                    style="width: 60px; height: 60px; line-height: 60px; font-size: 1.5rem;">
                                    <i class="bi bi-translate"></i>
                                </div>
                                <h5 class="fw-semibold mb-2">Multilingual Learning System</h5>
                                <p class="text-muted small">Study in your preferred language�English, Arabic, Somali,
                                    Amharic, French, or Nepali�with complete support for non-native speakers.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-success-subtle text-success rounded-circle mb-3 mx-auto"
                                    style="width: 60px; height: 60px; line-height: 60px; font-size: 1.5rem;">
                                    <i class="bi bi-chat-left-text-fill"></i>
                                </div>
                                <h5 class="fw-semibold mb-2">Real DMV Test Questions & Answers</h5>
                                <p class="text-muted small">Our course includes the actual test format and questions used
                                    by DMVs across all states, ensuring you�re fully prepared.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-warning-subtle text-warning rounded-circle mb-3 mx-auto"
                                    style="width: 60px; height: 60px; line-height: 60px; font-size: 1.5rem;">
                                    <i class="bi bi-collection-play-fill"></i>
                                </div>
                                <h5 class="fw-semibold mb-2">All-in-One Multimedia Course</h5>
                                <p class="text-muted small">Access video classes, eBooks, and audio lessons for a rich and
                                    engaging learning experience tailored to different learning styles.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-danger-subtle text-danger rounded-circle mb-3 mx-auto"
                                    style="width: 60px; height: 60px; line-height: 60px; font-size: 1.5rem;">
                                    <i class="bi bi-shield-fill-check"></i>
                                </div>
                                <h5 class="fw-semibold mb-2">100% Pass Guarantee</h5>
                                <p class="text-muted small">We�re so confident in our system that we guarantee you�ll pass
                                    your DMV test on the first try�or get extended access for free.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-info-subtle text-info rounded-circle mb-3 mx-auto"
                                    style="width: 60px; height: 60px; line-height: 60px; font-size: 1.5rem;">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                                <h5 class="fw-semibold mb-2">Learn at Your Own Pace</h5>
                                <p class="text-muted small">Whether you have a full-time job or a busy life, our platform
                                    lets you study anytime, anywhere�on any device.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-secondary-subtle text-secondary rounded-circle mb-3 mx-auto"
                                    style="width: 60px; height: 60px; line-height: 60px; font-size: 1.5rem;">
                                    <i class="bi  bi-truck-front-fill"></i>
                                </div>
                                <h5 class="fw-semibold mb-2">Built for Future Truckers</h5>
                                <p class="text-muted small">We specialize in helping aspiring CDL truck drivers�so you�re
                                    not just passing a test, you�re preparing for a career on the road.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="row container mx-auto bg-light">
            <div class="col-lg-12">
                <div class="course-curriculum">
                    <h3 class="mb-3">Course Curriculum</h3>
                    <div class="accordion" id="curriculumAccordion">
                        @php
                            $chapters = $course->chapters;
                            $chapters = $chapters->sortBy('order');
                        @endphp

                        @forelse ($chapters as $index => $chapter)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="chapterHeading{{ $index }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#chapterCollapse{{ $index }}" aria-expanded="false"
                                        aria-controls="chapterCollapse{{ $index }}">
                                        {{ $chapter->title }}
                                    </button>
                                </h2>
                                <div id="chapterCollapse{{ $index }}" class="accordion-collapse collapse"
                                    aria-labelledby="chapterHeading{{ $index }}"
                                    data-bs-parent="#curriculumAccordion">
                                    <div class="accordion-body">
                                        @if ($chapter->topics->count() > 0)
                                            <ul class="list-group">
                                                @foreach ($chapter->topics as $topic)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <strong>{{ $topic->title }}</strong>
                                                            @if ($topic->type === 'video')
                                                                <span class="badge bg-primary ms-2">Video</span>
                                                            @elseif ($topic->type === 'voice')
                                                                <span class="badge bg-info ms-2">Audio</span>
                                                            @elseif ($topic->type === 'pdf')
                                                                <span class="badge bg-warning ms-2">PDF</span>
                                                            @else
                                                                <span class="badge bg-success ms-2">Reading</span>
                                                            @endif
                                                        </div>

                                                        @php
                                                            $user = auth()->user();
                                                            $hasAccess = $user && $user->hasApprovedCourse($course->id);
                                                        @endphp

                                                        @if ($hasAccess)
                                                            @if ($topic->type === 'voice' && $topic->voice)
                                                                <!-- Button to Open Modal -->
                                                                <button class="btn btn-sm btn-outline-success"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#audioModal{{ $topic->id }}">
                                                                    <i class="bi bi-volume-up"></i>
                                                                    Play Audio
                                                                </button>

                                                                <!-- Modal -->
                                                                <div class="modal fade"
                                                                    id="audioModal{{ $topic->id }}" tabindex="-1"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    {{ $topic->title }}</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body text-center">
                                                                                <!-- Audio Player -->
                                                                                <audio
                                                                                    id="audio-player-{{ $topic->id }}"
                                                                                    controls style="width: 100%;"
                                                                                    class="audio-player">
                                                                                    <source
                                                                                        src="{{ asset('storage/' . $topic->voice) }}"
                                                                                        type="audio/mpeg">
                                                                                    Your browser does not support
                                                                                    the audio tag.
                                                                                </audio>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif($topic->type === 'pdf' && $topic->pdf)
                                                                <!-- Open PDF in a new tab -->
                                                                <span>


                                                                    <a href="{{ asset('storage/' . $topic->pdf) }}"
                                                                        target="_blank"
                                                                        class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-file-earmark-pdf"></i> View
                                                                        PDF
                                                                    </a>

                                                                    <!-- Open PDF in Modal -->
                                                                    <button class="btn btn-sm btn-outline-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#pdfModal{{ $topic->id }}">
                                                                        <i class="bi bi-eye"></i> Preview PDF
                                                                    </button>
                                                                </span>
                                                                <!-- PDF Modal -->
                                                                <div class="modal fade" id="pdfModal{{ $topic->id }}"
                                                                    tabindex="-1" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    {{ $topic->title }}</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <iframe
                                                                                    src="{{ asset('storage/' . $topic->pdf) }}"
                                                                                    width="100%"
                                                                                    height="500px"></iframe>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif($topic->type === 'video')
                                                                {{-- Check source (local, youtube, vimeo, etc.) --}}
                                                                @if ($topic->source_from === 'local' && $topic->local_video)
                                                                    <!-- Button to open a modal or new page with the Plyr player -->
                                                                    <button class="btn btn-sm btn-outline-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#videoModal{{ $topic->id }}">
                                                                        <i class="bi bi-play-circle"></i>
                                                                        Play Video

                                                                    </button>

                                                                    <!-- Modal with Plyr for local video -->
                                                                    <div class="modal fade"
                                                                        id="videoModal{{ $topic->id }}" tabindex="-1"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        {{ $topic->title }}</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <video
                                                                                        id="player-local-{{ $topic->id }}"
                                                                                        class="plyr__video-player" controls
                                                                                        style="width: 100%">
                                                                                        <source
                                                                                            src="{{ asset('storage/' . $topic->local_video) }}"
                                                                                            type="video/mp4">
                                                                                        Your browser does not
                                                                                        support the video tag.
                                                                                    </video>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif($topic->source_from === 'youtube' && $topic->video_url)
                                                                    <!-- Use Plyr embed for YouTube -->
                                                                    <button class="btn btn-sm btn-outline-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#videoModal{{ $topic->id }}">
                                                                        <i class="bi bi-play-circle"></i>
                                                                        Play Video
                                                                    </button>

                                                                    <!-- Modal for embedded YouTube -->
                                                                    <div class="modal fade"
                                                                        id="videoModal{{ $topic->id }}" tabindex="-1"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        {{ $topic->title }}</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="plyr__video-embed"
                                                                                        id="player-embed-{{ $topic->id }}">
                                                                                        <iframe
                                                                                            src="{{ $topic->video_url }}?origin={{ url('/') }}&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0"
                                                                                            allowfullscreen
                                                                                            allowtransparency
                                                                                            allow="autoplay"></iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif($topic->source_from === 'vimeo' && $topic->video_url)
                                                                    <!-- Similar embed logic for Vimeo -->
                                                                    <button class="btn btn-sm btn-outline-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#videoModal{{ $topic->id }}">
                                                                        <i class="bi bi-play-circle"></i>
                                                                        Play Video
                                                                    </button>

                                                                    <div class="modal fade"
                                                                        id="videoModal{{ $topic->id }}" tabindex="-1"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        {{ $topic->title }}</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="plyr__video-embed"
                                                                                        id="player-embed-{{ $topic->id }}">
                                                                                        <iframe
                                                                                            src="{{ $topic->video_url }}"
                                                                                            allowfullscreen
                                                                                            allowtransparency
                                                                                            allow="autoplay"></iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <!-- If 'other' or no recognized source -->
                                                                    <a href="{{ $topic->video_url }}" target="_blank"
                                                                        class="btn btn-sm btn-outline-success"><i
                                                                            class="bi bi-play-circle"></i>Play
                                                                        Video</a>
                                                                @endif
                                                            @else
                                                                {{-- Reading type --}}
                                                                @if ($topic->description)
                                                                    <!-- If it's textual reading, you can show it in a modal or link to a PDF -->
                                                                    <button class="btn btn-sm btn-outline-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#readingModal{{ $topic->id }}">
                                                                        <i class="bi bi-book"></i>
                                                                        Open Reading
                                                                    </button>

                                                                    <!-- Modal for reading content -->
                                                                    <div class="modal fade"
                                                                        id="readingModal{{ $topic->id }}"
                                                                        tabindex="-1" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        {{ $topic->title }}</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    {!! $topic->description !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <!-- If it's a PDF stored locally, you can link or embed it. For example: -->
                                                                    <a href="{{ asset('storage/' . $topic->pdf_file) }}"
                                                                        target="_blank"
                                                                        class="btn btn-sm btn-outline-primary">Open
                                                                        PDF</a>
                                                                @endif
                                                            @endif
                                                        @else
                                                            <button class="btn btn-sm btn-secondary"
                                                                disabled>Locked</button>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-muted">No topics in this chapter.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No chapters found for this course.</p>
                        @endforelse

                        {{-- Telegram Group Support Section (ONLY for Premium Tier) --}}
                        @auth
                            @php
                                $user = auth()->user();
                                $enrollment = $user->purchasedCourses()->where('course_id', $course->id)->first();
                                $currentTier = $user->getSubscriptionTier($course->id);
                                $hasAccess = $user && $user->hasApprovedCourse($course->id);
                            @endphp

                            @if ($hasAccess && $enrollment && $currentTier === 'premium' && $course->telegram_chat_id && $enrollment->pivot->telegram_invite_link)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#telegramSupport" aria-expanded="false"
                                            aria-controls="telegramSupport">
                                            <i class="bi bi-telegram me-2"></i> Group Support
                                        </button>
                                    </h2>
                                    <div id="telegramSupport" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            @if ($enrollment->pivot->telegram_invite_link)
                                                <p class="mb-3">
                                                    <i class="bi bi-info-circle text-primary me-1"></i>
                                                    Join our exclusive Telegram group to connect with instructors and fellow students.
                                                    Get support, ask questions, and stay updated!
                                                </p>
                                                <div class="alert alert-warning border-0 mb-3">
                                                    <small>
                                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                                        <strong>Important:</strong> This is a one-time invitation link generated uniquely for you.
                                                        The link can only be used once and will stop working after one person joins.
                                                    </small>
                                                </div>
                                                <a href="{{ route('telegram.invite.redeem', $course->id) }}"
                                                   class="btn btn-success w-100"
                                                   onclick="return confirm('Are you sure? This link can only be used once!')">
                                                    <i class="bi bi-telegram me-2"></i> Join Telegram Group Now
                                                </a>
                                                <p class="text-muted small mt-2 mb-0">
                                                    <i class="bi bi-clock me-1"></i>Link generated: {{ $enrollment->pivot->telegram_invite_generated_at ? \Carbon\Carbon::parse($enrollment->pivot->telegram_invite_generated_at)->diffForHumans() : 'Just now' }}
                                                </p>

                                                <div class="alert alert-light border mt-3 mb-0">
                                                    <p class="small mb-0">
                                                        <i class="bi bi-whatsapp text-success me-1"></i>
                                                        <strong>Need Help?</strong><br>
                                                        If, for any reason, the Telegram group link does not work for you, please contact me directly on WhatsApp at <a href="https://wa.me/16146052310" target="_blank" class="text-success fw-bold">+1 (614) 605-2310</a>.<br>
                                                        <em class="text-muted">This number is for support purposes only to help resolve your issue — it is not a general communication line.</em>
                                                    </p>
                                                </div>
                                            @else
                                                <div class="alert alert-info border-0">
                                                    <i class="bi bi-hourglass-split me-2"></i>
                                                    Generating your unique Telegram invite link... Please refresh the page.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endauth

                    </div>
                </div>

            </div>
        </section>
        <section class="why-info   py-5">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class=" ">
                        <h2 class="fw-bold text-success mb-3 text-center">About USATruckPath</h2>
                        <p class="text-muted why-info-p">

                            We make it easy to pass your Commercial Learner�s Permit (CLP) test. Our all-in-one course
                            includes video lessons, audio guides, and an eBook�available in multiple languages. It�s
                            everything you need to get started in trucking.
                        </p>
                        <!--p class="text-muted text-center mb-0 mt-2" style="font-weight: 700; font-size:2rem; ">Here's what
                            you need to do to get started:</p -->
                    </div>
                </div>
                <!-- div class="row">
                    <div class="col-lg-12 mx-auto">
                        <ul class="list-group list-group-numbered">
                            <li class="list-group-item d-flex   align-items-start">
                                <div class="ms-2">
                                    <div class="fw-bold">What You Get</div>
                                    <p class="text-muted mb-0">Original price $297, now only $80.
                                        You�ll get full access to:
                                    <p>Video course, Audio course, Downloadable eBook, Covers all topics: General Knowledge,
                                        Air Brakes, Combination, Hazmat (H), Tanker (N), Doubles & Triples (T), Passenger
                                        (P), School Bus (S), Tanker + Hazmat (X).</p>
                                    </p>
                                </div>
                            </li>
                            <li class="list-group-item d-flex   align-items-start">
                                <div class="ms-2">
                                    <div class="fw-bold">Proven Method</div>
                                    <p class="text-muted mb-0">Our study method is simple and guaranteed.
                                        You�ll get one question and one correct answer�no confusing multiple-choice options.
                                        Everyone who purchased our course has passed their test.</p>
                                </div>
                            </li>
                            <li class="list-group-item d-flex   align-items-start">
                                <div class="ms-2">
                                    <div class="fw-bold">Get Started Now</div>
                                    <p class="text-muted mb-0">This is your first step to becoming a CDL driver. Join
                                        thousands who�ve passed with our guide. Study at your own pace and pass with
                                        confidence�guaranteed..</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div -->
            </div>
        </section>


 

        <section class="testimonial-slider-section py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center mb-1">
                    <div class="col-lg-8 text-center">
                        <div class="section-title">
                            <h2 class="fw-bold text-success mb-3 mb-sm-1">What Our Students Say</h2>
                            <p class="lead text-muted">Read inspiring stories from individuals who have successfully
                                achieved their trucking careers with us.</p>
                        </div>
                    </div>
                </div>
                <div class="swiper testimonialSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial-slide card border-0 shadow-sm rounded-4 p-4 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="testimonial-avatar rounded-circle overflow-hidden me-3"
                                        style="width: 50px; height: 50px;">
                                        <img src={{ asset('frontend/img/public.png') }} alt="John Doe"
                                            class="img-fluid w-100 h-100 object-cover">
                                    </div>
                                    <h6 class="fw-semibold mb-0">Yodit Tadesse</h6>
                                </div>
                                <p class="text-muted mb-3">"I�m so glad I found USATruckPath.com! The practice questions
                                    were just like the real test and gave me the confidence I needed. I passed my permit
                                    test on the first try and even joined their trucking school, CDL City Truck Driving
                                    School, which is very affordable. Now I have my CDL, and I couldn�t be happier!"
                                </p>
                                <div class="rating text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-slide card border-0 shadow-sm rounded-4 p-4 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="testimonial-avatar rounded-circle overflow-hidden me-3"
                                        style="width: 50px; height: 50px;">
                                        <img src={{ asset('frontend/img/boy.png') }} alt="Alice Smith"
                                            class="img-fluid w-100 h-100 object-cover">
                                    </div>
                                    <h6 class="fw-semibold mb-0">Carlos Mendoza</h6>
                                </div>
                                <p class="text-muted mb-3">"I�m originally from Honduras and live in Columbus, Ohio. I had
                                    tried a couple of other programs to pass my CDL permit test, but they didn�t work for
                                    me. Then I found USATruckPath.com, and it changed everything! The questions were just
                                    like the real test, and the lessons were easy to understand. I passed my permit test on
                                    the first try and joined CDL City Truck Driving School here in Columbus. Now I have my
                                    CDL, and I couldn�t be happier!"</p>
                                <div class="rating text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-slide card border-0 shadow-sm rounded-4 p-4 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="testimonial-avatar rounded-circle overflow-hidden me-3"
                                        style="width: 50px; height: 50px;">
                                        <img src={{ asset('frontend/img/boy.png') }} alt="Bob Miller"
                                            class="img-fluid w-100 h-100 object-cover">
                                    </div>
                                    <h6 class="fw-semibold mb-0">Ahmed Hassan</h6>
                                </div>
                                <p class="text-muted mb-3">"I�m originally from Egypt and lived in Dearborn, Michigan,
                                    working as a DoorDash delivery driver. I was tired of the long hours and low pay and
                                    wanted a better career. That�s when I found USATruckPath.com and bought the Arabic
                                    version of the guide. It was perfect for me! The questions were just like the real test,
                                    and the lessons were so easy to follow in my own language. I passed my CDL permit test
                                    on the first try and joined CDL City Truck Driving School. Now I have my CDL and a new
                                    career I�m proud of. Thank you, USATruckPath!"
                                </p>
                                <div class="rating text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-slide card border-0 shadow-sm rounded-4 p-4 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="testimonial-avatar rounded-circle overflow-hidden me-3"
                                        style="width: 50px; height: 50px;">
                                        <img src={{ asset('frontend/img/public.png') }} alt="Bob Miller"
                                            class="img-fluid w-100 h-100 object-cover">
                                    </div>
                                    <h6 class="fw-semibold mb-0">Yodit Tadesse</h6>
                                </div>
                                <p class="text-muted mb-3">"I�m so glad I found USATruckPath.com! The practice questions
                                    were just like the real test and gave me the confidence I needed. I passed my permit
                                    test on the first try and even joined their trucking school, CDL City Truck Driving
                                    School, which is very affordable. Now I have my CDL, and I couldn�t be happier!"
                                </p>
                                <div class="rating text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination mt-4 d-flex justify-content-center"></div>

                    <div class="swiper-button-prev swiper-nav-button"></div>
                    <div class="swiper-button-next swiper-nav-button"></div>
                </div>
            </div>
        </section>



        <!-- Closing Section / Call to Action -->
        <section class="py-5 bg-light text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="fw-bold text-success mb-4">????????? Ready to start your American trucking career?</h2>
                        <p class="lead text-secondary mb-4">
                            Join today and let us guide you from Canada to the U.S. step by step � from visa and license conversion to your first trucking job.
                        </p>
                        <p class="lead text-secondary mb-4">
                            Enroll now and get lifetime mentorship and daily support until you're on the road in the USA.
                        </p>
                        <div class="mt-4">
                            @guest
                                <a href="{{ route('register') }}?course_id={{ $course->id }}" class="btn btn-success btn-lg px-5 py-3">Login to Enroll</a>
                            @else
                                @if (auth()->user()->hasApprovedCourse($course->id))
                                    <button class="btn btn-success btn-lg px-5 py-3" disabled>Already Enrolled</button>
                                @else
                                    @if ($course->status === 'upcoming')
                                        <button class="btn btn-secondary btn-lg px-5 py-3" disabled>Up Coming</button>
                                    @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                        <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="btn btn-warning btn-lg px-5 py-3">Continue Payment</a>
                                    @else
                                        <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="btn btn-success btn-lg px-5 py-3">Enroll Now</a>
                                    @endif
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main Course Content Section -->
        @endif

    </main>


    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const players = Array.from(document.querySelectorAll('.plyr__video-player, .plyr__video-embed'))
                    .map((p) => new Plyr(p));


            });
        </script>

        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const players = Plyr.setup('.audio-player');
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Pause audio when the modal is closed
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.addEventListener('hidden.bs.modal', function() {
                        let audio = modal.querySelector('audio');
                        if (audio) {
                            audio.pause();
                            audio.currentTime = 0; // Reset audio
                        }
                    });
                });
            });

            const swiper = new Swiper('.testimonialSwiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: { // Add this autoplay object
                    delay: 3000, // Autoplay every 5 seconds (5000 milliseconds)
                    disableOnInteraction: false, // Don't stop autoplay on user interaction
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                }
            });
        </script>
    @endpush

@endsection
