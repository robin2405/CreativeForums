<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("header.php");
?>
<?php

// Check to see if the person accessing this page is logged in
if ($_SESSION['uid']) {
	if (isset($_POST['reply_submit'])) {
		// Connect to the database
		include_once("Classes/Connect.class.php");
$link = DbConnection::getConnection();
		// Assign local variables
		$creator = $_SESSION['uid'];
		$cid = $_POST['cid'];
		$tid = $_POST['tid'];
		$reply_content = $_POST['reply_content'];
		
		// Insert query to enter the information into the posts table
		$sql = "INSERT INTO posts (category_id, topic_id, post_creator, post_content, post_date) 
		VALUES ('".mysqli_real_escape_string($link, $cid)."', 
             '".mysqli_real_escape_string($link, $tid)."', 
             '".mysqli_real_escape_string($link, $creator)."', 
             '".mysqli_real_escape_string($link, $reply_content)."', 
              now())"; 
		// Execute the INSERT query
		$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
		// Update query that will update the category that is associated with this topic reply
		$sql2 = "UPDATE categories SET last_post_date=now(), last_user_posted='".mysqli_real_escape_string($link, $creator)."' WHERE id='".mysqli_real_escape_string($link, $cid)."' LIMIT 1";
		// Execute the category UPDATE query
		$res2 = mysqli_query($link, $sql2) or Mysql::HandleError(mysqli_error($link));
		// Update query that will update the topic that is associated with this topic reply
		$sql3 = "UPDATE topics SET topic_reply_date=now(), topic_last_user='".mysqli_real_escape_string($link, $creator)."' WHERE id='".mysqli_real_escape_string($link, $tid)."' LIMIT 1";
		// Execute the topic UPDATE query
		$res3 = mysqli_query($link, $sql3) or Mysql::HandleError(mysqli_error($link));
		
		// Check to make sure all the required queries have been executed
		if (($res) && ($res2) && ($res3)) {
			echo "<META HTTP-EQUIV='refresh' CONTENT='5;URL=view_topic.php?cid=".$cid."&tid=".$tid."' />
                               <p>Your answer has been succesfully posted. </p>
                               <p>You will be redirected to the topic in 5seconds</p>
                                 <p>If you don't want to wait: <a href='view_topic.php?cid=".$cid."&tid=".$tid."'>Click here to go to the topic.</a></p>";
		} else {
			echo "<p>Er was een probleem met het antwoorden probeer later opnieuw als het nog is mislukt contacteer de website eigenaar.</p>";
		}
		
	} else {
		exit();
	}
} else {
	exit();
}
?>
<?php
include_once("footer.php");
?>