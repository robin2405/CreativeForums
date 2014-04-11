<?php
include_once("header.php");

// Function that will convert a user id into their email
function getuid($uid) {
	$sql = "SELECT id FROM users WHERE username='".$uid."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['id'];
}

$sql = "SELECT * FROM posts WHERE post_creator='".$uid."'";
$res = mysql_query($sql) or die(mysql_error());
$post_count = mysql_num_rows($res);

if (isset($_GET['username'])){
	$username = $_GET['username'];
} else {
	$username = "";
}

if ($username == "") {
	if (isset($_SESSION['uid'])){
		echo "
		<br />
		Ga naar <a href='forum.php'>forum index</a>
		<br />
		<center>
		<table>
		<tr><td><center>".getusername($uid)."</center><br /></td></tr>
		<tr><td><center><img src='".getavatar($uid)."' style='width:200px;height:200px;' /></center><br /></td></tr>
		<tr><td><center>Email: ".getemail($uid)."</center><br /></td></tr>
		<tr><td><center>Rang: ".getrank($uid)."</center><br /></td></tr>
		<tr><td><center>Posts: ".$post_count."</center><br /></td></tr>
		</table>
		</center>
		<br />
		";
	} else {
		echo "<h1>404</h1>
		<h3>It’s looking like you may have taken a wrong turn.<br />
		Don’t worry... it happens to the best of us.</h3>";
	}
} else {
	$uid2 = getuid($username);
	echo "<br />
	Ga naar <a href='forum.php'>forum index</a>
	<br />
	<center>
	<table>
	<tr><td><center>".getusername($uid2)."</center><br /></td></tr>
	<tr><td><center><img src='".getavatar($uid2)."' style='width:200px;height:200px;' /></center><br /></td></tr>
	<tr><td><center>Email: ".getemail($uid2)."</center><br /></td></tr>
	<tr><td><center>Rang: ".getrank($uid2)."</center><br /></td></tr>
	<tr><td><center>Posts: ".count_posts($uid2)."</center><br /></td></tr>
	</table>
	</center>
	<br />";
}

include_once("footer.php");
?>