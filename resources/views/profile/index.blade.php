@extends('layouts.master')

@section('content')




<div class="col-sm-8 blog-main">
    <h2>My profile Info</h2><br>

    <form action="/profile" method="post">
      {{ csrf_field() }}


    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" class="form-control" value="{{$user[0]->name}}" autocomplete="on">
    </div>


    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" class="form-control" value="{{$user[0]->email}}" autocomplete="on">
    </div>

    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" class="form-control" value="{{$user[0]->password}}" >
    </div>

    <div class="form-group">
      <label for="password">Password Confirmation:</label>
      <input type="password" name="password_confirmation" id="password_confirmation"
      class="form-control" value="{{$user[0]->password}}" autocomplete="off">
    </div>


    <div class="form-group">
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="#" class="btn btn-primary">Cancle</a>
    </div>

    @include('layouts.error')

</>


</div><!-- /.blog-main -->

@endsection

@section('footer')
      <script src="/js/file.js">
      </script>
@endsection
