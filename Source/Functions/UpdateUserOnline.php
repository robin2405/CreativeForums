<?php
	session_start(); // Start your sessions to allow your page to interact with session variables
	
	if (isset($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
	} else {
		$uid = "";
	}

	require "../Classes/Connect.class.php";
	$link = DbConnection::getConnection();
	$sql = "UPDATE users SET Last_Active=now() WHERE id='".$uid."'";
	$res = mysqli_query($link, $sql);
?>