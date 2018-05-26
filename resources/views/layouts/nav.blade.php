<div class="blog-masthead">
    <nav class="icon-bar" id="myTopnav">
        <div class="logo-wrapper">
            <a href="/" id="logo"></a>
        </div>
        <a href="/" ><i class="fa fa-home"></i></a>
        @if (!Auth::check())
            <div class="icon-bar-right">
                <a class="icon-bar-hightlight" href="/register">Register</a>
                <a href="/login">Login</a>
            </div>
        @else
            @if (Auth::user()->role === "admin")
                <div class="icon-bar-right">
                    <a data-toggle="tooltip" data-placement="bottom" title="Logout" href="/logout"><i class="fa fa-sign-out"></i></a>
                    <a data-toggle="tooltip" data-placement="bottom" title="Profile" href="/profile"><i class="fa fa-user-circle"></i> {{Auth::user()->name}} </a>
                    <a data-toggle="tooltip" data-placement="bottom" title="Go to your site" href="{{route('cafe.indexCafe' , Auth::user()->cafename) }}" ><i class="fa fa-desktop"></i> {{Auth::user()->cafename}}</a>
                </div>

            @else
                <div class="icon-bar-right">
                    <a data-toggle="tooltip" data-placement="bottom" title="Logout" href="/logout"><i class="fa fa-sign-out"></i></a>
                    <a data-toggle="tooltip" data-placement="bottom" title="Profile" href="/profile"><i class="fa fa-user-circle"></i> {{Auth::user()->name}} </a>
                </div>
            @endif
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
