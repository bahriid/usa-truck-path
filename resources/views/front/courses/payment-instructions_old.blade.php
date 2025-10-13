@extends('partials.master')

@section('main')
@php
    $setting = App\Models\SiteSetting::first();
@endphp
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Payment Instructions</h3>
                </div>
                <div class="card-body">
                    <h4 class="text-center mb-4">Thank you for registering with PassYourPermit!</h4>
                    
                    <p class="lead">
                        To access the full Commercial Learner’s Permit (CLP) Test course 
                        <strong>{{ $course->title }}</strong>, please send your payment of 
                        <strong>${{ $course->price }}</strong> via Zelle to:
                    </p>
                    
                    <div class="bg-light p-3 rounded mb-4">
                        <p class="mb-1"><strong>Zelle:</strong> {{ $setting->zelle }}</p>
                        {{-- If needed, uncomment below to display Cash App information --}}
                        <p class="mb-0"><strong>Cash App:</strong> {{ $setting->cash_app }}</p>
                    </div>
                    
                    <p class="lead">
                        If you have any questions, please contact:
                    </p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone-alt mr-2"></i> Meriam(English,  Arabic and French)-(612)445-7573</li>
                        <li><i class="fas fa-phone-alt mr-2"></i> Srijana(English,  Nepali and Hindi)-(614)-324-9482</li>
                        <li><i class="fas fa-phone-alt mr-2"></i> Ikran(English,  somali and swahili)-(614) 930-6050</li>
                    </ul>
                    <p class="text-center font-italic">We’re here to help!</p>
                </div>
                <div class="card-footer text-center bg-white border-0">
                    <a href="{{ route('front.course.details', $course->slug) }}" class="btn btn-primary btn-lg">OK</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
