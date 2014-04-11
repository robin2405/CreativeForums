<?php
session_start();
require 'connect.php';
require 'password.php';
require 'securimage/securimage.php';

$securimage = new Securimage();

$username=$_POST['username'];
$password = $_POST['password'];
$email=$_POST['email'];
$hash = password_hash($password, PASSWORD_BCRYPT);

if ($securimage->check($_POST['captcha_code']) == false) {
  // the code was incorrect
  // you should handle the error so that the form processor doesn't continue

  // or you can use the following code if there is no validation or you do not know how
  echo "The security code entered was incorrect.<br /><br />";
  echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
  exit;
} else {
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
}
?>