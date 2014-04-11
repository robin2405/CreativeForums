<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="favicon.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="Themes/Default/css/register.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<div class="container">

    <form action="register_parse.php" method="post" class="form-signin" role="form">
        <h2 class="form-signin-heading">Register</h2>
        <input type="username" name="username" class="form-control" placeholder="Username" required autofocus>
        <input type="email" name="email" class="form-control" placeholder="email" required>
		<input type="password" name="password" class="form-control" placeholder="Password" required>
		<center><img id="captcha" src="http://localhost/Creative%20Forums/securimage/securimage_show.php" /><br />
		<input type="text" class="form-control" name="captcha_code" size="10" maxlength="6" style="width:50%;" />
		<a href="#" onclick="document.getElementById('captcha').src = 'http://localhost/Creative%20Forums/securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a></center>
		<br /><button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Register</button>
	</form>
</div>