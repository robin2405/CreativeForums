<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("connect.php");



// Check to see if they person accessing this page is logged in and that there is a category id in the url

if ((!isset($_SESSION['uid']))) {

	header("Location: index.php");

	exit();

}

if ($permission!=$admin) {

        header("Location: index.php");

	exit();

}

// Check to see if the page_submit form button on the editpage.php page has been clicked
if (isset($_POST['cat_submit'])) {
	// Make sure that the title and content fields have been filled in
	if (($_POST['catdesc'] == "") || ($_POST['catname'] == "") || ($_GET['cid'] == "")) {
		echo "You did not fill in all fields. Please return to the previous page.";
		exit();
	} else {
		$desc=$_POST['catdesc'];
        $title=$_POST['catname'];
		$pid = $_GET['cid'];

		$sql = "UPDATE categories SET category_description='".$desc."' WHERE id='".$pid."'";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		mysql_close($con);
			$sql = "UPDATE categories SET category_title='".$title."' WHERE id='".$pid."'";
			$res = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($res);
			header("location: editcat.php");
			mysql_close($con);
	}
}
?>