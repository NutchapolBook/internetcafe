@extends('layouts.masterCafe')
@section('content')

<div class="col-sm-12 blog-main">
    <h2>Users information</h2><br>
    @include('layouts.status')
    @include('layouts.error')

    @php
        $sum=0;
    @endphp
    <div class="form-group">
        <input class="form-control col-sm-2 " type="text" id="search" placeholder="Search...">
    </div>

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
                                   <button type="button" class="btn btn-sm btn-success show-dialog" title="delete" data-toggle="tooltip" data-activity="{{ $user->id }}"> {{$user->status}} </button>
                               @elseif ($user->status == 'disable' )
                                   <button type="button" class="btn btn-sm btn-danger show-dialog" title="delete" data-toggle="tooltip" data-activity="{{ $user->id }}"> {{$user->status}} </button>
                               @endif
                                <dialog id="dialog-activity-{{ $user->id }}" class="mdl-dialog">
                                    <div class="mdl-dialog__content">
                                        <h4>
                                            Are you sure to change status this ID?
                                        </h4>
                                    </div>
                                    <div class="mdl-dialog__actions">
                                        <button type="button" class="mdl-button close">Close</button>
                                        <input type="hidden" name="id" id="id" value="{{$user->id}}">
                                        <input type="submit" name="status" id="status" class="mdl-button confirm" value="{{$user->status}}"/>
                                    </div>
                                </dialog>
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
    var dialog = document.querySelector('dialog');
    // var showDialogButton = document.querySelector('#show-dialog');

    if (! dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }

    // showDialogButton.addEventListener('click', function() {
    //   dialog.showModal();
    // });

    $('.show-dialog').on('click', function(){
        dialog = document.querySelector('#dialog-activity-'+$(this).data('activity'));
        dialog.showModal();
    });

    // dialog.querySelector('.close').addEventListener('click', function() {
    //   dialog.close();
    // });

    $('.close').on('click', function(){
        dialog.close();
    });
</script>
@endsection

@section('footer')
      <script src="/js/file.js">
      </script>
@endsection
