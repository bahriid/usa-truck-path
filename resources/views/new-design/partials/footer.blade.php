    <!-- Footer -->
    <footer class="bg-[#0A2342] text-white pt-20 pb-10 border-t-4 border-[#F5B82E]">
        @php
            $setting = App\Models\SiteSetting::first();
        @endphp

        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <!-- Brand Column -->
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 font-heading text-2xl font-bold uppercase tracking-tighter mb-6">
                        @if($setting && $setting->main_logo)
                            <img src="{{ Storage::url($setting->main_logo) }}" alt="Logo" class="h-12">
                        @else
                            <i data-lucide="truck" class="h-8 w-8 text-[#F5B82E]"></i>
                            <span>USATruckPath</span>
                        @endif
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed mb-6">
                        Helping people outside the USA understand how to become truck drivers in the United States. From Canada to your first mile on American roads.
                    </p>
                    <!-- Social Links -->
                    <div class="flex gap-4">
                        @if($setting && $setting->facebook_url)
                            <a href="{{ $setting->facebook_url }}" target="_blank" class="text-gray-300 hover:text-[#F5B82E] transition-colors">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        @endif
                        @if($setting && $setting->tiktok_url)
                            <a href="{{ $setting->tiktok_url }}" target="_blank" class="text-gray-300 hover:text-[#F5B82E] transition-colors">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                            </a>
                        @endif
                        @if($setting && $setting->youtube_url)
                            <a href="{{ $setting->youtube_url }}" target="_blank" class="text-gray-300 hover:text-[#F5B82E] transition-colors">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                        @endif
                        @if($setting && $setting->telegram_url)
                            <a href="{{ $setting->telegram_url }}" target="_blank" class="text-gray-300 hover:text-[#F5B82E] transition-colors">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- PROGRAMS -->
                <div class="col-span-1">
                    <h4 class="font-heading text-lg font-bold uppercase mb-6 text-[#F5B82E] tracking-wide">Programs</h4>
                    <ul class="space-y-4">
                        @php
                            $freeClpCourse = App\Models\Course::where('course_type', 'language_selector')
                                ->where('status', 'active')
                                ->where('is_active', 1)
                                ->first();
                        @endphp
                        @if($freeClpCourse)
                            <li><a href="{{ route('front.course.details', $freeClpCourse->slug) }}" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all inline-block">Free CLP Course</a></li>
                        @endif
                        <li><a href="{{ route('front.course') }}" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all inline-block">All Courses</a></li>
                    </ul>
                </div>

                <!-- SUPPORT -->
                <div class="col-span-1">
                    <h4 class="font-heading text-lg font-bold uppercase mb-6 text-[#F5B82E] tracking-wide">Support</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('front.contact_us') }}" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all inline-block">Contact Us</a></li>
                        <li><a href="{{ route('front.privacy_policy') }}" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all inline-block">Privacy Policy</a></li>
                        <li><a href="{{ route('front.terms_condition') }}" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all inline-block">Terms & Conditions</a></li>
                    </ul>
                </div>

                <!-- LEARN -->
                <div class="col-span-1">
                    <h4 class="font-heading text-lg font-bold uppercase mb-6 text-[#F5B82E] tracking-wide">Learn</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('front.how_it_works') }}" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all inline-block">How It Works</a></li>
                        <li><a href="{{ route('front.about_us') }}" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all inline-block">Why Choose Us</a></li>
                    </ul>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="border-t border-white/10 pt-8 mb-8">
                <div class="flex flex-wrap justify-center gap-8 text-gray-300 text-sm">
                    <div class="flex items-center gap-2">
                        <i data-lucide="map-pin" class="h-4 w-4 text-[#F5B82E]"></i>
                        <span>Columbus, Ohio, USA</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="phone" class="h-4 w-4 text-[#F5B82E]"></i>
                        <span>{{ $setting->contact_phone ?? '1-669-204-5626' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="mail" class="h-4 w-4 text-[#F5B82E]"></i>
                        <a href="mailto:{{ $setting->contact_email ?? 'info@usatruckpath.com' }}" class="hover:text-[#F5B82E] transition-colors">
                            {{ $setting->contact_email ?? 'info@usatruckpath.com' }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="pt-8 border-t border-white/10 text-center">
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} USATruckPath. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Initialize Lucide icons -->
    <script>
        lucide.createIcons();
    </script>

    @stack('scripts')
</body>
</html>
