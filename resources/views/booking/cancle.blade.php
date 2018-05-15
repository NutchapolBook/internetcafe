@extends('layouts.masterCafe')
@section('content')
@include('layouts.editstyle')

<div class="col-sm-12 blog-main">
    <h2>Check Booking</h2><br>
    <div class="form-group form-row">
        <div class="col-sm-8"></div>
        <div class="w3-col" style="width:50px">
            <i class="fa fa-search" style="font-size:34px"></i>
        </div>
        <input class="form-control col-sm-3" type="text" id="search" placeholder="Search..." >
    </div>

    <!-- <form action="/profile" method="post">
      {{ csrf_field() }} -->


    <div class="form-group">
      <strong style="font-size:30px;" for="date">Date  </strong>:
      <span style="font-size:30px;" id="dates"></span>
      <br>
      <strong style="font-size:30px;" for="time">Time  </strong>:
      <span style="font-size:30px;" id="clock"></span><br><br>

      <script>
      // sessionStorage.clear();
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

      <table class="table table-bordered table-hover shadow">
        <th>Name</th>
        <th>Seat Number</th>
        <th>Date</th>
        <th>Start Booking</th>
        <th>Play Time</th>
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

    <script>
          $("#search").keyup(function() {
              var value = this.value;

          $("table").find("tr").each(function(index) {
              if (index === 0) return;
              var id = $(this).find("td").text();
              $(this).toggle(id.indexOf(value) !== -1);
              });
          });
    </script>

    @include('layouts.error')

</>


</div><!-- /.blog-main -->

@endsection

@section('footer')
      <script src="/js/file.js">
      </script>
@endsection
