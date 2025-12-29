@extends('new-design.partials.master')

@section('main')
<main>
    <section class="min-h-[80vh] flex items-center justify-center bg-gradient-to-br from-[#0A2342] to-[#1B75F0] text-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiNmZmZmZmYiLz48L3N2Zz4=')"></div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="max-w-2xl mx-auto">
                <!-- Icon -->
                <div class="w-24 h-24 bg-[#F5B82E] rounded-full flex items-center justify-center mx-auto mb-8 shadow-2xl">
                    <i data-lucide="clock" class="h-12 w-12 text-[#0A2342]"></i>
                </div>

                <!-- Title -->
                <h1 class="font-heading text-5xl md:text-6xl font-bold uppercase mb-6">
                    Coming <span class="text-[#F5B82E]">Soon</span>
                </h1>

                <!-- Course Title -->
                @if(isset($course))
                <h2 class="text-2xl md:text-3xl font-semibold mb-4 text-gray-200">
                    {{ $course->title }}
                </h2>
                @endif

                <!-- Description -->
                <p class="text-xl text-gray-300 mb-10 leading-relaxed">
                    We're working hard to bring you something amazing. This course will be available soon. Stay tuned!
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('front.home') }}" class="inline-flex items-center justify-center bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase tracking-wide px-8 py-4 rounded-full shadow-lg transition-all transform hover:-translate-y-1">
                        <i data-lucide="home" class="h-5 w-5 mr-2"></i>
                        Back to Home
                    </a>
                    <a href="{{ route('front.course') }}" class="inline-flex items-center justify-center bg-white/10 hover:bg-white/20 text-white font-bold uppercase tracking-wide px-8 py-4 rounded-full shadow-lg transition-all transform hover:-translate-y-1 border border-white/30">
                        <i data-lucide="book-open" class="h-5 w-5 mr-2"></i>
                        View Other Courses
                    </a>
                </div>

                <!-- Decorative Elements -->
                <div class="mt-16 flex justify-center gap-3">
                    <div class="w-3 h-3 bg-[#F5B82E] rounded-full animate-bounce" style="animation-delay: 0s"></div>
                    <div class="w-3 h-3 bg-[#F5B82E] rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    <div class="w-3 h-3 bg-[#F5B82E] rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
