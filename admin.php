
<?php
if (isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
} else {
	$uid = "";
}

include_once("connect.php");

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

// if ($permission!=$admin) {
//    header("Location: index.php");
//}
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
        <!-- Bootstrap core CSS -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/dashboard.css" rel="stylesheet">

		<!-- Just for debugging purposes. Don't actually copy this line! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>

<script language="javascript" type="text/javascript" src="tiny_mce/tinymce.min.js"></script>

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
            <li><a href="admin.php">Admin Panel</a></li>
            <li><a href="editprofile.php">Profile Settings</a></li>
            <li><a href="profile.php">Profile</a></li>
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
            <li><a href="AdminPages.php">PageList</a></li>
            <li><a href="addpage.php">Add Page</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="AdminCategories.php">Categories</a></li>
            <li><a href="">Add Category</a></li>
          </ul>
		  <ul class="nav nav-sidebar">
            <li><a href="AdminGallery.php">MediaList</a></li>
            <li><a href="addpic.php">Add Media</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Admin Index</h1>
			
			Welcome on the admin panel,<br />
			Here you can find everything to manage users/pages/posts/categories/...<br />
			This page is still under heavy construction<br />
			
		<!-- FOOTER -->
		<footer>
			<hr class="featurette-divider">
			<p class="pull-right"><a href="#">Back to top</a></p>
			<?php include_once("FooterContent.php"); ?>
		</footer>
		
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/docs.min.js"></script>
</body>
</html>