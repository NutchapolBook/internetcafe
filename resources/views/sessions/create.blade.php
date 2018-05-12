@extends('layouts.master')
@section('content')
  <div class="col-md-6 mid">
    <form action="/login" method="post" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
        {{ csrf_field() }}
        <h1 class="w3-center">Login</h1>

        <div class="w3-row w3-section">
            <label for="radio">Select your role</label>
            <select class="custom-select" name="role" id="roleselector">
                <option selected name="role" value="user">Cafe user</option>
                <option name="role" value="admin">Cafe owner</option>
             </select>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user w3-text-grey"></i></div>
            <input type="email" name="email" id="email" class="form-control col-sm-10" placeholder="Email Address">
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock w3-text-grey"></i></div>
            <input type="password" name="password" id="password" class="form-control col-sm-10" placeholder="Password">
        </div>

        <div class="cafename form-group" id="user" >
            <label for="radio">Chose InternetCafe</label>
            <select class="custom-select" name="cafename"  id="roleselector">
                @foreach($cafenames as $cafename)
                    <option name="cafename" value="{{ $cafename->name }}">{{ $cafename->name}}</option>
                @endforeach
             </select>
        </div>

        <div class="form-group w3-center">
          <button type="submit" class="btn btn-primary">Login</button>
          <button type="reset" onclick="cancle()" class="btn btn-primary">Cancle</button>
        </div>
        @include('layouts.error')
    </form>


  </div>

  <script>
          $('#roleselector').change(function(){
              $('.cafename').hide();
              $('#' + $(this).val()).show();
          });
  </script>

  <script>
    function cancle(){
        $('.cafename').show();
    }
  </script>

@endsection
