<?php
include_once("header.php");

$table="";
$topics="";

// Function that will count how many replies each topic has
function topic_replies($cid, $tid) {
    $sql = "SELECT count(*) AS topic_replies FROM posts WHERE category_id='".$cid."' AND topic_id='".$tid."'";
    $res = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_assoc($res);
    return $row['topic_replies'] - 1;
}

function getpid($tid) {
$sql = "SELECT post_content FROM posts WHERE post_date = ((SELECT topic_date FROM topics WHERE id='".$tid."')) AND category_id = 1 AND topic_id = '".$tid."' LIMIT 1";
$res = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($res);
return $row['post_content'];
}

// Assign local variables
$cid = 1;

// Query that checks to see if the category specified in the $cid variable actually exists in the database
$sql = "SELECT id FROM categories WHERE id='".$cid."' LIMIT 5";
// Execute the SELECT query
$res = mysql_query($sql) or die(mysql_error());
// Check if the category exists
if (mysql_num_rows($res) == 1) {
    // Select the topics that are associated with this category id and order by the topic_reply_date
    $sql2 = "SELECT * FROM topics WHERE category_id='".$cid."' ORDER BY topic_reply_date DESC LIMIT 5";
    // Execute the SELECT query
    $res2 = mysql_query($sql2) or die(mysql_error());
    // Check to see if there are topics in the category
    if (mysql_num_rows($res2) >= 0) {
        // Appending table data to the $topics variable for output on the page
        $table .= "<div class='table-responsive'>
				   <table class='table table-striped'>";
        $table .= "<thead>
                <tr>
                  <th>Recent News</th>
                  <th></th>
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
			$pid = getpid($tid);
			
                        $sticky = $row['type'];
            // Check om te zien of iemand ooit al een reply gedaan heeft
            if ($row['topic_last_user'] == "") { $last_user = "N/A"; } else { $last_user = getusername($row['topic_last_user']); }
            // Append the actual topic data to the $topics variable
            $topics .= "<tr><td><a href='view_topic.php?cid=".$cid."&tid=".$tid."'>".$title." - <span class='post_info'>Posted on ".convertdate($date)."</span></a>
			<br />
			".$pid."
			</td>
			<td width='105' valign='top'><center>
			<a href='profile.php?username=".getusername($creator)."'><br /><img src=".getavatar($creator)." style='width:70px;height:70px;background:url();background-size:70px 70px;' /><br />
			".getusername($creator)."<br />
			</a>
			<hr />
			".getemail($creator)."
			<br />".getrank($creator)."
			<br />".count_posts($creator)." post(s)
            <br /><br />		
			</center></td></tr>";
			}
        $topics .= "</tbody>
            </table>
			</div>";
        // Displaying the $topics variable on the page
                echo $table;        
                echo $topics;

    }
}
include_once("footer.php");
?>