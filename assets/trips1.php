<?php
if($_GET['lat']){
  $lat	= $_GET['lat'];
  $lng  = $_GET['lng'];
}
 $data = file_get_contents("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$lat.",".$lng."&radius=500&types=cafe&key=AIzaSyAvHdLqVJday8_qQiWMl-9-4hvuztjAhOw");
 echo $data;
 
?>