@extends('new-design.partials.master')

@section('main')
<main>
    <!-- Hero Section -->
    <section class="relative py-24 bg-[#0A2342] text-white overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0A2342] to-transparent opacity-90"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-block bg-[#1B75F0] px-4 py-2 mb-6 rounded-full shadow-lg">
                    <span class="font-bold uppercase text-white tracking-wider text-sm">Trucking Insights</span>
                </div>
                <h1 class="font-heading text-5xl md:text-6xl font-bold uppercase leading-tight mb-6">
                    Our <span class="text-[#F5B82E]">Blog</span>
                </h1>
                <p class="text-xl text-gray-300 leading-relaxed">
                    Tips, insights, and stories from the trucking industry to help you succeed on your journey to becoming a US truck driver.
                </p>
            </div>
        </div>
    </section>

    <!-- Blog Posts Section -->
    <section class="py-24 bg-[#F2F4F7]">
        <div class="container mx-auto px-4">
            @if($posts->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                            <div class="relative h-56 overflow-hidden">
                                @if($post->featured_image)
                                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-[#0A2342] to-[#1B75F0] flex items-center justify-center">
                                        <i data-lucide="newspaper" class="h-16 w-16 text-white/30"></i>
                                    </div>
                                @endif
                                <div class="absolute bottom-4 left-4 bg-[#0A2342] text-white px-3 py-1 rounded-full text-sm font-bold">
                                    {{ $post->published_at->format('M d, Y') }}
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="font-heading text-xl font-bold uppercase text-[#0A2342] mb-3 leading-tight group-hover:text-[#1B75F0] transition-colors">
                                    <a href="{{ route('front.blog.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                    {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                                </p>
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-[#0A2342] to-[#1B75F0] rounded-full flex items-center justify-center text-white font-bold text-sm">
                                            {{ strtoupper(substr($post->author->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <span class="text-sm font-medium text-[#3A3A3A]">{{ $post->author->name ?? 'Admin' }}</span>
                                    </div>
                                    <a href="{{ route('front.blog.show', $post->slug) }}" class="text-[#1B75F0] font-bold text-sm hover:text-[#0A2342] transition-colors flex items-center gap-1">
                                        Read More <i data-lucide="arrow-right" class="h-4 w-4"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    {{ $posts->links('pagination::tailwind') }}
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-[#0A2342]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="newspaper" class="h-12 w-12 text-[#0A2342]/40"></i>
                    </div>
                    <h3 class="font-heading text-2xl font-bold uppercase text-[#0A2342] mb-3">No Blog Posts Yet</h3>
                    <p class="text-gray-600">Check back soon for new content!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-[#0A2342] text-white text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-[#0A2342] via-transparent to-[#0A2342]"></div>
        <div class="container mx-auto px-4 relative z-10">
            <h2 class="font-heading text-4xl font-bold uppercase mb-6">Ready to Start Your Journey?</h2>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-10">
                Join our free course and take the first step towards becoming a US truck driver.
            </p>
            <a href="{{ route('front.course') }}" class="inline-block bg-[#F5B82E] text-[#0A2342] hover:bg-[#F5B82E]/90 text-lg font-bold px-10 py-4 rounded-md shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all">
                Start Free Course
            </a>
        </div>
    </section>
</main>
@endsection
