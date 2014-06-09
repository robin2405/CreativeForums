<?php
session_start(); // Start your sessions to allow your page to interact with session variables

// Loading Classes
function LoadClass($class){
    include_once('Classes/' . $class . '.class.php');
}

LoadClass("Connect");
$link = DbConnection::getConnection();

$email=$_POST['email'];
$uid = $_SESSION['uid'];

$sql = "UPDATE users SET email='".mysqli_real_escape_string($link, $email)."' WHERE id='".$uid."'";
$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
$row = mysqli_fetch_assoc($res);
header("location: index.php");
mysql_close($con);
?>