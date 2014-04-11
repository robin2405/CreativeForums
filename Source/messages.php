<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("connect.php");

// Check to see if they person accessing this page is logged in and that there is a category id in the url
if ((!isset($_SESSION['uid']))) {
	header("Location: index.php");
	exit();
}

include_once("header.php");

if (isset($_GET['page'])) { $page  = $_GET['page']; } else { $page='1'; };
$start_from = ($page-1) * 5;

echo "
<center>
<button type='button' class='btn btn-sm btn-primary'  onClick=\"window.location = 'outbox.php'\">Outbox</button>
</center>
<br />
";

echo "<div class='table-responsive'>
<table class='table table-striped'>
<thead>
                <tr>
                  <th>Messages</th>
				  <th></th>
				  <th></th>
				  <th><div align='right'><button type='button' class='btn btn-sm btn-primary'  onClick=\"window.location = 'newmessage.php'\">Compose Message</button></div></th>
                </tr>
              </thead>
			  <tbody>";
$uid = $_SESSION['uid'];
		// Query the posts table for all posts in the specified topic
		$sql2 = "SELECT * FROM Messages WHERE Target='".$uid."' LIMIT $start_from, 5";
		// Execute the SELECT query
		$res2 = mysql_query($sql2) or die(mysql_error());
		// Fetch all the post data from the database
		while ($row2 = mysql_fetch_assoc($res2)) {
			// Echo out the topic post data from the database
                        $mid=$row2['ID'];
			echo "<tr><td valign='top'><a href='ReadMessage.php?mid=".$mid."'>Send by: ".getusername($row2['Sender'])."</td><td>Subject: ".$row2['Title']."</td><td>".convertdate($row2['Date'])."</a></td><td><a href='DelMessage.php?mid=".$mid."'>Delete</a></td></tr>";
		}
echo "</tbody>
            </table>
			</div>";
$sql = "SELECT * FROM Messages WHERE Target='".$uid."'"; 
$rs_result = mysql_query($sql) or die(mysql_error());
$row = mysql_num_rows($rs_result);
$total_pages = ceil($row / 5); 
echo "Page ";
for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='?page=".$i."'>".$i."</a> ";
}
include_once("footer.php");
?>