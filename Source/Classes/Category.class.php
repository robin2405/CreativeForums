<?php
	class Category {
		function count_topics($id) {
			$link = DbConnection::getConnection();
			$sql = "SELECT * FROM topics WHERE category_id='".$id."'";
			$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
			$topic_count = mysqli_num_rows($res);
			return $topic_count;
		}
		function count_posts($id) {
			$link = DbConnection::getConnection();
			$sql = "SELECT * FROM posts WHERE category_id='".$id."'";
			$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
			$post_count = mysqli_num_rows($res);
			return $post_count;
		}
	}
?>