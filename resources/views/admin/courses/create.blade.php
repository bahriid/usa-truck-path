@extends('admin.layouts.main')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="row ">
            <div class="col-md-6 col-sm-12">
                <h2>{{ isset($course) ? 'Edit Course' : 'Add Course' }}</h2>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row ">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-body">
                        <form action="{{ isset($course) ? route('admin.courses.update', $course) : route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($course))
                                @method('PUT')
                            @endif

                            <div class="form-group mb-3">
                                <label for="title">Course Title</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $course->title ?? '') }}" required>
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="menu_name">Course Menu Name</label>
                                <input type="text" name="menu_name" class="form-control" id="menu_name" value="{{ old('menu_name', $course->menu_name ?? '') }}" required>
                                @error('menu_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="category">Category</label>
                                <input type="text" name="category" class="form-control" id="category" value="{{ old('category', $course->category ?? '') }}" required>
                                @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                           

                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status" required>
                                    <option value="active" {{ old('status', $course->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $course->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="price">Price</label>
                                <input type="number" step="0.01" name="price" class="form-control" id="price" value="{{ old('price', $course->price ?? '') }}" required>
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="original_price">Original Price (Strikethrough)</label>
                                <input type="number" step="0.01" name="original_price" class="form-control" id="original_price" value="{{ old('original_price', $course->original_price ?? '') }}">
                                <small class="text-muted">Leave empty to hide strikethrough price</small>
                                @error('original_price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="is_active">Active</label>
                                <select name="is_active" class="form-control" id="is_active" required>
                                    <option value="1" {{ old('is_active', $course->is_active ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('is_active', $course->is_active ?? '') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('is_active')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="image"> Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                                @if (!empty($course->image))
                                    <img src="{{ Storage::url($course->image ) }}" class="mt-2 h-15 w-15" alt="Main Logo" width="100">
                                @endif
                                @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            </div>
                          
                            
                     

                            <div class="form-group mb-3">
                                <label for="summary">Description </label>
                                <textarea class="form-control" name="description" id="summary"
                                    placeholder="Summary &amp; Description (Meta Tag)">{{ old('summary', $course->description ?? '') }}</textarea>
                                    @error('summary')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>



                            <div class="form-group mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug"
                                    value="{{ old('slug', $course->slug ?? '') }}" required readonly>
                                    @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="tags"> Keywords Meta Tag</label>
                                <input class="form-control" name="tags" id="tags"
                                    placeholder="Meta Tag" value="{{ old('tags', $course->tags ?? '') }}" />
                                    @error('tags')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="meta_title">Meta title </label>
                                <textarea class="form-control" name="meta_title" id="meta_title"
                                    placeholder="Meta Title">{{ old('meta_title', $course->meta_title ?? '') }}</textarea>
                                    @error('meta_title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="meta_description">Meta Description </label>
                                <textarea class="form-control" name="meta_description" id="meta_description"
                                    placeholder="meta_description &amp; Description (Meta Tag)">{{ old('meta_description', $course->meta_description ?? '') }}</textarea>
                                    @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                          

                            <button type="submit" class="btn btn-success">{{ isset($course) ? 'Update' : 'Create' }} Course</button>
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script src="{{asset('asset_admin/vendor/ckeditor/ckeditor.js')}}"></script>

<script>

        // Replace the summary textarea with CKEditor
        CKEDITOR.replace('summary');
        CKEDITOR.replace('meta_description');

        // Ensure CKEditor content is updated before form submission
        document.querySelector("form").addEventListener("submit", function () {
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        });
        var input = document.querySelector("#tags");
        new Tagify(input);

    // Generate slug from title
    document.getElementById("title").addEventListener("keyup", function () {
        var text = this.value.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
        document.getElementById("slug").value = text;
    });

   
</script>

@endpush

@endsection
