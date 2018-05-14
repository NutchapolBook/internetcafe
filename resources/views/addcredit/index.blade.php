@extends('layouts.masterCafe')
@section('content')
@include('layouts.editstyle')

    <div class="col-sm-8">
        <h2>Add Credit</h2><br>
        @include('layouts.status')

        <form method="POST" action="{{route('cafe.addcredit.update',  $cafename)}}">
           {{ csrf_field() }}
          <div class="form-group">
            <label for="code">Code</label>
            <input type="text" class="form-control" id="code" name="code">
          </div>

          <div class="form-group">
              <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Submit</button>
          </div>


          <!-- Modal -->
            {{-- <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                   <div class="modal-header">
                      <h4 class="modal-title">Generate code complete</h4>
                  </div>
                  <div class="modal-body">
                    <p>{{$code}}</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" onclick="myFunction()" onmouseout="outFunc()" class="btn btn-default">
                          <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                      </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div> --}}
           </form>

           @include('layouts.error') </div>





    </div>

@endsection
