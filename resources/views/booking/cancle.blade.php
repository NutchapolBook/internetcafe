@extends('layouts.masterCafe')

@section('content')

<div class="col-sm-8 blog-main">
    <h2>Check Booking</h2><br>

    <!-- <form action="/profile" method="post">
      {{ csrf_field() }} -->


    <div class="form-group">
      <strong for="date">Date  </strong>:
      <span style="font-size:30px;" id="dates"></span>
      <br>
      <strong for="time">Time  </strong>:
      <span style="font-size:30px;" id="clock"></span>
      <script>
      (function () {

        var clockElement = document.getElementById( "clock" );
        function updateClock ( clock ) {
          clock.innerHTML = new Date().toLocaleTimeString();

        }

        setInterval(function () {
          updateClock( clockElement );
        }, 1);

        var dateElement = document.getElementById( "dates" );
        function updateTime ( clock ) {
          clock.innerHTML = new Date().toDateString();

        }

        setInterval(function () {
          updateTime( dateElement );
        }, 1);

      }());

      </script>
      <head>
        <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        </style>
        </head>

      <table>
        <th>Name</th>
        <th>Seat_Number</th>
        <th>Date</th>
        <th>Start_time</th>
        <th>End_time</th>
        <?php foreach($seat as $user): ?>
        <tr>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->seatname; ?></td>
            <td><?php echo $user->date; ?></td>
            <td><?php echo $user->starttime; ?></td>
            <td><?php echo $user->endtime; ?></td>
        </tr>
        <?php endforeach; ?>
      </table>



    </div>

    @include('layouts.error')

</>


</div><!-- /.blog-main -->

@endsection

@section('footer')
      <script src="/js/file.js">
      </script>
@endsection
