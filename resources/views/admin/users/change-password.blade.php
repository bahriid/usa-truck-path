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
      <div class="input-group">
        <input type="password" name="password" id="password" class="form-control" required>
        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password', this)">
          <i class="bi bi-eye"></i>
        </button>
      </div>
      @error('password')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Confirm New Password</label>
      <div class="input-group">
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password_confirmation', this)">
          <i class="bi bi-eye"></i>
        </button>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Update Password</button>
  </form>
          </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
@endpush
@endsection