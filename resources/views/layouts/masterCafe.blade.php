
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    @if (Auth::user()->role === "admin")
    <title>{{Auth::user()->cafename}}</title>
    @elseif (Auth::user()->role === "user")
    <title>{{$cafename}}</title>
    @endif

    {{-- script --}}
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/gojs/1.8.12/go-debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gojs/1.8.12/go.js"></script>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <!-- Custom styles for this template -->
    <link href="/css/blog.css" rel="stylesheet">
  </head>

  <body>

@include('layouts.nav')

    <div class="blog-header">
      <div class="container">
        @if (Auth::user()->role === "admin")
        <h1 class="blog-title">{{Auth::user()->cafename}}</h1>
        @elseif (Auth::user()->role === "user")
        <h1 class="blog-title">{{$cafename}}</h1>
        @endif
        {{-- <p class="lead blog-description">An example blog template built with Bootstrap.</p> --}}
      </div>
    </div>


    <div class="container">
      <div class="row">
          @yield('content')
      </div><!-- /.row -->

    </div><!-- /.container -->

@include('layouts.footer')
  </body>
</html>
