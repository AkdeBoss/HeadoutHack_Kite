<?php
session_start();
include_once("server.php");
include_once("functions.php");

$id = $_GET['id'];
$do = $_GET['do'];

switch ($do){
	case "follow":
		follow_user($_SESSION['userid'],$id);
		$userid = $_SESSION['userid'];
		$to = "95gautammittal@gmail.com";
		$subject = "Trip Plan";
		$txt = "Your friend is wanting to plan a trip with you check the collest places at link below";
		$headers = "From: 200mittalgautam@gmail.com";
		mail($to,$subject,$txt,$headers);
		$sql = "INSERT INTO activity (user_id, activity_type, friend_id) 
			VALUES ($userid, 'planned a trip', $id)";

	$result = mysql_query($sql);
	break;

	case "unfollow":
		unfollow_user($_SESSION['userid'],$id);
		$to = "95gautammittal@gmail.com";
		$subject = "Cancel Trip Plan";
		$txt = "Your friend has cancelled ha trip planned with you Checkout at by logging in ";
		$headers = "From: 200mittalgautam@gmail.com";

mail($to,$subject,$txt,$headers);
	break;

}
$_SESSION['message'] = $msg;
//echo "done";
header("Location:profile.php");
?>