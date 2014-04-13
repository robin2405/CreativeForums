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

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"] . $random . $_FILES["name"]);
$extension = end($temp);
$random=rand(2500, 25000);
  if ($_FILES["file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  } else {
    echo "Upload: " . $random . $_FILES["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("Resources/upload/" . $_FILES["file"] . $random ["name"])) {
      echo "Probeer opnieuw, lukt het nog niet contacteer dan Jasper ;)";
      } else {
      $filename=$random . ".png";
	  $avatar = "Resources/upload/" . $filename;
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "Resources/upload/" . $filename);
      }
    }
	
$sql = "INSERT INTO gallery (url) VALUES ('".$avatar."')";
$res = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($res);
header("location: admin.php?page=2");
mysql_close($con);
?>