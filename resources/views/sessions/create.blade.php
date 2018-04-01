@extends('layouts.master')


@section('content')
  <div class="col-md-8">
    <h1>User Login</h1>

    <form action="/login" method="post">
        {{ csrf_field() }}

        <div class="form-group">
          <label for="email">Email Address:</label>
          <input type="email" name="email" id="email" class="form-control" >
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="radio">InternetCafe:</label><br>
            <select class="custom-select" name="cafename"  id="roleselector">
                @foreach($cafenames as $cafename)
                    <option name="cafename" value="{{ $cafename->cafename }}">{{ $cafename->cafename}}</option>
                @endforeach
             </select>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Sign In</button>
          <button type="reset" class="btn btn-primary">Cancle</button>
        </div>

        @include('layouts.error')

    </form>

  </div>

@endsection
