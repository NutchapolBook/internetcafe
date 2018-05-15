@extends('layouts.masterCafe')
@section('content')
@include('layouts.editstyle')
<div class="col-sm-8 blog-main">
    <h2>News</h2><br>

    @if ((Auth::user()->role === "admin"))
        <div class="form-group">
            <a href="{{route('cafe.promotions.create' , $cafename) }} " class="btn btn-primary">Create new promotion</a>
        </div><br>
    @endif

    @foreach ($posts as $post)
        <div class="w3-container w3-card-4 w3-margin">
            @include('posts.post')
        </div>
    @endforeach

    {{-- <nav class="blog-pagination">
        <div class="form-group">
            <a class="btn btn-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </div>
    </nav> --}}

</div><!-- /.blog-main -->

@endsection

@section('footer')

      <script src="/js/file.js">

      </script>

@endsection
