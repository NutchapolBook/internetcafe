@extends('layouts.masterCafe')
@section('content')
@include('layouts.editstyle')

<div class="col-md-10 mid blog-main">
    @include('layouts.status')
    @include('layouts.error')

    <form method="POST" action="{{route('cafe.editcafe.update',  $cafename)}}" class="w3-container w3-card-4 w3-light-grey w3-margin">
      {{ csrf_field() }}
      <h1 class="w3-center">Edit your internetcafes</h1><br>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user w3-text-grey"></i></div>
      <input type="text" name="name" id="name" class="form-control col-sm-5" value="{{$cafe[0]->name}}"  required >
    </div>

    <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-money w3-text-green"></i></div>
        <p>Price per hours</p>
        <div class="input-group">
            <span class="input-group-addon">฿</span>
            <input type="number" name="price" id="price" class="form-control col-sm-6" value="{{$cafe[0]->price}}" required >
        </div>
    </div>

    @if ($cafe[0]->tabtextcolour == '')
        <div class="w3-row w3-section">
          <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-tint"></i></div>
          <label for="colour">Theme</label>
          <input type="color" name="tabcolour" id="tabcolour" value="#0b0de2">
          <label for="colour">Tab text</label>
          <input type="color" name="tabtextcolour" id="tabtextcolour" value="#ffffff" >
        </div>
    @else
        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-tint"></i></div>
            <label for="colour">Theme</label>
            <input type="color" name="tabcolour" id="tabcolour" value="{{$cafe[0]->tabcolour}}" >
            <label for="colour">Tab text</label>
            <input type="color" name="tabtextcolour" id="tabtextcolour" value="{{$cafe[0]->tabtextcolour}}">
        </div>

    @endif

        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-map-marker w3-text-orange"></i></div>
            <label for="location">Location</label>
            <textarea type="text" name="location" id="location" class="form-control col-sm-6" rows="6" required >{{$cafe[0]->location}}</textarea>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope w3-text-yellow"></i></div>
            <input type="email" name="email" id="email" class="form-control col-sm-6" value="{{$cafe[0]->email}}" required>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone-square"></i></div>
            <input type="text" name="tel" id="tel" class="form-control col-sm-6" value="{{$cafe[0]->tel}}" required >
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fab fa-facebook-f w3-text-blue"></i></div>
            <input type="url" name="facebook" id="facebook" class="form-control col-sm-6 " value="{{$cafe[0]->facebook}}" required >
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fab fa-line w3-text-green"></i></div>
            <input type="text" name="line" id="line" class="form-control col-sm-6" value="{{$cafe[0]->line}}" required >
        </div>

        <div class="w3-row w3-section">
            <div class="custom-file">
                <div class="col-sm-5">
                    <input type="file" name="policy" id="policy" class="custom-file-input">
                    <label class="custom-file-label" for="customFile">Policy</label>
                </div>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="custom-file">
                <div class="col-sm-5">
                    <input type="file" name="picture1" id="picture1" class="custom-file-input">
                    <label class="custom-file-label" for="customFile">Home Picture 1</label>
                </div>
            </div>
        </div>

        <div class="form-group ">
            <div class="custom-file">
                <div class="col-sm-5">
                    <input type="file" name="picture2" id="picture2" class="custom-file-input ">
                    <label class="custom-file-label" for="customFile">Home Picture 2</label>
                </div>
            </div>
        </div>

        <div class="form-group ">
            <div class="custom-file">
                <div class="col-sm-5">
                    <input type="file" name="picture3" id="picture3" class="custom-file-input ">
                    <label class="custom-file-label" for="customFile">Home Picture 3</label>
                </div>
            </div>
        </div>

        <div class="form-group ">
            <div class="custom-file">
                <div class="col-sm-5">
                    <input type="file" name="icon" id="icon" class="custom-file-input ">
                    <label class="custom-file-label" for="customFile">Website icon</label>
                </div>
            </div>
        </div>

        <div class="form-group w3-center">
            <input type="hidden" name="id" id="id" value="{{$cafe[0]->id}}">
            <button type="submit" function="function()" class="btn btn-primary" id="submit">Update</button>
            <button type="reset" class="btn btn-primary">Cancel</button>
        </div>

</div>


<script>
    $('#submit').click(function(){
        $('#color').get(0).type='text';
    });
</script>

@endsection

@section('footer')
      <script src="/js/file.js">
      </script>
@endsection
