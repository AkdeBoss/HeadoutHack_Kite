<?php
session_start();
include_once("server.php");
include_once("functions.php");

$userid = $_SESSION["user_id"];
$body = substr($_POST["body"],0,140);
//$userid = 1;
//$body = "hello";
add_post($userid,$body);
$_SESSION['message'] = "Your post has been added!";

header("Location:index.php");
?>