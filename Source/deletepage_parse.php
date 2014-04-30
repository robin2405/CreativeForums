<?php
session_start();
include_once("connect.php");

if ((!isset($_SESSION['uid']))) {

	header("Location: index.php");

	exit();

}

if ($permission!=$admin) {

        header("Location: index.php");

	exit();

}

$pid=$_GET['page'];

  $sql = "DELETE FROM pages WHERE id='".mysql_real_escape_string($pid)."'";
  $res = mysql_query($sql) or die(mysql_error());
  mysqli_close($con);
  header("Location: admin.php?page=3");
?>