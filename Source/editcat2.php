<?php
	session_start(); // Start your sessions to allow your page to interact with session variables

	include_once("Classes/Connect.class.php");
	$link = DbConnection::getConnection();

	// Assign local variables
	$pid = $_GET['cid'];

	// Check to see if they person accessing this page is logged in and that there is a category id in the url
	if ((!isset($_SESSION['uid']))) {
		header("Location: index.php");
		exit();
	}

	if ($permission!=$admin) {
		header("Location: index.php");
		exit();
	}

	include_once("header.php");



	function getdesc($pid) {
		$link = DbConnection::getConnection();
		$sql = "SELECT category_description FROM categories WHERE id='".mysqli_real_escape_string($link, $pid)."' LIMIT 1";
		$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
		$row = mysqli_fetch_assoc($res);
		return $row['category_description'];
	}

	function gettitle($pid) {
		$link = DbConnection::getConnection();
		$sql = "SELECT category_title FROM categories WHERE id='".mysqli_real_escape_string($link, $pid)."' LIMIT 1";
		$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
		$row = mysqli_fetch_assoc($res);
		return $row['category_title'];
	}

	echo 'Ga naar <a href="forum.php">forum index</a> - <a href="admin.php">admin index</a><br />

	<h3>'.gettitle($pid).'</h3>

	<form action="editcat2_parse.php?cid='.$pid.'" method="post">
		<p>Categorie titel</p>
		<input type="text" name="catname" size="98" maxlength="150" value="'.gettitle($pid).'"></input>
		<p>Beschrijving</p>
		<input type="text" name="catdesc" size="98" maxlength="150" value="'.getdesc($pid).'"></input>
		<input type="submit" name="cat_submit" value="Pas de category aan!" />
	</form>';

	include_once("footer.php");
?>	