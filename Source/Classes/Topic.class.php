<?php
	class Topic {
		// Function that will count how many replies each topic has
		function topic_replies($cid, $tid) {
		    $sql = "SELECT count(*) AS topic_replies FROM posts WHERE category_id='".mysql_real_escape_string($cid)."' AND topic_id='".mysql_real_escape_string($tid)."'";
		    $res = mysql_query($sql) or die(mysql_error());
		    $row = mysql_fetch_assoc($res);
		    return $row['topic_replies'] - 1;
		}
		// Function that returns if topic is hot or not
		function hot($views, $Root, $getTheme) {
			if ($views > "100"){
				return "<img src='".$Root."Themes/".$getTheme."/img/hot_topic.png' style='' />";
			} elseif ($views < "100") {
				return "<img src='".$Root."Themes/".$getTheme."/img/normal_topic.png' style='' />";
			}
		}
	}
?>