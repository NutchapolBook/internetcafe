@extends('layouts.masterCafe')
@section('content')
@include('layouts.editstyle')

<div class="col-md-6 mid">
     @include('layouts.status')
    <form action="/profile" method="post" class="w3-container w3-card-4 w3-light-grey w3-margin">
        {{ csrf_field() }}
        <h1 class="w3-center">Profile Info</h1><br>

    <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user w3-text-grey"></i></div>
        <input type="text" name="name" id="name" class="form-control col-sm-10" value="{{$user[0]->name}}" required >
    </div>


    <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope w3-text-yellow"></i></div>
        <input type="email" name="email" id="email" class="form-control col-sm-10" value="{{$user[0]->email}}" required >
    </div>

    <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock w3-text-grey"></i></div>
        <input type="password" name="password" id="password" class="form-control col-sm-10" placeholder="Password" required >
    </div>

    <div class="form-row">
        <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control col-sm-10" placeholder="Password Confirmation" autocomplete="off" required>
    </div><br>


    <div class="form-group w3-center">
      <button type="submit" class="btn btn-primary">Update</button>
      <button type="reset" class="btn btn-primary">Cancle</button>
    </div>

    @include('layouts.error')

</>


</div><!-- /.blog-main -->

@endsection

@section('footer')
      <script src="/js/file.js">
      </script>
@endsection
