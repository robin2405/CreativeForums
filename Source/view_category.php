<?php
include_once("header.php");

// Initialize used classes
LoadClass("Topic");

if (isset($_GET['page'])) { $page  = $_GET['page']; } else { $page='1'; };
$start_from = ($page-1) * 20;

// Assign local variables
$cid = $_GET['cid'];

// Check to see if the person accessing this page is logged in
if (isset($_SESSION['uid'])) {
    $logged = " <button type='button' class='btn btn-sm btn-primary'  onClick=\"window.location = 'create_topic.php?cid=".$cid."'\">Create topic</button>";
} else {
    $logged = " You have to be signed in to make a topic.";
}

// Query that checks to see if the category specified in the $cid variable actually exists in the database
$sql = "SELECT id FROM categories WHERE id='".$cid."' LIMIT $start_from, 20";
// Execute the SELECT query
$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
// Check if the category exists
if (mysqli_num_rows($res) == 1) {
    // Select the topics that are associated with this category id and order by the topic_reply_date
    $sql2 = "SELECT * FROM topics WHERE category_id='".$cid."' ORDER BY topic_reply_date DESC LIMIT $start_from, 20";
    // Execute the SELECT query
    $res2 = mysqli_query($link, $sql2) or Mysql::HandleError(mysqli_error($link));
    // Check to see if there are topics in the category
    if (mysqli_num_rows($res2) >= 0) {
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
        while ($row = mysqli_fetch_assoc($res2)) {
            // Assign local variables from the database data
            $tid = $row['id'];
            $title = $row['topic_title'];
            $views = $row['topic_views'];
            $date = $row['topic_date'];
            $creator = $row['topic_creator'];
                        $sticky = $row['type'];
            // Check om te zien of iemand ooit al een reply gedaan heeft
            if ($row['topic_last_user'] == "") { $last_user = "N/A"; } else { $last_user = User::getusername($row['topic_last_user']); }
            // Append the actual topic data to the $topics variable
            $topics .= "<tr><td>".Topic::hot($row['topic_views'], $Root, $getTheme)."<td><a href='view_topic.php?cid=".$cid."&tid=".$tid."'>".$title."</a><br /><span class='post_info'>Posted by: ".User::getusername($creator)." on ".Convert::convertdate($date)."</span></td><td align='center' style=''>".$last_user."</td><td>replies:<br />views:</td><td>".Topic::topic_replies($cid, $tid)." <br /> ".$views."</td></tr>";
            }
        $topics .= "</tbody>
            </table>
			</div>";
        // Displaying the $topics variable on the page
        echo $table;        
        echo $topics;

$sql = "SELECT id FROM categories WHERE id='".mysqli_real_escape_string($link, $cid)."'"; 
$rs_result = mysqli_query($link, $sql2) or Mysql::HandleError(mysqli_error($link));
$row = mysqli_num_rows($rs_result);
$total_pages = ceil($row / 20); 

echo "Page ";
for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='?cid=".$cid."&page=".$i."'>".$i."</a> "; 
};
    } else {
        // If there are no topics
        echo "<a href='index.php'>Return To Forum Index</a>";
        echo "<p>There are no topics in this category yet.".$logged."</p>";
    }
    	echo "<br /><img src='".$Root."/Themes/".$getTheme."/img/hot_topic.png' style='height:20px;width:20px;' /> = Hot Topic 
    	<img src='".$Root."/Themes/".$getTheme."/img/normal_topic.png' style='height:20px;width:20px;' /> = Normal Topic
    	<img src='".$Root."/Themes/".$getTheme."/img/sticky.png' style='height:20px;width:20px;' /> = Sticky Topic";
    } else {
    	// If the category does not exist
    	echo "<h1>404</h1>
    	<h3>It’s looking like you may have taken a wrong turn.<br />
        Don’t worry... it happens to the best of us.</h3>";
    }

include_once("footer.php");
?>