@extends('admin.layouts.main')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h2>Enrollment</h2>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="header">
                                Enrollment list
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div></div>
                                <a href="{{ route('admin.enrollment.export') }}?{{ http_build_query(request()->only(['search', 'status', 'tier'])) }}" class="btn btn-success">
                                    <i class="bi bi-file-earmark-excel"></i> Export to Excel
                                </a>
                            </div>

                            <form method="GET" action="{{ route('admin.enrollment.index') }}" class="mb-3">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <input type="text" name="search" class="form-control" placeholder="Search by name, email, phone..."
                                               value="{{ request('search') }}">
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <select name="status" class="form-control">
                                            <option value="">All Status</option>
                                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="approved"
                                                {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected"
                                                {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <select name="tier" class="form-control">
                                            <option value="">All Tiers</option>
                                            <option value="free" {{ request('tier') === 'free' ? 'selected' : '' }}>
                                                Free</option>
                                            <option value="premium"
                                                {{ request('tier') === 'premium' ? 'selected' : '' }}>Premium</option>
                                        </select>
                                    </div>

                                    <div class="col-md-5 mb-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-search"></i> Search
                                        </button>
                                        <a href="{{ route('admin.enrollment.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-clockwise"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table mb-3">
                                    <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Course</th>
                                        <th>Tier</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($enrollments as $enroll)
                                        <tr>
                                            <td>{{ $enroll->user_name }}</td>
                                            <td>{{ $enroll->email }}</td>
                                            <td>{{ $enroll->phone }}</td>
                                            <td>{{ $enroll->course_title }}</td>
                                            <td>
                                                @if ($enroll->tier === 'free')
                                                    <span class="badge bg-success">FREE</span>
                                                @elseif($enroll->tier === 'premium')
                                                    <span class="badge bg-primary">PREMIUM</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($enroll->status === 'pending')
                                                    <span class="badge bg-warning text-dark">{{ ucfirst($enroll->status) }}</span>
                                                @elseif($enroll->status === 'approved')
                                                    <span class="badge bg-success">{{ ucfirst($enroll->status) }}</span>
                                                @elseif($enroll->status === 'rejected')
                                                    <span class="badge bg-danger">{{ ucfirst($enroll->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.users.show', $enroll->user_id) }}"
                                                   class="btn btn-sm btn-info"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-theme="dark"
                                                   title="View User Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.users.changePassword', $enroll->user_id) }}"
                                                   class="btn btn-sm btn-warning"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-theme="dark"
                                                   title="Change User Password">
                                                    <i class="bi bi-key-fill"></i>
                                                </a>
                                                <form action="{{ route('admin.user.delete', $enroll->user_id) }}"
                                                      method="POST"
                                                      style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                            class="btn btn-sm btn-danger delete-button"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            data-bs-theme="dark"
                                                            title="Delete User">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No enrollments found.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{ $enrollments->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('form');
                    const userId = form.dataset.userId;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit the form if the user confirms
                        }
                    })
                });
            });

            // Initialize Bootstrap tooltips
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        });
    </script>
@endpush