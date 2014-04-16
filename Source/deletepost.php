<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("connect.php");

$pid = $_GET['pid'];

if ((!isset($_SESSION['uid']))) {

	header("Location: index.php");

	exit();

}

include_once("header.php");

function getposter($pid) {
	$sql = "SELECT post_creator FROM posts WHERE id='".$pid."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['post_creator'];
}

function gettid($pid) {
	$sql = "SELECT topic_id FROM posts WHERE id='".$pid."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['topic_id'];
}

function getcid($pid) {
	$sql = "SELECT category_id FROM posts WHERE id='".$pid."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['category_id'];
}

if(getposter($pid) == $_SESSION['uid']){
echo '<META HTTP-EQUIV="refresh" CONTENT="5;URL=view_topic.php?cid='.getcid($pid).'&tid='.gettid($pid).'">';
echo 'You will be redirected in 5 seconds....<br />Don\'t wanna wait? <a href="view_topic.php?cid='.getcid($pid).'&tid='.gettid($pid).'">click here</a>';
$sql = "DELETE FROM posts WHERE id='".$pid."'";
$res = mysql_query($sql) or die(mysql_error());
}elseif($permission==$admin){
echo '<META HTTP-EQUIV="refresh" CONTENT="5;URL=view_topic.php?cid='.getcid($pid).'&tid='.gettid($pid).'">';
echo 'You will be redirected in 5 seconds....<br />Don\'t wanna wait? <a href="view_topic.php?cid='.getcid($pid).'&tid='.gettid($pid).'">click here</a>';
$sql = "DELETE FROM posts WHERE id='".$pid."'";
$res = mysql_query($sql) or die(mysql_error());
}else{
echo '<h1>404</h1>
	<h3>It’s looking like you may have taken a wrong turn.<br />
Don’t worry... it happens to the best of us.</h3>';
echo '<META HTTP-EQUIV="refresh" CONTENT="5;URL=view_topic.php?cid='.getcid($pid).'&tid='.gettid($pid).'">';
echo 'You will be redirected in 5 seconds....<br />Don\'t wanna wait? <a href="view_topic.php?cid='.getcid($pid).'&tid='.gettid($pid).'">click here</a>';
}
include_once("footer.php");
?>