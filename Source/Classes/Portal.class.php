<?php
	class Portal {
		function getpostcontent($tid) {
		    $sql = "SELECT post_content FROM posts WHERE post_date = ((SELECT topic_date FROM topics WHERE id='".mysql_real_escape_string($tid)."')) AND category_id = 1 AND topic_id = '".mysql_real_escape_string($tid)."' LIMIT 1";
		    $res = mysql_query($sql) or die(mysql_error());
		    $row = mysql_fetch_assoc($res);
		    return $row['post_content'];
		}
	}
?>