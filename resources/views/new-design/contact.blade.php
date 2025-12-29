@extends('new-design.partials.master')

@push('styles')
@if(config('recaptcha.site_key'))
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif
@endpush

@section('main')
<main>
    <section class="py-20 bg-gray-50 min-h-screen flex items-center">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">

                <!-- Contact Info -->
                <div class="bg-[#0A2342] text-white p-10 md:w-2/5 flex flex-col justify-between">
                    <div>
                        <h2 class="font-heading text-3xl font-bold uppercase mb-6">Get in Touch</h2>
                        <p class="text-gray-300 mb-8 leading-relaxed">
                            Have questions about the program? We're here to help you navigate your trucking journey.
                        </p>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <i data-lucide="mail" class="h-6 w-6 text-[#F5B82E] mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-lg">Email</h4>
                                    <p class="text-gray-300">{{ $setting->contact_email ?? 'support@usatruckpath.com' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <i data-lucide="message-circle" class="h-6 w-6 text-[#F5B82E] mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-lg">Live Chat</h4>
                                    <p class="text-gray-300">Available Mon-Fri, 9am-5pm EST</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h4 class="font-bold text-lg mb-4">Follow Us</h4>
                        <div class="flex gap-4">
                            @if($setting && $setting->facebook_url)
                                <a href="{{ $setting->facebook_url }}" target="_blank" class="bg-white/10 p-2 rounded hover:bg-[#F5B82E] hover:text-[#0A2342] transition-colors">
                                    <i data-lucide="facebook" class="h-5 w-5"></i>
                                </a>
                            @else
                                <a href="#" class="bg-white/10 p-2 rounded hover:bg-[#F5B82E] hover:text-[#0A2342] transition-colors">
                                    <i data-lucide="facebook" class="h-5 w-5"></i>
                                </a>
                            @endif
                            <a href="#" class="bg-white/10 p-2 rounded hover:bg-[#F5B82E] hover:text-[#0A2342] transition-colors">
                                <i data-lucide="twitter" class="h-5 w-5"></i>
                            </a>
                            <a href="#" class="bg-white/10 p-2 rounded hover:bg-[#F5B82E] hover:text-[#0A2342] transition-colors">
                                <i data-lucide="instagram" class="h-5 w-5"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="p-10 md:w-3/5">
                    <form action="{{ route('front.contact.send') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">First Name</label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('first_name') border-red-500 @enderror" placeholder="John">
                                @error('first_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Last Name</label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('last_name') border-red-500 @enderror" placeholder="Doe">
                                @error('last_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('email') border-red-500 @enderror" placeholder="john@example.com">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Message</label>
                            <textarea rows="4" name="message" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('message') border-red-500 @enderror" placeholder="How can we help you?">{{ old('message') }}</textarea>
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
