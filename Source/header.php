<?php
	require "connect.php";

	session_start(); // Start your sessions to allow your page to interact with session variables
	
	if (isset($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
	} else {
		$uid = "";
	}

	$sql = "UPDATE users SET Last_Active=now() WHERE id='".$uid."'";
	$res = mysql_query($sql) or die(mysql_error());

	// PreDefined Variables
	$logged="";
	$table="";
	$pages="";
	$topics="";

	function convertdate($date) {
		$date = strtotime($date);
		return date("M j, Y g:ia", $date);
	}

	function count_posts($uid) {
		$sql = "SELECT * FROM posts WHERE post_creator='".$uid."'";
		$res = mysql_query($sql) or die(mysql_error());
		$post_count = mysql_num_rows($res);
		return $post_count;
	}

	// Function that will convert a user id into their email addres
	function getemail($uid) {
		$sql = "SELECT email FROM users WHERE id='".$uid."' LIMIT 1";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		return $row['email'];
	}


	// Function that will convert a user id into their rank
	function getrank($uid) {
		$sql = "SELECT rank FROM users WHERE id='".$uid."' LIMIT 1";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		return $row['rank'];
	}

	// Function that will convert a user id into their Permission
	function getpermission($uid) {
		$sql = "SELECT Permission FROM users WHERE id='".$uid."'";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		return $row['Permission'];
	}

	function getusername($uid) {
		$sql = "SELECT username FROM users WHERE id='".$uid."' LIMIT 1";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		return $row['username'];
	}

	// Function that will convert a user id into their username
	function getstyle($sid) {
		$sql = "SELECT content FROM style WHERE id='".$sid."' LIMIT 1";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		return $row['content'];
	}

	// Function that will convert a user id into their username
	function count_onlineusers() {
	 $sql = "SELECT * FROM users WHERE TIMESTAMPDIFF(SECOND,`last_Active`,NOW()) <= 1";
	 $res = mysql_query($sql) or die(mysql_error());
	 $post_count = mysql_num_rows($res);
	 return $post_count;
	}

	// Function that will convert a user id into their username
	function count_registered() {
	 $sql = "SELECT * FROM users";
	 $res = mysql_query($sql) or die(mysql_error());
	 $post_count = mysql_num_rows($res);
	 return $post_count;
	}

	// Function that will convert a user id into their username
	function count_messages($uid) {
	 $sql = "SELECT * FROM Messages WHERE Target='".$uid."' AND viewed='0'";
	 $res = mysql_query($sql) or die(mysql_error());
	 $mess_count = mysql_num_rows($res);
	 return $mess_count;
	}

	// Function that will convert a user id into their avatar
	function getavatar($uid) {
		$sql = "SELECT avatar FROM users WHERE id='".$uid."' LIMIT 1";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		return $row['avatar'];
	}

	$permission = getpermission($uid);
	$admin = 'admin';
	
	// Function that will retrieve the selected theme
	function getTheme() {
		$sql = "SELECT SettingValue FROM settings WHERE SettingName='Theme' LIMIT 1";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		return $row['SettingValue'];
	}
	// Function that will retrieve the selected theme
	function getRoot() {
		$sql = "SELECT SettingValue FROM settings WHERE SettingName='Root' LIMIT 1";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		return $row['SettingValue'];
	}
	
	$getTheme = getTheme();
	$Root = getRoot();
	
	include_once(dirname(__FILE__)."/Themes/".$getTheme."/header.php");
?>