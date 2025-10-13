@extends('partials.master')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Privacy Policy</h1>
              <p class="mb-0"></p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="{{url()->current()}}">Privacy Policy</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

        <section id="courses" class="courses section">

            <div class="container">

                <div class="row mb-3">
     {!!$terms->privacy_policy?? ''!!}
       </div>
       </div>

    </section>
    
    </main>
    
    @endsection