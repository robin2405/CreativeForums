<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("header.php");
?>
<?php

// Check to see if the person accessing this page is logged in
if ($_SESSION['uid']) {
	if (isset($_POST['reply_submit'])) {
		// Connect to the database
		include_once("connect.php");
		// Assign local variables
		$creator = $_SESSION['uid'];
		$cid = $_POST['cid'];
		$tid = $_POST['tid'];
		$reply_content = $_POST['reply_content'];
		
		// Insert query to enter the information into the posts table
		$sql = "INSERT INTO posts (category_id, topic_id, post_creator, post_content, post_date) 
		VALUES ('".mysql_real_escape_string($cid)."', 
             '".mysql_real_escape_string($tid)."', 
             '".mysql_real_escape_string($creator)."', 
             '".mysql_real_escape_string($reply_content)."', 
              now())"; 
		// Execute the INSERT query
		$res = mysql_query($sql) or die(mysql_error());
		// Update query that will update the category that is associated with this topic reply
		$sql2 = "UPDATE categories SET last_post_date=now(), last_user_posted='".$creator."' WHERE id='".$cid."' LIMIT 1";
		// Execute the category UPDATE query
		$res2 = mysql_query($sql2) or die(mysql_error());
		// Update query that will update the topic that is associated with this topic reply
		$sql3 = "UPDATE topics SET topic_reply_date=now(), topic_last_user='".$creator."' WHERE id='".$tid."' LIMIT 1";
		// Execute the topic UPDATE query
		$res3 = mysql_query($sql3) or die(mysql_error());
		
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