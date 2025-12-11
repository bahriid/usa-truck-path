@extends('admin.layouts.main')
@section('content')
<main class="app-main">

    <div class="app-content-header">
        <div class="row ">
            <div class="col-md-6 col-sm-12">
                <h2>Courses</h2>

            </div>

        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row ">
                <div class="card card-primary card-outline mb-4">

                    <div class="card-header">
                        <div class="header d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Add Course</a>
                            <small class="text-muted"><i class="bi bi-arrows-move"></i> Drag rows to reorder courses</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" >
                            <thead>
                                <tr>
                                    <th style="width: 40px;"></th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Original Price</th>
                                    <th>Premium Tier</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="sortable-courses">
                                @forelse ($courses as $course)
                                <tr data-id="{{ $course->id }}" style="cursor: grab;">
                                    <td class="drag-handle"><i class="bi bi-grip-vertical"></i></td>
                                    <td> <img src="{{ Storage::url($course->image) }}"  style="height: 50px; width: 50px;border-radius: 50%;"/></td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->category ?? '' }}</td>
                                    <td>{{ ucfirst($course->status) }}</td>
                                    <td>${{ $course->price }}</td>
                                    <td>{{ $course->original_price ? '$' . $course->original_price : '-' }}</td>
                                    <td>
                                        <span class="badge bg-primary">${{ number_format($course->premium_price ?? 150, 0) }}</span>
                                    </td>
                                    <td>{{ $course->is_active ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('admin.courses.edit', $course) }}"
                                            class="btn btn-warning btn-sm"> <i class="bi bi-pencil"></i></a>
                                            <a href="{{ route('chapters.index', $course->id) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-play-circle"></i> Content
                                            </a>

                                        <form action="{{ route('admin.courses.destroy', $course) }}" method="POST"
                                            style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this course?')"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="11">No Course found !</td>
                                </tr>
                                @endforelse



                            </tbody>
                        </table>

                        {{$courses->links('pagination::bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tbody = document.getElementById('sortable-courses');

        if (tbody) {
            new Sortable(tbody, {
                animation: 150,
                handle: '.drag-handle',
                ghostClass: 'bg-light',
                onEnd: function() {
                    const order = [];
                    tbody.querySelectorAll('tr[data-id]').forEach((row, index) => {
                        order.push({
                            id: row.dataset.id,
                            position: index + 1
                        });
                    });

                    fetch('{{ route("admin.courses.reorder") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ order: order })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Show success toast or notification
                        console.log(data.message);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to save order. Please try again.');
                    });
                }
            });
        }
    });
</script>
@endsection