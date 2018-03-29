@extends('layouts.master')

@section('content')
<div class="col-sm-8 blog-main">
    <h2>Promotions</h2><br>

  @foreach ($posts as $post)
    @include('posts.post')
  @endforeach

  <nav class="blog-pagination">
    <div class="form-group">
      <a class="btn btn-outline-primary" href="#">Older</a>
      <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
    </div>

    @if ((Auth::user()->role === "admin"))
        <div class="form-group">
        <a href="/posts/create" class="btn btn-primary">Create new promotion</a>
        </div>
    @endif

  </nav>

</div><!-- /.blog-main -->

@endsection

@section('footer')

      <script src="/js/file.js">

      </script>

@endsection
