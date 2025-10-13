@extends('admin.layouts.main')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h2>Users List</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-md-end">
                <!-- Search Form -->
                <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex justify-content-end">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search users..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <div class="header">
                            Lists
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover mb-3" id="sliderTable" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info">View</a>
                                            <a href="{{ route('admin.users.changePassword', $user->id) }}" class="btn btn-sm btn-warning">Change Password</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $users->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
