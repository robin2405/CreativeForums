<?php
session_start(); // Start your sessions to allow your page to interact with session variables

// Check to see if they person accessing this page is logged in and that there is a category id in the url
if ((!isset($_SESSION['uid'])) || ($_GET['cid'] == "")) {
	header("Location: index.php");
	exit();
}
// Assign local variables found in the url
$cid = $_GET['cid'];
$tid = $_GET['tid'];

include_once("header.php");
?>
<?php
		echo "<p>Go back to <a href='view_topic.php?cid=".$cid."&tid=".$tid."'>Topic</a> - <a href='pages.php?page=24' target='_blank'>Upload a picture</a>.</p>";
		?>
<form action="post_reply_parse.php" method="post">
<textarea name="reply_content" rows="5" cols="75" placeholder="Content"></textarea>
<br /><br />
<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
<input type="hidden" name="tid" value="<?php echo $tid; ?>" />
<center><input type="submit" class="btn btn-sm btn-primary" name="reply_submit" value="Reply" /></center>
</form>
<?php
include_once("footer.php");
?>	