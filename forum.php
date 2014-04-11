<?php
session_start(); // Start your sessions to allow your page to interact with session variables
// template files :p
include_once("header.php");
?>
<div class='table-responsive'>
<table class='table table-striped'>
<thead>
                <tr>
                  <th>Category</th>
                  <th></th>
                </tr>
              </thead>
			  <tbody>
<?php
include_once("connect.php");

function count_topics($id) {
 $sql = "SELECT * FROM topics WHERE category_id='".$id."'";
 $res = mysql_query($sql) or die(mysql_error());
 $post_count = mysql_num_rows($res);
 return $post_count;
}

// Select all the data from the categories table in your database and order them by the category_title
$sql = "SELECT * FROM categories ORDER BY category_title ASC";
// Execute the SELECT query
$res = mysql_query($sql) or die(mysql_error());
$categories = "";
// Check to make sure that the categories table has data in it
if (mysql_num_rows($res) > 0) {
	// Retrieve data from the categories table
	while ($row = mysql_fetch_assoc($res)) {
		// Assign local variables from each field in the categories table
		$id = $row['id'];
		$title = $row['category_title'];
		$description = $row['category_description'];
		// Append the data from the categories table into a list of links
		$categories .= "<tr><td><a href='view_category.php?cid=".$id."' class='cat_links'>".$title."</a><br /><p>".$description."</p></td>
                <td>Posts: ".count_posts($row['id'])."<br />Topics: ".count_topics($row['id'])."</td></tr>";
	}
	// Display list of links
	echo $categories;
} else {
	// If there are is no data in the categories table
	echo "<p>Er zijn nog geen categorieën beschikbaar.</p>";
}
?>
</tbody>
            </table>
			</div>
<?php
include_once("footer.php");
?>