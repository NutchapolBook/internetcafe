<div class="blog-masthead">
  <div class="container">
    <nav class="nav blog-nav">
      <a class="nav-link active" href="{{route('cafe.indexCafe' , $cafename) }}" >Home</a>

      @if (!Auth::check())
          <a class="nav-link ml-auto" href="/login">Login</a>
          <a class="nav-link" href="/register">Register</a>

      @elseif (Auth::user()->role === "user")
        <a class="nav-link" href="{{route('cafe.promotions.index' , $cafename) }}">Promotions</a>
        <a class="nav-link" href="{{route('cafe.booking.index' , $cafename) }}">Booking</a>
        <a class="nav-link" href=" {{route('cafe.booking.cancle' , $cafename) }}">Check Booking</a>
        <a class="nav-link ml-auto" href="{{route('cafe.addcredit' , $cafename) }}">Balance: {{Auth::user()->balance}} BAHT</a>
        <a class="nav-link" href="/profile">{{Auth::user()->name}}</a>
        <a class="nav-link" href="/logout">Logout</a>

      @elseif (Auth::user()->role === "admin")
        <a class="nav-link" href="{{route('cafe.promotions.index' , $cafename) }}" >Promotions</a>
        <a class="nav-link" href="#">View Users</a>
        <a class="nav-link" href="{{route('cafe.editseat.index' , $cafename) }}">Edit Seat</a>
        <a class="nav-link" href="#">User information</a>
        <a class="nav-link ml-auto"  href="/profile">{{Auth::user()->name}}</a>
        <a class="nav-link" href="/logout">Logout</a>
      @endif



    </nav>
  </div>
</div>
