@extends('admin.layouts.main')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="row ">
            <div class="col-md-6 col-sm-12">
                <h2>Edit Slider</h2>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row ">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-body">
                        <form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $slider->title) }}">
                                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group">
                                <label>Subtitle</label>
                                <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $slider->subtitle) }}">
                                @error('subtitle') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label>Redirect Url</label>
                                <input type="url" name="redirect_url" class="form-control" value="{{ old('redirect_url', $slider->redirect_url) }}">
                                @error('redirect_url') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group">
                                <label>Current Image</label><br>
                                <img src="{{ asset('storage/' . $slider->image) }}" width="100">
                            </div>

                            <div class="form-group">
                                <label>Upload New Image</label>
                                <input type="file" name="image" class="form-control">
                                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="is_active" {{ $slider->is_active ? 'checked' : '' }}>
                                    Active
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Slider</button>
                            <a href="{{ route('sliders.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
