@extends('layouts.masterCafe')
@section('content')

<div class="col-sm-12 blog-main">
    <h2>Users information</h2><br>
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

    <table class="table table-bordered table-hover shadow" id="tablera">
        <thead>
            <tr class="center">
                <th width="1">
                    ID
                </th>
                <th>
                    Name
                </th>
                <th>
                    Email
                </th>
                <th>
                    balance
                </th>
                <th class="center">
                    Status
                </th>
                <th class="center">
                    Registration time
                </th>
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
                        {{ $user->balance }}
                    </td>
                    <td>
                        <form method="POST" action="{{route('cafe.usersinfo.update',  $cafename)}}">
                           {{ csrf_field() }}
                           <div class="text-center">
                               @if ($user->status == 'useable' )
                                   <button type="button" class="btn btn-sm btn-success" title="enabled" data-toggle="modal" data-target="#exampleModal"> Enabled </button>
                               @elseif ($user->status == 'disable' )
                                   <button type="button" class="btn btn-sm btn-danger" title="disable" data-toggle="modal" data-target="#exampleModal"> Disabled </button>
                               @endif
                               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">Are you sure to change status ID: {{$user->name}}?</h5>
                                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                               </button>
                                           </div>
                                           <div class="modal-footer">
                                               <input type="hidden" name="id" id="id" value="{{$user->id}}">
                                               <input type="hidden" name="status" id="status" value="{{$user->status}}">
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
@endsection

@section('footer')
      <script src="/js/file.js">
      </script>
@endsection
