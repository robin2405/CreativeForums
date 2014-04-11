<?php
session_start();
require 'connect.php';
require 'password.php';

$username=$_POST['username'];
$password = $_POST['password'];
$email=$_POST['email'];
$hash = password_hash($password, PASSWORD_BCRYPT);

$mysql_date = date( 'Y-m-d' );
      
	$sql = "SELECT * FROM users WHERE username='".$username."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	if (mysql_num_rows($res) == 1) {
		echo "Username already in use.";
	} else {
		mysql_query("INSERT INTO users(username, password, email, rank)VALUES('$username', '$hash', '$email', 'member')");
		header("location: index.php");
		mysql_close($con);
	}
?>