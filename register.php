<?php
session_start();
error_reporting(0);
?>
<html>
<head>
<title>
Register user
</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>

<body>
	<?php
	$SERVER = "localhost";
$USER = "root";
$PASS = "";
$DATABASE = "hackathon";
   

if (!($mylink = mysql_connect( $SERVER, $USER, $PASS))){
	echo  "<h3>Sorry, could not connect to database.</h3><br/>
	Please contact your system's admin for more help\n";
	exit;
}

mysql_select_db( $DATABASE );

      
	if($_POST["submit"]){
       $username = $_POST['username'];
       $email =  $_POST["email"];
       $password = $_POST["password"];
       $place_x = $_POST["placex"];
       $place_y = $_POST["placey"];
       

		$sql = "INSERT INTO users (username, email, password, place_x, place_y) 
		VALUES ('" .$_POST['username']. "', '" .$_POST['email']. "', '" .$_POST['password']. "', '" .$_POST['placex']. "', '" .$_POST['placey']. "');";


			

        $result = mysql_query($sql);
        $_SESSION['userid'] = mysql_insert_id();
        header("Refresh: 5; URL='profile.php'");
	} 
	?>
  <center><h2> Register at Kite</h2></center>
  <br>
  <br>
  <br>
  <br>
  <div class="container">
<div class="jumbotron">
  <form action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="email" name="email">
  </div>
  <div class="form-group">
    <label for="text">Username</label>
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="email" name="username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
  </div>
    
    <div class="form-group">
 
 <div id="locationField">
  <label for="exampleInputPassword1">Address</label>
      <input id="autocomplete" placeholder="Enter your address"
             onFocus="geolocate()" type="text" class="form-control">
    </div>
  </div>
  <input type = "hidden" name = "placex" id="place_x">
<input type = "hidden" name = "placey" id="place_y">
  
  <input type="submit" class="btn btn-default" name="submit" value="submit">
</form>
</div>
</div>
<script>

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
      {types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();
  
document.getElementById('place_x').value = place.geometry.location.lat();
document.getElementById('place_y').value = place.geometry.location.lng();

  
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
// [END region_geolocation]

    
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA84DmOq0GA7J3Pp1ikXA7gPZg7FHzqxo0&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
</body>