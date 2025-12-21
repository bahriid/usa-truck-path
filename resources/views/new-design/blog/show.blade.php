@extends('new-design.partials.master')

@push('styles')
<style>
    .blog-content h1, .blog-content h2, .blog-content h3, .blog-content h4, .blog-content h5, .blog-content h6 {
        font-family: 'Oswald', sans-serif;
        color: #0A2342;
        font-weight: 700;
        text-transform: uppercase;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .blog-content h2 { font-size: 1.75rem; }
    .blog-content h3 { font-size: 1.5rem; }
    .blog-content h4 { font-size: 1.25rem; }
    .blog-content p {
        margin-bottom: 1.25rem;
        line-height: 1.8;
        color: #3A3A3A;
    }
    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 1.5rem 0;
    }
    .blog-content ul, .blog-content ol {
        margin-bottom: 1.25rem;
        padding-left: 1.5rem;
    }
    .blog-content li {
        margin-bottom: 0.5rem;
        line-height: 1.7;
    }
    .blog-content blockquote {
        background: #F2F4F7;
        border-left: 4px solid #1B75F0;
        padding: 1.5rem;
        margin: 1.5rem 0;
        border-radius: 0 12px 12px 0;
        font-style: italic;
    }
    .blog-content a {
        color: #1B75F0;
        text-decoration: underline;
    }
    .blog-content a:hover {
        color: #0A2342;
    }
</style>
@endpush

@section('main')
<main>
    <!-- Hero Section -->
    <section class="relative py-20 bg-[#0A2342] text-white overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0A2342] to-transparent opacity-90"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto">
                <!-- Breadcrumb -->
                <nav class="flex items-center gap-2 text-sm text-gray-300 mb-6">
                    <a href="{{ route('front.home') }}" class="hover:text-[#F5B82E] transition-colors">Home</a>
                    <i data-lucide="chevron-right" class="h-4 w-4"></i>
                    <a href="{{ route('front.blog.index') }}" class="hover:text-[#F5B82E] transition-colors">Blog</a>
                    <i data-lucide="chevron-right" class="h-4 w-4"></i>
                    <span class="text-[#F5B82E]">{{ Str::limit($post->title, 30) }}</span>
                </nav>

                <h1 class="font-heading text-4xl md:text-5xl font-bold uppercase leading-tight mb-6">
                    {{ $post->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-6 text-gray-300">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="h-5 w-5 text-[#F5B82E]"></i>
                        <span>{{ $post->published_at->format('F d, Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="user" class="h-5 w-5 text-[#F5B82E]"></i>
                        <span>{{ $post->author->name ?? 'Admin' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Post Content Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                @if($post->featured_image)
                    <div class="relative -mt-24 mb-12 rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full max-h-[500px] object-cover">
                    </div>
                @endif

                <article class="blog-content text-lg">
                    {!! $post->content !!}
                </article>

                <!-- Share Buttons -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <div class="flex flex-wrap items-center gap-4">
                        <span class="font-heading font-bold uppercase text-[#0A2342]">Share:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"
                           class="w-12 h-12 bg-[#1877f2] rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform">
                            <i data-lucide="facebook" class="h-5 w-5"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank"
                           class="w-12 h-12 bg-[#1da1f2] rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform">
                            <i data-lucide="twitter" class="h-5 w-5"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}" target="_blank"
                           class="w-12 h-12 bg-[#0077b5] rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform">
                            <i data-lucide="linkedin" class="h-5 w-5"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank"
                           class="w-12 h-12 bg-[#25d366] rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform">
                            <i data-lucide="message-circle" class="h-5 w-5"></i>
                        </a>
                    </div>
                </div>

                <!-- Author Box -->
                <div class="mt-12 bg-[#F2F4F7] rounded-2xl p-8 flex flex-col md:flex-row items-center gap-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-[#0A2342] to-[#1B75F0] rounded-full flex items-center justify-center text-white font-heading font-bold text-2xl flex-shrink-0">
                        {{ strtoupper(substr($post->author->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="text-center md:text-left">
                        <h4 class="font-heading text-xl font-bold uppercase text-[#0A2342] mb-2">{{ $post->author->name ?? 'Admin' }}</h4>
                        <p class="text-gray-600">Author at USATruckPath - Helping drivers navigate their journey to becoming US truck drivers.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Posts Section -->
    @if($recentPosts->count() > 0)
        <section class="py-20 bg-[#F2F4F7]">
            <div class="container mx-auto px-4">
                <h2 class="font-heading text-3xl font-bold uppercase text-[#0A2342] text-center mb-12">More Articles</h2>
                <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    @foreach($recentPosts as $recentPost)
                        <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                            <div class="relative h-40 overflow-hidden">
                                @if($recentPost->featured_image)
                                    <img src="{{ Storage::url($recentPost->featured_image) }}" alt="{{ $recentPost->title }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-[#0A2342] to-[#1B75F0] flex items-center justify-center">
                                        <i data-lucide="newspaper" class="h-10 w-10 text-white/30"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-5">
                                <h3 class="font-heading text-lg font-bold uppercase text-[#0A2342] mb-2 leading-tight group-hover:text-[#1B75F0] transition-colors">
                                    <a href="{{ route('front.blog.show', $recentPost->slug) }}">{{ $recentPost->title }}</a>
                                </h3>
                                <span class="text-sm text-gray-500">{{ $recentPost->published_at->format('M d, Y') }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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

@section('meta')
    <title>{{ $post->meta_title ?? $post->title }} | USATruckPath</title>
    <meta name="description" content="{{ $post->meta_description ?? $post->excerpt ?? Str::limit(strip_tags($post->content), 160) }}">
    <meta property="og:title" content="{{ $post->meta_title ?? $post->title }}">
    <meta property="og:description" content="{{ $post->meta_description ?? $post->excerpt ?? Str::limit(strip_tags($post->content), 160) }}">
    @if($post->featured_image)
        <meta property="og:image" content="{{ Storage::url($post->featured_image) }}">
    @endif
@endsection
