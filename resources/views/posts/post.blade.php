<div class="blog-post">
  <h2 class="blog-post-title">
    <a href="{{route('cafe.promotions.post'  , ['post' => $post->id, 'cafename' =>  $cafename]) }}">
        {{$post->title}}
    </a>

  </h2>
  <p class="blog-post-meta">
    {{$post->user->name}} on
    {{$post->updated_at->toDayDateTimeString()}}
  </p>

  {{$post->body}}
</div>
