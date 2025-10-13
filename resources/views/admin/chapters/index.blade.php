@extends('admin.layouts.main')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="row">
            <div class="col-md-6">
                <h2>Chapters for Course: {{ $course->title }}</h2>
            </div>
            <div class="col-md-6 text-end">
           
                    <a href="{{ route('admin.courses.index', $course->id) }}" class="btn btn-secondary"> <i class="bi bi-arrow-left"></i></a>
               
                <a href="{{ route('chapters.create', $course->id) }}" class="btn btn-primary">Add Chapter</a>
            
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <div class="card-body">
                
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th style="width:20%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                            @forelse ($chapters as $chapter)
                                <tr data-id="{{ $chapter->id }}">
                                    <td>{{ $chapter->title }}</td>
                                    <td>{{ $chapter->description }}</td>
                                    <td>
                                        <a href="{{ route('chapters.edit', ['course' => $course->id, 'chapter' => $chapter->id]) }}" class="btn btn-warning"><i class="bi bi-pen"></i></a>
                                        <a href="{{ route('topics.index', ['course' => $course->id, 'chapter' => $chapter->id]) }}" class="btn btn-primary">Add Topics</a>
                                        <form action="{{ route('chapters.destroy', ['course' => $course->id, 'chapter' => $chapter->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this chapter?')"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No chapters found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                        
                    </table>
                    {{ $chapters->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</main>
@push('styles')
    <style>
        tbody{
            /* display: block;/ */
        }
        tbody:hover{
            cursor: move;
        }
    </style>
@endpush

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(function() {
        $("#sortable").sortable({
            update: function(event, ui) {
                let order = [];
                $("#sortable tr").each(function(index, element) {
                    order.push({ id: $(this).data("id"), position: index + 1 });
                });

                $.ajax({
                    url: "{{ route('chapters.reorder') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        order: order
                    },
                    success: function(response) {
                        console.log(response.message);
                    }
                });
            }
        });
    });
</script>

 
@endpush
@endsection
