<?php
session_start(); // Start your sessions to allow your page to interact with session variables
if ($_GET['page'] == 1){
header("Location: home.php");
}
include_once("header.php");
include_once("Classes/Connect.class.php");
$link = DbConnection::getConnection();

// Function that will convert a user id into their username
function getpage($pid) {
	$sql = "SELECT content FROM pages WHERE id='".mysqli_real_escape_string($link, $pid)."' LIMIT 1";
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
	return $row['content'];
}

echo getpage($_GET['page']);

include_once("footer.php");
?>	