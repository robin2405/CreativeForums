<?php
	require "connect.php";

	session_start(); // Start your sessions to allow your page to interact with session variables
	
	if (isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
	} else {
		$uid = "";
	}

	// Function that will retrieve the selected theme
	function getTheme() {
		$sql = "SELECT SettingValue FROM settings WHERE SettingName='Theme' LIMIT 1";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		return $row['SettingValue'];
	}

	// Function that will retrieve the selected theme
	function getRoot() {
		$sql = "SELECT SettingValue FROM settings WHERE SettingName='Root' LIMIT 1";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		return $row['SettingValue'];
	}
	
	$getTheme = getTheme();
	$Root = getRoot();

	if (isset($_GET['page'])){
		$PageID = $_GET['page'];
	} else {
		$PageID = "";
	}
	
	require "Themes/".$getTheme."/AdminHeader.php";
		if($PageID == "1") {
			// Category List
					echo '
					<h2 class="sub-header">Category list</h2>
					  <div class="table-responsive">
						<table class="table table-striped">';
				// Select the topics that are associated with this category id and order by the topic_reply_date
				$sql2 = "SELECT * FROM categories ORDER BY id";
				// Execute the SELECT query
				$res2 = mysql_query($sql2) or die(mysql_error());
				// Check to see if there are topics in the category
				if (mysql_num_rows($res2) >= 0) {
					// Appending table data to the $topics variable for output on the page
					$table .= "<thead>
							<tr>
							  <th>#</th>
							  <th>Name</th>
							  <th>Description</th>
							  <th>Delete?</th>
							</tr>
						  </thead>
						  <tbody>";
					// Fetching topic data from the database
					while ($row = mysql_fetch_assoc($res2)) {
						// Assign local variables from the database data
						$cid = $row['id'];
						$title = $row['category_title'];
						$desc = $row['category_description'];
						
						// Append the actual topic data to the $topics variable
						$pages .= "<tr><td>".$cid."</td><td><a href='editcat2.php?cid=".$cid."'>".$title."</td><td>".$desc."</a></td><td><a href='admin.php?page=8&cat=".$cid."'>Delete</a></td></tr>";
						}
					// Displaying the $topics variable on the page
							echo $table;     
							echo $pages;
				}
						  echo '</tbody>
						</table>
					  </div>';
			} else if($PageID == "2") {
				// Gallery
				echo '
					<h2 class="sub-header">Media list</h2>
							  <div class="table-responsive">
								<table class="table table-striped">';
					// Select the topics that are associated with this category id and order by the topic_reply_date
						$sql2 = "SELECT * FROM gallery ORDER BY id";
						// Execute the SELECT query
						$res2 = mysql_query($sql2) or die(mysql_error());
						// Check to see if there are topics in the category
						if (mysql_num_rows($res2) >= 0) {
							// Appending table data to the $topics variable for output on the page
							$table .= "<thead>
									<tr>
									  <th>#</th>
									  <th>Picture</th>
									  <th>Delete?</th>
									</tr>
								  </thead>
								  <tbody>";
							// Fetching topic data from the database
							while ($row = mysql_fetch_assoc($res2)) {
								// Assign local variables from the database data
								$cid = $row['id'];
								$url = $row['url'];
								
								// Append the actual topic data to the $topics variable
								$pages .= "<tr><td>".$cid."</td><td><a href='".$url."'><img src='".$url."' style='width:100px;height:100px;'/></a></td><td><a href='admin.php?page=9&cat=".$cid."'>Delete</a></td></tr>";
								}
							$topics .= "";
							// Displaying the $topics variable on the page
									echo $table;     
									echo $pages;
					}
								  echo '</tbody>
								</table>
							  </div>';
			} else if($PageID == "3") {
				// Pages
				echo '
				<h2 class="sub-header">Page list</h2>
						  <div class="table-responsive">
							<table class="table table-striped">';
				// Select the topics that are associated with this category id and order by the topic_reply_date
					$sql2 = "SELECT * FROM pages ORDER BY id";
					// Execute the SELECT query
					$res2 = mysql_query($sql2) or die(mysql_error());
					// Check to see if there are topics in the category
					if (mysql_num_rows($res2) >= 0) {
						// Appending table data to the $topics variable for output on the page
						$table .= "<thead>
								<tr>
								  <th>#</th>
								  <th>Name</th>
								</tr>
							  </thead>
							  <tbody>";
						// Fetching topic data from the database
						while ($row = mysql_fetch_assoc($res2)) {
							// Assign local variables from the database data
							$pid = $row['id'];
							$title = $row['title'];

							// Append the actual topic data to the $topics variable
							$pages .= "<tr><td>".$pid."</td><td><a href='editpage.php?pid=".$pid."'>".$title."</a> - <a href='pages.php?page=".$pid."'>Preview</a> - <a href='admin.php?page=7&pageID=".$pid."'>Delete</a></td></tr>";
							}
						// Displaying the $topics variable on the page
								echo $table;     
								echo $pages;
				}
							  echo '</tbody>
							</table>
						  </div>';
			} else if($PageID == "4") {
				echo '
				<h2 class="sub-header">Add Page</h2>
                <form action="addpage_parse.php" method="post">
						<input type="text" class="form-control" name="pagename" size="98" maxlength="150" placeholder="Page Name"></input><br />
						<input type="submit" class="btn btn-lg btn-primary btn-block" name="page_submit" value="Add the page!" />
				</form>
				';
			} else if($PageID == "5") {
				echo '
				<h2 class="sub-header">Add Category</h2>
                <form action="addcat_parse.php" method="post">
					<input type="text" class="form-control" name="catname" size="98" maxlength="150" placeholder="Category title"></input><br />
					<input type="text" class="form-control" name="catdesc" size="98" maxlength="150" placeholder="Description"></input><br />
					<input type="submit" class="btn btn-lg btn-primary btn-block" name="cat_submit" value="Add category!" />
				</form>
				';
			} else if($PageID == "6") {
				echo '
				<h2 class="sub-header">Add Picture</h2>
				<form action="addpic_parse.php" enctype="multipart/form-data" method="post">
					<span for="file">File:</span> <input id="file" name="file" type="file" /><br />
					<input name="submit" class="btn btn-lg btn-primary btn-block" type="submit" value="Add Picture!" />
				</form>
				';
			} else if($PageID == "7") {
				$pid=$_GET['pageID'];

				echo "<a href='deletepage_parse.php?page=".$pid."'>Yes remove the page</a><br />
				<a href='admin.php?page=3'>No keep the page</a>";
			} else if($PageID == "8") {
				$cid=$_GET['cat'];

				echo "<a href='deletecat_parse.php?cat=".$cid."'>Yes, remove the category</a><br />
				<a href='editcat.php'>Keep the category.</a>";
			} else if($PageID == "9") {
				$cid=$_GET['cat'];

				echo "<a href='deletepic_parse.php?cat=".$cid."'>Yes, remove the picture</a><br />
				<a href='editcat.php'>Keep the picture</a>";
			} else {
				// Home Page (admin panel)
				echo '<h1 class="page-header">Admin Index</h1>
					
				Welcome on the admin panel,<br />
				Here you can find everything to manage users/pages/posts/categories/...<br />
				This page is still under heavy construction<br />';
			}
	require "Themes/".$getTheme."/AdminFooter.php";
?>