<?php
	class Messages {
		function view($mid) {
			$link = DbConnection::getConnection();
			$sql = "UPDATE Messages SET viewed='1' WHERE id='".mysqli_real_escape_string($link, $mid)."'";
			$res = mysqli_query($link, $sql);
		}
		function Target($uid) {
			$link = DbConnection::getConnection();
			$sql = "SELECT Target FROM Messages WHERE id='".mysqli_real_escape_string($link, $uid)."'";
			$res = mysqli_query($link, $sql);
			$row = mysqli_fetch_assoc($res);
			return $row['Target'];
		}
	}
?>