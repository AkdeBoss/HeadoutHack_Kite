<?php
/**
 *  Example API call
 *  GET profile information
 */

// the ID of the profile


// set up the curl resource


function httpGet($url)
{
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
 curl_setopt($ch,CURLOPT_HEADER, false); 
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}

echo httpGet(" GET https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=500&types=food&name=cruise&key=AIzaSyA84DmOq0GA7J3Pp1ikXA7gPZg7FHzqxo0");
$data = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=500&types=food&name=cruise&key=AIzaSyA84DmOq0GA7J3Pp1ikXA7gPZg7FHzqxo0');
echo $data;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=500&types=food&name=cruise&key=AIzaSyA84DmOq0GA7J3Pp1ikXA7gPZg7FHzqxo0");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);

// execute the request

$output = curl_exec($ch);

// output the profile information - includes the header

$ss = json_decode($output, true);

print_r($ss);
// close curl resource to free up system resources

curl_close($ch);
?>