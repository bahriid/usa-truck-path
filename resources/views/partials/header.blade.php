<!DOCTYPE html>
<html lang="en">
@php
    $setting = App\Models\SiteSetting::first();
    $course = App\Models\Course::latest()->take(6)->get();
    $user = Auth::user();
@endphp

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $setting->site_title ?? 'CDL Permit' }}</title>
    <meta name="description" content="{{ $setting->meta_description ?? '' }}"> 
    <meta name="keywords" content="{{ $setting->meta_keywords ?? '' }}">

    <!-- Favicons -->
    <link href="{{ Storage::url($setting->site_favicon) }}" rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Poppins:wght@300;400;500;600;700;900&family=Raleway:wght@300;400;500;600;700;900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link rel="preload" href="{{ asset('frontend/css/main.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}"></noscript>

    <!-- Toast & Player -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />

    <!-- Carousel & Swiper -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    @stack('styles')
    
    <style>
        .header .logo img {
            max-height: 55px;
            margin-right: 15px;
        }
    </style>

    <!-- Meta Pixel -->
    <script>
        !function(f,b,e,v,n,t,s){
            if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1283452659472097');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1283452659472097&ev=PageView&noscript=1" /></noscript>
</head>

<body class="index-page">

    {{-- Notifications --}}
    @if (session('success'))
        <script>
            iziToast.success({
                title: 'Success',
                message: "{{ session('success') }}",
                position: 'topRight'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            iziToast.error({
                title: 'Error',
                message: "{{ session('error') }}",
                position: 'topRight'
            });
        </script>
    @endif

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
                <img src="{{ Storage::url($setting->main_logo) }}" alt="logo">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url('/') }}" class="{{ request()->routeIs('front.home') ? 'active' : '' }}">Home</a></li>

                    {{-- CDL Permit Dropdown (Languages) --}}
                    @if ($course && $course->count())
                        <li class="dropdown">
                            <a href="#"><span>CDL Permit</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                @foreach ($course as $menu)
                                    <li>
                                        <a href="{{ route('front.course.details', $menu->slug) }}"
                                           class="{{ request()->is('Courses-details/' . $menu->slug) ? 'active' : '' }}">
                                           {{ $menu->menu_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif

                    {{-- New Placeholder Categories --}}
                    <li><a href="{{ route('front.course.details', 'cdl-canada') }}"
                           class="{{ request()->is('courses-details/cdl-canada') ? 'active' : '' }}">CDL Canada</a></li>
                    <li><a href="{{ route('front.course.details', 'cdl-europe') }}"
                           class="{{ request()->is('courses-details/cdl-europe') ? 'active' : '' }}">CDL Europe</a></li>
                    <li><a href="{{ route('front.course.details', 'cdl-global') }}"
                           class="{{ request()->is('courses-details/cdl-global') ? 'active' : '' }}">CDL Permit (Global)</a></li>

                    <li><a href="{{ route('front.about_us') }}" class="{{ request()->routeIs('front.about_us') ? 'active' : '' }}">Why Choose us</a></li>
                    <li><a href="{{ route('front.how_it_works') }}" class="{{ request()->routeIs('front.how_it_works') ? 'active' : '' }}">How It Works </a></li>
                    <li><a href="{{ route('front.contact_us') }}" class="{{ request()->routeIs('front.contact_us') ? 'active' : '' }}">Contact</a></li>

                    {{-- User Menu --}}
                    @auth
                        <li class="dropdown">
                            <a href="#"><span>{{ $user->name ?? '' }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                            Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            @guest
                <a class="btn-getstarted" href="{{ route('login') }}">Register</a>
            @endguest

        </div>
    </header>
