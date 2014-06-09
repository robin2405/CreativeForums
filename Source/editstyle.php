<?php

session_start(); // Start your sessions to allow your page to interact with session variables

include_once("Classes/Connect.class.php");
$link = DbConnection::getConnection();

// Function that will convert a user id into their username
function getstyle($sid) {
	$sql = "SELECT content FROM style WHERE id='".$sid."' LIMIT 1";
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
	return $row['content'];
}

// Check to see if they person accessing this page is logged in and that there is a category id in the url

if ((!isset($_SESSION['uid']))) {

	header("Location: index.php");

	exit();

}

if ($permission!=$admin) {

        header("Location: index.php");

	exit();

}

		echo 'Ga naar <a href="forum.php">forum index</a> - <a href="admin.php">admin index</a><br />

		<form action="editstyle_parse.php" method="post">
		<p>Style Id</p>
		<input type="text" name="pid" size="98" maxlength="150" value="1" readOnly="true"/>
		<br />
		<p>Style Content</p>

		<textarea name="page_content" rows="30" cols="75">'.getstyle('1').'</textarea>
		<br />

		<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
		<input type="submit" name="page_submit" value="Change the style" />
		</form>
		';

?>