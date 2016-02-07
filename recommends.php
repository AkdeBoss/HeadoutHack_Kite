<?php
session_start();
include_once("server.php");
include_once("functions.php");

$img=$_FILES['img'];
if(isset($_POST['submit'])){ 
 if($img['name']==''){  
  echo "<h2>An Image Please.</h2>";
 }else{
  $filename = $img['tmp_name'];
  $client_id="364992387298fe3";
  $handle = fopen($filename, "r");
  $data = fread($handle, filesize($filename));
  $pvars   = array('image' => base64_encode($data));
  $timeout = 30;
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
  curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
  $out = curl_exec($curl);
  curl_close ($curl);
  $pms = json_decode($out,true);
  $url=$pms['data']['link'];
  if($url!=""){
   echo "<h2>Uploaded Without Any Problem</h2>";
   echo $url;






$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://apius.faceplusplus.com/v2/detection/detect?api_key=5012574a83d799132dfb95dc5a2ba2d5&api_secret=AyGKY2doAYpQc_4Ddnkcldll3FdTQ_pd&url='.$url.''));
// Send the request & save response to $resp
$resp = curl_exec($curl);

$l = json_decode($resp ,true);


$smiling =  $l['face']['0']['attribute']['smiling']['value'];
$_SESSION['smiling'] = $smiling;
if( $smiling>0 && $smiling<20 )
{
	header("Refresh: 5; URL='trips1.php'");

}
else if($smiling>20 && $smiling<40)
{
	
header("Refresh: 5; URL='trips2.php'");
}

else if($smiling>40 && $smiling<60)
{
	header("Refresh: 5; URL='trips3.php'");
}

else if($smiling>60 && $smiling<80)
{
	header("Refresh: 5; URL='trips4.php'");



}

else if ($smiling>80 && $smiling<100)
{
	echo "you are quite energetic";
	header("Refresh: 5; URL='trips5.php'");
}
else {
	"watch tv";
}

// Close request to clear up some resources
curl_close($curl);





  }else{
   echo "<h2>There's a Problem</h2>";
   echo $pms['data']['error'];  
  } 
 }
}

?>