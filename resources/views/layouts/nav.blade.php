<div class="blog-masthead">
  <div class="container">
    <nav class="nav blog-nav">
      <a class="nav-link active" href="/">Home</a>
      @if (!Auth::check())
        <a class="nav-link ml-auto" href="/login">Login</a>
        <a class="nav-link" href="/register">Register</a>
      @else
        {{-- <a class="nav-link active" href="{{route('cafe.indexCafe' , $cafename) }}" >internetcafe</a> --}}
        <a class="nav-link ml-auto"  href="/profile">{{Auth::user()->name}}</a>
        <a class="nav-link" href="/logout">Logout</a>
      @endif


    </nav>
  </div>
</div>
