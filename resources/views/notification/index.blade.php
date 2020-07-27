@extends('layouts.app')
@push('plugin-styles')
  {{-- <link href="{{ asset('assets/plugins/simplemde/simplemde.min.css') }}" rel="stylesheet" /> --}}
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  {{-- <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" /> --}}
  {{-- <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" /> --}}
  {{-- <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" /> --}}
  {{-- <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" /> --}}
@endpush
@section('content')

<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Notifications</h6>
        <p class="card-description"> Notifications visible to app user. </p>
        <div class="chat-header border-bottom pb-2">
          

            @foreach ($notifications as $item)
            <div class="d-flex justify-content-between mt-4">
            <div class="d-flex align-items-center">
              <i data-feather="corner-up-left" id="backToChatList" class="icon-lg mr-2 ml-n2 text-muted d-lg-none"></i>
              <figure class="mb-0 mr-2">
                @if (Storage::disk('public')->exists($item->featured_image_url))
                <img src="{{ Storage::url($item->featured_image_url) }}" class="img-sm rounded-circle" alt="image">
                @else
                <img src="https://via.placeholder.com/800x300" class="img-sm rounded-circle" alt="image">
                @endif
                {{-- <img src="{{ url('https://via.placeholder.com/43x43') }}" class="img-sm rounded-circle" alt="image"> --}}
                {{-- <div class="status online"></div>
                <div class="status online"></div> --}}
              </figure>
              <div>
                <p>{{ $item->title }}</p>
                <p class="text-muted tx-13">{{ $item->summary }}</p>
                
                  <p class="text-muted tx-13 mt-1">{{ $item->created_at->diffForHumans() }}</p>
                 
                
              </div>
            </div>
            <div class="d-flex align-items-center mr-n1">
              
              <form action="{{ route('noti-delete', [ 'id'=>$item->id ]) }}" method="post">
                @csrf
                <input type="hidden" name="_method" value="delete">
                <button type="submit" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#deletePost">
                  <i data-feather="delete"></i>
                </button>
              </form>
            </div>
          </div>
            @endforeach
           


            
          
        </div>
      </div>
    </div>


    
  </div>
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Create Notification</h6>
        <p class="card-text">This is instant Notification program, after creating users will be notified instantly. </p>
        <hr>
       
        <form method="POST" action="{{ route('noti-store') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="nameInput">Title</label>
            <input name="title" type="text" class="form-control" id="nameInput" placeholder="Enter Title">
          </div>
          <div class="form-group">
            <label for="valueInput">Content (Notification should be short)</label>
            <input name="summary" type="text" class="form-control" id="valueInput" placeholder="Enter notification content">
          </div>
          <div class="form-group">
            <label for="myDropify">Small Image</label>
            <input name="featured_image_url" type="file" id="myDropify" class="border"/>
          </div>
    
          <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
          
        <hr>

      </div>

    </div>
  </div>
</div>
    
@endsection

@push('plugin-scripts')
  {{-- <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script> --}}
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/plugins/simplemde/simplemde.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/plugins/ace-builds/ace.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/plugins/ace-builds/theme-chaos.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script> --}}
@endpush

@push('custom-scripts')
  {{-- <script src="{{ asset('assets/js/tinymce.js') }}"></script> --}}
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/simplemde.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/js/ace.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/js/tags-input.js') }}"></script> --}}
@endpush