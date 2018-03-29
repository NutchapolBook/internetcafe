@extends('layouts.master')

@section('content')
  <div class="col-sm-8">
      <h2>Register</h2>

      <form action="/register" method="post">
        {{ csrf_field() }}

        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="password">Password Confirmation:</label>
          <input type="password" name="password_confirmation" id="password_confirmation"
          class="form-control" required>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Register</button>
          <a href="#" class="btn btn-primary">Cancle</a>
        </div>

          @include('layouts.error')

      </>

  </div>

@endsection
