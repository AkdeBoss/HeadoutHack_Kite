<?php
session_start();
include_once("server.php");
include_once("functions.php");

$smile = $_SESSION['smiling'];
echo $smile;
$sql = "SELECT * from trips  WHERE smile >= '$smile'";
  $result = mysql_query($sql);

  while ($data = mysql_fetch_object($result)){
    $posts[] = array(   'place_name' =>$data->place_name,
        'place_expense' => $data->place_expense,
        'id' => $data->id);
  }
 foreach ($posts as $key => $value){ 
   echo "<a href='tripdetail.php?id=$key'".">".$value['place_name']."</a>";
   echo "<br>";
   
   

}
?>