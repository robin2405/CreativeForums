<?php
	class Topic {
		// Function that will count how many replies each topic has
		function topic_replies($cid, $tid) {
		    $link = DbConnection::getConnection();
		    $sql = "SELECT count(*) AS topic_replies FROM posts WHERE category_id='".mysqli_real_escape_string($link, $cid)."' AND topic_id='".mysqli_real_escape_string($link, $tid)."'";
		    $res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
		    $row = mysqli_fetch_assoc($res);
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