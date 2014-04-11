<?php
session_start(); // Start your sessions to allow your page to interact with session variables
include_once("header.php");

include_once("connect.php");

// Function that will convert a user id into their username
function getpage($pid) {
	$sql = "SELECT content FROM pages WHERE id='".$pid."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['content'];
}

echo "".getpage('4')."";

include_once("footer.php");
?>