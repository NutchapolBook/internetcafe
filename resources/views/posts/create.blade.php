@extends('layouts.masterCafe')

@section('content')
@include('layouts.editstyle')
<div class="col-sm-12 blog-main ">
  <h2>Create a news</h2><br>

      <form method="POST" action="{{route('cafe.promotions.posts',  $cafename)}}" class="w3-container w3-card-4 w3-margin">
         {{ csrf_field() }}

        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control col-md-8" id="title" name="title" placeholder="Title" >
        </div>

        <div class="form-group">
          <label for="body">Body</label>
          <textarea name="body" id='body' class="form-control" rows="10" placeholder="Body"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Publish</button>
        </div>

      </form>

      <form>
        @include('layouts.error')
      </form>


</div>

@endsection
