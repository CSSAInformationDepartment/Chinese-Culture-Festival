<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GeoLocation Module</title>
    <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<link rel="stylesheet" href="/main.css">
    <link rel="stylesheet" href="assets/vender/intl-tel-input/css/intlTelInput.css">
  </head>

<body>
<div class ="container">
    <div class="row">
      <div class= "col-md-3"></div>
      <div class = "col-md-6">
          <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
              <article>
                <p class ="text-center">Finding your location: <span id="status">checking...</span></p>
              </article>
      </div>
      <div class= "col-md-3"></div>
    </div>

      <div class = "row">
        <div class= "col-md-5"></div>

        <div class="col-md-2">
          <form action="upload.php" method="POST">    
            <div class="form-group">
               <!--/>Following 2 lines are coordinate bypass. DO NOT REMOVE</-->
              <input type="hidden" name="plag" id="plag"／>
              <input type="hidden" name="plng" id="plng"／>
              <!--/></-->              
              <div class="form-group">
                <!--/>reCaptcha token. REPLACE with new one </-->
                <div class="g-recaptcha" data-sitekey="6LcfCSUTAAAAAObIhSXxh85T64yv6LQb9ushtZ39"></div>
                <!--/></-->    
                <span class="help-block" style="display: none;">Please check that you are not a robot.</span>
              </div>
              <span class="help-block" style="display: none;">Please enter a the security code.</span>
              <button type="submit" class ="btn btn-success btn-block">Submit!</>
            </div>
          </form>
          
          <a href = "/index.php" role ="button" class ="btn btn-danger btn-block">Cancel</a>
        </div>
      <div class= "col-md-5"></div>
        
      </div>

</div>
<footer>
  <p align = "center">Designed by Shepherd MOZ in Parkville</p>
</footer>

<script>
var globallag;
var globallng;
        function success(position) {
          var s = document.querySelector('#status');

          if (s.className == 'success') {
            // not sure why we're hitting this twice in FF, I think it's to do with a cached result coming back    
            return;
          }

          s.innerHTML = "found you!";
          s.className = 'success';
          
          var mapcanvas = document.createElement('div');
          mapcanvas.id = 'mapcanvas';
          mapcanvas.style.height = '400px';
          mapcanvas.style.width = '560px';
          //Map Loader
          document.querySelector('article').appendChild(mapcanvas);          
          globallag = position.coords.latitude;
          globallng = position.coords.longitude;
          //coordinates bypass
          document.getElementById("plag").value = globallag;
          document.getElementById("plng").value = globallng;
            

          var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

          var myOptions = {
            zoom: 15,
            center: latlng,
            mapTypeControl: false,
            navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);

          var marker = new google.maps.Marker({
              position: latlng, 
              map: map, 
              title:"You are here! (at least within a "+position.coords.accuracy+" meter radius)"
          });
        
        }

        function error(msg) {
          var s = document.querySelector('#status');
          s.innerHTML = typeof msg == 'string' ? msg : "failed";
          s.className = 'fail';

          // console.log(arguments);
        }

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(success, error);
        } else {
          error('not supported');
        }
    

</script>

<!--/>Google Maps API token. REPLACE with new one</-->    
<script async defer    
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD1TwgO9zEXs9B_70ZX0FC9wGnHcPz9To&callback=initMap">
</script>    

<script src="assets/vender/intl-tel-input/js/intlTelInput.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>	
<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>	
  
  </body>
</html>