@extends('layouts.masterCafe')
@section('content')
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
          <input type="number" class="form-control" id="amount" name="amount" required>
        </div>

        <div class="form-group">
          <label for="code">Code</label>
          <input type="text" class="form-control" id="code" name="code" value="{{$code}}" >

          <button type="button" onclick="myFunction()" onmouseout="outFunc()" class="btn btn-default">
              <span class="tooltiptext" id="myTooltip">Copy code to clipboard</span>
          </button>

        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Submit</button>
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
      tooltip.innerHTML = "Copy to clipboard";
    }
</script>

@endsection
