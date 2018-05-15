@extends('layouts.masterCafe')
@section('content')
@include('layouts.editstyle')

<div class="col-sm-12 blog-main">
    <div class="form-row">
    <h2>Income Info</h2>
    <a class="nav-link" href="{{route('cafe.income.index' , $cafename) }}"><i class="fa fa-refresh w3-text-blue" style="font-size:30px"></i></a>
    </div>
    @include('layouts.status')
    @include('layouts.error')

    @php
        $sum=0;
    @endphp

    <div class="form-group form-row">
        <div class="col-sm-8"></div>
        <div class="w3-col" style="width:50px">
            <i class="fa fa-search" style="font-size:34px"></i>
        </div>
        <input class="form-control col-sm-3 " type="text" id="search" placeholder="Search..." >
    </div>
    <br><br>

    {{-- <form method="POST" action="{{route('cafe.income.create',  $cafename)}}">
        {{ csrf_field() }}
        <div class="form-group" >
                <div class="form-group row" >
                    <label for="startdate" class="col-md-1 control-label">Start date</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name"startdate" id="startdate" required>
                        </div>
                    <label for="enddate" class="col-md-1 control-label">End date</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name"enddate" id="enddate" required>
                        </div>
                    <button type="submit" class="btn btn-primary">search</button>
                </div>
        </div>

    </form> --}}

    <form method="POST" action="{{route('cafe.income.create',  $cafename)}}">
       {{ csrf_field() }}
       <div class="form-group">
          <div class="form-group row" >
              <div class="col-sm-1"></div>
                <label for="startdate" class="col-md-1 control-label">Start date</label>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="startdate" name="startdate" required>
                </div>

                <label for="enddate" class="col-md-1 control-label">End date</label>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="enddate" name="enddate" required>
                </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </div>
        </div>
    </form>


    <table class="table table-bordered table-hover shadow" id="myTable">
        <thead>
            <tr class="center">
                <th onclick="sortTable(0)" width="1">
                    ID
                </th>
                <th onclick="sortTable(1)" >
                    User id
                </th>
                <th onclick="sortTable(2)" >
                    Admin id
                </th>
                <th onclick="sortTable(3)"  class="center">
                    Status
                </th>
                <th onclick="sortTable(4)"  class="center">
                    Amount
                </th>
                <th  onclick="sortTable(5)" class="center">
                    Time
                </th>
                <th>
                    Code
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($incomes as $hove => $income)
                <tr>
                    <td>
                        {{ $income->id }}
                    </td>
                    <td>
                        {{ $income->user_id }}
                    </td>
                    <td>
                        {{ $income->admin_id }}
                    </td>
                    <td>
                        {{ $income->status }}
                    </td>
                    <td>
                        {{ $income->amount }}
                    </td>
                    <td>
                        {{ $income->created_at }}
                    </td>
                    <td>
                        {{ $income->code}}
                    </td>
                </tr>
                @php
                    $sum=$sum+$income->amount;
                @endphp
            @endforeach
        </tbody>
    </table>
    <br>
    <div class="form-group right">
        <h2><label for="sum">Income summary {{$sum}} BATH</label></h2>
    </div>
</div><!-- /.blog-main -->

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

{{-- <script>
    var id = $(this).find("td").first().text();
</script> --}}


{{-- <script>
      $("#search").keyup(function() {
          var value = this.value;

      $("table").find("tr").each(function(index) {
          $row = $(this);
          $(this).find('td').each (function() {
            var id = $(this).text();
                if (id.indexOf(value) !== 0) {
                    $row.hide();
                    }
                else {
                    $row.show();
                }
            });
          });
      });
</script> --}}

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

@endsection

@section('footer')
      <script src="/js/file.js">
      </script>
@endsection
