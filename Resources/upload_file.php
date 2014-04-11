<?php
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"] . $random . $_FILES["name"]);
$extension = end($temp);
$random=rand(1, 2500);
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $random . $_FILES["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("upload/" . $_FILES["file"] . $random ["name"]))
      {
      echo "Probeer opnieuw, lukt het nog niet contacteer dan Jasper ;)";
      }
    else
      {
      $filename=$random . ".png";
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $filename);
      echo "<a href ='/upload/$filename'>$filename</a><br />";
      }
    }
?>