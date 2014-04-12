<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("connect.php");

// Check to see if they person accessing this page is logged in and that there is a category id in the url

if ((!isset($_SESSION['uid']))) {

	header("Location: index.php");

	exit();

}

Function GetUserID($name){
	$sql = "SELECT id FROM users WHERE username='".$name."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['id'];
}

                $title=$_POST['title'];
                $content=$_POST['Content'];
                $lala=$_POST['target'];
                $target=GetUserID($lala);
                $uid=$_SESSION['uid'];

		// Insert query to enter the information into the posts table
		$sql = "INSERT INTO Messages (Sender,Target,Title,Content,Date) VALUES ('".$uid."' ,'".$target."','".$title."','".$content."',now())";
		// Execute the INSERT query
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		header("location: user.php?page=7");
		mysql_close($con);
?>