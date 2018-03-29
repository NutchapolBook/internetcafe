@extends('layouts.master')

@section('content')
  <div class="col-sm-8 blog-main">
      <h1>{{$post->title}}</h1>
      <hr>
      {{$post->body}}
      <hr><br>

      <div class="comment">
          <h3>Comments</h1>
      @foreach ($post->comments as $comment)

          <strong>
            {{$comment->created_at->diffForHumans()}}: &nbsp;
          </strong>
            {{$comment->body}}
            <br>
      @endforeach
      </div>

      <hr>

      {{-- //add comment --}}

      <div class="card">
        <div class="card-block">
          <form action="/posts/{{$post->id}}/comments" method="POST">
          {{ csrf_field() }}
            <div class="form-group">
              <textarea name="body" id="body" class="form-control" rows="5" placeholder="Your comment here." required></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add comment</button>
            </div>
        </div>
        </form>
        {{-- @include('layouts.error) --}}

      </div>

  </div>

@endsection
