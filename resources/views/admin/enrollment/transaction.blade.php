@extends('admin.layouts.main')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h2>Transactions</h2>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <div class="header">
                            Transaction List
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.transaction.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <input type="text" name="search" class="form-control" placeholder="Search by Name, Email, Course, or Transaction ID" value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ route('admin.transaction.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table mb-3">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Course Name</th>
                                        <th>Price</th>
                                        <th>Transaction ID</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->user_name }}</td>
                                            <td>{{ $transaction->user_email }}</td>
                                            <td>{{ $transaction->course_title }}</td>
                                            <td>${{ number_format($transaction->transaction_amount, 2) }}</td>
                                            <td>{{ $transaction->transaction_id }}</td>
                                            <td>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No transactions found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $transactions->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
