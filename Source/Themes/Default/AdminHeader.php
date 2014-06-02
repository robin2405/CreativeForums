<?php
  require "connect.php";

  session_start(); // Start your sessions to allow your page to interact with session variables
  
  if (isset($_SESSION['uid'])){
    $uid = $_SESSION['uid'];
  } else {
    $uid = "";
  }

  // PreDefined Variables
  $logged="";
  $table="";
  $pages="";
  $topics="";

  // Setting the players online status
  echo'<script language="javascript">
        window.setInterval(
          function cancelClicked() {
              // function below will run clear.php?h=michael
              $.ajax({
                  url: "Functions/UpdateUserOnline.php" ,
                  success : function() { 
                      // Do something when the code is executed
                  }
              });
          }
        , 5000);
    </script>';

  // Loading Classes
  function LoadClass($class){
      include_once('Classes/' . $class . '.class.php');
  }

  LoadClass("Mysql");
  LoadClass("Convert");
  LoadClass("Site");
  LoadClass("User");

  $permission = User::getpermission($uid);
  $admin = 'admin';
  
  $getTheme = Site::getTheme();
  $Root = Site::getRoot();

  if ($permission!=$admin) {
    header("Location: index.php");
  }
?>

<!doctype html>
<html lang="en">
<head>
		<link rel="icon" type="image/ico" href="favicon.ico">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
        <title>Admin Panel</title>
        <?php 
		echo' <!-- Bootstrap core CSS -->
		<link href="'.$Root.'bootstrap/css/bootstrap.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="'.$Root.'/Themes/'.$getTheme.'/css/dashboard.css" rel="stylesheet">
		';
		?>

		<!-- Just for debugging purposes. Don't actually copy this line! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>

<?php
	echo' <script language="javascript" type="text/javascript" src="'.$Root.'tiny_mce/tinymce.min.js"></script>';
?>

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
</div>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="admin.php">Admin Panel</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="user.php">Profile</a></li>
            <li><a href="index.php">Home</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="admin.php">Overview</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="admin.php?page=3">PageList</a></li>
            <li><a href="admin.php?page=4">Add Page</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="admin.php?page=1">Categories</a></li>
            <li><a href="admin.php?page=5">Add Category</a></li>
          </ul>
		  <ul class="nav nav-sidebar">
            <li><a href="admin.php?page=2">MediaList</a></li>
            <li><a href="admin.php?page=6">Add Media</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">