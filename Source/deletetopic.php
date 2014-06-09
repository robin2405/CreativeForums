<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("Classes/Connect.class.php");
$link = DbConnection::getConnection();

$tid = $_GET['tid'];

if ((!isset($_SESSION['uid']))) {

	header("Location: index.php");

	exit();

}

include_once("header.php");


function getposter($tid) {
	$sql = "SELECT topic_creator FROM topics WHERE id='".mysqli_real_escape_string($link, $tid)."' LIMIT 1";
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
	return $row['topic_creator'];
}

function getcid($tid) {
	$sql = "SELECT category_id FROM topics WHERE id='".mysqli_real_escape_string($link, $tid)."' LIMIT 1";
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
	return $row['category_id'];
}

if(".getposter(".$tid.")." == $_SESSION['uid']){
echo '<META HTTP-EQUIV="refresh" CONTENT="5;URL=view_category.php?cid='.getcid($tid).'">';
echo 'you will be redirected to the category in 5 seconds....<br />You don\'t wanna wait? <a href="view_category.php?cid='.getcid($tid).'">click here</a>';
$sql = "DELETE FROM topics WHERE id='".$tid."'";
$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
}elseif($permission==$admin){
echo '<META HTTP-EQUIV="refresh" CONTENT="5;URL=view_category.php?cid='.getcid($tid).'">';
echo 'you will be redirected to the category in 5 seconds....<br />You don\'t wanna wait? <a href="view_category.php?cid='.getcid($tid).'">click here</a>';
$sql = "DELETE FROM topics WHERE id='".$tid."'";
$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
}else{
echo '<h1>404</h1>
	<h3>It’s looking like you may have taken a wrong turn.<br />
Don’t worry... it happens to the best of us.</h3>';
echo '<META HTTP-EQUIV="refresh" CONTENT="5;URL=view_category.php?cid='.getcid($tid).'">';
echo 'you will be redirected to the category in 5 seconds....<br />You don\'t wanna wait? <a href="view_category.php?cid='.getcid($tid).'">click here</a>';
}

include_once("footer.php");
?>