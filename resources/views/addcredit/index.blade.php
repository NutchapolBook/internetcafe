@extends('layouts.masterCafe')
@section('content')
@include('layouts.editstyle')

    <div class="col-sm-6 mid">
        @include('layouts.status')
        @include('layouts.error')

        <form method="POST" action="{{route('cafe.addcredit.update',  $cafename)}}" class="w3-container w3-card-4 w3-light-grey w3-margin">
            {{ csrf_field() }}
            <h1 class="w3-center">Profile Info</h1><br>

            <div class="w3-row w3-section">
                <label for="code">Code</label>
                <input type="text" class="form-control col-sm-10" id="code" name="code" placeholder="Code">
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
       </div>





    </div>

@endsection
