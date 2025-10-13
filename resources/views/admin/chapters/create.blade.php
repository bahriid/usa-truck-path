@extends('admin.layouts.main')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="row">
            <div class="col-md-6">
                <h2>Add Chapter for Course: {{ $course->title }}</h2>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <div class="card-body">
                    <form action="{{ route('chapters.store', $course->id) }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">Chapter Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter chapter title" required value="{{old('title')}}">
                            @error('title')
                            <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Chapter Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter description (optional)"></textarea>
                               @error('description')
                            <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Chapter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
