<?php
session_start();
include_once("server.php");
include_once("functions.php");
?>
<html>
<head>
<title>
Add places you have visited
</title>
</head>
<body>
	<?php
if($_POST["submit"]){
       $address = $_POST['address'];
       $place_x =  $_POST["placex"];
       $place_y = $_POST["placey"];
       
       

		$sql = "INSERT INTO markers (address, lat, lng) 
		VALUES ('" .$_POST['address']. "', '" .$_POST['placex']. "', '" .$_POST['placey']. "');";


			

        $result = mysql_query($sql);
        
        header("Refresh: 5; URL='profile.php'");
	} 
	?>
<form action ="" method="post">

 <div id="locationField">
      <input id="autocomplete" placeholder="Enter your address"
             onFocus="geolocate()" type="text" name="address"></input>
    </div>
<input type = "text" name = "placex" id="place_x">
<input type = "text" name = "placey" id="place_y">
<input  type = "submit"  name = "submit" value = "submit"> 

</form>
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
</html>