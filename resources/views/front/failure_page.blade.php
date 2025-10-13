@extends('partials.master')  
@section('main')
    <div class="container py-5">
        <div class="alert alert-danger" role="alert">
            <h2 class="alert-heading">Payment Failed</h2>
            <p>{{ $error ?? 'An error occurred during payment processing.' }}</p>
            <p>Please try again, or contact our support team if the problem persists.</p>
             
        </div>
    </div>
@endsection