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
						$pages .= "<tr><td>".$cid."</td><td><a href='editcat2.php?cid=".$cid."'>".$title."</td><td>".$desc."</a></td><td><a href='deletecat.php?cat=".$cid."'>Delete</a></td></tr>";
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
								$pages .= "<tr><td>".$cid."</td><td><a href='".$url."'><img src='".$url."' style='width:100px;height:100px;'/></a></td><td><a href='deletepic.php?cat=".$cid."'>Delete</a></td></tr>";
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
							$pages .= "<tr><td>".$pid."</td><td><a href='editpage.php?pid=".$pid."'>".$title."</a> - <a href='pages.php?page=".$pid."'>Preview</a> - <a href='deletepage.php?page=".$pid."'>Delete</a></td></tr>";
							}
						// Displaying the $topics variable on the page
								echo $table;     
								echo $pages;
				}
							  echo '</tbody>
							</table>
						  </div>';
			} else {
				// Home Page (admin panel)
				echo '<h1 class="page-header">Admin Index</h1>
					
				Welcome on the admin panel,<br />
				Here you can find everything to manage users/pages/posts/categories/...<br />
				This page is still under heavy construction<br />';
			}
	require "Themes/".$getTheme."/AdminFooter.php";
?>