<!doctype html>
<html>
<head>
	<?php
	echo '
	<link rel="icon" type="image/ico" href="Themes/'.$getTheme.'/favicon.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="J-Designs">

    <title>Creative Forums</title>
	
	<link href="Themes/'.$getTheme.'/css/Style.css" rel="stylesheet">';
	?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<body>
<div id="msg" style="font-size:largest;">

<!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Creative Forums</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="forum.php">Forum</a></li>
            <li><a href="#">About</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Features<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
              </ul>
            </li>
          </ul>
		  <ul class="nav navbar-nav navbar-right">
			<?php if (!isset($_SESSION['uid'])) {
				echo'<li><a href="Login.php">Login</a></li>
				<li><a href="register.php">Register</a></li>
				';
			} else {
				echo'
				<li class="dropdown">
					<a href="user.php" class="dropdown-toggle" data-toggle="dropdown">'.User::getusername($uid).'<b class="caret"></b></a>
					<ul class="dropdown-menu">';
					if ($permission==$admin) {
						echo'
						<li class="dropdown-header">Admin</li>
						<li><a href="admin.php">Admin panel</a></li>';
					}
						echo'
						<li class="dropdown-header">User</li>
						<li><a href="user.php">Profile</a></li>
						<li><a href="user.php?page=6">Messages</a></li>
						<li><a href="user.php?page=10">Your Content</a></li>						
					</ul>
				</li>
				<li class="active"><a href="logout_parse.php">Logout</a></li>
				';
			} ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
<center>

<?php
require 'Sources/editor.php';
?>

</center>
</div>
		<div class="row row-offcanvas row-offcanvas-right">
		<div class="container forum-container" style="padding-top:70px;">
		<div class="col-xs-12 col-sm-9">