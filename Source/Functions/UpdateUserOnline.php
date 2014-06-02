<?php
	require "../connect.php";

	session_start(); // Start your sessions to allow your page to interact with session variables
	
	if (isset($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
	} else {
		$uid = "";
	}

	$sql = "UPDATE users SET Last_Active=now() WHERE id='".$uid."'";
	$res = mysql_query($sql) or die(mysql_error());
?>