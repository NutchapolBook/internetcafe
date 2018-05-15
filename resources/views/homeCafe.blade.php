@extends('layouts.masterCafe')
@section('content')
@include('layouts.editstyle')

<div style="width:768px; margin:0 auto;" class="col-sm-12 blog-main " >
    <div class="container">

        <div class="slideshow-container">
            @if ($cafe[0]->picture1 == '')
                <div class="mySlides w3-animate-opacity" align="center">
                  <img src="{{asset('images/ex1.jpg')}}" alt="cafepic1" height="432">
                </div>
            @else
                <div class="mySlides w3-animate-opacity" align="center">
                  <img src="{{asset('images/').'/'.$cafe[0]->picture1}}" alt="cafepic1" height="432">
                </div>
            @endif

            @if ($cafe[0]->picture2 == '')
                <div class="mySlides w3-animate-opacity" align="center">
                  <img src="{{asset('images/ex2.jpg')}}" alt="cafepic2" height="432">
                </div>
            @else
                <div class="mySlides w3-animate-opacity" align="center">
                  <img src="{{asset('images/').'/'.$cafe[0]->picture2}}" alt="cafepic2" height="432">
                </div>
            @endif

            @if ($cafe[0]->picture3 == '')
                <div class="mySlides w3-animate-opacity" align="center">
                  <img src="{{asset('images/ex3.jpg')}}" alt="cafepic3" height="432">
                </div>
            @else
                <div class="mySlides w3-animate-opacity" align="center">
                  <img src="{{asset('images/').'/'.$cafe[0]->picture3}}" alt="cafepic3" height="432">
                </div>
            @endif
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>

        <div style="text-align:center">
          <span class="dot" onclick="currentSlide(1)"></span>
          <span class="dot" onclick="currentSlide(2)"></span>
          <span class="dot" onclick="currentSlide(3)"></span>
        </div>


    </div>
</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
}
</script>


@endsection



@section('footer')
@endsection
