@extends('new-design.partials.master')

@push('styles')
@if(config('recaptcha.site_key'))
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif
@endpush

@section('main')
<main>
    <!-- Page Title -->
    <section class="relative py-16 bg-[#0A2342] text-white overflow-hidden">
        <div class="container mx-auto px-4 text-center">
            <h1 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-tighter mb-4">Contact</h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                Your Road to Success Begins Here! Take the first step toward your trucking career.
            </p>
        </div>
    </section>

    <!-- Map -->
    <div class="w-full">
        <iframe style="border:0; width: 100%; height: 300px;"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11967.737352649469!2d-82.9987942!3d39.9611755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88388f3b93db6a9b%3A0x18c340da05d4a70e!2sColumbus%2C%20OH%2C%20USA!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus"
            frameborder="0" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">

                <!-- Contact Info -->
                <div class="bg-[#0A2342] text-white p-10 md:w-2/5 flex flex-col justify-between">
                    <div>
                        <h2 class="font-heading text-3xl font-bold uppercase mb-6">Get in Touch</h2>
                        <p class="text-gray-300 mb-8 leading-relaxed">
                            Have questions about the program? We're here to help you navigate your trucking journey.
                        </p>

                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <i data-lucide="map-pin" class="h-6 w-6 text-[#F5B82E] mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-lg">Address</h4>
                                    <p class="text-gray-300">{{ $setting->address ?? 'Columbus, Ohio, USA' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <i data-lucide="phone" class="h-6 w-6 text-[#F5B82E] mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-lg">Call Us</h4>
                                    <p class="text-gray-300">{{ $setting->contact_phone ?? '1-669-204-5626' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <i data-lucide="mail" class="h-6 w-6 text-[#F5B82E] mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-lg">Email Us</h4>
                                    <p class="text-gray-300">{{ $setting->contact_email ?? 'info@usatruckpath.com' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h4 class="font-bold text-lg mb-4">Follow Us</h4>
                        <div class="flex gap-4">
                            @if($setting && $setting->facebook_url)
                                <a href="{{ $setting->facebook_url }}" target="_blank" class="bg-white/10 p-2 rounded hover:bg-[#F5B82E] hover:text-[#0A2342] transition-colors">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                            @endif
                            @if($setting && $setting->youtube_url)
                                <a href="{{ $setting->youtube_url }}" target="_blank" class="bg-white/10 p-2 rounded hover:bg-[#F5B82E] hover:text-[#0A2342] transition-colors">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                </a>
                            @endif
                            @if($setting && $setting->telegram_url)
                                <a href="{{ $setting->telegram_url }}" target="_blank" class="bg-white/10 p-2 rounded hover:bg-[#F5B82E] hover:text-[#0A2342] transition-colors">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="p-10 md:w-3/5">
                    <form action="{{ route('front.contact.send') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Your Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('name') border-red-500 @enderror" placeholder="John Doe">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('email') border-red-500 @enderror" placeholder="john@example.com">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subject -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Subject <span class="text-red-500">*</span></label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('subject') border-red-500 @enderror" placeholder="How can we help?">
                            @error('subject')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Message <span class="text-red-500">*</span></label>
                            <textarea rows="5" name="message" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('message') border-red-500 @enderror" placeholder="Your message...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- reCAPTCHA -->
                        @if(config('recaptcha.site_key'))
                        <div>
                            <div class="g-recaptcha" data-sitekey="{{ config('recaptcha.site_key') }}"></div>
                            @error('g-recaptcha-response')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif

                        <button type="submit" class="w-full bg-[#1B75F0] hover:bg-[#0A2342] text-white font-bold uppercase tracking-wide py-4 rounded-lg shadow-lg transition-all transform hover:-translate-y-1">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
