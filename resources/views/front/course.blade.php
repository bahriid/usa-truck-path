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
</style>
@endpush

@section('main')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Courses</h1>
                            <p class="mb-0">Pass your commercial learner's permit test with ease using our exact questions
                                and answers. Prepare by reading and familiarizing yourself with the General Knowledge, Air
                                Brakes, and Combination sections.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Courses</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Courses Section -->
        <section id="courses" class="courses section">

            <div class="container">

                <div class="row mb-3">




                    @forelse ($courses as $course)
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-3" data-aos="zoom-in"
                            data-aos-delay="100">
                            <div class="course-item">
                                @guest

                                    <a href="{{ route('front.course.details', $course->slug) }}">
                                        <img src="{{ Storage::url($course->image ?? '') }}" class="" alt="..."
                                            style="width: 100%; height: 274px; display: block;"></a>
                                @endguest
                                @auth


                                    <a href="{{ route('course.curriculam', $course->id) }}">
                                        <img src="{{ Storage::url($course->image ?? '') }}" class="" alt="..."
                                            style="width: 100%; height: 274px; display: block;"></a>
                                @endauth

                                <div class="course-content">
                                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                                        @guest
                                            <a href="{{ route('register.with.course') }}?course_id={{ $course->id }}"
                                                class="btn btn-primary">Login to Enroll</a>

                                            {{-- <a href="{{ route('register') }}" class="btn btn-primary">Login to Enroll</a> --}}
                                        @else
                                            @if (auth()->user()->hasApprovedCourse($course->id))
                                                <button class="btn btn-success" disabled>Already Enrolled</button>
                                            @else
                                                <!-- If you want to show 'Up Coming' based on course status, you can do something like: -->
                                                @if ($course->status === 'upcoming')
                                                    <button class="btn btn-secondary" disabled>Up Coming</button>
                                                @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                                    <button class="btn btn-info w-100" disabled>Request Pending...</button>
                                                @else
                                                    <!-- Instead of directly purchasing, go to the enroll form -->
                                                    <a href="{{ route('stripe.payment.view', $course->id) }}"
                                                        class="btn btn-primary">Enroll
                                                        Now</a>
                                                @endif
                                            @endif
                                        @endguest
                                        @guest

                                            <a href="{{ route('front.course.details', $course->slug) }}"
                                                class="btn btn-info">More Details</a>
                                        @endguest
                                        @auth
                                            <a href="{{ route('course.curriculam', $course->id) }}" class="btn btn-info">More
                                                Details</a>
                                        @endauth
                                        <!--<p class="category">Enroll Now</p>-->
                                        @guest

                                            <p class="price">${{ $course->price ?? '' }}</p>
                                        @endguest
                                    </div>

                                    @guest

                                        <h3><a
                                                href="{{ route('front.course.details', $course->slug) }}">{{ Str::limit($course->title ?? '', 60) }}</a>
                                        </h3>
                                    @endguest
                                    @auth
                                        <h3><a
                                                href="{{ route('course.curriculam', $course->id) }}">{{ Str::limit($course->title ?? '', 60) }}</a>
                                        </h3>

                                    @endauth
                                    @guest

                                        <p class="description">{!! Str::limit($course->description ?? '', 60) !!}.</p>
                                    @endguest

                                </div>
                            </div>
                        </div> <!-- End Course Item-->
                    @empty
                        <div>No course Found</div>
                    @endforelse


                </div>

                {{ $courses->links('pagination::bootstrap-5') }}
            </div>
        </section><!-- /Courses Section -->

    </main>
@endsection
