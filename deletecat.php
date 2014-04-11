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

echo "<br /><h1><center><a href='deletecat_parse.php?cat=".$cid."'>Ja verwijder de categorie...</a> - <a href='editcat.php'>Keer terug naar categorie index</a></center></h1><br />";

?>