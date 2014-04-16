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


		$content=$_POST['reply_content'];
		
		// Order of replacement
		$str     = $content;
		$order   = array("'");
		$replace = "\'";
		
		$newstr = str_replace($order, $replace, $str);
		
		$content = $newstr;
		
		$pid = $_GET['pid'];
        $cid = $_POST['cid'];
        $tid = $_POST['tid'];

		$sql = "UPDATE posts SET post_content='".$content."' WHERE id='".$pid."'";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		header("location: view_topic.php?cid=".$cid."&tid=".$tid."");
		mysql_close($con);
?>