@extends('layouts.masterCafe')
@section('content')
@include('layouts.editstyle')

  <div class="col-sm-8">
      @php
          $code = uniqid(true);
      @endphp

      <h2>Add Credit</h2><br>
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
      @include('layouts.error')

      <form method="POST" action="{{route('cafe.addcredit.post',  $cafename)}}">
         {{ csrf_field() }}

        <div class="form-group">
          <label for="amount">Amount</label>
          <input type="number" class="form-control col-sm-6" id="amount" name="amount" required>
        </div>

        <div class="form-group">
          {{-- <label for="code">Code</label> --}}
          <input type="hidden" class="form-control col-sm-6" id="code" name="code" value="{{$code}}" >
        </div>

        {{-- <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div> --}}

        <div class="form-group">
            <button type="button" onclick="getamount()" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Submit </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>code: {{$code}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="myFunction()" onmouseout="outFunc()" class="btn btn-default">
                                <span class="tooltiptext" id="myTooltip">Copy this code</span>
                            </button>
                            <button type="submit" class="btn btn-primary">Yes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
             </div>
         </div>

      </form>
  </div>

<script>
    function myFunction() {
      var copyText = document.getElementById("code");
      copyText.select();
      document.execCommand("Copy");

      var tooltip = document.getElementById("myTooltip");
      tooltip.innerHTML = "Copied: " + copyText.value;
    }

    function outFunc() {
      var tooltip = document.getElementById("myTooltip");
      tooltip.innerHTML = "Copy code to clipboard";
    }

    function getamount() {
        var Amount = document.getElementById("amount").value;
        if (Amount == null) {
            document.getElementById('exampleModalLabel').innerHTML = "Please enter your amount!";
        }
        else {
            document.getElementById('exampleModalLabel').innerHTML = "Are you sure to addcredit amount " +Amount+ " Baht?";
        }
    }

</script>

@endsection
