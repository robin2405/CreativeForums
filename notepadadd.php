<?php
include_once("header.php");
include_once("sidebar.php");
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
echo '
                <form action="notepadadd_parse.php" method="post">
				<p>Beschrijving</p>
				<input type="text" name="catdesc" size="98" maxlength="150" value=""></input>
		<br />
		<input type="submit" name="cat_submit" value="Voeg Note toe!" />
		</form>
';
include_once("footer.php");
?>