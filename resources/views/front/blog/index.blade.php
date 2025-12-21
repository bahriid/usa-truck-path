@extends('partials.master')

@push('styles')
<style>
    .blog-hero {
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .blog-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="2"/></svg>');
        opacity: 0.2;
    }

    .blog-hero h1 {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .blog-hero p {
        font-size: clamp(1.1rem, 2.5vw, 1.3rem);
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.7;
        opacity: 0.95;
    }

    .blog-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .blog-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 35px rgba(25, 135, 84, 0.15);
    }

    .blog-card-image {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .blog-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .blog-card:hover .blog-card-image img {
        transform: scale(1.05);
    }

    .blog-card-image .date-badge {
        position: absolute;
        bottom: 15px;
        left: 15px;
        background: #198754;
        color: white;
        padding: 8px 15px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .blog-card-body {
        padding: 25px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .blog-card-body h3 {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 12px;
        line-height: 1.4;
    }

    .blog-card-body h3 a {
        color: #212529;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .blog-card-body h3 a:hover {
        color: #198754;
    }

    .blog-card-body .excerpt {
        color: #6c757d;
        font-size: 0.95rem;
        line-height: 1.6;
        flex: 1;
    }

    .blog-card-body .author {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #e9ecef;
    }

    .blog-card-body .author-avatar {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1rem;
    }

    .blog-card-body .author-name {
        font-weight: 600;
        color: #212529;
        font-size: 0.9rem;
    }

    .no-image-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .no-image-placeholder i {
        font-size: 4rem;
        color: rgba(255, 255, 255, 0.3);
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 50px;
    }

    @media (max-width: 768px) {
        .blog-hero {
            padding: 60px 0 50px;
        }

        .blog-section {
            padding: 50px 0;
        }

        .blog-card-image {
            height: 180px;
        }
    }
</style>
@endpush

@section('main')
<main class="main">
    <!-- Hero Section -->
    <section class="blog-hero text-white">
        <div class="container position-relative" data-aos="fade-up">
            <div class="text-center">
                <h1>Our Blog</h1>
                <p>
                    Tips, insights, and stories from the trucking industry to help you succeed on your journey.
                </p>
            </div>
        </div>
    </section>

    <!-- Blog Posts Section -->
    <section class="blog-section">
        <div class="container">
            @if($posts->count() > 0)
                <div class="row g-4">
                    @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="blog-card">
                                <div class="blog-card-image">
                                    @if($post->featured_image)
                                        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}">
                                    @else
                                        <div class="no-image-placeholder">
                                            <i class="bi bi-newspaper"></i>
                                        </div>
                                    @endif
                                    <div class="date-badge">
                                        {{ $post->published_at->format('M d, Y') }}
                                    </div>
                                </div>
                                <div class="blog-card-body">
                                    <h3>
                                        <a href="{{ route('front.blog.show', $post->slug) }}">{{ $post->title }}</a>
                                    </h3>
                                    <p class="excerpt">
                                        {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                                    </p>
                                    <div class="author">
                                        <div class="author-avatar">
                                            {{ strtoupper(substr($post->author->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <span class="author-name">{{ $post->author->name ?? 'Admin' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pagination-wrapper">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-newspaper" style="font-size: 4rem; color: #ccc;"></i>
                    <h3 class="mt-4 text-muted">No blog posts yet</h3>
                    <p class="text-muted">Check back soon for new content!</p>
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
