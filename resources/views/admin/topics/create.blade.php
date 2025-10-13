@extends('admin.layouts.main')
@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="row">
      <div class="col-md-6">
        <h2>Add Topic for Chapter: {{ $chapter->title }}</h2>
      </div>
    </div>
  </div>
  <div class="app-content">
    <div class="container-fluid">
      <div class="card card-primary card-outline mb-4">
        @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
                 <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="card-body">
          <form action="{{ route('topics.store', [$courseId, $chapter->id]) }}" method="POST">
            @csrf

            <!-- Topic Type and Title -->
            <div class="form-group mb-3">
              <label for="type">Topic Type</label>
              <select name="type" id="topicType" class="form-control" required>
                <option value="">-- Select Type --</option>
                <option value="video">Video</option>
                <option value="reading">Reading</option>
                <option value="pdf">Pdf</option>
                <option value="voice">Voice</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="title">Topic Title</label>
              <input type="text" name="title" class="form-control" placeholder="Enter topic title" required>
            </div>

            <!-- Video-specific Fields -->
            <div id="videoFields" style="display: none;">
              <div class="form-group mb-3">
                <label for="duration">Duration</label>
                <input type="text" name="duration" class="form-control" placeholder="e.g., 10:30">
              </div>
              <div class="form-group mb-3">
                <label for="source_from">Video Source</label>
                <select name="source_from" id="videoSource" class="form-control">
                  <option value="">-- Select Source --</option>
                  <option value="youtube">YouTube</option>
                  <option value="vimeo">Vimeo</option>
                  <option value="local">Local</option>
                  <option value="other">Other</option>
                </select>
              </div>
              <!-- Video URL field for remote sources -->
              <div class="form-group mb-3" id="videoUrlField" style="display: none;">
                <label for="video_url">Video URL</label>
                <input type="url" name="video_url" class="form-control" placeholder="Enter video URL">
              </div>
              <!-- Local Video Chunk Upload Field for local video -->
              <div id="localVideoUpload" class="form-group mb-3" style="display: none;">
                <label>Upload Video (Local)</label>
                <button type="button" id="browseLocalVideo" class="btn btn-secondary">Browse Video File</button>
                <div id="localVideoProgress" class="progress mt-2" style="display:none; height: 25px;">
                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;">0%</div>
                </div>
                <!-- Hidden field will store the returned video filename -->
                <input type="hidden" name="local_video" id="local_video">
              </div>
            </div>

            <!-- Reading-specific Fields -->
            <div id="readingFields" style="display: none;">
              <div class="form-group mb-3">
                <label for="description">Reading Description</label>
                <textarea id="description" name="description" class="form-control" placeholder="Enter description"></textarea>
              </div>
            </div>

            <!-- PDF-specific Fields (Chunk Upload) -->
            <div id="pdfUpload" class="form-group mb-3" style="display: none;">
              <label>Upload PDF</label>
              <button type="button" id="browsePdf" class="btn btn-secondary">Browse PDF File</button>
              <div id="pdfProgress" class="progress mt-2" style="display:none; height: 25px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;">0%</div>
              </div>
              <input type="hidden" name="pdf" id="pdf">
            </div>

            <!-- Voice-specific Fields (Chunk Upload) -->
            <div id="voiceUpload" class="form-group mb-3" style="display: none;">
              <label>Upload Audio</label>
              <button type="button" id="browseVoice" class="btn btn-secondary">Browse Audio File</button>
              <div id="voiceProgress" class="progress mt-2" style="display:none; height: 25px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;">0%</div>
              </div>
              <input type="hidden" name="voice" id="voice">
            </div>

            <button type="submit" id="submitTopic" class="btn btn-primary">Add Topic</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

@push('scripts')
<!-- Include jQuery, CKEditor, and Resumable.js via CDN -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="{{ asset('asset_admin/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
<script>
  // Initialize CKEditor for reading description if it exists.
  if(document.getElementById('description')){
    CKEDITOR.replace('description');
  }

  // Toggle fields based on the selected topic type.
  document.getElementById('topicType').addEventListener('change', function() {
      var type = this.value;

      // Show/hide sections based on topic type.
      document.getElementById('videoFields').style.display = (type === 'video') ? 'block' : 'none';
      document.getElementById('readingFields').style.display = (type === 'reading') ? 'block' : 'none';
      document.getElementById('pdfUpload').style.display = (type === 'pdf') ? 'block' : 'none';
      document.getElementById('voiceUpload').style.display = (type === 'voice') ? 'block' : 'none';

      // If video, reset video source fields.
      if(type === 'video'){
          document.getElementById('videoUrlField').style.display = 'none';
          document.getElementById('localVideoUpload').style.display = 'none';
      }
  });

  // Toggle video source fields based on selection.
  document.getElementById('videoSource').addEventListener('change', function(){
      var source = this.value;
      var videoUrlField = document.getElementById('videoUrlField');
      var localVideoUpload = document.getElementById('localVideoUpload');
      if(source === 'local'){
          localVideoUpload.style.display = 'block';
          videoUrlField.style.display = 'none';
      } else if(source === 'youtube' || source === 'vimeo' || source === 'other'){
          videoUrlField.style.display = 'block';
          localVideoUpload.style.display = 'none';
      } else {
          videoUrlField.style.display = 'none';
          localVideoUpload.style.display = 'none';
      }
  });

  /**
   * Checks if any upload progress bar is visible.
   * If yes, disable the submit button and update its text.
   */
  function checkUploads() {
      if ($('#localVideoProgress').is(':visible') || $('#pdfProgress').is(':visible') || $('#voiceProgress').is(':visible')) {
          $('#submitTopic').prop('disabled', true).text('Uploading...');
      } else {
          $('#submitTopic').prop('disabled', false).text('Add Topic');
      }
  }

  /**
   * Create a Resumable.js instance for a given file type.
   *
   * @param {string} browseButtonId - The selector for the browse button.
   * @param {string} progressBarSelector - The selector for the progress bar container.
   * @param {string} hiddenInputSelector - The selector for the hidden input field.
   * @param {string} fileType - The file type (local_video, pdf, voice).
   */
  function createResumableInstance(browseButtonId, progressBarSelector, hiddenInputSelector, fileType) {
      var browseButton = $(browseButtonId);
      var resumable = new Resumable({
          target: '{{ route("files.upload.chunk") }}',
          query: { _token: '{{ csrf_token() }}', file_type: fileType },
          chunkSize: 10 * 1024 * 1024, // 10MB chunks
          testChunks: false,
          throttleProgressCallbacks: 1
      });
      resumable.assignBrowse(browseButton[0]);

      resumable.on('fileAdded', function(file) {
          $(progressBarSelector).show();
          checkUploads();
          resumable.upload();
      });

      resumable.on('fileProgress', function(file) {
          var progress = Math.floor(file.progress() * 100);
          $(progressBarSelector + ' .progress-bar').css('width', progress + '%').html(progress + '%');
      });

      resumable.on('fileSuccess', function(file, response) {
          response = JSON.parse(response);
          $(hiddenInputSelector).val(response.filename);
          $(progressBarSelector).hide();
          checkUploads();
      });

      resumable.on('fileError', function(file, response) {
          alert('File uploading error for ' + fileType);
          $(progressBarSelector).hide();
          checkUploads();
      });
  }

  // Initialize the resumable uploaders when the document is ready.
  $(document).ready(function() {
      createResumableInstance('#browseLocalVideo', '#localVideoProgress', '#local_video', 'local_video');
      createResumableInstance('#browsePdf', '#pdfProgress', '#pdf', 'pdf');
      createResumableInstance('#browseVoice', '#voiceProgress', '#voice', 'voice');
  });
</script>
@endpush
@endsection
