<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("connect.php");

// Check to see if they person accessing this page is logged in and that there is a category id in the url
if ((!isset($_SESSION['uid']))) {
	header("Location: index.php");
	exit();
}

function convertdate($date) {
	$date = strtotime($date);
	return date("M j, Y g:ia", $date);
}

include_once("header.php");
include_once("sidebar.php");

if (isset($_GET['page'])) { $page  = $_GET['page']; } else { $page='1'; };
$start_from = ($page-1) * 5;

echo "
Ga naar <a href='forum.php'>Forum Index</a> - <a href='messages.php'>Inbox</a><br />
<br />
";

echo "<table class='bordered'><th>INBOX</th>";
$uid = $_SESSION['uid'];
		// Query the posts table for all posts in the specified topic
		$sql2 = "SELECT * FROM Messages WHERE Sender='".$uid."' LIMIT $start_from, 5";
		// Execute the SELECT query
		$res2 = mysql_query($sql2) or die(mysql_error());
		// Fetch all the post data from the database
		while ($row2 = mysql_fetch_assoc($res2)) {
                        $mid=$row2['ID'];
			// Echo out the topic post data from the database
			echo "<tr><td valign='top'><a href='ReadMessage.php?mid=".$mid."'>Gezonden naar: ".getusername($row2['Target'])." - ".$row2['Title']." - ".convertdate($row2['Date'])."</a></td></tr>";
		}
echo "</table>";
$sql = "SELECT * FROM Messages WHERE Target='".$uid."'"; 
$rs_result = mysql_query($sql) or die(mysql_error());
$row = mysql_num_rows($rs_result);
$total_pages = ceil($row / 5); 
echo "Pagina ";
for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='?page=".$i."'>".$i."</a> ";
}
include_once("footer.php");
?>