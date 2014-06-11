<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("Classes/Connect.class.php");
$link = DbConnection::getConnection();

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
		$sql = "INSERT INTO pages (content,title) VALUES ('Leeg...' ,'".mysqli_real_escape_string($link, $title)."')";
		// Execute the INSERT query
		$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
		$row = mysqli_fetch_assoc($res);
		header("location: admin.php?page=3");
		mysql_close($con);
?>