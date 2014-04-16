<?php
include_once("header.php");

// Check to see if they person accessing this page is logged in and that there is a category id in the url
if ((!isset($_SESSION['uid'])) || ($_GET['cid'] == "")) {
	header("Location: index.php");
	exit();
}
// Assign local variables found in the url
$cid = $_GET['cid'];
if (!isset($_GET['tid'])) {
	$tid = "";
} else {
	$tid = $_GET['tid'];
}
		echo "Go back to <a href='view_category.php?cid=".$cid."'>Category</a> - <a href='pages.php?page=24' target='_blank'>Upload a picture</a>";
		?>
<form action="create_topic_parse.php" method="post">
<br />
<input class="form-control" type="text" name="topic_title" placeholder="Topic title" required autofocus />
<br />
<textarea name="topic_content" rows="5" cols="75" placeholder="Content"></textarea>
<br />
<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
<input type="submit" class="btn btn-sm btn-primary" name="topic_submit" value="Make the topic" />
</form>
<?php
include_once("footer.php");
?>