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

echo "<br /><h1><center><a href='deletepage_parse.php?page=".$pid."'>Ja verwijder de pagina...</a> - <a href='editpage2.php'>Keer terug naar pagina index</a></center></h1><br />";

?>