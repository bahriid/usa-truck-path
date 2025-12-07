@extends('partials.master')

@push('styles')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Contact</h1>
              <p class="mb-0"> Your Road to Success Begins Here!
Take the first step toward your trucking career. Get your CLP, train with experts, and hit the road with confidence.</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="current">Contact</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

    <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
      <iframe style="border:0; width: 100%; height: 300px;" 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11967.737352649469!2d-82.9987942!3d39.9611755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88388f3b93db6a9b%3A0x18c340da05d4a70e!2sColumbus%2C%20OH%2C%20USA!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus" 
        frameborder="0" allowfullscreen="" loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p>{{$setting->address??''}}</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>{{$setting->contact_phone??''}}</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                 <p>{{$setting->contact_email??''}}</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
        <form action="{{ route('front.contact.send') }}" method="POST" class="php-email-form">
            @csrf
            <div class="row gy-4">
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    @error('name')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                       @error('email')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                       @error('subject')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                       @error('message')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                @if(config('recaptcha.site_key'))
                <div class="col-md-12">
                    <div class="g-recaptcha" data-sitekey="{{ config('recaptcha.site_key') }}"></div>
                    @error('g-recaptcha-response')
                    <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
                @endif
                <div class="col-md-12 text-center">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                    <button type="submit">Send Message</button>
                </div>
            </div>
        </form>

          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

@endsection