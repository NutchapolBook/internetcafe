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
      {{-- <strong style="font-size:30px;" for="date">Date  </strong>:
      <span style="font-size:30px;" id="dates"></span>
      <br>
      <strong style="font-size:30px;" for="time">Time  </strong>:
      <span style="font-size:30px;" id="clock"></span><br><br> --}}

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

      <table class="table table-bordered table-hover shadow"  id="myTable">
        <th onclick="sortTable(1)">Seat Number</th>
        <th onclick="sortTable(2)">Date</th>
        <th onclick="sortTable(3)">Start Booking</th>
        <th onclick="sortTable(4)">Play Time</th>
        <?php foreach($seat as $user): ?>
        <tr>
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

    <script>
    function sortTable(n) {
          var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
          table = document.getElementById("myTable");
          switching = true;
          //Set the sorting direction to ascending:
          dir = "asc";
          /*Make a loop that will continue until
          no switching has been done:*/
          while (switching) {
            //start by saying: no switching is done:
            switching = false;
            rows = table.getElementsByTagName("TR");
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
              //start by saying there should be no switching:
              shouldSwitch = false;
              /*Get the two elements you want to compare,
              one from current row and one from the next:*/
              x = rows[i].getElementsByTagName("TD")[n];
              y = rows[i + 1].getElementsByTagName("TD")[n];
              /*check if the two rows should switch place,
              based on the direction, asc or desc:*/
              if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                  //if so, mark as a switch and break the loop:
                  shouldSwitch= true;
                  break;
                }
              } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                  //if so, mark as a switch and break the loop:
                  shouldSwitch= true;
                  break;
                }
              }
            }
            if (shouldSwitch) {
              /*If a switch has been marked, make the switch
              and mark that a switch has been done:*/
              rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
              switching = true;
              //Each time a switch is done, increase this count by 1:
              switchcount ++;
            } else {
              /*If no switching has been done AND the direction is "asc",
              set the direction to "desc" and run the while loop again.*/
              if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
              }
            }
          }
    }
    </script>

    @include('layouts.error')

</>


</div><!-- /.blog-main -->

@endsection

@section('footer')
      <script src="/js/file.js">
      </script>
@endsection
