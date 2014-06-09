<?php
session_start();
include_once("Classes/Connect.class.php");
$link = DbConnection::getConnection();

if ((!isset($_SESSION['uid']))) {

	header("Location: index.php");

	exit();

}

if ($permission!=$admin) {

        header("Location: index.php");

	exit();

}

$pid=$_GET['page'];

  $sql = "DELETE FROM pages WHERE id='".mysqli_real_escape_string($link, $pid)."'";
  $res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
  mysqli_close($con);
  header("Location: admin.php?page=3");
?>