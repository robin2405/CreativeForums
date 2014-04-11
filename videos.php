<?php
include_once("header.php");

if (isset($_GET['page'])) { $page  = $_GET['page']; } else { $page='1'; };
$start_from = ($page-1) * 4;

function getvideourl($uid) {
	$sql = "SELECT url FROM videos WHERE id='".$uid."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['url'];
}

		// Query the posts table for all posts in the specified topic
		$sql2 = "SELECT * FROM videos LIMIT $start_from, 4";
		// Execute the SELECT query
		$res2 = mysql_query($sql2) or die(mysql_error());
		// Fetch all the post data from the database
	while ($row2 = mysql_fetch_assoc($res2)) {
		// Echo out the topic post data from the database
		echo '
		<iframe width="400" height="275" src="//www.youtube.com/embed/'.getvideourl($row2['id']).'" frameborder="0" allowfullscreen></iframe>';
	}
$sql = "SELECT * FROM videos";
$rs_result = mysql_query($sql) or die(mysql_error());
$row = mysql_num_rows($rs_result); 
$total_pages = ceil($row / 4); 
echo "<br />Pagina ";
for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='?page=".$i."'>".$i."</a> ";
}
include_once("footer.php");
?>