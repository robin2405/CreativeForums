<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("connect.php");

// Check to see if they person accessing this page is logged in and that there is a category id in the url

if ((!isset($_SESSION['uid']))) {

	header("Location: index.php");

	exit();

}

if ($permission!=$admin) {

        header("Location: index.php");

	exit();

}

                $title=$_POST['pagename'];

		// Insert query to enter the information into the posts table
		$sql = "INSERT INTO pages (content,title) VALUES ('Leeg...' ,'".$title."')";
		// Execute the INSERT query
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		header("location: editpage2.php");
		mysql_close($con);
?>