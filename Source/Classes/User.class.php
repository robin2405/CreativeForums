<?php
	class User {
		// Function that returns the users email addres
		function getemail($uid) {
			$sql = "SELECT email FROM users WHERE id='".mysql_real_escape_string($uid)."' LIMIT 1";
			$res = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($res);
			return $row['email'];
		}

		// Function that returns the users rank
		function getrank($uid) {
			$sql = "SELECT rank FROM users WHERE id='".mysql_real_escape_string($uid)."' LIMIT 1";
			$res = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($res);
			return $row['rank'];
		}

		// Function that returns the users permission
		function getpermission($uid) {
			$sql = "SELECT Permission FROM users WHERE id='".mysql_real_escape_string($uid)."'";
			$res = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($res);
			return $row['Permission'];
		}

		// Function that returns the users username
		function getusername($uid) {
			$sql = "SELECT username FROM users WHERE id='".mysql_real_escape_string($uid)."' LIMIT 1";
			$res = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($res);
			return $row['username'];
		}

		// Function that returns the users avatar
		function getavatar($uid) {
			$sql = "SELECT avatar FROM users WHERE id='".mysql_real_escape_string($uid)."' LIMIT 1";
			$res = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($res);
			return $row['avatar'];
		}

		// Function that returns the amount of posts made by a user
		function count_posts($uid) {
			$sql = "SELECT * FROM posts WHERE post_creator='".mysql_real_escape_string($uid)."'";
			$res = mysql_query($sql) or die(mysql_error());
			$post_count = mysql_num_rows($res);
			return $post_count;
		}

		// Function that returns the amount of messages Received by a user
		function count_messages($uid) {
			$sql = "SELECT * FROM Messages WHERE Target='".mysql_real_escape_string($uid)."' AND viewed='0'";
			$res = mysql_query($sql) or die(mysql_error());
			$mess_count = mysql_num_rows($res);
			return $mess_count;
		}
	}
?>