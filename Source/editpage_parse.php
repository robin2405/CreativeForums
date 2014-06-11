<?php
	session_start(); // Start your sessions to allow your page to interact with session variables

	include_once("Classes/Connect.class.php");
	$link = DbConnection::getConnection();



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
	                $title=$_POST['pagename'];
			$pid = $_POST['pid'];

			$sql = "UPDATE pages SET content='".mysqli_real_escape_string($link, $content)."' WHERE id='".mysqli_real_escape_string($link, $pid)."'";
			$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
			$row = mysqli_fetch_assoc($res);
	                mysql_close($con);
	                $sql = "UPDATE pages SET title='".mysqli_real_escape_string($link, $title)."' WHERE id='".mysqli_real_escape_string($link, $pid)."'";
			$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
			$row = mysqli_fetch_assoc($res);
			header("location: editpage2.php");
			mysql_close($con);
		}
	}
?>