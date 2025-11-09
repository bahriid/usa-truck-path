@extends('partials.master')



@push('styles')

    <style>
        .course-item img {
            object-fit: contain;
            background: #f8f9fa;
        }

        @media (max-width: 768px) {
            .course-item img {
                object-fit: cover;
                background: transparent;
            }
        }

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

                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color:#0a3d1ab0;">

                </div>

                <div class="container" style="position: relative; z-index: 1;">

                    <div class="row align-items-center">

                        <div class="col-md-8 text-white">

                            <h1 class="mb-4" style="font-size: 2.5rem; font-weight: bold;  color:var(--accent-color)  ;">

                                {{ $course->title }}</h1>

                            <p class="lead mb-4">

                                {{ $course->short_description ?? 'Unlock your trucking career with our full CDL permit prep course — available in English, with video, audio, and eBook lessons.' }}

                            </p>

                            <nav aria-label="breadcrumb">

                                <ol class="breadcrumb ">

                                    <li class="breadcrumb-item"><a href="{{ url('/') }}"

                                            class="text-white text-decoration-none">Home</a></li>

                                    <li class="breadcrumb-item active" style="  color:var(--accent-color);"

                                        aria-current="page">

                                        {{ $course->title }}</li>

                                </ol>

                            </nav>

                        </div>

                        <div class="col-md-4 text-md-end button-section">

                            @guest

                                {{-- <a href="{{ route('register') }}" class="cta-btn">Login to Enroll</a> --}}

                                <a href="{{ route('register') }}?course_id={{ $course->id }}" class="cta-btn">Login to

                                    Enroll</a>

                            @else

                                @if (auth()->user()->hasApprovedCourse($course->id))

                                    <button class="btn btn-success " disabled>Already Enrolled</button>

                                @else

                                    @if ($course->status === 'upcoming')

                                        <button class="btn btn-secondary " disabled>Up Coming</button>

                                    @elseif(auth()->user()->hasPurchasedCourse($course->id))

                                        <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="btn btn-warning w-100">Continue Payment</a>

                                    @else

                                        <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="cta-btn">Enroll

                                            Now</a>

                                    @endif

                                @endif

                            @endguest

                        </div>

                    </div>

                </div>

            </section>

            <section class="row container mx-auto bg-light mb-2">

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

                                                                $hasAccess =

                                                                    $user && $user->hasApprovedCourse($course->id);

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

                                                                    <div class="modal fade"

                                                                        id="pdfModal{{ $topic->id }}" tabindex="-1"

                                                                        aria-hidden="true">

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

                                                                            id="videoModal{{ $topic->id }}"

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

                                                                                        <video

                                                                                            id="player-local-{{ $topic->id }}"

                                                                                            class="plyr__video-player"

                                                                                            controls style="width: 100%">

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

                                                                            id="videoModal{{ $topic->id }}"

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

                                                                            id="videoModal{{ $topic->id }}"

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

            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color:#0a3d1ab0;">

            </div>

            <div class="container" style="position: relative; z-index: 1;">

                <div class="row align-items-center">

                    <div class="col-md-8 text-white">

                        <h1 class="mb-4" style="font-size: 2.5rem; font-weight: bold;  color:var(--accent-color)  ;">

                            {{ $course->title }}</h1>

                        <p class="lead mb-4">

                            {{ $course->short_description ?? 'Unlock your trucking career with our full CDL permit prep course — available in English, with video, audio, and eBook lessons.' }}

                        </p>

                        <nav aria-label="breadcrumb">

                            <ol class="breadcrumb ">

                                <li class="breadcrumb-item"><a href="{{ url('/') }}"

                                        class="text-white text-decoration-none">Home</a></li>

                                <li class="breadcrumb-item active" style="  color:var(--accent-color);"

                                    aria-current="page">

                                    {{ $course->title }}</li>

                            </ol>

                        </nav>

                    </div>

                    <div class="col-md-4 text-md-end button-section">

                        @guest

                            {{-- <a href="{{ route('register') }}" class="cta-btn">Login to Enroll</a> --}}

                            <a href="{{ route('register') }}?course_id={{ $course->id }}" class="cta-btn">Login to

                                Enroll</a>

                        @else

                            @if (auth()->user()->hasApprovedCourse($course->id))

                                <button class="btn btn-success " disabled>Already Enrolled</button>

                            @else

                                @if ($course->status === 'upcoming')

                                    <button class="btn btn-secondary " disabled>Up Coming</button>

                                @elseif(auth()->user()->hasPurchasedCourse($course->id))

                                    <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="btn btn-warning w-100">Continue Payment</a>

                                @else

                                    <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="cta-btn">Enroll

                                        Now</a>

                                @endif

                            @endif

                        @endguest

                    </div>

                </div>

            </div>

        </section>





        {{-- <div class="pricing-head">

            <h2 class="mt-4 text-success">Choose Your Plan</h2>



        </div> --}}

        <section id="courses" class="courses section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Courses</h2>
                <p>CDL Class A Permit Course</p>
            </div>
            <!-- End Section Title -->
            <div class="container">
                <div class="row mb-3">
                    @forelse ($courses as $course)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-3" data-aos="zoom-in"
                        data-aos-delay="100">
                        <div class="course-item">
                        <a href="{{ route('front.course.details', $course->slug) }}">
                        <img src="{{ Storage::url($course->image ?? '') }}" class="" alt="..."
                            style="width: 100%; height: 274px; display: block;"></a>
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                                {{-- @guest
                                <a href="{{ route('register') }}?course_id={{ $course->id }}"
                                    class="btn btn-primary">Login to Enroll</a>
                                @else
                                @if (auth()->user()->hasApprovedCourse($course->id))
                                <button class="btn btn-success" disabled>Already Enrolled</button>
                                @else
                                <!-- If you want to show 'Up Coming' based on course status, you can do something like: -->
                                @if ($course->status === 'upcoming')
                                <button class="btn btn-secondary" disabled>Up Coming</button>
                                @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="btn btn-warning">Continue Payment</a>
                                @else
                                <!-- Instead of directly purchasing, go to the enroll form -->
                                <a href="{{ route('front.courses.enrollForm', $course->id) }}"
                                    class="btn btn-primary">Enroll
                                Now</a>
                                @endif
                                @endif
                                @endguest --}}
                                @if(($course->course_type ?? 'paid') === 'tier')
                                    <a href="{{ route('front.course.details', $course->slug) }}"
                                        class="btn btn-success">Start Free Course</a>
                                @else
                                    <a href="{{ route('front.course.details', $course->slug) }}"
                                        class="btn btn-success">More Details</a>
                                @endif

                                <div class="price-wrapper">
                                    @if(($course->course_type ?? 'paid') === 'tier')
                                        <p class="price mb-0">
                                            <span style="text-decoration: line-through; color: #999; font-size: 0.9em; margin-right: 8px;">$0</span>
                                            <span style="color: #5fcf80; font-weight: bold;">FREE</span>
                                        </p>
                                    @else
                                        @if($course->original_price)
                                            <p class="price mb-0">
                                                <span style="text-decoration: line-through; color: #999; font-size: 0.9em; margin-right: 8px;">${{ $course->original_price }}</span>
                                                <span style="color: #5fcf80; font-weight: bold;">${{ $course->price ?? '' }}</span>
                                            </p>
                                        @else
                                            <p class="price mb-0">${{ $course->price ?? '' }}</p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <h3><a
                                href="{{ route('front.course.details', $course->slug) }}">{{ Str::limit($course->title ?? '', 60) }}</a>
                            </h3>
                            <!-- <p class="description">{!! Str::limit($course->description ?? '', 152) !!}.</p> -->
                            <p class="description">{{ Str::limit(strip_tags($course->description ?? ''), 152, '...') }}</p>
                            <!--<div class="trainer d-flex justify-content-between align-items-center">-->
                            <!--<div class="trainer-profile d-flex align-items-center">-->
                            <!--<i class="bi bi-clock"></i>&nbsp;2:30 h -->
                            <!--              </div>-->
                            <!--              <div class="trainer-rank d-flex align-items-center">-->
                            <!--                  <i class="bi bi-people"></i>&nbsp;{{ $course->students->count() }} students-->
                            <!--                  &nbsp;&nbsp;-->
                            <!--                  <i class="bi bi-book"></i>&nbsp;{{ $course->chapters->count() }} lessons-->
                            <!--              </div>-->
                            <!--</div>-->
                        </div>
                        </div>
                    </div>
                    <!-- End Course Item-->
                    @empty
                    <div>No course Found</div>
                    @endforelse
                </div>
                <!-- Load More Button -->
                @if ($courses->hasMorePages())
                <div class="text-center">
                    <a class="btn btn-primary" href="{{ route('front.course') }}" id="loadMore" data-page="2"
                        style ="background: var(--accent-color);
                        border: none;">Load More...</a>
                </div>
                @endif
            </div>
            </section>
            <!-- /Courses Section -->

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

