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
                        <div class="header">
                            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Add Course</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" >
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>Title</th>
                                    <th>Category</th>

                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Original Price</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody  >
                                @forelse ($courses as $course)
                                <tr >
                                    <td> <img src="{{ Storage::url($course->image) }}"  style="height: 50px; width: 50px;border-radius: 50%;"/></td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->category ?? '' }}</td>

                                    <td>{{ ucfirst($course->status) }}</td>
                                    <td>${{ $course->price }}</td>
                                    <td>{{ $course->original_price ? '$' . $course->original_price : '-' }}</td>
                                    <td>{{ $course->is_active ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('admin.courses.edit', $course) }}"
                                            class="btn btn-warning"> <i class="bi bi-pencil"></i></a>
                                            <a href="{{ route('chapters.index', $course->id) }}" class="btn btn-info">
                                                <i class="bi bi-play-circle"></i> Manage Content
                                            </a>
                                        
                                        <form action="{{ route('admin.courses.destroy', $course) }}" method="POST"
                                            style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Delete this course?')"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="8">No Course found !</td>
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