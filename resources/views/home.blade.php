@extends('layouts.masterHome')
@section('home')

<div style="width:768px; margin:0 auto;" class="col-sm-12 blog-main" >
    <div class="w3-container row" style="bottom:0; ">
        <picture>
            <source media="(min-width: 1441px)" srcset="{{asset('images/bg-xl.jpg')}}">
            <source media="(min-width: 1024px)" srcset="{{asset('images/bg-l.jpg')}}">
            <source media="(min-width: 560px)" srcset="{{asset('images/bg.jpg')}}">
            <source media="(max-width: 400px)" srcset="{{asset('images/bg-mobile.jpg')}}">
            <img src="{{asset('images/bg.jpg')}}" alt="background" style="width:100%; height:100%;">
        </picture>
        <div class="text-block">
            <img src="{{asset('images/logo.png')}}" alt="logo" class="w3-center">
            <p class="lead blog-description">SaaS for InternetCafe management</p>
        </div>
    </div>
</div>

@endsection



@section('footer')

      <script src="/js/file.js">

      </script>

@endsection
