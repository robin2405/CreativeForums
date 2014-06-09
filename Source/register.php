<?php
	require("connect.php");
	// Function that will retrieve the selected theme
	function getTheme() {
		$sql = "SELECT SettingValue FROM settings WHERE SettingName='Theme' LIMIT 1";
		$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
		$row = mysqli_fetch_assoc($res);
		return $row['SettingValue'];
	}
	// Function that will retrieve the selected theme
	function getRoot() {
		$sql = "SELECT SettingValue FROM settings WHERE SettingName='Root' LIMIT 1";
		$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
		$row = mysqli_fetch_assoc($res);
		return $row['SettingValue'];
	}
	
	$getTheme = getTheme();
	$Root = getRoot();

	include_once(dirname(__FILE__)."/Themes/".$getTheme."/RegisterHeader.php");
	$CurrentUrl = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	$CaptchaUrl = str_replace("register.php", "", $CurrentUrl) . "securimage/securimage_show.php?";
	$captcha = "captcha";

	echo '
	<div class="container">

	    <form action="register_parse.php" method="post" class="form-signin" role="form">
	        <h2 class="form-signin-heading">Register</h2>
	        <input type="username" name="username" class="form-control" placeholder="Username" required autofocus>
	        <input type="email" name="email" class="form-control" placeholder="email" required>
			<input type="password" name="password" class="form-control" placeholder="Password" required>
			<center><img id="captcha" src="http://localhost/Creative%20Forums/securimage/securimage_show.php" /><br />
			<input type="text" class="form-control" name="captcha_code" size="10" maxlength="6" style="width:50%;" />
			<a href="#" onclick="document.getElementById('.$captcha.').src = '.$CaptchaUrl.' + Math.random(); return false">[ Different Image ]</a></center>
			<br /><button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Register</button>
		</form>
	</div>';
?>