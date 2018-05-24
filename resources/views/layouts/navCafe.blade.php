<div class="blog-masthead">
    <nav class="icon-bar" id="myTopnav">
        <a data-toggle="tooltip" data-placement="bottom" title="Home" href="{{route('cafe.indexCafe' , $cafename) }}"><i class="fa fa-home"></i></a>

      @if (Auth::user()->role === "user")
        <a href="{{route('cafe.promotions.index' , $cafename) }}">News</a>
        <a data-toggle="tooltip" data-placement="bottom" title="Booking" href="{{route('cafe.booking.index' , $cafename) }}"><i class="fas fa-gamepad"></i></a>
        <a href=" {{route('cafe.booking.cancle' , $cafename) }}">Check Booking</a>

        <div class="icon-bar-right">
            <a data-toggle="tooltip" data-placement="bottom" title="Logout" href="/logout"><i class="fa fa-sign-out"></i></a>
            <a data-toggle="tooltip" data-placement="bottom" title="Profile" href="/profile"><i class="fa fa-user-circle"></i> {{Auth::user()->name}} </a>
            <a  href="{{route('cafe.addcredit.index' , $cafename) }}">Balance {{Auth::user()->balance}} ฿</a>
        </div>

      @elseif (Auth::user()->role === "admin")
        <a  href="{{route('cafe.promotions.index' , $cafename) }}" >News</a>
        <a  data-toggle="tooltip" data-placement="bottom" title="Add Credit"  href="{{route('cafe.addcredit.indexAdmin' , $cafename) }}"><i class="fas fa-dollar-sign"></i></a>
        <a  data-toggle="tooltip" data-placement="bottom" title="Cafe Users info" href="{{route('cafe.usersinfo.index' , $cafename) }}"><i class="fas fa-users"></i></a>
        <a  data-toggle="tooltip" data-placement="bottom" title="Income" href="{{route('cafe.income.index' , $cafename) }}"><i class="fas fa-hand-holding-usd"></i></a>
        <a  href="{{route('cafe.editseat.index' , $cafename) }}">Edit Seat</a>

        <div class="icon-bar-right">
            <a data-toggle="tooltip" data-placement="bottom" title="Logout" href="/logout"><i class="fa fa-sign-out"></i></a>
            <a data-toggle="tooltip" data-placement="bottom" title="Profile" href="/profile"><i class="fa fa-user-circle"></i> {{Auth::user()->name}} </a>
            <a data-toggle="tooltip" data-placement="bottom" title="Edit Internetcafe info" href="{{route('cafe.editcafe.index' , $cafename) }}"><i class="fa fa-cogs"></i></a>
        </div>
      @endif
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
      </a>
    </nav>
</div>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "icon-bar") {
        x.className += " responsive";
    } else {
        x.className = "icon-bar";
    }
}
</script>
