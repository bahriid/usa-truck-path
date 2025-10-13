@extends('admin.layouts.main')
@section('content')
<main class="app-main">

    <div class="app-content-header">
        <div class="row ">
            <div class="col-md-6 col-sm-12">
                <h2>Slider</h2>

            </div>

        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row ">
                <div class="card card-primary card-outline mb-4">

                    <div class="card-header">
                        <div class="header">
                            <a href="{{ route('sliders.create') }}" class="btn btn-primary">Add Slider</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="sliderTable"  cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $key => $slider)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ asset('storage/'.$slider->image) }}" width="100"></td>
                                    <td>{{Str::limit( $slider->title ,60)}}</td>
                                   <td>{!! nl2br(e(Str::limit(wordwrap($slider->subtitle, 30, "\n", true), 100))) !!}</td>

                                    <td>{{ $slider->is_active ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this slider?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
            
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
