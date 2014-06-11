<?php
	session_start(); // Start your sessions to allow your page to interact with session variables

	include_once("Classes/Connect.class.php");
	$link = DbConnection::getConnection();

	// Check to see if they person accessing this page is logged in and that there is a category id in the url

	if ((!isset($_SESSION['uid']))) {

		header("Location: index.php");

		exit();

	}

	Function GetUserID($name){
		$link = DbConnection::getConnection();
		$sql = "SELECT id FROM users WHERE username='".mysqli_real_escape_string($link, $name)."' LIMIT 1";
		$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
		$row = mysqli_fetch_assoc($res);
		return $row['id'];
	}

	$title=$_POST['title'];
	$content=$_POST['Content'];
	$lala=$_POST['target'];
	$target=GetUserID($lala);
	$uid=$_SESSION['uid'];

	// Insert query to enter the information into the posts table
	$sql = "INSERT INTO Messages (Sender,Target,Title,Content,Date) VALUES ('".mysqli_real_escape_string($link, $uid)."' ,'".$target."','".mysqli_real_escape_string($link, $title)."','".mysqli_real_escape_string($link, $content)."',now())";
	// Execute the INSERT query
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
	header("location: user.php?page=7");
	mysql_close($con);
?>