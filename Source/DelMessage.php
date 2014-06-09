<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("Classes/Connect.class.php");
$link = DbConnection::getConnection();

// Check to see if they person accessing this page is logged in and that there is a category id in the url
if ((!isset($_SESSION['uid']))) {
	header("Location: index.php");
	exit();
}

$uid=$_SESSION['uid'];

Function GetUserID($uid){
	$sql = "SELECT Target FROM Messages WHERE Target='".$uid."' LIMIT 1";
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
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

  $sql = "DELETE FROM Messages WHERE ID='".mysqli_real_escape_string($link, $mid)."'";
  $res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
  mysqli_close($con);
  header("Location: user.php?page=6");
?>