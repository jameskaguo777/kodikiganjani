@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      @if (Storage::disk('public')->exists($newspost->featured_image_url))
      <img src="{{ Storage::url($newspost->featured_image_url) }}" class="card-img-top" alt="...">
      @else
      <img src="https://miro.medium.com/max/3150/1*J_BOSSzUz4qBvAjFb-YgZA@2x.jpeg" class="card-img-top" alt="...">
      @endif
      <div class="card-body">
        <h6 class="card-title">{{ $newspost->title }}</h6>
        <p class="card-text">{{ $newspost->summary }}</p>
        <hr>
       
          {!! $newspost->post !!}
        <hr>
        <button type="button" onclick="window.location='{{ route('news-edit', ['id'=>$newspost->id]) }}'" class="btn btn-primary btn-icon">
          <i data-feather="edit"></i>
        </button>
        <button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#deletePost">
          <i data-feather="delete"></i>
        </button>

        
          
       


      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deletePost" tabindex="-1" role="dialog" aria-labelledby="deletePostLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletePostLabel">You're about to delete the post!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span class="badge badge-danger">THIS ACTION CANNOT BE REVERTED</span>
        <hr>
        {{ $newspost->title }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <form action="{{ route('news-show-delete', [ 'id'=>$newspost->id ]) }}" method="post">
          
          @csrf
          <input type="hidden" name="_method" value="delete">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        
      </div>
    </div>
  </div>
</div>
    
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
@endpush