@extends('admin.layouts.main')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="row ">
            <div class="col-md-6 col-sm-12">
                <h2>Change Password for {{ $user->name }}</h2>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row ">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-body">

  <form action="{{ route('admin.users.updatePassword', $user->id) }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="password" class="form-label">New Password</label>
      <input type="password" name="password" id="password" class="form-control" required>
      @error('password')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Confirm New Password</label>
      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Password</button>
  </form>
          </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection