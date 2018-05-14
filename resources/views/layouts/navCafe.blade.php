<div class="blog-masthead">
    <nav class="icon-bar ">
        <a href="{{route('cafe.indexCafe' , $cafename) }}" ><i class="fa fa-home"></i></a>

      @if (Auth::user()->role === "user")
        <a  href="{{route('cafe.promotions.index' , $cafename) }}">Promotions</a>
        <a  href="{{route('cafe.booking.index' , $cafename) }}"><i class="fas fa-gamepad"></i></a>
        <a  href=" {{route('cafe.booking.cancle' , $cafename) }}">Check Booking</a>

        <div class="icon-bar-right">
            <a href="/logout"><i class="fa fa-sign-out"></i></a>
            <a href="/profile"><i class="fa fa-user-circle"></i> {{Auth::user()->name}} </a>
            <a  href="{{route('cafe.addcredit.index' , $cafename) }}">Balance {{Auth::user()->balance}} ฿</a>
        </div>

      @elseif (Auth::user()->role === "admin")
        <a  href="{{route('cafe.promotions.index' , $cafename) }}" >Promotions</a>
        <a  href="{{route('cafe.addcredit.indexAdmin' , $cafename) }}"><i class="fas fa-dollar-sign"></i></a>
        <a  href="{{route('cafe.usersinfo.index' , $cafename) }}"><i class="fas fa-users"></i></a>
        <a  href="{{route('cafe.income.index' , $cafename) }}"><i class="fas fa-hand-holding-usd"></i></a>
        <a  href="{{route('cafe.editseat.index' , $cafename) }}">Edit Seat</a>

        <div class="icon-bar-right">
            <a href="/logout"><i class="fa fa-sign-out"></i></a>
            <a href="/profile"><i class="fa fa-user-circle"></i> {{Auth::user()->name}} </a>
            <a href="{{route('cafe.editcafe.index' , $cafename) }}"><i class="fa fa-cogs"></i></a>
        </div>
      @endif
    </nav>
</div>
