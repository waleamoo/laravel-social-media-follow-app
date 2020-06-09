@extends('layouts.app')

@section('content')
<section class="row new-post">
    <div class="col-md-6 offset-md-3">
        <header><h3>Your Account</h3></header>
        <form action="{{ route('accountSave') }}" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ $user->name}}" id="first_name">
            </div>
            <div class="form-group">
                <label for="image">Image (only .jpg)</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>
            <button type="submit" class="btn btn-primary">Save Account</button>
            @csrf
        </form>
    </div>
</section>
@if (Storage::disk('local')->has($user->name . '-' . $user->id . '.jpg'))
    <section class="row new-post">
        <div class="col-md-6 offset-md-3">
        <img src="{{ route('accountImage', ['filename' => $user->name . '-' . $user->id . '.jpg']) }}" alt="" class="img-responsive" width="300" height="350">
        </div>
    </section>
@endif
@endsection