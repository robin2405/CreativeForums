<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("connect.php");

// Check to see if they person accessing this page is logged in and that there is a category id in the url
if ((!isset($_SESSION['uid']))) {
	header("Location: index.php");
	exit();
}

// Function that will convert a user id into their Permission
function Target($uid) {
	$sql = "SELECT Target FROM Messages WHERE id='".$uid."'";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['Target'];
}

function view($uid) {
	$sql = "UPDATE Messages SET viewed='1' WHERE id='".$uid."'";
    $res = mysql_query($sql) or die(mysql_error());
}
	
include_once("header.php");

$mid=$_GET['mid'];

echo "
Go back to <a href='messages.php'>inbox</a><br />
<br />
";
if (Target($mid) == $uid) {
view($mid);
echo "<div class='table-responsive'>
<table class='table table-striped'>
<thead>
                <tr>
                  <th>Message</th>
                </tr>
              </thead>
			  <tbody>";
$uid = $_SESSION['uid'];
		// Query the posts table for all posts in the specified topic
		$sql2 = "SELECT * FROM Messages WHERE id='".$mid."' LIMIT 1";
		// Execute the SELECT query
		$res2 = mysql_query($sql2) or die(mysql_error());
		// Fetch all the post data from the database
		while ($row2 = mysql_fetch_assoc($res2)) {
			// Echo out the topic post data from the database
			echo "<tr><td valign='top'>Send by: ".getusername($row2['Sender'])." - ".convertdate($row2['Date'])." <br /><br /> ".$row2['Content']."</td></tr>";
                        echo "</tbody>
            </table>
			</div>";
                        echo "<button type='button' class='btn btn-lg btn-primary btn-block'  onClick=\"window.location = 'ReplyMessage.php?mid=".$mid."'\">Reply</button>";
		}
} else {
	header("Location: index.php");
}
include_once("footer.php");
?>