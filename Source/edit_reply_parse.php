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


		$content=$_POST['reply_content'];
		
		$pid = $_GET['pid'];
        $cid = $_POST['cid'];
        $tid = $_POST['tid'];

		$sql = "UPDATE posts SET post_content='".mysqli_real_escape_string($link, $content)."' WHERE id='".mysqli_real_escape_string($link, $pid)."'";
		// Insert query to enter the information into the posts table
		$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
		$row = mysqli_fetch_assoc($res);
		header("location: view_topic.php?cid=".$cid."&tid=".$tid."");
		mysql_close($con);
?>