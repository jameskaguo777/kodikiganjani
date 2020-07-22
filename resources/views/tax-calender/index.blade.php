@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')


<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Add Tax Events in the calendar</h6>
        <p class="card-description">  </p>
        <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Summary</th>
                  <th>Tax Date</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach ($calender as $item)
                <tr>
                  <th>{{ $item->id }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->summary }}</td>
                  <td>{{ $item->tax_date }}</td>
                  <td>
                    <form action="{{ route('tax-calender-delete', [ 'id'=>$item->id ]) }}" method="post">
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
        <h6 class="card-title">Add Tax Calender</h6>
        <p class="card-text"> </p>
        <hr>
       
        <form method="POST" action="{{ route('tax-calender-store') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="nameInput">Name</label>
            <input name="name" type="text" class="form-control" id="nameInput" placeholder="Enter Name">
          </div>
          <div class="form-group">
            <label for="valueInput">Summary</label>
            <input name="summary" type="text" class="form-control" id="summaryInput" placeholder="Enter Decimal value">
          </div>

          <div class="form-group">
            <div class="input-group date datepicker" id="datePickerExample">
              <input name="tax_date" type="text" class="form-control"><span class="input-group-addon"><i data-feather="calendar"></i></span>
            </div>
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
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('custom-scripts')
  
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  
@endpush

