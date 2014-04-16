<?php
	require("connect.php");
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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="favicon.ico">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <?php
		echo'<!-- Custom styles for this template -->
		<link href="Themes/'.$getTheme.'/css/login.css" rel="stylesheet">
		<link href="Themes/'.$getTheme.'/css/Style.css" rel="stylesheet">';
	?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

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