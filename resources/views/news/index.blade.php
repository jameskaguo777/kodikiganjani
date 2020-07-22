@extends('layouts.app')
@section('content')

<div class="row">

  @foreach ($newsposts as $item)
  <div class="col-12 col-md-4 col-xl-6 mb-3">

    <div class="card">
      @if (Storage::disk('public')->exists($item->featured_image_url))
      <img src="{{ Storage::url($item->featured_image_url) }}" class="card-img-top" alt="...">
      @else
      <img src="https://miro.medium.com/max/3150/1*J_BOSSzUz4qBvAjFb-YgZA@2x.jpeg" class="card-img-top" alt="...">
      @endif
      
      <div class="card-body">
        <h5 class="card-title">{{ $item->title }}</h5>
        
        <p class="card-text">{{ $item->summary }}</p>

        
        <a href="{{ route('news-show', [ 'id'=>$item->id ]) }}" class="btn btn-primary">Read Post</a>
      </div>
    </div>
    

  </div>

  @endforeach

  
  
  
</div>

<ul class="pagination justify-content-center">
  {{ $newsposts->links() }}
</ul>



    
@endsection