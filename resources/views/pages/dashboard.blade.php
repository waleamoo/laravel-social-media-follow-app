@extends('layouts.app')

@section('content')
<div class="container">
    <section class="row new-post">
        <div class="col-md-6  offset-md-3">
            <header>
                <h3>What do you have to say?</h3>
            </header>
            @include('includes.message')
            <form action="{{ route('postCreate') }}" method="POST">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" cols="30" rows="10"
                        placeholder="Your comment"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
                @csrf
            </form>
        </div>
    </section>

    <section class="row posts">
        <div class="col-md-6 offset-md-3">
            <header>
                <h3>What other people say..</h3>
            </header>
            @foreach ($posts as $post)
            <article class="post" data-postid="{{ $post->id }}">
                    <p>{{$post->body}}</p>
                    <div class="info">
                        Posted by {{$post->user->name}} on {{$post->created_at}}
                    </div>
                    <div class="interaction">
                        <a href="#">Like | </a>
                        <a href="#">Dislike </a>
                        @if (Auth::user() == $post->user)
                            |
                            <a href="#" data-target="#edit-modal"  class="edit">Edit | </a>
                            <a href="{{ route('getDelete', ['id' => $post->id]) }}">Delete</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</div>
<!-- modal section -->
<div class="modal" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Post</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="">
                  <div class="form-group">
                      <label for="post-body">Edit the Post</label>
                      <textarea class="form-control" id="post-body" cols="30" rows="10"></textarea>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
            </div>
          </div>
        </div>
      </div>

      <script>
          var token = '{{ Session::token() }}'; 
          var url = '{{ route('edit') }}';
    </script>
@endsection