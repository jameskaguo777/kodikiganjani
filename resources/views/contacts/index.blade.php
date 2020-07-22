@extends('layouts.app')
@section('content')



<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Contact Info in App</h6>
        <p class="card-description"> 1 contact is recommended. </p>
        <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Phone</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach ($contacts as $item)
                <tr>
                  <th>{{ $item->id }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->phone }}</td>
                  <td>
                    <form action="{{ route('contacts-delete', [ 'id'=>$item->id ]) }}" method="post">
                      @csrf
                      <input type="hidden" name="_method" value="delete">
                      <button type="submit" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#deletePost">
                        <i data-feather="delete"></i>
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
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Add Phone</h6>
        <p class="card-text"></p>
        <hr>
       
        <form method="POST" action="{{ route('contacts-store') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="nameInput">Name</label>
            <input name="name" type="text" class="form-control" id="nameInput" placeholder="Enter Name">
          </div>
          <div class="form-group">
            <label for="valueInput">Phone</label>
            <input name="phone" type="tel" class="form-control" id="valueInput" placeholder="Enter Phone number">
          </div>
         
    
          <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
          
        <hr>
        
        

        
          
       


      </div>

    </div>
  </div>
</div>
    
@endsection