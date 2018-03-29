@extends('layouts.master')

@section('content')
  <div class="col-sm-8">
      <h2>Cancle Booking</h2><br>

     <table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>NO.</th>
      <th>Start</th>
      <th>End</th>
      <th><span class="glyphicon glyphicon-remove"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>07.00</td>
      <td>08.00</td>
      <td><button type="button" class="btn btn-danger">Cancle</button></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>07.00</td>
      <td>08.00</td>
      <td><button type="button" class="btn btn-danger">Cancle</button></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>07.00</td>
      <td>08.00</td>
      <td><button type="button" class="btn btn-danger">Cancle</button></td>
    </tr>
  </tbody>
</table>

          @include('layouts.error')

      </>

  </div>

@endsection
