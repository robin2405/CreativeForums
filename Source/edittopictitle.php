<?php

session_start(); // Start your sessions to allow your page to interact with session variables

include_once("Classes/Connect.class.php");
$link = DbConnection::getConnection();

// Assign local variables
$tid = $_GET['tid'];
$cid = $_GET['cid'];


// Check to see if they person accessing this page is logged in and that there is a category id in the url

if ((!isset($_SESSION['uid']))) {

	header("Location: index.php");

	exit();

}

include_once("header.php");



function gettitle($tid) {
	$sql = "SELECT topic_title FROM topics WHERE id='".mysqli_real_escape_string($link, $tid)."' LIMIT 1";
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
	return $row['topic_title'];
}

		echo 'Ga naar <a href="forum.php">forum index</a> - <a href="admin.php">admin index</a> - <a href="pages.php?page=24" target="_blank">Upload een foto</a><br />

		<h3>'.gettitle($pid).'</h3>

		<form action="edittopictitle_parse.php?tid='.$tid.'&cid='.$cid.'" method="post">
		<p>Topic Title</p>
                <input type="text" name="topictitle" size="98" maxlength="150" value="'.gettitle($tid).'"></input>
		<br />
		<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
		<input type="submit" name="page_submit" value="Verander titel" />
		</form>
		';

		

include_once("footer.php");

?>	