<?php
session_start();
require 'connect.php';
require 'password.php';

// Function that will convert a user id into their username
function getcurpass($uid) {
	$sql = "SELECT password FROM users WHERE id='".$uid."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['password'];
}

$oldpass=$_POST['oldpass'];
$newpass=$_POST['newpass'];
$newpass2=$_POST['newpass2'];
$uid = $_SESSION['uid'];
$hash = getcurpass($uid);

if(password_verify($oldpass, $hash)) {
	if($newpass == $newpass2) {
		$password = password_hash($newpass, PASSWORD_BCRYPT);
		$sql = "UPDATE users SET password='".$password."' WHERE id='".$uid."'";
		$res = mysql_query($sql) or die(mysql_error());
		mysql_close($con);
		header("Location: index.php");
		} else {
			echo "<p>Uw wachtwoord zijn niet gelijk.</p>";
		}
	} else {
		echo "<p>Het ingegeven huidig wachtwoord is niet gelijk aan het huidige wachtwoord.</p>";
}
?>