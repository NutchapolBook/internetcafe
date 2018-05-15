@extends('layouts.master')
@section('content')
  <div class="col-md-6 mid">
      @include('layouts.error')
      <form action="/register" method="post" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
        {{ csrf_field() }}
        <h1 class="w3-center">Register</h1>

        <div class="w3-row w3-section">
            <label for="radio">Select your role</label>
            <select class="custom-select" name="role" id="roleselector">
                <option selected name="role" value="user">Cafe user</option>
                <option name="role" value="admin">Cafe owner</option>
             </select>
        </div>

        <div class="w3-row w3-section">
          <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user w3-text-grey"></i></div>
          <input type="text" name="name" id="name" class="form-control col-sm-10" placeholder="Name" required>
        </div>

        <div class="cafename form-group" id="admin" style="display:none">
          <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-group"></i></div>
          <input type="text" name="cafename" id="cafename" class="form-control col-sm-10" placeholder="Internet Cafe Name">
        </div>

        <div class="form-group">
          <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope w3-text-yellow"></i></div>
          <input type="email" name="email" id="email" class="form-control col-sm-10" placeholder="Email" required>
        </div>

        <div class="form-group">
          <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock w3-text-grey"></i></div>
          <input type="password" name="password" id="password"  class="form-control col-sm-10" placeholder="Password" required>
        </div>

        <div class="form-row">
            <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control col-sm-10" placeholder="Password Confirmation" required>
        </div><br>

        <div class="form-group ">
            <div class="g-recaptcha" data-sitekey="6LcuYVkUAAAAAHTYPVMzBzj4yUohGj4Vdzug5eWt"></div>
        </div>

        <div class="form-group w3-center">
          <button type="submit" class="btn btn-primary">Register</button>
          <button type="reset" class="btn btn-primary">Cancle</button>
        </div>

      </>

      <script>
              $('#roleselector').change(function(){
                  $('.cafename').hide();
                  $('#' + $(this).val()).show();
              });
      </script>


  </div>

@endsection
