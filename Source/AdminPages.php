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

	require "Themes/".$getTheme."/AdminHeader.php";
		
echo '
<h2 class="sub-header">Media list</h2>
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
			
	require "Themes/".$getTheme."/AdminFooter.php";