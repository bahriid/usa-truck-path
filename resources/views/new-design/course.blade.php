@extends('new-design.partials.master')

@section('main')
<main>
    <!-- Hero Section -->
    <section class="relative py-24 bg-[#0A2342] text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-truck-highway.png') }}" alt="Truck on highway" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-b from-[#0A2342]/90 to-[#0A2342]/70"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="font-heading text-4xl md:text-6xl font-bold uppercase tracking-tighter mb-6">
                Start Your <span class="text-[#F5B82E] block mt-2">Free Trucking Courses</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto mb-10 leading-relaxed">
                Learn the basics, understand the process, and begin your path to becoming a U.S. truck driver.
            </p>
            <a href="#courses" class="btn-cta bg-[#F5B82E] text-[#0A2342] hover:bg-[#F5B82E]/90 h-14 px-10 text-lg font-bold uppercase tracking-wide shadow-lg hover:shadow-[#F5B82E]/20 transition-all transform hover:-translate-y-1 rounded inline-flex items-center justify-center">
                Start My First Course
            </a>
        </div>
    </section>

    <!-- Courses Grid -->
    <section id="courses" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($courses as $course)
                    <div class="bg-white rounded-xl border-none shadow-lg hover:shadow-xl transition-all duration-300 group overflow-hidden flex flex-col h-full">
                        <div class="h-2 bg-[#1B75F0] group-hover:bg-[#F5B82E] transition-colors"></div>
                        <div class="p-6 pb-4">
                            <div class="flex justify-between items-start mb-4">
                                @php
                                    $emojis = ['🇨🇦', '🇪🇺', '🌍', '📝', '🚛', '🚚', '📋', '🛣️'];
                                    $emoji = $emojis[$loop->index % count($emojis)];
                                @endphp
                                <span class="text-4xl">{{ $emoji }}</span>
                                @if(in_array($course->course_type ?? 'paid', ['tier', 'language_selector']))
                                    <span class="bg-[#0A2342] text-white text-xs font-semibold px-2.5 py-0.5 rounded hover:bg-[#0A2342]">FREE COURSE</span>
                                @else
                                    <span class="bg-[#1B75F0] text-white text-xs font-semibold px-2.5 py-0.5 rounded">${{ $course->price }}</span>
                                @endif
                            </div>
                            <h3 class="font-heading text-2xl font-bold text-[#0A2342] leading-tight min-h-[64px]">
                                {{ Str::limit($course->title ?? '', 60) }}
                            </h3>
                        </div>
                        <div class="p-6 pt-0 flex-grow">
                            <p class="text-gray-600 leading-relaxed mb-6">
                                {{ Str::limit(strip_tags($course->description ?? ''), 180, '...') }}
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <span class="text-xs font-semibold bg-blue-50 text-[#1B75F0] px-2 py-1 rounded">Visa Guide</span>
                                <span class="text-xs font-semibold bg-blue-50 text-[#1B75F0] px-2 py-1 rounded">Hiring Companies</span>
                                <span class="text-xs font-semibold bg-blue-50 text-[#1B75F0] px-2 py-1 rounded">Step-by-Step</span>
                            </div>
                        </div>
                        <div class="p-6 pt-0 mt-auto">
                            <a href="{{ route('front.course.details', $course->slug) }}" class="block w-full bg-[#1B75F0] hover:bg-[#0A2342] text-white font-bold uppercase tracking-wide transition-colors group-hover:shadow-md py-2 rounded text-center">
                                @if(in_array($course->course_type ?? 'paid', ['tier', 'language_selector']))
                                    Start Free Course
                                @else
                                    View Course
                                @endif
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 text-lg">No courses found</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($courses->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Why These Courses Matter -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="font-heading text-3xl md:text-4xl font-bold text-[#0A2342] uppercase mb-6">
                    Why These Free Courses Matter
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    We created these courses to help beginners understand the complex U.S. trucking process, reduce confusion, and give you a clear roadmap before you commit to a career change.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Benefit 1 -->
                <div class="text-center p-6 rounded-xl bg-gray-50 border border-gray-100 hover:border-[#F5B82E]/30 transition-colors">
                    <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                        <i data-lucide="map" class="h-8 w-8 text-[#F5B82E]"></i>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-3">Clear Roadmap</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Stop guessing. Get a clear, step-by-step path to your trucking career.
                    </p>
                </div>
                <!-- Benefit 2 -->
                <div class="text-center p-6 rounded-xl bg-gray-50 border border-gray-100 hover:border-[#F5B82E]/30 transition-colors">
                    <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                        <i data-lucide="file-text" class="h-8 w-8 text-[#F5B82E]"></i>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-3">Visa Prep</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Understand the complex visa requirements for your specific region.
                    </p>
                </div>
                <!-- Benefit 3 -->
                <div class="text-center p-6 rounded-xl bg-gray-50 border border-gray-100 hover:border-[#F5B82E]/30 transition-colors">
                    <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                        <i data-lucide="users" class="h-8 w-8 text-[#F5B82E]"></i>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-3">Interview Help</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Learn what U.S. companies are looking for and how to get hired.
                    </p>
                </div>
                <!-- Benefit 4 -->
                <div class="text-center p-6 rounded-xl bg-gray-50 border border-gray-100 hover:border-[#F5B82E]/30 transition-colors">
                    <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                        <i data-lucide="graduation-cap" class="h-8 w-8 text-[#F5B82E]"></i>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-3">CLP Practice</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Practice with real exam questions to ensure you pass on the first try.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mentorship Connection -->
    <section class="py-20 bg-[#0A2342] text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-[#1B75F0]/10 skew-x-12 transform translate-x-20"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="font-heading text-3xl md:text-4xl font-bold uppercase mb-6">
                        Ready for the Next Step?
                    </h2>
                    <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                        Our free courses give you the understanding. Our <span class="text-[#F5B82E] font-bold">Mentorship Program</span> gives you the step-by-step guidance, private community, documents, and daily support to make it happen.
                    </p>
                    <ul class="space-y-4 mb-10">
                        <li class="flex items-center gap-3">
                            <i data-lucide="check-circle-2" class="h-6 w-6 text-[#F5B82E]"></i>
                            <span class="text-lg font-medium">Guidance on visa requirements and documents</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="check-circle-2" class="h-6 w-6 text-[#F5B82E]"></i>
                            <span class="text-lg font-medium">Help applying to hiring companies that accept foreign drivers</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="check-circle-2" class="h-6 w-6 text-[#F5B82E]"></i>
                            <span class="text-lg font-medium">Interview preparation to increase your chances</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="check-circle-2" class="h-6 w-6 text-[#F5B82E]"></i>
                            <span class="text-lg font-medium">Clear roadmap from your country to a trucking job in the USA</span>
                        </li>
                    </ul>
                    <a href="{{ route('front.mentorship') }}" class="btn-cta bg-[#F5B82E] text-[#0A2342] hover:bg-[#F5B82E]/90 h-14 px-10 text-lg font-bold uppercase tracking-wide shadow-lg rounded inline-flex items-center justify-center">
                        Join Mentorship Program
                    </a>
                </div>
                <div class="relative hidden lg:block">
                    <div class="absolute inset-0 bg-[#F5B82E] rounded-2xl transform rotate-3"></div>
                    <img src="{{ asset('images/mentorship-training-v2.png') }}" alt="Mentorship Program" class="relative z-10 rounded-2xl shadow-2xl transform -rotate-3 hover:rotate-0 transition-transform duration-500">
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
