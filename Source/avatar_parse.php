<?php
session_start(); // Start your sessions to allow your page to interact with session variables

// Loading Classes
function LoadClass($class){
    include_once('Classes/' . $class . '.class.php');
}

LoadClass("Connect");
$link = DbConnection::getConnection();

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"] . $random . $_FILES["name"]);
$extension = end($temp);
$random=rand(1, 2500);
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

$uid = $_SESSION['uid'];

$sql = "UPDATE users SET avatar='".$avatar."' WHERE id='".$uid."'";
$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
$row = mysqli_fetch_assoc($res);
header("location: index.php");
mysql_close($con);
?>