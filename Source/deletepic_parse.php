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

$cid=$_GET['cat'];

  $sql = "DELETE FROM gallery WHERE id='".mysql_real_escape_string($cid)."'";
  $res = mysql_query($sql) or die(mysql_error());
  mysqli_close($con);
  header("Location: admin.php?page=2");
?>