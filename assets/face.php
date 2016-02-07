<?php
if($_GET['url']){
$curl = curl_init();

$url = $_GET['url'];

curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://apius.faceplusplus.com/v2/detection/detect?api_key=5012574a83d799132dfb95dc5a2ba2d5&api_secret=AyGKY2doAYpQc_4Ddnkcldll3FdTQ_pd&url='.$url.''));
// Send the request & save response to $resp
$resp = curl_exec($curl);

echo $resp;
}


// Close request to clear up some resources
curl_close($curl);

?>