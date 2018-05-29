@extends('layouts.masterHome')
@section('content')

<div class="col-sm-12 blog-main">
    <br><br>
    <h2>Users & Admin management</h2><br>
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
        <input class="form-control col-sm-3" type="text" id="search" placeholder="Search..." >
    </div>
    <br>

    <table class="table table-bordered table-hover shadow" id="myTable">
        <thead>
            <tr class="center">
                <th onclick="sortTable(0)" width="1">
                    ID
                </th>
                <th onclick="sortTable(1)">
                    Name
                </th>
                <th onclick="sortTable(2)">
                    Email
                </th>
                <th onclick="sortTable(3)">
                    Role
                </th>
                <th onclick="sortTable(4)">
                    Cafe name
                </th>
                <th onclick="sortTable(5)">
                    Balance
                </th>
                <th onclick="sortTable(6)" class="center">
                    Status
                </th>
                <th onclick="sortTable(7)" class="center">
                    Registration time
                </th>
                {{-- <th>
                    <i class="fas fa-trash-alt"></i>
                </th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($users as $hove => $user)
                <tr>
                    <td>
                        {{ $user->id }}
                    </td>
                    <td>
                        {{ $user->name}}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        @if ($user->role=='admin')
                            <button class="btn btn-primary" name="admin"> {{ $user->role }} </button>
                        @elseif ($user->role=='user')
                            <button class="btn btn-default" name="user"> {{ $user->role }} </button>
                        @else
                            <button class="btn btn-warning" name="provider"> {{ $user->role }} </button>
                        @endif
                    </td>
                    <td>
                        @if ($user->role=='admin')
                            {{ $user->cafename }}
                        @endif
                    </td>
                    <td>
                        {{ $user->balance }}
                    </td>
                    <td>
                        <form method="POST" action="/users_management/update">
                           {{ csrf_field() }}
                           <input type="hidden" name="id" id="id" value="{{$user->id}}">
                           <input type="hidden" name="status" id="status" value="{{$user->status}}">
                           <div class="text-center">
                               @if ($user->status == 'useable' )
                                   <button type="button" class="btn btn-sm btn-success" title="enabled" data-toggle="modal" data-target="#exampleModal{{$user->id}}" name="enabled"> Enabled </button>
                               @elseif ($user->status == 'disable' )
                                   <button type="button" class="btn btn-sm btn-danger" title="disabled" data-toggle="modal" data-target="#exampleModal{{$user->id}}" name"disabled"> Disabled </button>
                               @endif
                               <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-{{$user->id}}" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel-{{$user->id}}">Are you sure to change status ID: {{$user->name}}?</h5>
                                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                               </button>
                                           </div>
                                           <div class="modal-footer">
                                               <button type="submit" class="btn btn-primary">Save changes</button>
                                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                           </div>
                                       </div>
                                   </div>
                                </div>
                            </div>
                        </form>
                    </td>

                    <td>
                        {{ $user->created_at}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
