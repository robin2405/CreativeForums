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
if (isset($_POST['page_submit'])) {
	// Make sure that the title and content fields have been filled in
	if (($_POST['pid'] == "") && ($_POST['page_content'] == "")) {
		echo "You did not fill in both fields. Please return to the previous page.";
		exit();
	} else {
		$content=$_POST['page_content'];
		$pid = $_POST['pid'];

		$sql = "UPDATE style SET content='".$content."' WHERE id='".$pid."'";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		header("location: admin.php");
		mysql_close($con);
	}
}
?>