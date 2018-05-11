@extends('layouts.masterCafe')
@section('content')
<div class="col-sm-8 blog-main">
    <h2>Edit your internetcafes</h2><br>
    @include('layouts.status')
    @include('layouts.error')

    <form method="POST" action="{{route('cafe.editcafe.update',  $cafename)}}">
      {{ csrf_field() }}
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" id="name" class="form-control col-sm-6" value="{{$cafe[0]->name}}" required >
    </div>

    <div class="form-group">
      <label for="price">Price per hour (฿)</label>
      <input type="number" name="price" id="price" class="form-control col-sm-6" value="{{$cafe[0]->price}}" required >
    </div>

    @if ($cafe[0]->colour == '')
        <div class="form-group">
          <label for="colour">Colour</label>
          <input type="color" name="colour" id="colour" value="#CDDDEB" >
        </div>
    @else
        <div class="form-group">
          <label for="colour">Colour</label>
          <input type="color" name="colour" id="colour" value="{{$cafe[0]->colour}}" >
        </div>
    @endif

    <div class="form-group">
      <label for="location">Location</label>
      <textarea type="text" name="location" id="location" class="form-control col-sm-6" rows="5" required >{{$cafe[0]->location}}</textarea>
    </div>

    <div class="form-group">
      <label for="tel">Phone number</label>
      <input type="text" name="tel" id="tel" class="form-control col-sm-6" value="{{$cafe[0]->tel}}" required >
    </div>

    <div class="form-group">
      <label for="facebook">Facebook</label>
      <input type="url" name="facebook" id="facebook" class="form-control col-sm-6" value="{{$cafe[0]->facebook}}" required >
    </div>

    <div class="form-group">
      <label for="line">Line :</label>
      <input type="text" name="line" id="line" class="form-control col-sm-6" value="{{$cafe[0]->line}}" required >
    </div>

    <div class="form-group">
      <label for="picture">Home Picture 1</label>
      <input type="file" name="picture1" id="picture1" class="form-control-file">
    </div>

    <div class="form-group">
      <label for="picture2">Home Picture 2</label>
      <input type="file" name="picture2" id="picture2" class="form-control-file">
    </div>

    <div class="form-group">
      <label for="picture3">Home Picture 3</label>
      <input type="file" name="picture3" id="picture3" class="form-control-file">
    </div>

    <div class="form-group">
      <label for="icon">Website Icon</label>
      <input type="file" name="icon" id="icon" class="form-control-file">
    </div>

    <div class="form-group">
      <input type="hidden" name="id" id="id" value="{{$cafe[0]->id}}">
      <button type="submit" function="function()" class="btn btn-primary" id="submit">Update</button>
      <button type="reset" class="btn btn-primary">Cancle</button>
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
