<footer class="blog-footer">
  {{-- <p>Blog template built for <a href="https://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p> --}}
  <div id="contact" class="container-fluid bg-grey">
      <h2 class="text-center w3-text-black">Contact Us</h2><br>
          <div class="row col-sm-10">
              <div class="col-sm-3"></div>
              <div class="col-sm-5">
                  <p><i class="w3-xxlarge fa fa-map-marker w3-text-orange"></i> Bangkok , Thailand</p>
                  <p><i class="w3-xxlarge fa fa-envelope w3-text-yellow"></i>Nutchapol.poonkasem@gmail.com / thanapech.t@hotmail.com</p>
                  <p><i class="w3-xxlarge fa fa-phone-square"></i> 081-3456789 / 083-7833460</p>
              </div>
              <div class="slideanim col-sm-3">
                  <p><i class="w3-xxlarge fab fa-facebook-f w3-text-blue"></i> <a href="https://www.facebook.com/nutchapol.poonkasem">Nutchapol</a>/<a href="https://www.facebook.com/nongpech.motic">Thanapech</a></p>
                  <p><i class="w3-xxlarge fab fa-line w3-text-green"></i> bookncp / thanapech</p>
                </div>
              </div>
              <br>

          <div class="text-center">
              <a href="#">Back to top</a>
              <a onclick="modal()" >Policies</a>

              <img class="hidden" id="myImg" src="{{asset('images/policy.jpg')}}"  style="display:none">

              <div id="myModal" class="modal">
                  <span class="close">&times;</span>
                  <img class="modal-content" id="img01">
                   <div id="caption"></div>
              </div>

          </div>
  </div>

  <script>
    function modal(){
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById('myImg');
        var modalImg = document.getElementById("img01");

        modal.style.display = "block";
        modalImg.src = myImg.src;

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    }
</script>

</footer>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
{{-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> --}}
