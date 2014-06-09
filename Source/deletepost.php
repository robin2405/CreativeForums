<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("Classes/Connect.class.php");
$link = DbConnection::getConnection();

$pid = $_GET['pid'];

if ((!isset($_SESSION['uid']))) {

	header("Location: index.php");

	exit();

}

include_once("header.php");

function getposter($pid) {
	$sql = "SELECT post_creator FROM posts WHERE id='".mysqli_real_escape_string($link, $pid)."' LIMIT 1";
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
	return $row['post_creator'];
}

function gettid($pid) {
	$sql = "SELECT topic_id FROM posts WHERE id='".mysqli_real_escape_string($link, $pid)."' LIMIT 1";
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
	return $row['topic_id'];
}

function getcid($pid) {
	$sql = "SELECT category_id FROM posts WHERE id='".mysqli_real_escape_string($link, $pid)."' LIMIT 1";
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
	return $row['category_id'];
}

if(getposter($pid) == $_SESSION['uid']){
echo '<META HTTP-EQUIV="refresh" CONTENT="5;URL=view_topic.php?cid='.getcid($pid).'&tid='.gettid($pid).'">';
echo 'You will be redirected in 5 seconds....<br />Don\'t wanna wait? <a href="view_topic.php?cid='.getcid($pid).'&tid='.gettid($pid).'">click here</a>';
$sql = "DELETE FROM posts WHERE id='".$pid."'";
$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
}elseif($permission==$admin){
echo '<META HTTP-EQUIV="refresh" CONTENT="5;URL=view_topic.php?cid='.getcid($pid).'&tid='.gettid($pid).'">';
echo 'You will be redirected in 5 seconds....<br />Don\'t wanna wait? <a href="view_topic.php?cid='.getcid($pid).'&tid='.gettid($pid).'">click here</a>';
$sql = "DELETE FROM posts WHERE id='".$pid."'";
$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
}else{
echo '<h1>404</h1>
	<h3>It’s looking like you may have taken a wrong turn.<br />
Don’t worry... it happens to the best of us.</h3>';
echo '<META HTTP-EQUIV="refresh" CONTENT="5;URL=view_topic.php?cid='.getcid($pid).'&tid='.gettid($pid).'">';
echo 'You will be redirected in 5 seconds....<br />Don\'t wanna wait? <a href="view_topic.php?cid='.getcid($pid).'&tid='.gettid($pid).'">click here</a>';
}
include_once("footer.php");
?>