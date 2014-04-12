<?php
session_start();
require 'connect.php';
require 'password.php';

function getcurpass($uid) {
	$sql = "SELECT password FROM users WHERE id='".$uid."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['password'];
}

function getsalt($uid) {
	$sql = "SELECT salt FROM users WHERE id='".$uid."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['salt'];
}

$oldpass=$_POST['oldpass'];
$newpass=$_POST['newpass'];
$newpass2=$_POST['newpass2'];
$uid = $_SESSION['uid'];
$salt = getsalt($uid);
$oldpass = $salt.$oldpass;
$hash = getcurpass($uid);

if(password_verify($oldpass, $hash)) {
	if($newpass == $newpass2) {
		$password = password_hash($newpass, PASSWORD_BCRYPT);
		$sql = "UPDATE users SET password='".$password."' WHERE id='".$uid."'";
		$res = mysql_query($sql) or die(mysql_error());
		mysql_close($con);
		header("Location: index.php");
		} else {
			echo "<p>The passwords don't match.</p>";
		}
	} else {
		echo "<p>That's not the current password.</p>";
}
?>