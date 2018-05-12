@extends('layouts.masterCafe')

@section('content')

<div class="col-sm-10 blog-main " >
<div class="container">
    <h2>Contact us</h2><br>
      <label for="name">Location {{$cafe[0]->location}}</label><br>
      <label for="name">Phone number {{$cafe[0]->tel}}</label><br>
      <label for="name">Facebook {{$cafe[0]->facebook}}</label><br>
      <label for="name">Line {{$cafe[0]->line}}</label>

</div>




</div>

@endsection

@section('footer')

      <script src="/js/file.js">

      </script>

@endsection
