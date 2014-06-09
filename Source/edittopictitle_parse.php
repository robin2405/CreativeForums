<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("Classes/Connect.class.php");
$link = DbConnection::getConnection();

$tid=$_GET['tid'];
$uid=$_SESSION['uid'];
$title=$_POST['topictitle'];
$cid=$_GET['cid'];

// Check to see if they person accessing this page is logged in and that there is a category id in the url

if ((!isset($_SESSION['uid']))) {

	header("Location: index.php");

	exit();

}

function gettitle($tid) {
	$link = DbConnection::getConnection();
	$sql = "SELECT topic_creator FROM topics WHERE id='".mysqli_real_escape_string($link, $tid)."' LIMIT 1";
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
	return $row['topic_creator'];
}

// Check to see if the page_submit form button on the editpage.php page has been clicked
if (gettitle($tid) == $uid){
if (isset($_POST['page_submit'])) {
	// Make sure that the title and content fields have been filled in
	if (($_POST['tid'] == "") && ($_POST['topictitle'] == "")) {
		echo "Vul alles in aub.";
		exit();
	} else {
		$sql = "UPDATE topics SET topic_title='".mysqli_real_escape_string($link, $title)."' WHERE id='".mysqli_real_escape_string($link, $tid)."'";
		$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
		$row = mysqli_fetch_assoc($res);
		header("location: http://craftopianl.com/view_topic.php?cid=$cid&tid=$tid");
		mysql_close($con);
	}
}
}else{
echo "Je bent niet de eigenaar van dit topic dus je kan de naam niet veranderen!<br />";
}
?>