<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

@extends('layouts.masterCafe')

@section('content')
<style media="screen">
.nav-link {
    position: relative;
    padding: 1rem;
    font-weight: 500;
    color: {{$cafe[0]->colour}};
}

</style>

<div style="width:768px; margin:0 auto;" class="col-sm-10 blog-main " >
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
            {{-- {{$cafe[0]->picture}} --}}
            @if ($cafe[0]->picture1 == '')
                <div class="item active">
                  <img src="{{asset('images/ex1.jpg')}}" alt="cafepic1" height="432">
                </div>
            @else
                <div class="item active">
                  <img src="{{asset('images/').'/'.$cafe[0]->picture1}}" alt="cafepic1" height="432">
                </div>
            @endif

            @if ($cafe[0]->picture2 == '')
                <div class="item">
                  <img src="{{asset('images/ex2.jpg')}}" alt="cafepic2" height="432">
                </div>
            @else
                <div class="item">
                  <img src="{{asset('images/').'/'.$cafe[0]->picture2}}" alt="cafepic2" height="432">
                </div>
            @endif

            @if ($cafe[0]->picture3 == '')
                <div class="item">
                  <img src="{{asset('images/ex3.jpg')}}" alt="cafepic3" height="432">
                </div>
            @else
                <div class="item">
                  <img src="{{asset('images/').'/'.$cafe[0]->picture3}}" alt="cafepic3" height="432">
                </div>
            @endif
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
