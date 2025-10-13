@extends('admin.layouts.main')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="row ">
            <div class="col-md-6 col-sm-12">
                <h2>Term and Condition and Privay policy</h2>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row ">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-body">

    <form action="{{ route('admin.legal.update') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="privacy_policy" class="form-label"><strong>Privacy Policy</strong></label>
            <textarea name="privacy_policy" id="privacy_policy" class="form-control" rows="10">{{ old('privacy_policy', $legal->privacy_policy) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="terms_and_conditions" class="form-label"><strong>Terms & Conditions</strong></label>
            <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-control" rows="10">{{ old('terms_and_conditions', $legal->terms_and_conditions) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Legal Pages</button>
    </form>
</div>
                </div>
            </div>
        </div>
    </div>
</main>



@push('scripts')
<script src="{{asset('asset_admin/vendor/ckeditor/ckeditor.js')}}"></script>
    <!-- Include CKEditor CDN -->
    <!--<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>-->
    <script>
       // Ensure CKEditor content is updated before form submission
        // Initialize CKEditor for both textareas
        CKEDITOR.replace('privacy_policy');
        CKEDITOR.replace('terms_and_conditions');
        document.querySelector("form").addEventListener("submit", function () {
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        });
    </script>
@endpush

@endsection
