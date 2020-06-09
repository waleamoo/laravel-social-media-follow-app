@if(count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger error" role="alert">
          <h4 class="alert-heading"></h4>
          <p>{{ $error }}</p>
          <p class="mb-0"></p>
        </div>
    @endforeach
@endif  

@if (session('success'))
    <div class="alert alert-success success" role="alert">
        <p>{{ session('success') }}</p>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" role="alert">
        <p>{{ session('error') }}</p>
    </div>
@endif