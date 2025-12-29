@extends('admin.layouts.main')
@section('content')

    <main  class="app-main">
    

        <div class="app-content-header">
            <div class="row ">
                <div class="col-md-6 col-sm-12">
                    <h2>Site Settings</h2>
                </div>            
              
            </div>
        </div>
        <div class="app-content">
           <div  class="container-fluid">
            <div class="row ">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <div class="header">
                            <h4>Site Settings</h4>
                        </div>
                    </div>
                        <div class="card-body">
                         
                                <form action="{{ route('settings.site_settings.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                        
                                    <div class="form-group mb-3 ">
                                        <label for="site_title">Site Title</label>
                                        <input type="text" name="site_title" class="form-control" id="site_title" value="{{ old('site_title', $setting->site_title ?? '') }}" required>
                                        @error('site_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                        
                                    <div class="form-group mb-3">
                                        <label for="site_description">Site Description</label>
                                        <textarea name="site_description" class="form-control" id="site_description" rows="4" required>{{ old('site_description', $setting->site_description ?? '') }}</textarea>
                                        @error('site_description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                        
                                    <div class="form-group mb-3">
                                    
                                       
                                              
                                                
                                                    <label for="site_keywords">Site Keywords</label>
                                                    <input type="text" name="site_keywords" class="form-control" id="tags" 
                                                         
                                                           value="{{ old('site_keywords', $setting->site_keywords ?? '') }}">
                                               

                                                @error('site_keywords')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            
                                       
                                        
                                    </div>
                                    <div class="form-group mb-3 ">
                                        <label for="zelle">Zelle</label>
                                        <input type="text" name="zelle" class="form-control" id="zelle" value="{{ old('zelle', $setting->zelle ?? '') }}" required>
                                        @error('zelle')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 ">
                                        <label for="cash_app">Cash App</label>
                                        <input type="text" name="cash_app" class="form-control" id="cash_app" value="{{ old('cash_app', $setting->cash_app ?? '') }}" required>
                                        @error('cash_app')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                        
                                    <div class="form-group mb-3">
                                        <label for="main_logo">Main Logo</label>
                                        <input type="file" name="main_logo" class="form-control" id="main_logo">
                                        @if (!empty($setting->main_logo))
                                            <img src="{{ Storage::url($setting->main_logo ) }}" alt="Main Logo" width="100">
                                        @endif
                                        @error('main_logo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                        
                                    {{-- <div class="form-group mb-3">
                                        <label for="sticky_logo">Sticky Logo</label>
                                        <input type="file" name="sticky_logo" class="form-control" id="sticky_logo">
                                        @if (!empty($setting->sticky_logo))
                                            <img src="{{ Storage::url($setting->sticky_logo  ) }}" alt="Sticky Logo" width="100">
                                        @endif
                                    </div> --}}
                        
                                    <div class="form-group mb-3">
                                        <label for="footer_logo">Footer Logo</label>
                                        <input type="file" name="footer_logo" class="form-control" id="footer_logo">
                                        @if (!empty($setting->footer_logo))
                                            <img src="{{ Storage::url($setting->footer_logo ) }}" alt="Footer Logo" width="100">
                                        @endif
                                        @error('footer_logo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                        
                                    <div class="form-group mb-3">
                                        <label for="site_favicon">Site Favicon</label>
                                        <input type="file" name="site_favicon" class="form-control" id="site_favicon">
                                        @if (!empty($setting->site_favicon))
                                            <img src="{{ Storage::url($setting->site_favicon ) }}" alt="Favicon" width="30">
                                        @endif
                                        @error('site_favicon')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                        
                                    <div class="form-group mb-3">
                                        <label for="facebook_url">Facebook URL</label>
                                        <input type="url" name="facebook_url" class="form-control" id="facebook_url" value="{{ old('facebook_url', $setting->facebook_url ?? '') }}">
                                        @error('facebook_url')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                        
                                  
                        
                                    <div class="form-group mb-3">
                                        <label for="instagram_url">Tiktok URL</label>
                                        <input type="url" name="instagram_url" class="form-control" id="instagram_url" value="{{ old('instagram_url', $setting->instagram_url ?? '') }}">
                                        @error('instagram_url')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                        
                                    <div class="form-group mb-3">
                                        <label for="linkedin_url">LinkedIn URL</label>
                                        <input type="url" name="linkedin_url" class="form-control" id="linkedin_url" value="{{ old('linkedin_url', $setting->linkedin_url ?? '') }}">
                                        @error('linkedin_url')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                        
                                    <div class="form-group mb-3">
                                        <label for="youtube_url">YouTube URL</label>
                                        <input type="url" name="youtube_url" class="form-control" id="youtube_url" value="{{ old('youtube_url', $setting->youtube_url ?? '') }}">
                                        @error('youtube_url')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="twitter_url">Twitter URL</label>
                                        <input type="url" name="twitter_url" class="form-control" id="twitter_url" value="{{ old('twitter_url', $setting->twitter_url ?? '') }}">
                                        @error('twitter_url')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                        
                                    <div class="form-group mb-3">
                                        <label for="contact_email">Contact Email</label>
                                        <input type="email" name="contact_email" class="form-control" id="contact_email" value="{{ old('contact_email', $setting->contact_email ?? '') }}">
                                        @error('contact_email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                        
                                    <div class="form-group mb-3">
                                        <label for="contact_phone">Contact Phone</label>
                                        <input type="text" name="contact_phone" class="form-control" id="contact_phone" value="{{ old('contact_phone', $setting->contact_phone ?? '') }}">
                                        @error('contact_phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="whatsapp_no">Whatsapp No</label>
                                        <input type="number" name="whatsapp_no" class="form-control" id="whatsapp_no" value="{{ old('whatsapp_no', $setting->whatsapp_no ?? '') }}">
                                        @error('whatsapp_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                        
                                    <div class="form-group mb-3">
                                        <label for="address">Address</label>
                                        <textarea name="address" class="form-control" id="address">{{ old('address', $setting->address ?? '') }}</textarea>
                                        @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>

                                    <hr class="my-4">
                                    <h5 class="mb-3">Course Settings</h5>

                                    <div class="form-group mb-3">
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="geo_filtering_enabled" value="0">
                                            <input type="checkbox" name="geo_filtering_enabled" class="form-check-input" id="geo_filtering_enabled" value="1" {{ old('geo_filtering_enabled', $setting->geo_filtering_enabled ?? false) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="geo_filtering_enabled">
                                                <strong>Enable Country-Based Course Filtering</strong>
                                            </label>
                                        </div>
                                        <small class="text-muted">When enabled, visitors will only see courses targeted to their region (US, Canada, Europe, or Global). When disabled, all courses are shown to everyone.</small>
                                        @error('geo_filtering_enabled')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <button type="submit" class="btn btn-primary">Update Settings</button>
                                </form>
                               
                               
                              
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        </div>
    </main>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var input = document.querySelector("#tags");
            new Tagify(input);
        });
    </script>
    
    @endpush

@endsection