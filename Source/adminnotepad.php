<?php

session_start(); // Start your sessions to allow your page to interact with session variables

include_once("connect.php");

// PreDefined Variables
$permission="";
$admin="";

// Check to see if they person accessing this page is logged in and that there is a category id in the url

if ((!isset($_SESSION['uid']))) {

	header("Location: index.php");

	exit();

}

if ($permission!=$admin) {

        header("Location: index.php");

	exit();

}

include_once("header.php");

include_once("sidebar.php");



    // Select the topics that are associated with this category id and order by the topic_reply_date
    $sql2 = "SELECT * FROM notepad ORDER BY id";
    // Execute the SELECT query
    $res2 = mysql_query($sql2) or die(mysql_error());
    // Check to see if there are topics in the category
    if (mysql_num_rows($res2) >= 0) {
        // Appending table data to the $topics variable for output on the page
        $table .= "Keer terug naar <a href='admin.php'>admin Index</a> - <a href='notepadadd.php'>Voeg note toe.</a>".$logged."<br />";
        $table .= "<table class='bordered'>";
        $table .= "<tr><th>ID</th><th align='center'>Beschrijving</th></tr>";
        // Fetching topic data from the database
        while ($row = mysql_fetch_assoc($res2)) {
            // Assign local variables from the database data
            $cid = $row['id'];
			$desc = $row['text'];
			
            // Append the actual topic data to the $topics variable
            $pages .= "<tr><td>".$cid."</td><td>".$desc."</td></tr>";
            }
        $topics .= "</table>";
        // Displaying the $topics variable on the page
                echo $table;     
                echo $pages;
}
echo '</table>';

include_once("footer.php");

?>