@extends('layouts.masterCafe')

@section('content')
@include('layouts.editstyle')
<div class="col-sm-8 blog-main">
  <h2>Create a promotion</h2>

      <form method="POST" action="{{route('cafe.promotions.posts',  $cafename)}}">
         {{ csrf_field() }}

        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" >
        </div>

        <div class="form-group">
          <label for="body">Body</label>
          <textarea name="body" id='body' class="form-control" rows="10"  ></textarea>
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
