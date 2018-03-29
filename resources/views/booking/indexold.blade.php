@extends('layouts.master')

@section('content')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gojs/1.8.12/go-debug.js"></script>
  <div class="col-sm-12">
      <h2>Booking</h2><br>
      <div align="right">
          <button onclick="myFunction()" class="btn btn-primary"  title="Create" data-toggle="tooltip"><i class="material-icons">add row</i></button>
          <button onclick="createTable()" class="btn btn-primary"  title="Create" data-toggle="tooltip"><i class="material-icons">Add Table</i></button>
      </div>
      <br>


<table class="table table-bordered" id="myTable">
</table>
<br>

        <div class="form-group" align="middle">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>


        <script>
        function myFunction() {
            var table = document.getElementById("myTable");
            var row = table.insertRow(0);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            cell1.innerHTML = "NEW CELL1";
            cell2.innerHTML = "NEW CELL2";
        }

        function createTable()
        {
        rn = window.prompt("Input number of rows", 1);
        cn = window.prompt("Input number of columns",1);

         for(var r=0;r<rn;r++)
          {
           var x=document.getElementById('myTable').insertRow(r);
           for(var c=0;c<cn;c++)
            {
             var y=  x.insertCell(c);
             y.innerHTML="Row-"+r+" Column-"+c;
            }
           }
        }

        </script>

          @include('layouts.error')

      </>

  </div>

@endsection
