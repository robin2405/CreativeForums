<?php
	class Messages {
		function view($mid) {
			$sql = "UPDATE Messages SET viewed='1' WHERE id='".mysql_real_escape_string($mid)."'";
			$res = mysql_query($sql) or die(mysql_error());
		}
		function Target($uid) {
			$sql = "SELECT Target FROM Messages WHERE id='".mysql_real_escape_string($uid)."'";
			$res = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($res);
			return $row['Target'];
		}
	}
?>