@extends('layouts.app')
@section('content')

<div class="row">

  @foreach ($newsposts as $item)
  <div class="col-12 col-md-4 col-xl-6 mb-3">

    <div class="card">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{ $item->title }}</h5>
        <p class="card-text">{{ $item->summary }}</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
    

  </div>

  @endforeach
  
  
</div>





    
@endsection