<?php
	class User {
		// Function that returns the users email addres
		function getemail($uid) {
			$link = DbConnection::getConnection();
			$sql = "SELECT email FROM users WHERE id='".mysqli_real_escape_string($link, $uid)."' LIMIT 1";
			$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
			$row = mysqli_fetch_assoc($res);
			return $row['email'];
		}

		// Function that returns the users rank
		function getrank($uid) {
			$link = DbConnection::getConnection();
			$sql = "SELECT rank FROM users WHERE id='".mysqli_real_escape_string($link, $uid)."' LIMIT 1";
			$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
			$row = mysqli_fetch_assoc($res);
			return $row['rank'];
		}

		// Function that returns the users permission
		function getpermission($uid) {
			$link = DbConnection::getConnection();
			$sql = "SELECT Permission FROM users WHERE id='".mysqli_real_escape_string($link, $uid)."'";
			$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
			$row = mysqli_fetch_assoc($res);
			return $row['Permission'];
		}

		// Function that returns the users username
		function getusername($uid) {
			$link = DbConnection::getConnection();
			$sql = "SELECT username FROM users WHERE id='".mysqli_real_escape_string($link, $uid)."' LIMIT 1";
			$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
			$row = mysqli_fetch_assoc($res);
			return $row['username'];
		}

		// Function that returns the users avatar
		function getavatar($uid) {
			$link = DbConnection::getConnection();
			$sql = "SELECT avatar FROM users WHERE id='".mysqli_real_escape_string($link, $uid)."' LIMIT 1";
			$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
			$row = mysqli_fetch_assoc($res);
			return $row['avatar'];
		}

		// Function that returns the amount of posts made by a user
		function count_posts($uid) {
			$link = DbConnection::getConnection();
			$sql = "SELECT * FROM posts WHERE post_creator='".mysqli_real_escape_string($link, $uid)."'";
			$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
			$post_count = mysqli_num_rows($res);
			return $post_count;
		}

		// Function that returns the amount of messages Received by a user
		function count_messages($uid) {
			$link = DbConnection::getConnection();
			$sql = "SELECT * FROM Messages WHERE Target='".mysqli_real_escape_string($link, $uid)."' AND viewed='0'";
			$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
			$mess_count = mysqli_num_rows($res);
			return $mess_count;
		}
	}
?>