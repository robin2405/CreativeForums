<?php
include_once("header.php");

LoadClass("Category");

echo"<div class='table-responsive'>
	<table class='table table-striped'>
		<thead>
			<tr>
				<th>Category</th>
				<th></th>
			</tr>
		</thead>
		<tbody>";

// Select all the data from the categories table in your database and order them by the category_title
$sql = "SELECT * FROM categories ORDER BY category_title ASC";
// Execute the SELECT query
$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
$categories = "";
// Check to make sure that the categories table has data in it
if (mysqli_num_rows($res) > 0) {
	// Retrieve data from the categories table
	while ($row = mysqli_fetch_assoc($res)) {
		// Assign local variables from each field in the categories table
		$id = $row['id'];
		$title = $row['category_title'];
		$description = $row['category_description'];
		// Append the data from the categories table into a list of links
		$categories .= "<tr><td><a href='view_category.php?cid=".$id."' class='cat_links'>".$title."</a><br /><p>".$description."</p></td>
                <td>Posts: ".Category::count_posts($row['id'])."<br />Topics: ".Category::count_topics($row['id'])."</td></tr>";
	}
	// Display list of links
	echo $categories;
} else {
	// If there are is no data in the categories table
	echo "<p>There are no categories available.</p>";
}

echo"</tbody>
</table>
</div>";

include_once("footer.php");
?>