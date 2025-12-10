@extends('new-design.partials.master')

@section('main')
<main>
    <!-- Hero Section -->
    <section class="relative py-16 bg-[#0A2342] text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('frontend/img/whitetruck.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A2342] to-[#0A2342]/80"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <h1 class="font-heading text-3xl md:text-4xl font-bold uppercase tracking-tighter mb-2 text-[#F5B82E]">{{ $course->title ?? 'Courses' }}</h1>
            <p class="text-gray-300 text-lg mb-4">{{ $course->short_description ?? 'Explore our available courses in this category' }}</p>
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ url('/') }}" class="text-gray-300 hover:text-[#F5B82E] transition-colors">Home</a>
                <i data-lucide="chevron-right" class="h-4 w-4 text-gray-500"></i>
                <a href="{{ route('front.course') }}" class="text-gray-300 hover:text-[#F5B82E] transition-colors">Courses</a>
                <i data-lucide="chevron-right" class="h-4 w-4 text-gray-500"></i>
                <span class="text-[#F5B82E]">{{ $course->category ?? 'Category' }}</span>
            </nav>
        </div>
    </section>

    <!-- Courses Grid -->
    <section class="py-16 bg-[#F2F4F7]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-2">Available Courses</h2>
                <p class="text-gray-600">Choose the course that fits your goals</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @forelse ($courses as $courseItem)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-transparent hover:border-[#1B75F0] group">
                        <a href="{{ route('front.course.details', $courseItem->slug) }}" class="block">
                            <div class="relative">
                                @if($courseItem->image)
                                    <img src="{{ Storage::url($courseItem->image) }}" alt="{{ $courseItem->title }}" class="w-full h-52 object-cover">
                                @else
                                    <div class="w-full h-52 bg-gray-200 flex items-center justify-center">
                                        <i data-lucide="book-open" class="h-12 w-12 text-gray-400"></i>
                                    </div>
                                @endif
                                @if(($courseItem->course_type ?? 'paid') === 'tier')
                                    <span class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold uppercase">Free Start</span>
                                @endif
                            </div>
                        </a>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                @if(($courseItem->course_type ?? 'paid') === 'tier')
                                    <a href="{{ route('front.course.details', $courseItem->slug) }}" class="bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
                                        Start Free Course
                                    </a>
                                @else
                                    <a href="{{ route('front.course.details', $courseItem->slug) }}" class="bg-[#1B75F0] hover:bg-[#0A2342] text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
                                        More Details
                                    </a>
                                @endif
                                <div>
                                    @if(($courseItem->course_type ?? 'paid') === 'tier')
                                        <span class="text-green-500 font-bold text-lg">FREE</span>
                                    @else
                                        @if($courseItem->original_price)
                                            <span class="text-gray-400 line-through text-sm mr-1">${{ $courseItem->original_price }}</span>
                                        @endif
                                        <span class="text-[#1B75F0] font-bold text-lg">${{ $courseItem->price }}</span>
                                    @endif
                                </div>
                            </div>
                            <h3 class="font-heading font-bold text-[#0A2342] text-lg mb-3 line-clamp-2 group-hover:text-[#1B75F0] transition-colors">
                                <a href="{{ route('front.course.details', $courseItem->slug) }}">{{ Str::limit($courseItem->title, 60) }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm line-clamp-3">{{ Str::limit(strip_tags($courseItem->description ?? ''), 120) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <i data-lucide="search-x" class="h-16 w-16 text-gray-300 mx-auto mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-500 mb-2">No Courses Found</h3>
                        <p class="text-gray-400">There are no courses available in this category yet.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($courses->hasPages())
                <div class="flex justify-center mt-12">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
