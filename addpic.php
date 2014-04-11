<?php
include_once("header.php");

// Check to see if they person accessing this page is logged in and that there is a category id in the url

if ((!isset($_SESSION['uid']))) {

	header("Location: index.php");

	exit();

}

if ($permission!=$admin) {

        header("Location: index.php");

	exit();

}
echo '
<form action="addpic_parse.php" enctype="multipart/form-data" method="post">
<tr>
<td><p>Foto:</p></td>
<td><p><label for="file">Bestand:</label> <input id="file" name="file" type="file" /><br /> <input name="submit" type="submit" value="Voeg foto toe!" /></p></td>
</tr>
</form>
';
include_once("footer.php");
?>