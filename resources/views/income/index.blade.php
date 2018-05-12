@extends('layouts.masterCafe')
@section('content')

<div class="col-sm-12 blog-main">
    <h2>Income Info</h2><br>
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


    <table class="table table-bordered table-hover shadow" id="tablera">
        <thead>
            <tr class="center">
                <th width="1">
                    ID
                </th>
                <th>
                    User_id
                </th>
                <th>
                    Admin_id
                </th>
                <th class="center">
                    Status
                </th>
                <th class="center">
                    Amount
                </th>
                <th  class="center">
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
    <div class="form-group">
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

@endsection

@section('footer')
      <script src="/js/file.js">
      </script>
@endsection
