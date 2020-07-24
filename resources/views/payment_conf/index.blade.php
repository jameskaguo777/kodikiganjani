@extends('layouts.app')
@section('content')

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Payment Configuration</h6>
        <p class="card-text"> </p>
        <hr>
       
        <form method="POST" action="{{ route('pay-conf-update') }}" autocomplete="off" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="exampleFormControlSelect1">Account Condition</label>
            
              <select name="status" class="form-control" id="exampleFormControlSelect1">
                @if ($conf->status)
                <option selected>Live</option>
                <option>Test</option>
                @else
                <option>Live</option>
                <option selected>Test</option>
                @endif
              </select>
            
                
            
              
            
            
            
          </div>

          <div class="form-group">
            <label for="nameInput">Test Username</label>
            <input value="{{ $conf->test_username }}" name="test_acc" type="text" class="form-control" id="testUser" placeholder="Enter Test Username">
          </div>
          <div class="form-group">
            <label for="valueInput">Test Password</label>
            <input value="{{ $conf->test_pass }}" name="test_pass" type="password" class="form-control" id="testPass" placeholder="Enter test password">
          </div>

          <div class="form-group">
            <label for="nameInput">Live Username</label>
            <input value="{{ $conf->live_username }}" name="live_acc" type="text" class="form-control" id="liveUser" placeholder="Enter live username">
          </div>
          <div class="form-group">
            <label for="valueInput">Live Password</label>
            <input value="{{ $conf->live_pass }}" name="live_pass" type="password" class="form-control" id="livePass" placeholder="Enter live password">
          </div>
          
          <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
          
        <hr>


      </div>

    </div>
  </div>
</div>
    
@endsection