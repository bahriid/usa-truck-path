@extends('admin.layouts.main')
@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="row">
      <div class="col-md-6">
        <h2>Topics for Chapter: {{ $chapter->title }}</h2>
      </div>
      <div class="col-md-6 text-end">
        <a href="{{ route('chapters.index', [$courseId, $chapter->id]) }}" class="btn btn-secondary"> <i class="bi bi-arrow-left"></i></a>
        <a href="{{ route('topics.create', [$courseId, $chapter->id]) }}" class="btn btn-primary">Add Topic</a>
      </div>
    </div>
  </div>
  <div class="app-content">
    <div class="container-fluid">
      <div class="card card-primary card-outline mb-4">
        <div class="card-body">
        
          <table class="table mb-3">
            <thead>
              <tr>
                <th>Type</th>
                <th>Tier</th>
                <th>Title</th>
                <th>Duration</th>
                <th>Source</th>
                <th>Description</th>
                <th>Preview</th>
                <th style="width:20%;">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($topics as $topic)
                <tr>
                  <td>{{ ucfirst($topic->type) }}</td>
                  <td>
                    @if (($topic->tier ?? 'free') === 'free')
                      <span class="badge bg-success">FREE</span>
                    @elseif($topic->tier === 'premium')
                      <span class="badge bg-primary">PREMIUM</span>
                    @elseif($topic->tier === 'mentorship')
                      <span class="badge bg-warning text-dark">MENTORSHIP</span>
                    @endif
                  </td>
                  <td>{{ $topic->title }}</td>
                  <td>{{ $topic->duration ?? '-' }}</td>
                  <td>{{ $topic->source_from ?? '-' }}</td>
                  <td>{!! Str::limit($topic->description ?? '-') !!}</td>
                  <td>
                    @if($topic->type === 'video')
                        @if($topic->source_from === 'local' && $topic->local_video)
                            <video width="200" controls>
                                <source src="{{ asset('storage/' . $topic->local_video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @elseif(in_array($topic->source_from, ['youtube', 'vimeo', 'other']) && $topic->video_url)
                            <a href="{{ $topic->video_url }}" target="_blank">View Video</a>
                        @else
                            -
                        @endif
                
                    @elseif($topic->type === 'pdf' && $topic->pdf)
                        <iframe src="{{ asset('storage/' . $topic->pdf) }}" width="200" height="150"></iframe>
                        <br>
                        <a href="{{ asset('storage/' . $topic->pdf) }}" target="_blank">View PDF</a>
                
                    @elseif($topic->type === 'voice' && $topic->voice)
                        <audio controls>
                            <source src="{{ asset('storage/' . $topic->voice) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                
                    @elseif($topic->type === 'reading' && $topic->description)
                        <p>{!! Str::limit($topic->description, 100) !!}</p>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#readingModal{{ $topic->id }}">Read More</a>
                
                        <!-- Modal for Full Text -->
                        <div class="modal fade" id="readingModal{{ $topic->id }}" tabindex="-1" aria-labelledby="readingModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="readingModalLabel">{{ $topic->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ $topic->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                    @else
                        -
                    @endif
                </td>
                
                  <td>
                    <a href="{{ route('topics.edit', [$courseId, $chapter->id, $topic->id]) }}" class="btn btn-warning"><i class="bi bi-pen"></i></a>
                    <form action="{{ route('topics.destroy', [$courseId, $chapter->id, $topic->id]) }}" method="POST" style="display:inline;">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this topic?')"><i class="bi bi-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center">No topics found!</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          {{ $topics->links('pagination::bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
