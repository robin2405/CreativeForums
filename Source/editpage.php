<?php
include_once("header.php");

// Assign local variables
$pid = $_GET['pid'];

// Check to see if they person accessing this page is logged in and that there is a category id in the url
if ((!isset($_SESSION['uid']))) {

	header("Location: index.php");

	exit();

}

if ($permission!=$admin) {

        header("Location: index.php");

	exit();

}

function getpage($pid) {
	$sql = "SELECT content FROM pages WHERE id='".mysql_real_escape_string($pid)."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['content'];
}

function gettitle($pid) {
	$sql = "SELECT title FROM pages WHERE id='".mysql_real_escape_string($pid)."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['title'];
}

		echo 'Ga naar <a href="forum.php">forum index</a> - <a href="admin.php">admin index</a> - <a href="pages.php?page=24" target="_blank">Upload een foto</a><br />

		<h3>'.gettitle($pid).'</h3>

		<form action="editpage_parse.php" method="post">
		<p>Page Id - VERANDER DIT GETAL NIET!!!</p>
		<input type="text" name="pid" size="98" maxlength="150"  value="'.$pid.'"/>
                <p>Page Title</p>
                <input type="text" name="pagename" size="98" maxlength="150" value="'.gettitle($pid).'"></input>
		<br />
		<p>Page Content</p>

		<textarea name="page_content" rows="5" cols="75">'.getpage($pid).'</textarea>
		<br />

		<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
		<input type="submit" name="page_submit" value="Change the page" />
		</form>
		';

		

include_once("footer.php");

?>	