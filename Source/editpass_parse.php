<?php
session_start();
require 'connect.php';
require 'password.php';

function getcurpass($uid) {
	$sql = "SELECT password FROM users WHERE id='".$uid."' LIMIT 1";
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
	return $row['password'];
}

function getsalt($uid) {
	$sql = "SELECT salt FROM users WHERE id='".$uid."' LIMIT 1";
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
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
		// Accepts these characters for salt.
		$Allowed_Chars =
		'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
		$Chars_Len = 63;

		$Salt_Length = 15;
		
		$salt="";
		
		for($i=0; $i<$Salt_Length; $i++)
		{
			$salt .= $Allowed_Chars[mt_rand(0,$Chars_Len)];
		}
		
		$newpass = $salt.$newpass;
		$password = password_hash($newpass, PASSWORD_BCRYPT);
		$sql = "UPDATE users SET password='".$password."', salt='".$salt."' WHERE id='".$uid."'";
		$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
		mysql_close($con);
		header("Location: index.php");
		} else {
			echo "<p>The passwords don't match.</p>";
		}
	} else {
		echo "<p>That's not the current password.</p>";
}
?>