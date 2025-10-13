@extends('partials.master')

@section('main')
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Row with two columns of equal height -->
            <div class="row g-4 align-items-stretch">
                <!-- Left Column: Update Profile Info -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="h-100 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <!-- Right Column: Update Password -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="h-100 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enrolled Courses Section -->
         <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="container">
                        <h2 class="mt-2 mb-4"><strong >My Courses</strong></h2>
                        <div class="row">
                            @forelse ($courses as $course)
                                @php
                                    // Use pivot status if available, else fall back to course status
                                    $enrollmentStatus = $course->pivot->status ?? ucfirst($course->status);
                                @endphp
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <!-- When clicking the image, redirect to the course detail page using its slug -->
                                        <a href="{{ route('front.course.details', $course->slug) }}">
                                            <img src="{{ Storage::url($course->image) }}" 
                                                 class="card-img-top" 
                                                 style="height:200px;" 
                                                 alt="{{ $course->title }}">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ Str::limit($course->title, 20) }}</h5>
                                            <p class="card-text">
                                                <strong><i class="bi bi-check-circle"></i> Enrollment:</strong>  
                                                {{ $enrollmentStatus }}<br>
                                                <strong><i class="bi bi-cash"></i> Price:</strong> 
                                                ${{ $course->price }}<br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p>You haven't enrolled in any courses yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
</x-app-layout>
@endsection
