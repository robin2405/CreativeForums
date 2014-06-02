<?php
	class Category {
		function count_topics($id) {
			$sql = "SELECT * FROM topics WHERE category_id='".$id."'";
			$res = mysql_query($sql) or die(mysql_error());
			$topic_count = mysql_num_rows($res);
			return $topic_count;
		}
		function count_posts($id) {
			$sql = "SELECT * FROM posts WHERE category_id='".$id."'";
			$res = mysql_query($sql) or die(mysql_error());
			$post_count = mysql_num_rows($res);
			return $post_count;
		}
	}
?>