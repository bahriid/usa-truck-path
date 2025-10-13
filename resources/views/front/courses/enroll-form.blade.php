@extends('partials.master')

@section('main')
<div class="container py-5">
  <h2>Enroll in {{ $course->title }}</h2>

  @if(session('info'))
    <div class="alert alert-info">{{ session('info') }}</div>
  @endif

  <form action="{{ route('front.courses.processEnroll', $course->id) }}" method="POST" class="mt-4">
    @csrf

    <div class="mb-3">
      <label for="full_name" class="form-label">Full Name</label>
      <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name') }}" required>
      @error('full_name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
      @error('email') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label for="phone" class="form-label">Phone Number</label>
      <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
      @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
