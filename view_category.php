<?php
session_start(); // Start your sessions to allow your page to interact with session variables

include_once("header.php");

// Connect to the database
include_once("connect.php");

$table="";
$topics="";

if (isset($_GET['page'])) { $page  = $_GET['page']; } else { $page='1'; };
$start_from = ($page-1) * 20;

// Function that will count how many replies each topic has
function topic_replies($cid, $tid) {
    $sql = "SELECT count(*) AS topic_replies FROM posts WHERE category_id='".$cid."' AND topic_id='".$tid."'";
    $res = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_assoc($res);
    return $row['topic_replies'] - 1;
}

// Assign local variables
$cid = $_GET['cid'];

// Check to see if the person accessing this page is logged in
if (isset($_SESSION['uid'])) {
    $logged = " <button type='button' class='btn btn-sm btn-primary'  onClick=\"window.location = 'create_topic.php?cid=".$cid."'\">Create topic</button>";
} else {
    $logged = " You have to be signed in to make a topic.";
}

function hot($views) {
    if ($views > "100"){
return "<img src='img/hot_topic.png' style='' />";
    } elseif ($views < "100") {
return "<img src='img/normal_topic.png' style='' />";
}
}

// Query that checks to see if the category specified in the $cid variable actually exists in the database
$sql = "SELECT id FROM categories WHERE id='".$cid."' LIMIT $start_from, 20";
// Execute the SELECT query
$res = mysql_query($sql) or die(mysql_error());
// Check if the category exists
if (mysql_num_rows($res) == 1) {
    // Select the topics that are associated with this category id and order by the topic_reply_date
    $sql2 = "SELECT * FROM topics WHERE category_id='".$cid."' ORDER BY topic_reply_date DESC LIMIT $start_from, 20";
    // Execute the SELECT query
    $res2 = mysql_query($sql2) or die(mysql_error());
    // Check to see if there are topics in the category
    if (mysql_num_rows($res2) >= 0) {
        // Appending table data to the $topics variable for output on the page
        $table .= "<div class='table-responsive'>
<table class='table table-striped'>
<thead>
                <tr>
                  <th></th>
                  <th>Topic Info</th>
				  <th></th>
				  <th></th>
				  <th>".$logged."</th>
                </tr>
              </thead>
			  <tbody>";
        // Fetching topic data from the database
        while ($row = mysql_fetch_assoc($res2)) {
            // Assign local variables from the database data
            $tid = $row['id'];
            $title = $row['topic_title'];
            $views = $row['topic_views'];
            $date = $row['topic_date'];
            $creator = $row['topic_creator'];
                        $sticky = $row['type'];
            // Check om te zien of iemand ooit al een reply gedaan heeft
            if ($row['topic_last_user'] == "") { $last_user = "N/A"; } else { $last_user = getusername($row['topic_last_user']); }
            // Append the actual topic data to the $topics variable
            $topics .= "<tr><td>".hot($row['topic_views'])."<td><a href='view_topic.php?cid=".$cid."&tid=".$tid."'>".$title."</a><br /><span class='post_info'>Posted by: ".getusername($creator)." on ".convertdate($date)."</span></td><td align='center' style=''>".$last_user."</td><td>replies:<br />views:</td><td>".topic_replies($cid, $tid)." <br /> ".$views."</td></tr>";
            }
        $topics .= "</tbody>
            </table>
			</div>";
        // Displaying the $topics variable on the page
                echo $table;        
                echo $topics;
$sql = "SELECT id FROM categories WHERE id='".$cid."'"; 
$rs_result = mysql_query($sql2) or die(mysql_error());
$row = mysql_num_rows($rs_result);
$total_pages = ceil($row / 20); 

echo "Pagina ";
for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='?cid=".$cid."&page=".$i."'>".$i."</a> "; 
};
    } else {
        // If there are no topics
        echo "<a href='index.php'>Return To Forum Index</a>";
        echo "<p>There are no topics in this category yet.".$logged."</p>";
    }
	
	echo "<br /><img src='img/hot_topic.png' style='height:20px;width:20px;' /> = Famous Topic 
	<img src='img/normal_topic.png' style='height:20px;width:20px;' /> = Normal Topic
	<img src='img/sticky.png' style='height:20px;width:20px;' /> = Sticky Topic";
} else {
	// If the category does not exist
	echo "<h1>404</h1>
	<h3>It’s looking like you may have taken a wrong turn.<br />
Don’t worry... it happens to the best of us.</h3>";
}
include_once("footer.php");
?>