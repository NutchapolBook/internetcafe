<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

@extends('layouts.master')

@section('content')

<div style="width:800px; margin:0 auto;" class="col-sm-10 blog-main " >

<div class="container">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img src="http://img.online-station.net/_news/2015/1018/87482_DSC01601.jpg" alt="Los Angeles" style="width:100%;">
      </div>

      <div class="item">
        <img src="https://lh6.googleusercontent.com/cJVuwmcjLcYd6zP_4MqrES4213r-nctiEXz2hFOGAuSWhliBoR-3gF9c0oytM2O06TPlXJtwu8H8Lb9UySc_fmnErBzIqHNfX71eF2dFvnnuw2ut0xQtvYO0nvlGfLbRoJlt5TGeiA" alt="Chicago" style="width:100%;">
      </div>

      <div class="item">
        <img src="https://www.fpsthailand.com/index/wp-content/uploads/2017/12/Pro-League-Day-2-30.jpg" alt="New York" style="width:100%;">
      </div>

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>




</div>

@endsection



@section('footer')

      <script src="/js/file.js">

      </script>

@endsection
