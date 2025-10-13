@php
$setting = App\Models\SiteSetting::first();
@endphp

{{-- <img 
style="width: 200px"
height="200px"
src="{{Storage::url($setting->main_logo??'')}}" alt="Application Logo"> --}}