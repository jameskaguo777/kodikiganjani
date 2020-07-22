
@if (count($errors) > 0)
<div class="alert alert-danger">
  <h4 class="alert-heading">Errors</h4>
    <ul>
        @foreach ($errors->all() as $error)
        <p><li>{{ $error }}</li></p>
        @endforeach
        
    </ul>
    <hr>
    <p class="mb-0">If problem persist please contact your Admin</p>
</div>

@endif 
@if (session('status'))
<div class="alert alert-{{ session('status')['status'] }}" role="alert">{{ session('status')['message'] }}</div>
@endif




