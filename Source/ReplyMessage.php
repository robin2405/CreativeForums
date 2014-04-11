<?php
include_once("connect.php");
include_once("header.php");

$mid=$_GET['mid'];

Function GetSubject($mid){
	$sql = "SELECT Title FROM Messages WHERE ID='".$mid."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['Title'];
}

Function GetTarget($uid){
	$sql = "SELECT Sender FROM Messages WHERE ID='".$uid."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['Sender'];
}

$Target=GetTarget($mid);
$Target=Getusername($Target);
$Onderwerp=GetSubject($mid);

echo '
Go back to: <a href="messages.php">Inbox</a> - <a href="pages.php?page=24" target="_blank">Upload a picture</a>
<form action="newmessage_parse.php" method="post">
	<input type="text" class="form-control" name="target" Value="'.$Target.'">
	<br />
	<input type="text" class="form-control" name="title" Value="RE: '.$Onderwerp.'">
	<br />
	<textarea name="Content">Your Message.</textarea>
	<input type="submit" class="btn btn-lg btn-primary btn-block" value="Reply" />
</form>
';

include_once("footer.php");
?>