@extends('partials.master')

@section('main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-danger text-white text-center py-4">
                    <i class="fas fa-exclamation-triangle fa-4x animate__animated animate__shakeX"></i>
                    <h2 class="mt-3 mb-0">Payment Failed</h2>
                </div>
                <div class="card-body px-5 text-center">
                    <h3 class="text-danger mb-4">Oops! Something Went Wrong</h3>
                    
                    <div class="alert alert-danger bg-light-danger border-danger">
                        <h5 class="mb-3">⚠️ We couldn't process your payment</h5>
                        <p class="mb-0">Please check your payment details and try again</p>
                    </div>

                    <div class="mt-4">
                        <p class="lead">Need help? We're here for you!</p>
                        <div class="support-contacts mt-3">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-phone-alt text-danger me-2"></i>
                                    Meriam: (612) 445-7573
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-phone-alt text-danger me-2"></i>
                                    Srijana: (614) 324-9482
                                </li>
                                <li>
                                    <i class="fas fa-phone-alt text-danger me-2"></i>
                                    Ikran: (614) 930-6050
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="d-grid gap-2 col-md-8 mx-auto mt-5">
                        <a href="{{ route('front.course.details', $course->slug) }}" 
                           class="btn btn-danger btn-lg py-3">
                            <i class="fas fa-redo-alt me-2"></i>Try Payment Again
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .support-contacts li {
        transition: transform 0.3s ease;
    }
    .support-contacts li:hover {
        transform: translateX(10px);
    }
</style>
@endsection