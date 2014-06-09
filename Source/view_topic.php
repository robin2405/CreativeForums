<?php
include_once("header.php");

$creator="";

if (isset($_GET['page'])) { $page  = $_GET['page']; } else { $page='1'; };
$start_from = ($page-1) * 5;

// Assign local variables from the variables in the URL
$cid = $_GET['cid'];
$tid = $_GET['tid'];

// Select the topic data depending on the $cid and $tid variables
$sql = "SELECT * FROM topics WHERE category_id='".mysqli_real_escape_string($link, $cid)."' AND id='".mysqli_real_escape_string($link, $tid)."' LIMIT 1";

// Execute the SELECT query
$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
$row = mysqli_fetch_assoc($res);

function get_postid($uid) {
	$sql = "SELECT * FROM posts WHERE post_creator='".$uid."'";
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
	return $row['id'];
}

// Assign local variables from the variables in the URL
$cid = $_GET['cid'];
$tid = $_GET['tid'];
// Select the topic data depending on the $cid and $tid variables
$sql = "SELECT * FROM topics WHERE category_id='".mysqli_real_escape_string($link, $cid)."' AND id='".mysqli_real_escape_string($link, $tid)."' LIMIT 1";
// Execute the SELECT query
$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
// Check to see if the topic exists
if (mysqli_num_rows($res) == 1) {
	echo "Go back to the <a href='view_category.php?cid=".$cid."'>category</a>";
	echo "<br>Views: ".$row['topic_views']."<br>";
	echo "<div class='table-responsive'>
<table class='table table-striped'>
<thead>
              ";
	// Check to see if the person accessing this page is logged in
	if ($uid != "") { echo "<tr><th>".$row['topic_title']."<a href='edittopictitle.php?tid=".$tid."&cid=".$cid."'><img src='".$Root."Themes/".$getTheme."/img/modify.gif' style='height:20px;width:20px;'/></a></th><th><input type='submit' class='btn btn-sm btn-primary' value='Reply to this topic' onClick=\"window.location = 'post_reply.php?cid=".$cid."&tid=".$tid."'\" /></th></thead>
			  <tbody>"; } else { echo "<tr><th>".$row['topic_title']."</th><th><p>Log in to reply.</p></th></tr></thead>
			  <tbody>"; }
	// Fetch all the topic data from the database
	while ($row = mysqli_fetch_assoc($res)) {
		// Query the posts table for all posts in the specified topic
		$sql2 = "SELECT * FROM posts WHERE category_id='".mysqli_real_escape_string($link, $cid)."' AND topic_id='".mysqli_real_escape_string($link, $tid)."' ORDER BY post_date ASC LIMIT $start_from, 5";
		// Execute the SELECT query
		$res2 = mysqli_query($link, $sql2) or Mysql::HandleError(mysqli_error($link));
		// Fetch all the post data from the database
		while ($row2 = mysqli_fetch_assoc($res2)) {
			$postcreator = User::getusername($row2['post_creator']);
			// Echo out the topic post data from the database
			echo "<tr><td valign='top'><div style='min-height: 125px;'>".$row['topic_title']."<br />by ".User::getusername($row2['post_creator'])." - ".Convert::convertdate($row2['post_date'])."".$row2['post_content']."</div></td>
                              <td width='100' valign='top' align='center'>
							  <center>
							  <a href='user.php?username=".$postcreator."'><img src=".User::getavatar($row2['post_creator'])." style='width:70px;height:70px;background:url();background-size:70px 70px;' />
							  <br />".User::getusername($row2['post_creator'])."
							  </a>
							  <hr />
							  ".User::getemail($row2['post_creator'])."
							  <br />".User::getrank($row2['post_creator'])."
							  <br />".User::count_posts($row2['post_creator'])." posts
                                                          <br /><br />";
                                                          if ($row2['post_creator']==$uid){
                                                          echo '<br /><a href="deletetopic.php?tid='.$tid.'">Delete topic</a>
                                                          <br /><a href="deletepost.php?pid='.$row2['id'].'">Delete Post</a>
                                                          <br /><a href="editpost.php?pid='.$row2['id'].'&tid='.$tid.'&cid='.$cid.'">Edit Post</a>';
                                                          } elseif ($permission==$admin) {
                                                          echo '<br /><a href="deletetopic.php?tid='.$tid.'">Delete topic</a>
                                                          <br /><a href="deletepost.php?pid='.$row2['id'].'">Delete Post</a>
                                                          <br /><a href="editpost.php?pid='.$row2['id'].'&tid='.$tid.'&cid='.$cid.'">Edit Post</a>';
							  }
                                                          echo "</td></tr><br /></center>";
		}
		// Assign local variable for the current number of views that this topic has
		$old_views = $row['topic_views'];
		// Add 1 to the current value of the topic views
		$new_views = $old_views + 1;
		// Update query that will update the topic_views for this topic
		$sql3 = "UPDATE topics SET topic_views='".$new_views."' WHERE category_id='".mysqli_real_escape_string($link, $cid)."' AND id='".mysqli_real_escape_string($link, $tid)."' LIMIT 1";
		// Execute the UPDATE query
		$res3 = mysqli_query($link, $sql3) or Mysql::HandleError(mysqli_error($link));
	}
echo "</tbody>
            </table>
			</div>";

$sql = "SELECT * FROM posts WHERE topic_id='".mysqli_real_escape_string($link, $tid)."' AND category_id='".mysqli_real_escape_string($link, $cid)."'"; 
$rs_result = mysqli_query($link, $sql2) or Mysql::HandleError(mysqli_error($link));
$row = mysqli_num_rows($rs_result);
$total_pages = ceil($row / 5); 
echo "Pagina ";
for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='?cid=".$cid."&tid=".$tid."&page=".$i."'>".$i."</a> ";
}
} else {
	// If the topic does not exist
	echo "<h1>404</h1>
	<h3>It’s looking like you may have taken a wrong turn.<br />
Don’t worry... it happens to the best of us.</h3>";
}

include_once("footer.php");
?>