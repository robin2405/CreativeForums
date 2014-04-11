<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include('connect.php');

$name=$_POST['name'];
$uid = $_SESSION['uid'];

$sql = "UPDATE users SET username='".$name."' WHERE id='".$uid."'";
$res = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($res);
header("location: index.php");
mysql_close($con);
?>