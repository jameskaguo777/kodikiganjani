@extends('layouts.app')
@section('content')



<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Current Active Users</h6>
        <p class="card-description"> </p>
        <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>email</th>
                  <th>Package</th>
                  <th>Expiration Date</th>

                  
                </tr>
              </thead>
              <tbody>
                @foreach ($subscribers as $subscriber)
                <tr>
                  <th>{{ $subscriber->id }}</th>
                  <th>{{ $subscriber->user->name }}</th>
                  <td>{{ $subscriber->user->email }}</td>
                  <td>{{ $subscriber->packages->name }}</td>
                  <td>{{ $subscriber->expiration }}</td>
                  <td>
                    {{-- <form action="{{ route('tax-calculator-delete', [ 'id'=>$item->id ]) }}" method="post">
                      @csrf
                      <input type="hidden" name="_method" value="delete">
                      <button type="submit" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#deletePost">
                        <i data-feather="delete"></i>
                      </button>
                    </form> --}}
                    
                  </td>
                </tr>
                @endforeach
                
                
              </tbody>
            </table>
        </div>
      </div>
    </div>


    
  </div>
  
</div>
    
@endsection