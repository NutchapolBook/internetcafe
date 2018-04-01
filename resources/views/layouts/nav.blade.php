<div class="blog-masthead">
  <div class="container">
    <nav class="nav blog-nav">
      <a class="nav-link active" href="/">Home</a>
      <a class="nav-link" href="/post">Promotions</a>



      @if (!Auth::check())
          <a class="nav-link ml-auto" href="/login">Login</a>
          <a class="nav-link" href="/register">Register</a>

      @elseif (Auth::user()->role === "user")
          <a class="nav-link" href="/booking">Booking</a>
          <a class="nav-link" href="/booking/cancle">Cancle Booking</a>


          <a class="nav-link ml-auto" href="/addcredit">Balance : {{Auth::user()->balance}} baht</a>
          <a class="nav-link ml-auto" href="/profile">{{Auth::user()->name}}</a>
          <a class="nav-link" href="/logout">Logout</a>

      @elseif (Auth::user()->role === "admin")
          <a class="nav-link" href="#">View Users</a>
          <a class="nav-link" href="/editseat">Edit Seat</a>
          <a class="nav-link" href="#">User information</a>
          <a class="nav-link ml-auto"  href="/profile">{{Auth::user()->name}}</a>
          <a class="nav-link" href="/logout">Logout</a>
      @endif



    </nav>
  </div>
</div>
