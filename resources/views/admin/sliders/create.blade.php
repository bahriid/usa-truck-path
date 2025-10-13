@extends('admin.layouts.main')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="row ">
            <div class="col-md-6 col-sm-12">
                <h2>Add Slider</h2>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row ">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-body">
                        <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="{{old('name')}}">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>Subtitle</label>
                                <input type="text" name="subtitle" class="form-control" value="{{old('subtitle')}}">
                                @error('subtitle')
                                <span class="text-danger">{{ $message }}</span>
                                
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>  Redirect Url</label>
                                <input type="url" name="redirect_url" class="form-control" value="{{old('redirect_url')}}">
                                @error('redirect_url')
                                <span class="text-danger">{{ $message }}</span>
                                
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="checkbox" name="is_active" checked> Active

                                @error('is_active')
                                <span class="text-danger">{{ $message }}</span>
                                
                            @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Add Slider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection