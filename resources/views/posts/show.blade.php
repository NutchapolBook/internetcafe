@extends('layouts.masterCafe')
@section('content')
@include('layouts.editstyle')
  <div class="col-sm-12 blog-main w3-container w3-card-4 w3-margin">
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
          <form action="{{route('cafe.promotions.comments'  , ['post' => $post->id, 'cafename' =>  $cafename]) }}" method="POST">
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

    </div><br>

  </div>

@endsection
