@extends('layouts.master')

@section('content')
  <div class="col-sm-8">
      <h2>Add Credit</h2><br>

        <div class="form-group">
          <label for="name">Addcredit Code:</label>
          <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>


          @include('layouts.error')

      </>

  </div>

@endsection
