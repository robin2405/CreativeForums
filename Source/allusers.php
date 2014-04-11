<?php
session_start(); // Start your sessions to allow your page to interact with session variables
include_once("connect.php");

include_once("header.php");

if (isset($_GET['page'])) { $page  = $_GET['page']; } else { $page='1'; };
$start_from = ($page-1) * 20;

echo "<div class='table-responsive'>
<table class='table table-striped'>
<thead>
                <tr>
                  <th>Avatar</th>
                  <th>Username</th>
				  <th>Rank</th>
				  <th>Last time active</th>
                </tr>
              </thead>
			  <tbody>";
		// Query the posts table for all posts in the specified topic
		$sql2 = "SELECT * FROM users LIMIT $start_from, 20";
		// Execute the SELECT query
		$res2 = mysql_query($sql2) or die(mysql_error());
		// Fetch all the post data from the database
		while ($row2 = mysql_fetch_assoc($res2)) {
			// Echo out the topic post data from the database
			echo "<tr><td valign='top'><a href='".getavatar($row2['id'])."'><img src='".getavatar($row2['id'])."' style='width:50px;height:50px;vertical-align:middle'></a></td>
			<td><a href='profile.php?username=".$row2['username']."'><font style='vertical-align:middle'> ".$row2['username']."</font></a></td>
			<td><font style='vertical-align:middle'> ".$row2['rank']."</font></td>
			<td><font style='vertical-align:middle'> ".convertdate($row2['Last_Active'])."</font></td>
			</tr>";
		}
echo "</tbody>
            </table>
			</div>";
$sql = "SELECT id FROM users"; 
$rs_result = mysql_query($sql2) or die(mysql_error());
$row = mysql_num_rows($rs_result);
$total_pages = ceil($row / 20); 

echo "Page ";
for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='?page=".$i."'>".$i."</a> "; 
};
include_once("footer.php");
?>