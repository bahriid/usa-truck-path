@extends('admin.layouts.main')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h2>Contacts</h2>
            </div>
        </div>
    </div>
    
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <div class="header">List</div>
                    </div>
                    <div class="card-body">

                        <!-- Status Filter Form -->
                        <form method="GET" action="{{ url('/admin/contacts') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        <option value="">All Status</option>
                                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Contacted" {{ request('status') == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                                        <option value="No Response" {{ request('status') == 'No Response' ? 'selected' : '' }}>No Response</option>
                                        <option value="Call Later" {{ request('status') == 'Call Later' ? 'selected' : '' }}>Call Later</option>
                                        <option value="Closed" {{ request('status') == 'Closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                        <table class="table table-bordered mb-3">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Update Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{!! nl2br(e(Str::limit(wordwrap($contact->subject, 30, "\n", true), 100))) !!}</td>
                                    <td>{!! nl2br(e(Str::limit(wordwrap($contact->message, 30, "\n", true), 100))) !!}</td>
                                    <td>{{ $contact->status }}</td>
                                    <td>
                                        <form action="{{ url('/admin/contacts/' . $contact->id . '/status') }}" method="POST">
                                            @csrf
                                            <select name="status" onchange="this.form.submit()">
                                                <option value="Pending" {{ $contact->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Contacted" {{ $contact->status == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                                                <option value="No Response" {{ $contact->status == 'No Response' ? 'selected' : '' }}>No Response</option>
                                                <option value="Call Later" {{ $contact->status == 'Call Later' ? 'selected' : '' }}>Call Later</option>
                                                <option value="Closed" {{ $contact->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $contacts->appends(['status' => request('status')])->links('pagination::bootstrap-5') }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
