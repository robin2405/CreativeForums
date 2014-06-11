<?php
include_once("header.php");

if (isset($_GET['page'])) { $page  = $_GET['page']; } else { $page='1'; };
$start_from = ($page-1) * 10;

function getvideourl($uid) {
	$link = DbConnection::getConnection();
	$sql = "SELECT url FROM gallery WHERE id='".$uid."' LIMIT 1";
	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
	return $row['url'];
}

		// Query the posts table for all posts in the specified topic
		$sql2 = "SELECT * FROM gallery LIMIT $start_from, 10";
		// Execute the SELECT query
		$res2 = mysqli_query($link, $sql2) or Mysql::HandleError(mysqli_error($link));
		// Fetch all the post data from the database
	while ($row2 = mysqli_fetch_assoc($res2)) {
		// Echo out the topic post data from the database
		echo '
		<a href="'.getvideourl($row2['id']).'"><img src="'.getvideourl($row2['id']).'" style="height:200;width:200px;"/></a>';
	}
	$sql = "SELECT * FROM gallery"; 
$rs_result = mysqli_query($link, $sql2) or Mysql::HandleError(mysqli_error($link));
$row = mysqli_num_rows($rs_result);
$total_pages = ceil($row / 10); 
echo "<br />Pagina ";
for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='?page=".$i."'>".$i."</a> ";
}
include_once("footer.php");
?>