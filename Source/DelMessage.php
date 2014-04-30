<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("connect.php");

// Check to see if they person accessing this page is logged in and that there is a category id in the url
if ((!isset($_SESSION['uid']))) {
	header("Location: index.php");
	exit();
}

$uid=$_SESSION['uid'];

Function GetUserID($uid){
	$sql = "SELECT Target FROM Messages WHERE Target='".$uid."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['Target'];
}

if ($uid != GetUserID($uid)){
        header("Location: user.php?page=6");
	exit();
}

function convertdate($date) {
	$date = strtotime($date);
	return date("M j, Y g:ia", $date);
}

$mid=$_GET['mid'];

  $sql = "DELETE FROM Messages WHERE ID='".mysql_real_escape_string($mid)."'";
  $res = mysql_query($sql) or die(mysql_error());
  mysqli_close($con);
  header("Location: user.php?page=6");
?>