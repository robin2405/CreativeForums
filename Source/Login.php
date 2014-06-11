<?php
	// Loading Classes
	function LoadClass($class){
	    include_once('Classes/' . $class . '.class.php');
	}

	LoadClass("Connect");
	LoadClass("Mysql");

	// Function that will retrieve the selected theme
	function getTheme() {
		$link = DbConnection::getConnection();
		$sql = "SELECT SettingValue FROM settings WHERE SettingName='Theme' LIMIT 1";
		$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
		$row = mysqli_fetch_assoc($res);
		return $row['SettingValue'];
	}
	// Function that will retrieve the selected theme
	function getRoot() {
		$link = DbConnection::getConnection();
		$sql = "SELECT SettingValue FROM settings WHERE SettingName='Root' LIMIT 1";
		$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
		$row = mysqli_fetch_assoc($res);
		return $row['SettingValue'];
	}
	
	$getTheme = getTheme();
	$Root = getRoot();

	include_once(dirname(__FILE__)."/Themes/".$getTheme."/LoginHeader.php");
?>

<div class="container">

      <form action="login_parse.php" method="post" class="form-signin" role="form">
        <h2 class="form-signin-heading">Login</h2>
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
			<label class="checkbox">
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
		<br />
		Don't have an account yet? <a href="register.php">Register!</a>
    </form>

</div>