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
    <title>CLp Permit</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ Storage::url($setting->site_favicon) }}" rel="icon">
    <!---->
     <link rel="preload" href="{{ asset('frontend/img/whitetruck2.webp') }}" as="image" fetchpriority="high">
    

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
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
     
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    <!-- Plyr CSS (in <head>) -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />




    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        @stack('styles')
        <!-- Meta Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
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
        src="https://www.facebook.com/tr?id=1283452659472097&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Meta Pixel Code -->

</head>

<body class="index-page">
    @if (session('success'))
        <script>
            iziToast.success({
                title: 'Success',
                message: "{{ session('success') }}",
                position: 'topRight'
            });
        </script>
    @endif
    @if (session('status'))
        <script>
            iziToast.success({
                title: 'Success',
                message: "{{ session('status') }}", // use session('status') here
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
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ Storage::url($setting->main_logo) }}" alt="">
                <!--<h1 class="sitename">ClP</h1>-->
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url('/') }}"
                            class="{{ request()->routeIs('front.home') ? 'active' : '' }}">Home<br></a></li>
                    @if ($course)
                        <!--@foreach ($course as $menu)-->
                        <!--    <li>-->
                        <!--        <a href="{{ route('front.course.details', $menu->slug) }}"-->
                        <!--            class="{{ request()->is('Courses-details/' . $menu->slug) ? 'active' : '' }}">-->
                        <!--            {{ $menu->menu_name ?? '' }}-->
                        <!--        </a>-->
                        <!--    </li>-->
                        <!--@endforeach-->
                        @php
                            $customOrder = ['CLP English', 'CLP Arabic', 'CLP Somali', 'CLP French', 'CLP Amharic', 'CLP Nepali'];
                        @endphp

                        @foreach ($customOrder as $name)
                            @foreach ($course as $menu)
                                @if ($menu->menu_name === $name)
                                    <li>
                                        <a href="{{ route('front.course.details', $menu->slug) }}"
                                        class="{{ request()->is('Courses-details/' . $menu->slug) ? 'active' : '' }}">
                                        {{ $menu->menu_name }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endforeach

                    @endif
                    <li><a href="{{ route('front.about_us') }}"
                            class="{{ request()->routeIs('front.about_us') ? 'active' : '' }}">About</a></li>
                    <!--<li><a href="{{ route('front.course') }}"  class="{{ request()->routeIs('front.course') ? 'active' : '' }}">Courses</a></li>-->

                    {{-- <li><a href="trainers.html">Trainers</a></li>
                    <li><a href="events.html">Events</a></li>
                    <li><a href="pricing.html">Pricing</a></li>
                    <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Deep Dropdown 1</a></li>
                                    <li><a href="#">Deep Dropdown 2</a></li>
                                    <li><a href="#">Deep Dropdown 3</a></li>
                                    <li><a href="#">Deep Dropdown 4</a></li>
                                    <li><a href="#">Deep Dropdown 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li> --}}


                    <li><a href="{{ route('front.contact_us') }}"
                            class="{{ request()->routeIs('front.contact_us') ? 'active' : '' }}">Contact</a></li>
                    @auth
                        <li class="dropdown"><a href="#"
                                class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}"><span>{{ $user->name ?? '' }}</span>
                                <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="{{ route('profile.edit') }}">Profile </a></li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
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

            @auth
            @else
                <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
            @endauth

        </div>
    </header>
