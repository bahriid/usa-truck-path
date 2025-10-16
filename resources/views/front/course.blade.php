﻿@extends('partials.master')

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
                                <a href="{{ route('front.course.category', $course->category) }}">
                                    <img src="{{ Storage::url($course->image ?? '') }}" class="" alt="..."
                                        style="width: 100%; height: 274px; display: block;"></a>
                                <div class="course-content">
                                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                                        <a href="{{ route('front.course.category', $course->category) }}"
                                            class="btn btn-info">More Details</a>
                                        <p class="price">${{ $course->price ?? '' }}</p>
                                    </div>

                                    <h3><a
                                            href="{{ route('front.course.category', $course->category) }}">{{ Str::limit($course->title ?? '', 60) }}</a>
                                    </h3>
                                    <p class="description">{{ Str::limit(strip_tags($course->description ?? ''), 152, '...') }}</p>

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
