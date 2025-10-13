@extends('admin.layouts.main')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <h2>Add Content for {{ $course->title }}</h2>
    </div>
    <div class="app-content">
        <form action="{{ route('courses.contents.store', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title (optional)</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="type">Content Type</label>
                <select name="type" class="form-control" required>
                    <option value="">Select Type</option>
                    <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
                    <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Image</option>
                    <option value="pdf" {{ old('type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                    <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                    <option value="external_link" {{ old('type') == 'external_link' ? 'selected' : '' }}>External Link</option>
                </select>
            </div>

            <div class="form-group">
                <label for="file">Upload File (if applicable)</label>
                <input type="file" name="file" class="form-control">
            </div>

            <div class="form-group">
                <label for="external_link">External Link (if applicable)</label>
                <input type="url" name="external_link" class="form-control" value="{{ old('external_link') }}">
            </div>

            <div class="form-group">
                <label for="content_text">Text Content (if applicable)</label>
                <textarea name="content_text" class="form-control" rows="5">{{ old('content_text') }}</textarea>
            </div>

            <div class="form-group">
                <label for="order">Order</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
            </div>

            <div class="form-group">
                <label for="meta">Meta Data (JSON format, optional)</label>
                <textarea name="meta" class="form-control" rows="3">{{ old('meta') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Content</button>
        </form>
    </div>
</main>
@endsection
