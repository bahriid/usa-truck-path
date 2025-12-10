<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $setting = App\Models\SiteSetting::first();
    $user = Auth::user();
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $setting->site_title ?? 'USATruckPath' }} - Become a U.S. Truck Driver</title>
    <meta name="description" content="{{ $setting->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $setting->meta_keywords ?? '' }}">

    <!-- Favicon -->
    @if($setting && $setting->site_favicon)
        <link href="{{ Storage::url($setting->site_favicon) }}" rel="icon">
    @endif

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Toast Notifications -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Oswald', 'sans-serif'],
                    },
                    colors: {
                        navy: '#0A2342',
                        brightBlue: '#1B75F0',
                        gold: '#F5B82E',
                        lightGray: '#F2F4F7',
                        darkGray: '#3A3A3A',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #3A3A3A;
        }
        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: 'Oswald', sans-serif;
        }
        .btn-cta {
            transition: all 0.3s ease;
        }
        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>

    @stack('styles')

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

<body class="bg-white selection:bg-[#F5B82E] selection:text-[#0A2342]">

    {{-- Toast Notifications --}}
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

    <!-- Header -->
    <header class="sticky top-0 z-50 w-full bg-[#0A2342] text-white shadow-md">
        <div class="container mx-auto px-4 flex h-20 items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-2 font-heading text-2xl font-bold uppercase tracking-tighter text-white hover:text-[#F5B82E] transition-colors">
                @if($setting && $setting->main_logo)
                    <img src="{{ Storage::url($setting->main_logo) }}" alt="Logo" class="h-12">
                @else
                    <i data-lucide="truck" class="h-8 w-8 text-[#F5B82E]"></i>
                    <span>USATruckPath</span>
                @endif
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center gap-6">
                <a href="{{ url('/') }}" class="text-sm font-bold uppercase tracking-wide text-white hover:text-[#F5B82E] transition-all {{ request()->routeIs('front.home') ? 'text-[#F5B82E]' : '' }}">Home</a>

                {{-- Canada → USA --}}
                @php $canadaCourse = App\Models\Course::find(15); @endphp
                @if($canadaCourse)
                    <a href="{{ route('front.course.details', $canadaCourse->slug) }}" class="text-sm font-bold uppercase tracking-wide text-white hover:text-[#F5B82E] transition-all {{ request()->is('courses-details/' . $canadaCourse->slug) ? 'text-[#F5B82E]' : '' }}">Canada → USA</a>
                @endif

                {{-- Europe → USA --}}
                @php $europeCourse = App\Models\Course::find(16); @endphp
                @if($europeCourse)
                    <a href="{{ route('front.course.details', $europeCourse->slug) }}" class="text-sm font-bold uppercase tracking-wide text-white hover:text-[#F5B82E] transition-all {{ request()->is('courses-details/' . $europeCourse->slug) ? 'text-[#F5B82E]' : '' }}">Europe → USA</a>
                @endif

                {{-- World → USA --}}
                @php $globalCourse = App\Models\Course::find(17); @endphp
                @if($globalCourse)
                    <a href="{{ route('front.course.details', $globalCourse->slug) }}" class="text-sm font-bold uppercase tracking-wide text-white hover:text-[#F5B82E] transition-all {{ request()->is('courses-details/' . $globalCourse->slug) ? 'text-[#F5B82E]' : '' }}">World → USA</a>
                @endif

                {{-- CLP CDL Grant --}}
                @php
                    $freeClpCourse = App\Models\Course::where('course_type', 'language_selector')
                        ->where('status', 'active')
                        ->where('is_active', 1)
                        ->first();
                @endphp
                @if ($freeClpCourse)
                    <a href="{{ route('front.course.details', $freeClpCourse->slug) }}" class="text-sm font-bold uppercase tracking-wide text-white hover:text-[#F5B82E] transition-all {{ request()->is('courses-details/' . $freeClpCourse->slug) ? 'text-[#F5B82E]' : '' }}">CLP CDL Grant</a>
                @endif

                {{-- Dispatcher --}}
                @php $dispatcherCourse = App\Models\Course::find(19); @endphp
                @if($dispatcherCourse)
                    <a href="{{ route('front.course.details', $dispatcherCourse->slug) }}" class="text-sm font-bold uppercase tracking-wide text-white hover:text-[#F5B82E] transition-all {{ request()->is('courses-details/' . $dispatcherCourse->slug) ? 'text-[#F5B82E]' : '' }}">Dispatcher</a>
                @endif

                {{-- About Dropdown --}}
                <div class="relative group">
                    <button class="text-sm font-bold uppercase tracking-wide text-white hover:text-[#F5B82E] transition-all flex items-center gap-1">
                        About <i data-lucide="chevron-down" class="h-4 w-4"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-48 bg-[#0A2342] border border-[#1B75F0] rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="{{ route('front.how_it_works') }}" class="block px-4 py-3 text-sm text-white hover:bg-[#1B75F0] hover:text-white transition-colors {{ request()->routeIs('front.how_it_works') ? 'bg-[#1B75F0]' : '' }}">How It Works</a>
                        <a href="{{ route('front.about_us') }}" class="block px-4 py-3 text-sm text-white hover:bg-[#1B75F0] hover:text-white transition-colors {{ request()->routeIs('front.about_us') ? 'bg-[#1B75F0]' : '' }}">Why Us</a>
                    </div>
                </div>

                {{-- User Menu --}}
                @auth
                    <div class="relative group">
                        <button class="text-sm font-bold uppercase tracking-wide text-white hover:text-[#F5B82E] transition-all flex items-center gap-1">
                            {{ $user->name ?? '' }} <i data-lucide="chevron-down" class="h-4 w-4"></i>
                        </button>
                        <div class="absolute top-full right-0 mt-2 w-48 bg-[#0A2342] border border-[#1B75F0] rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm text-white hover:bg-[#1B75F0] hover:text-white transition-colors">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-white hover:bg-[#1B75F0] hover:text-white transition-colors">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-[#F5B82E] text-[#0A2342] hover:bg-[#F5B82E]/90 h-10 px-6 rounded font-medium transition-colors flex items-center">
                        Login
                    </a>
                @endauth
            </nav>

            <!-- Mobile Menu Button -->
            <button class="lg:hidden text-white hover:bg-white/10 p-2 rounded" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                <i data-lucide="menu" class="h-6 w-6"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-[#0A2342] border-t border-[#1B75F0] p-4 absolute w-full">
            <nav class="flex flex-col gap-4">
                <a href="{{ url('/') }}" class="text-lg font-bold uppercase tracking-wide text-white hover:text-[#F5B82E]">Home</a>

                @if($canadaCourse ?? false)
                    <a href="{{ route('front.course.details', $canadaCourse->slug) }}" class="text-lg font-bold uppercase tracking-wide text-white hover:text-[#F5B82E]">Canada → USA</a>
                @endif

                @if($europeCourse ?? false)
                    <a href="{{ route('front.course.details', $europeCourse->slug) }}" class="text-lg font-bold uppercase tracking-wide text-white hover:text-[#F5B82E]">Europe → USA</a>
                @endif

                @if($globalCourse ?? false)
                    <a href="{{ route('front.course.details', $globalCourse->slug) }}" class="text-lg font-bold uppercase tracking-wide text-white hover:text-[#F5B82E]">World → USA</a>
                @endif

                @if($freeClpCourse ?? false)
                    <a href="{{ route('front.course.details', $freeClpCourse->slug) }}" class="text-lg font-bold uppercase tracking-wide text-white hover:text-[#F5B82E]">CLP CDL Grant</a>
                @endif

                @if($dispatcherCourse ?? false)
                    <a href="{{ route('front.course.details', $dispatcherCourse->slug) }}" class="text-lg font-bold uppercase tracking-wide text-white hover:text-[#F5B82E]">Dispatcher</a>
                @endif

                <a href="{{ route('front.how_it_works') }}" class="text-lg font-bold uppercase tracking-wide text-white hover:text-[#F5B82E]">How It Works</a>
                <a href="{{ route('front.about_us') }}" class="text-lg font-bold uppercase tracking-wide text-white hover:text-[#F5B82E]">Why Us</a>

                @auth
                    <a href="{{ route('profile.edit') }}" class="text-lg font-bold uppercase tracking-wide text-white hover:text-[#F5B82E]">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-lg font-bold uppercase tracking-wide text-white hover:text-[#F5B82E]">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-[#F5B82E] text-[#0A2342] hover:bg-[#F5B82E]/90 w-full py-3 rounded font-medium mt-2 text-center">
                        Login
                    </a>
                @endauth
            </nav>
        </div>
    </header>
