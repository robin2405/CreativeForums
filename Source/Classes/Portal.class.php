<?php
	class Portal {
		function getpostcontent($tid) {
			$link = DbConnection::getConnection();
		    $sql = "SELECT post_content FROM posts WHERE post_date = ((SELECT topic_date FROM topics WHERE id='".mysqli_real_escape_string($link, $tid)."')) AND category_id = 1 AND topic_id = '".mysqli_real_escape_string($link, $tid)."' LIMIT 1";
		    $res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
		    $row = mysqli_fetch_assoc($res);
		    return $row['post_content'];
		}
	}
?>