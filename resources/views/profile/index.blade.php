@extends('layouts.master')

@section('content')

<div class="col-sm-8 blog-main">
    <h2>My profile Info</h2><br>

    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" class="form-control" value="XXXXXX" autocomplete="off">
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" class="form-control" value="XXXXXX" autocomplete="off">
    </div>

    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" class="form-control" value="XXXXXX" autocomplete="off">
    </div>

    <div class="form-group">
      <label for="password">Password Confirmation:</label>
      <input type="password" name="password_confirmation" id="password_confirmation"
      class="form-control" value="XXXXXX" autocomplete="off">
    </div>

  <nav class="blog-pagination">
        <div class="form-group">
        <a href="#" class="btn btn-primary">Save</a>

        <a href="#" class="btn btn-primary">Cancle</a>
        </div>
  </nav>

</div><!-- /.blog-main -->

@endsection

@section('footer')
      <script src="/js/file.js">
      </script>
@endsection
