<!doctype html>
<html>
<head>
	<link rel="icon" type="image/ico" href="favicon.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="J-Designs">

    <title>Creative Forums</title>

    <!-- Bootstrap core CSS -->
    <link href="../../bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="../../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="../../bootstrap/css/carousel.css" rel="stylesheet">
	<link href="css/Style.css" rel="stylesheet">
	
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="bootstrap/js/ie8-responsive-file-warning.js"></script><![endif]-->

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
					<a href="profile.php" class="dropdown-toggle" data-toggle="dropdown">'.getusername($uid).'<b class="caret"></b></a>
					<ul class="dropdown-menu">';
					if ($permission==$admin) {
						echo'
						<li class="dropdown-header">Admin</li>
						<li><a href="admin.php">Admin panel</a></li>';
					}
						echo'
						<li class="dropdown-header">User</li>
						<li><a href="editprofile.php">Edit Profile</a></li>
						<li><a href="messages.php">Messages</a></li>
						<li><a href="content.php">Your Content</a></li>						
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

<script language="javascript" type="text/javascript" src="../../tiny_mce/tinymce.min.js"></script>

<script type="text/javascript">

tinymce.init({

    selector: "textarea",

    theme: "modern",

    plugins: [

        "link image charmap preview anchor pagebreak hr",

        "searchreplace wordcount visualblocks visualchars fullscreen insertdatetime media nonbreaking save table contextmenu directionality emoticons paste image textcolor",

    ],

    toolbar1: "insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image preview media | forecolor backcolor emoticons",

    templates: [],

});

</script>

<!-- END TINYMCE SCRIPT -->
</center>
</div>
		<div class="row row-offcanvas row-offcanvas-right">
		<div class="container forum-container" style="padding-top:70px;">
		<div class="col-xs-12 col-sm-9">