@extends('partials.master')

@section('main')
    <div class="container py-5">
        <h2>Enroll in {{ $course->title }}</h2>
        {{-- @if (session('success'))
        @session('success')
        <div class="alert alert-danger">{{session('success')}}</div>
            
        @endsession
            
        @endif --}}

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Course Details</h5>
                        <div class="card-text">
                            <strong>Title:</strong> {{ $course->title }}<br>
                            {{-- <strong>Description:</strong> {{$course->description ?? 'No description available.' }}<br> --}}
                            <strong>Description:</strong> {!! $course->description ?? 'No description available.' !!}<br>

                            <strong>Price:</strong>
                            @if($course->original_price)
                                <span style="text-decoration: line-through; color: #999; margin-right: 8px;">${{ $course->original_price }}</span>
                                <span style="color: #28a745; font-weight: bold; font-size: 1.2em;">${{ $course->price }}</span>
                            @else
                                ${{ $course->price }}
                            @endif
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Enrollment</h5>
                        <p class="card-text">Complete your enrollment by proceeding to secure payment.</p>

                        <div class="mt-4">
                            <h5>Payment Information</h5>
                            <p class="text-muted">You will be redirected to a secure payment page.</p>
                            <div class="border rounded p-3 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-credit-card-fill text-primary me-2" style="font-size: 1.5rem;"></i>
                                    <span>Secure Payment</span>
                                </div>
                                
                            </div>
                            <form action="{{ route('stripe.checkout') }}" method="POST">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <input type="hidden" name="price" value="{{ $course->price }}">
                                <button type="submit" class="btn btn-primary w-100">
                                    Checkout with Stripe
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .stripe-logo {
        height: 30px;
    }
</style>
