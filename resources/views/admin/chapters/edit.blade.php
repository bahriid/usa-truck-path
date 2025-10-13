@extends('admin.layouts.main')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="row">
            <div class="col-md-6">
                <h2>Edit Chapter for Course: {{ $course->title }}</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('chapters.index', $course->id) }}" class="btn btn-secondary"> <i class="bi bi-arrow-left"></i></a>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <div class="card-body">
                    <form action="{{ route('chapters.update', [$course->id, $chapter->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="title">Chapter Title</label>
                            <input type="text" name="title" class="form-control" value="{{old('title', $chapter->title) }}" required>
                              @error('title')
                            <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Chapter Description</label>
                            <textarea name="description" class="form-control">{{ old('description', $chapter->description) }}</textarea>
                              @error('description')
                            <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Chapter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
