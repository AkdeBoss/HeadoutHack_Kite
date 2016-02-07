<?php
include_once("server.php");
include_once("functions.php");
if(isset($_GET['id']))
{
	$id = $_GET['id']+1;
	
}
$sql = "SELECT *FROM trips
	 WHERE id = $id";
	$result = mysql_query($sql);
	while($data = mysql_fetch_object($result)){
		$trip[] = array( 	'place_xc' => $data->pace_xc, 
							'place_y' => $data->pace_y, 
							'place_air' => $data->place_air,
							'place_name'=> $data->place_name,
							'place_expn' => $data->place_expense,
							'place_photo' => $data->photo,
							'smile'=> $data->smile

					);
	}

$lat = $trip['0']['place_xc'];
$lng = $trip['0']['place_y'];


$postdata = array(
'request' => array(
'passengers' => array(
	'adultCount' => 1),
'slice'=> array(
	'0' => array(
		'origin' => 'BLR',
		'destination' =>$trip['0']['place_air'] ,
		'date' => '2016-03-01')
	)
)
);

// Setup cURL
$ch = curl_init('https://www.googleapis.com/qpxExpress/v1/trips/search?key=AIzaSyAvHdLqVJday8_qQiWMl-9-4hvuztjAhOw	
');
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        
        'Content-Type: application/json'
    ),

    CURLOPT_POSTFIELDS => json_encode($postdata)
));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Send the request
$response = curl_exec($ch);

// Check for errors
if($response === FALSE){
    die(curl_error($ch));
}

//
//Decode the response
$responseData = json_decode($response, TRUE);

// Print the date from the response


//$data = file_get_contents("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$lat.",".$lng."&radius=500&types=cafe&key=AIzaSyAvHdLqVJday8_qQiWMl-9-4hvuztjAhOw");
//echo $data;

?>



















<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Parallax Template - Materialize</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  

  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text-lighten-2"><?php echo "#";echo$trip['0']['place_name'];?></h1>
        <div class="row center">
          <h5 class="header col s12 light">City to Visit</h5>
        </div>
        <div class="row center">
          
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src=<?php echo$trip['0']['place_photo'] ;?> alt="Unsplashed background img 1"></div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Estimated flight cost</h5>

            <p class="light"><?php echo $responseData['trips']['tripOption']['0']['pricing']['0']['saleTotal'];?><br>It is an estimated one way cost </p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">group</i></h2>
            <h5 class="center">Per day average expenditure</h5>

            <p class="light"><?php echo $trip['0']['place_expn'];?><br> This is the per person average expense of a single day.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Total expenditure</h5>

            <p class="light"><?php echo  (int)$trip['0']['place_expn']+(int)$responseData['trips']['tripOption']['0']['pricing']['0']['saleTotal'];?></p>
          </div>
        </div>
      </div>

    </div>
  </div>


  
     


  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">Kite data says, at this place <?php echo$trip['0']['smile'];?> is average rate of hapiness</a></h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src=<?php echo$trip['0']['place_photo'] ;?> alt="Unsplashed background img 3"></div>
  </div>

  
   


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
