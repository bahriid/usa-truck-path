@extends('admin.layouts.main')
@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="row">
      <div class="col-md-6">
        <h2>Edit Topic for Chapter: {{ $chapter->title }}</h2>
      </div>

      <div class="col-md-6 text-end">
        <a href="{{ route('topics.index', [$courseId, $chapter->id]) }}" class="btn btn-secondary"> <i class="bi bi-arrow-left"></i></a>
  
      </div>
    </div>
  </div>
  <div class="app-content">
    <div class="container-fluid">
      <div class="card card-primary card-outline mb-4">
        <div class="card-body">
          <form action="{{ route('topics.update', [$courseId, $chapter->id, $topic->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group mb-3">
              <label for="type">Topic Type</label>
              <select name="type" id="topicType" class="form-control" required>
                <option value="">-- Select Type --</option>
                <option value="video" {{ $topic->type == 'video' ? 'selected' : '' }}>Video</option>
                <option value="reading" {{ $topic->type == 'reading' ? 'selected' : '' }}>Reading</option>
                <option value="pdf" {{ $topic->type == 'pdf' ? 'selected' : '' }}>Pdf</option>
                <option value="voice" {{ $topic->type == 'voice' ? 'selected' : '' }}>Voice</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="title">Topic Title</label>
              <input type="text" name="title" class="form-control" value="{{ $topic->title }}" required>
            </div>

            <!-- Tier Selection -->
            <div class="form-group mb-3">
              <label for="tier">Access Tier</label>
              <select name="tier" id="tier" class="form-control" required>
                <option value="free" {{ ($topic->tier ?? 'free') == 'free' ? 'selected' : '' }}>Free - Accessible to all users</option>
                <option value="premium" {{ ($topic->tier ?? 'free') == 'premium' ? 'selected' : '' }}>Premium - Requires premium tier</option>
                <option value="mentorship" {{ ($topic->tier ?? 'free') == 'mentorship' ? 'selected' : '' }}>Mentorship - Requires mentorship tier</option>
              </select>
              <small class="form-text text-muted">
                Select the access tier required to view this topic. Free topics are visible to all enrolled users.
              </small>
            </div>

            <!-- Video-specific fields -->
            <div id="videoFields" style="display: none;">
              <div class="form-group mb-3">
                <label for="duration">Duration</label>
                <input type="text" name="duration" class="form-control" value="{{ $topic->duration }}">
              </div>
              <div class="form-group mb-3">
                <label for="source_from">Video Source</label>
                <select name="source_from" id="videoSource" class="form-control">
                  <option value="">-- Select Source --</option>
                  <option value="youtube" {{ $topic->source_from == 'youtube' ? 'selected' : '' }}>YouTube</option>
                  <option value="vimeo" {{ $topic->source_from == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                  <option value="local" {{ $topic->source_from == 'local' ? 'selected' : '' }}>Local</option>
                  <option value="other" {{ $topic->source_from == 'other' ? 'selected' : '' }}>Other</option>
                </select>
              </div>
              <div class="form-group mb-3" id="videoUrlField" style="display: none;">
                <label for="video_url">Video URL</label>
                <input type="url" name="video_url" class="form-control" value="{{ $topic->video_url }}">
              </div>
              <div class="form-group mb-3" id="localVideoField" style="display: none;">
                <label for="local_video">Upload Video</label>
                <input type="file" name="local_video" class="form-control">
                @if($topic->local_video)
                  <p>Current file: {{ $topic->local_video }}</p>
                @endif
              </div>
            </div>
            <!-- Reading-specific fields -->
            <div id="readingFields" style="display: none;">
              <div class="form-group mb-3">
                <label for="description">Reading Description</label>
                <textarea id="description" name="description" class="form-control">{!! $topic->description !!}</textarea>
              </div>
            </div>

             <!-- pdf-specific fields -->
             <div id="pdfFields" style="display: none;">
              <div class="form-group mb-3">

                @if($topic->type === 'pdf' && $topic->pdf)
                <iframe src="{{ asset('storage/' . $topic->pdf) }}" width="200" height="150"></iframe>
                <br>
                <a href="{{ asset('storage/' . $topic->pdf) }}" target="_blank">View PDF</a>
                @endif
        
          
                <label for="pdf">Upload Pdf</label>

                <input type="file" name="pdf" class="form-control" accept=".pdf">
              </div>
            </div>
            <!-- voice-specific fields -->
            <div id="voiceFields" style="display: none;">
              <div class="form-group mb-3">
                @if($topic->type === 'voice' && $topic->voice)
                <audio controls>
                    <source src="{{ asset('storage/' . $topic->voice) }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
                @endif
                {{-- <label for="voice">Upload Audio</label> --}}
                <input type="file" name="voice" class="form-control" accept="audio/*">
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Topic</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>


@push('scripts')
<script src="{{asset('asset_admin/vendor/ckeditor/ckeditor.js')}}"></script>



     
<script>
     // Replace the summary textarea with CKEditor
     CKEDITOR.replace('description');
  function toggleFields() {
    var type = document.getElementById('topicType').value;
    var videoFields = document.getElementById('videoFields');
    var readingFields = document.getElementById('readingFields');
    var pdfFields = document.getElementById('pdfFields');
    var voiceFields = document.getElementById('voiceFields');

    videoFields.style.display = (type === 'video') ? 'block' : 'none';
    readingFields.style.display = (type === 'reading') ? 'block' : 'none';
    pdfFields.style.display = (type === 'pdf') ? 'block' : 'none';
    voiceFields.style.display = (type === 'voice') ? 'block' : 'none';
  }

  // Run toggle on page load
  toggleFields();

  document.getElementById('topicType').addEventListener('change', function() {
    toggleFields();
  });

  document.getElementById('videoSource').addEventListener('change', function(){
    var source = this.value;
    var videoUrlField = document.getElementById('videoUrlField');
    var localVideoField = document.getElementById('localVideoField');
    if(source === 'local'){
      localVideoField.style.display = 'block';
      videoUrlField.style.display = 'none';
    } else if(source === 'youtube' || source === 'vimeo' || source === 'other'){
      videoUrlField.style.display = 'block';
      localVideoField.style.display = 'none';
    } else {
      videoUrlField.style.display = 'none';
      localVideoField.style.display = 'none';
    }
  });
</script>
@endpush
@endsection
