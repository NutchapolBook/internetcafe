<div class="blog-post">
    <div class="row">
        <h2 class="blog-post-title">
          <a href="{{route('cafe.promotions.post'  , ['post' => $post->id, 'cafename' =>  $cafename]) }}">
              {{$post->title}}
          </a>
               {{-- <input class="right fas fa-trash-alt" type="submit" >
              <a class="right" data-toggle="tooltip" data-placement="bottom" title="Delete" href=""><i class="fas fa-trash-alt"></i></a> --}}
        </h2>

        @if (Auth::user()->role === "admin" || Auth::user()->role === "provider" )
            <h4><form action="{{route('cafe.promotions.destroy'  , ['post' => $post]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <i onclick="popup({{$post->title}})" class="right fas fa-trash-alt" data-toggle="modal" data-target="#exampleModal{{$post->id}}"  style="color:red" class="fa fa-address-book"></i>
                <div class="modal fade" id="exampleModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$post->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel{{$post->id}}">Are you sure to delete {{$post->title}}?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-primary" name="Submit" id="Submit" value="Delete">Yes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form></h4>
        @endif
    </div>

  <p class="blog-post-meta">
    {{$post->user->name}} on
    {{$post->updated_at->toDayDateTimeString()}}
  </p>

  {{$post->body}}
</div>

<script>
    function popup($title) {
        document.getElementById('exampleModalLabel').innerHTML = "Are you sure to delete this news?";
    }
</script>
