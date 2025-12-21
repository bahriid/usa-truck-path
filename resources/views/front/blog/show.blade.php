@extends('partials.master')

@push('styles')
<style>
    .post-hero {
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .post-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="2"/></svg>');
        opacity: 0.2;
    }

    .post-hero .breadcrumb {
        margin-bottom: 20px;
    }

    .post-hero .breadcrumb a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
    }

    .post-hero .breadcrumb a:hover {
        color: white;
    }

    .post-hero h1 {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.3;
    }

    .post-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
        opacity: 0.9;
    }

    .post-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .post-section {
        padding: 60px 0;
        background: white;
    }

    .post-featured-image {
        margin-top: -60px;
        margin-bottom: 40px;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
    }

    .post-featured-image img {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
    }

    .post-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }

    .post-content h2,
    .post-content h3,
    .post-content h4 {
        color: #198754;
        margin-top: 30px;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .post-content p {
        margin-bottom: 20px;
    }

    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 20px 0;
    }

    .post-content ul,
    .post-content ol {
        margin-bottom: 20px;
        padding-left: 20px;
    }

    .post-content li {
        margin-bottom: 10px;
    }

    .post-content blockquote {
        background: #f8f9fa;
        border-left: 4px solid #198754;
        padding: 20px 25px;
        margin: 25px 0;
        border-radius: 0 12px 12px 0;
        font-style: italic;
    }

    .author-box {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 16px;
        padding: 30px;
        margin-top: 50px;
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .author-box-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 2rem;
        flex-shrink: 0;
    }

    .author-box h4 {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .author-box p {
        color: #6c757d;
        margin: 0;
    }

    .related-posts {
        background: #f8f9fa;
        padding: 60px 0;
    }

    .related-posts h3 {
        font-weight: 700;
        margin-bottom: 30px;
        color: #198754;
    }

    .related-post-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .related-post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(25, 135, 84, 0.15);
    }

    .related-post-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .related-post-card .card-body {
        padding: 20px;
    }

    .related-post-card h5 {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .related-post-card h5 a {
        color: #212529;
        text-decoration: none;
    }

    .related-post-card h5 a:hover {
        color: #198754;
    }

    .related-post-card .date {
        font-size: 0.85rem;
        color: #6c757d;
    }

    .share-buttons {
        display: flex;
        gap: 10px;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid #e9ecef;
    }

    .share-buttons a {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: white;
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }

    .share-buttons a:hover {
        transform: scale(1.1);
    }

    .share-buttons .facebook { background: #1877f2; }
    .share-buttons .twitter { background: #1da1f2; }
    .share-buttons .linkedin { background: #0077b5; }
    .share-buttons .whatsapp { background: #25d366; }

    @media (max-width: 768px) {
        .post-hero {
            padding: 60px 0 50px;
        }

        .author-box {
            flex-direction: column;
            text-align: center;
        }

        .post-featured-image {
            margin-top: -40px;
        }
    }
</style>
@endpush

@section('main')
<main class="main">
    <!-- Hero Section -->
    <section class="post-hero text-white">
        <div class="container position-relative" data-aos="fade-up">
            <div class="breadcrumb">
                <a href="{{ route('front.home') }}">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('front.blog.index') }}">Blog</a>
                <span class="mx-2">/</span>
                <span>{{ Str::limit($post->title, 30) }}</span>
            </div>
            <h1>{{ $post->title }}</h1>
            <div class="post-meta">
                <div class="post-meta-item">
                    <i class="bi bi-calendar3"></i>
                    <span>{{ $post->published_at->format('F d, Y') }}</span>
                </div>
                <div class="post-meta-item">
                    <i class="bi bi-person"></i>
                    <span>{{ $post->author->name ?? 'Admin' }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Post Content Section -->
    <section class="post-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @if($post->featured_image)
                        <div class="post-featured-image" data-aos="fade-up">
                            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}">
                        </div>
                    @endif

                    <article class="post-content" data-aos="fade-up">
                        {!! $post->content !!}
                    </article>

                    <!-- Share Buttons -->
                    <div class="share-buttons">
                        <span class="me-2 align-self-center fw-bold">Share:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="facebook" title="Share on Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="twitter" title="Share on Twitter">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}" target="_blank" class="linkedin" title="Share on LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" class="whatsapp" title="Share on WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>

                    <!-- Author Box -->
                    <div class="author-box" data-aos="fade-up">
                        <div class="author-box-avatar">
                            {{ strtoupper(substr($post->author->name ?? 'A', 0, 1)) }}
                        </div>
                        <div>
                            <h4>{{ $post->author->name ?? 'Admin' }}</h4>
                            <p>Author at USATRUCKPATH</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Posts Section -->
    @if($recentPosts->count() > 0)
        <section class="related-posts">
            <div class="container">
                <h3 class="text-center">More Articles</h3>
                <div class="row g-4">
                    @foreach($recentPosts as $recentPost)
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="related-post-card">
                                @if($recentPost->featured_image)
                                    <img src="{{ Storage::url($recentPost->featured_image) }}" alt="{{ $recentPost->title }}">
                                @else
                                    <div style="height: 150px; background: linear-gradient(135deg, #198754 0%, #146c43 100%); display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-newspaper" style="font-size: 2rem; color: rgba(255,255,255,0.3);"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5><a href="{{ route('front.blog.show', $recentPost->slug) }}">{{ $recentPost->title }}</a></h5>
                                    <span class="date">{{ $recentPost->published_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</main>
@endsection

@section('meta')
    <title>{{ $post->meta_title ?? $post->title }} | USATRUCKPATH</title>
    <meta name="description" content="{{ $post->meta_description ?? $post->excerpt ?? Str::limit(strip_tags($post->content), 160) }}">
    <meta property="og:title" content="{{ $post->meta_title ?? $post->title }}">
    <meta property="og:description" content="{{ $post->meta_description ?? $post->excerpt ?? Str::limit(strip_tags($post->content), 160) }}">
    @if($post->featured_image)
        <meta property="og:image" content="{{ Storage::url($post->featured_image) }}">
    @endif
@endsection
