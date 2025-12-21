@extends('admin.layouts.main')
@section('content')
<main class="app-main">

    <div class="app-content-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h2>Blog Posts</h2>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card card-primary card-outline mb-4">

                    <div class="card-header">
                        <div class="header">
                            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add Post</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Published</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->author->name ?? 'Unknown' }}</td>
                                    <td>
                                        @if($post->status === 'published')
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-warning">Draft</span>
                                        @endif
                                    </td>
                                    <td>{{ $post->published_at ? $post->published_at->format('M d, Y') : '-' }}</td>
                                    <td>
                                        <a href="{{ route('front.blog.show', $post->slug) }}" class="btn btn-info btn-sm" target="_blank">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this post?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="6">No posts found!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $posts->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
