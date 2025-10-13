@extends('admin.layouts.main')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <h2>Manage Content for {{ $course->title }}</h2>
    </div>
    <div class="app-content">
        <a href="{{ route('courses.contents.create', $course->id) }}" class="btn btn-primary">Add Content</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Preview</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contents as $content)
                <tr>
                    <td>{{ $content->title }}</td>
                    <td>{{ ucfirst($content->type) }}</td>
                    <td>
                        @if($content->type == 'video' && $content->file_path)
                            <video width="200" controls>
                                <source src="{{ asset('storage/' . $content->file_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @elseif($content->type == 'image' && $content->file_path)
                            <img src="{{ asset('storage/' . $content->file_path) }}" alt="{{ $content->title }}" width="100">
                        @elseif($content->type == 'pdf' && $content->file_path)
                            <a href="{{ asset('storage/' . $content->file_path) }}" target="_blank">View PDF</a>
                        @elseif($content->type == 'external_link' && $content->external_link)
                            <a href="{{ $content->external_link }}" target="_blank">Visit Link</a>
                        @elseif($content->type == 'text' && $content->content_text)
                            {{ \Illuminate\Support\Str::limit($content->content_text, 50) }}
                        @else
                            No preview available.
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('courses.contents.edit', [$course->id, $content->id]) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('courses.contents.destroy', [$course->id, $content->id]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this content?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No content found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>
@endsection
