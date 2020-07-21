@extends('layouts.app')
@section('content')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/simplemde/simplemde.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />

@endpush

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Create Post</h6>
        <form method="POST" action="{{ route('news-create-store') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="exampleInputText1">News Title</label>
            <input name="title" type="text" class="form-control" id="exampleInputText1" placeholder="Enter Very Short News Titile">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Summary</label>
            <input name="summary" type="text" class="form-control" id="exampleInputEmail3" placeholder="Enter Very Short Summary">
          </div>
         <div class="form-group">
            <label for="tinymceExample">Post Content</label>
            <textarea name="post" class="form-control" name="tinymce" id="tinymceExample" rows="10"></textarea>
         </div>
         <div class="form-group">
           <label for="myDropify"></label>
           <input name="featured_image_url" type="file" id="myDropify" class="border"/>
         </div>
         <div class="form-group">
           <label for="tags">Tags (Separate with comma)</label>
           <input name="tags" id="tags" />
         </div>
    
          <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
      </div>
    </div>
  </div>
</div>
    
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/plugins/simplemde/simplemde.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/ace-builds/ace.js') }}"></script>
  <script src="{{ asset('assets/plugins/ace-builds/theme-chaos.js') }}"></script> --}}
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/tinymce.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/simplemde.js') }}"></script>
  <script src="{{ asset('assets/js/ace.js') }}"></script> --}}
@endpush