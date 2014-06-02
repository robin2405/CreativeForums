<?php
	class Site {
		// Function that returns the amount of users online at the moment (+5 seconds)
		function count_onlineusers() {
			$sql = "SELECT * FROM users WHERE TIMESTAMPDIFF(SECOND,`last_Active`,NOW()) <= 5";
			$res = mysql_query($sql) or die(mysql_error());
			$post_count = mysql_num_rows($res);
			return $post_count;
		}

		// Function that returns the amount of registered users
		function count_registered() {
			$sql = "SELECT * FROM users";
			$res = mysql_query($sql) or die(mysql_error());
			$post_count = mysql_num_rows($res);
			return $post_count;
		}

		// Returns the selected Theme
		function getTheme() {
			$sql = "SELECT SettingValue FROM settings WHERE SettingName='Theme' LIMIT 1";
			$res = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($res);
			return $row['SettingValue'];
		}

		// Returns the set root direction
		function getRoot() {
			$sql = "SELECT SettingValue FROM settings WHERE SettingName='Root' LIMIT 1";
			$res = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($res);
			return $row['SettingValue'];
		}
	}
?>