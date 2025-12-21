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
        @media (min-width: 1200px) {
            .header .logo {
                margin-right: 0 !important;
            }
            .navmenu {
                flex-grow: 1;
                display: flex;
                justify-content: center;
            }
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

                    {{-- Canada → USA --}}
                    @php
                        $canadaCourse = App\Models\Course::find(15);
                    @endphp
                    @if($canadaCourse)
                    <li><a href="{{ route('front.course.details', $canadaCourse->slug) }}"
                           class="{{ request()->is('courses-details/' . $canadaCourse->slug) ? 'active' : '' }}">Canada → USA</a></li>
                    @endif

                    {{-- Europe → USA --}}
                    @php
                        $europeCourse = App\Models\Course::find(16);
                    @endphp
                    @if($europeCourse)
                    <li><a href="{{ route('front.course.details', $europeCourse->slug) }}"
                           class="{{ request()->is('courses-details/' . $europeCourse->slug) ? 'active' : '' }}">Europe → USA</a></li>
                    @endif

                    {{-- World → USA --}}
                    @php
                        $globalCourse = App\Models\Course::find(17);
                    @endphp
                    @if($globalCourse)
                    <li><a href="{{ route('front.course.details', $globalCourse->slug) }}"
                           class="{{ request()->is('courses-details/' . $globalCourse->slug) ? 'active' : '' }}">World → USA</a></li>
                    @endif

                    {{-- CLP CDL Grant --}}
                    @php
                        $freeClpCourse = App\Models\Course::where('course_type', 'language_selector')
                            ->where('status', 'active')
                            ->where('is_active', 1)
                            ->first();
                    @endphp
                    @if ($freeClpCourse)
                        <li><a href="{{ route('front.course.details', $freeClpCourse->slug) }}"
                               class="{{ request()->is('courses-details/' . $freeClpCourse->slug) ? 'active' : '' }}">CLP CDL Grant</a></li>
                    @endif

                    {{-- Dispatcher --}}
                    @php
                        $dispatcherCourse = App\Models\Course::find(19);
                    @endphp
                    @if($dispatcherCourse)
                    <li><a href="{{ route('front.course.details', $dispatcherCourse->slug) }}"
                           class="{{ request()->is('courses-details/' . $dispatcherCourse->slug) ? 'active' : '' }}">Dispatcher</a></li>
                    @endif

                    {{-- Blog --}}
                    <li><a href="{{ route('front.blog.index') }}" class="{{ request()->routeIs('front.blog.*') ? 'active' : '' }}">Blog</a></li>

                    {{-- How It Works & Why Us Combined Dropdown --}}
                    <li class="dropdown">
                        <a href="#"><span>About</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ route('front.how_it_works') }}" class="{{ request()->routeIs('front.how_it_works') ? 'active' : '' }}">How It Works</a></li>
                            <li><a href="{{ route('front.about_us') }}" class="{{ request()->routeIs('front.about_us') ? 'active' : '' }}">Why Us</a></li>
                        </ul>
                    </li>

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
                <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
            @endguest

        </div>
    </header>
