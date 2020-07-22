@extends('layouts.app')
@section('content')



<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Current Tax Calculator Values</h6>
        <p class="card-description"> Used for calculating values in Tax Calculator in the app. changes to the app may take time depending on user activities. </p>
        <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Value</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach ($tax_calculator_values as $item)
                <tr>
                  <th>{{ $item->id }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->value }}</td>
                  <td>
                    <form action="{{ route('tax-calculator-delete', [ 'id'=>$item->id ]) }}" method="post">
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
        <h6 class="card-title">Add Tax Calculator Values</h6>
        <p class="card-text">Name filled is name of the value. <br> Value is double value take if percent, <code>20/100 = 0.2</code> so <code>0.2</code> will be the value. <b>The app multiply this value with the user input.</b>  </p>
        <hr>
       
        <form method="POST" action="{{ route('tax-calculator-store') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="nameInput">Name</label>
            <input name="name" type="text" class="form-control" id="nameInput" placeholder="Enter Name">
          </div>
          <div class="form-group">
            <label for="valueInput">Value</label>
            <input name="value" type="text" class="form-control" id="valueInput" placeholder="Enter Decimal value">
          </div>
         
    
          <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
          
        <hr>
        
        

        
          
       


      </div>

    </div>
  </div>
</div>
    
@endsection