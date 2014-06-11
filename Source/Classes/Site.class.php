<?php
	class Site {
		// Function that returns the amount of users online at the moment (+5 seconds)
		function count_onlineusers() {
			$link = DbConnection::getConnection();
			$sql = "SELECT * FROM users WHERE TIMESTAMPDIFF(SECOND,`last_Active`,NOW()) <= 5";
			$res = mysqli_query($link,$sql) or Mysql::HandleError(mysqli_error($link));
			$post_count = mysqli_num_rows($res);
			return $post_count;
		}

		// Function that returns the amount of registered users
		function count_registered() {
			$link = DbConnection::getConnection();
			$sql = "SELECT * FROM users";
			$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
			$post_count = mysqli_num_rows($res);
			return $post_count;
		}

		// Returns the selected Theme
		function getTheme() {
			$link = DbConnection::getConnection();
			$sql = "SELECT SettingValue FROM settings WHERE SettingName='Theme' LIMIT 1";
			$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
			$row = mysqli_fetch_assoc($res);
			return $row['SettingValue'];
		}

		// Returns the set root direction
		function getRoot() {
			$link = DbConnection::getConnection();
			$sql = "SELECT SettingValue FROM settings WHERE SettingName='Root' LIMIT 1";
			$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
			$row = mysqli_fetch_assoc($res);
			return $row['SettingValue'];
		}
	}
?>