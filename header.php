<?php
include_once("connect.php");

session_start(); // Start your sessions to allow your page to interact with session variables

// Function that will retrieve the selected theme
function getTheme() {
	$sql = "SELECT SettingValue FROM settings WHERE SettingName='Theme' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['SettingValue'];
}

	$getTheme = getTheme();
	
	include_once("Themes/".$getTheme."/header.php");
?>