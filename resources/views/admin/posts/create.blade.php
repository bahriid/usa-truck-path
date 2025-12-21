@extends('admin.layouts.main')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h2>{{ isset($post) ? 'Edit Post' : 'Add Post' }}</h2>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-body">
                        <form action="{{ isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($post))
                                @method('PUT')
                            @endif

                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $post->title ?? '') }}" required>
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ old('slug', $post->slug ?? '') }}" required>
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="excerpt">Excerpt</label>
                                <textarea name="excerpt" class="form-control" id="excerpt" rows="3" placeholder="Brief summary for listing pages">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                                @error('excerpt')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="content">Content</label>
                                <textarea name="content" class="form-control" id="content" rows="10" required>{{ old('content', $post->content ?? '') }}</textarea>
                                @error('content')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="featured_image">Featured Image</label>
                                <input type="file" name="featured_image" class="form-control" id="featured_image">
                                @if (!empty($post->featured_image))
                                    <img src="{{ Storage::url($post->featured_image) }}" class="mt-2" alt="Featured Image" width="200">
                                @endif
                                @error('featured_image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" id="status" required>
                                            <option value="draft" {{ old('status', $post->status ?? 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="published" {{ old('status', $post->status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="published_at">Publish Date</label>
                                        <input type="datetime-local" name="published_at" class="form-control" id="published_at" value="{{ old('published_at', isset($post->published_at) ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
                                        <small class="text-muted">Leave empty to publish immediately when status is Published</small>
                                        @error('published_at')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">
                            <h5 class="mb-3">SEO Settings</h5>

                            <div class="form-group mb-3">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" id="meta_title" value="{{ old('meta_title', $post->meta_title ?? '') }}" placeholder="Leave empty to use post title">
                                @error('meta_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="meta_description">Meta Description</label>
                                <textarea name="meta_description" class="form-control" id="meta_description" rows="2" placeholder="Leave empty to use excerpt">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
                                @error('meta_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">{{ isset($post) ? 'Update' : 'Create' }} Post</button>
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script src="{{ asset('asset_admin/vendor/ckeditor/ckeditor.js') }}"></script>

<script>
    // Replace the content textarea with CKEditor
    CKEDITOR.replace('content');

    // Ensure CKEditor content is updated before form submission
    document.querySelector("form").addEventListener("submit", function () {
        for (var instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
    });

    // Generate slug from title
    document.getElementById("title").addEventListener("keyup", function () {
        var text = this.value.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
        document.getElementById("slug").value = text;
    });
</script>
@endpush

@endsection
