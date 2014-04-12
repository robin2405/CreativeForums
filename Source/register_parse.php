<?php
session_start();
require 'connect.php';
require 'password.php';
require 'securimage/securimage.php';

$securimage = new Securimage();

$username=$_POST['username'];
$password = $_POST['password'];
$email=$_POST['email'];
$salt = "";

if ($securimage->check($_POST['captcha_code']) == false) {
  // the code was incorrect
  // you should handle the error so that the form processor doesn't continue

  // or you can use the following code if there is no validation or you do not know how
  echo "The security code entered was incorrect.<br /><br />";
  echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
  exit;
} else {
	// Accepts these characters for salt.
	$Allowed_Chars =
	'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
	$Chars_Len = 63;

	$Salt_Length = 15;

	for($i=0; $i<$Salt_Length; $i++)
	{
		$salt .= $Allowed_Chars[mt_rand(0,$Chars_Len)];
	}
	
	$password = $salt.$password;
	
	$hash = password_hash($password, PASSWORD_BCRYPT);

	$mysql_date = date( 'Y-m-d' );
      
	$sql = "SELECT * FROM users WHERE username='".$username."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	if (mysql_num_rows($res) == 1) {
		echo "Username already in use.";
	} else {
		mysql_query("INSERT INTO users(username, password, salt, email, rank)VALUES('$username', '$hash', '$salt', '$email', 'member')");
		header("location: index.php");
		mysql_close($con);
	}
}
?>