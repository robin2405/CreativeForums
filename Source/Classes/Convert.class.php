<?php
	class Convert {
		// Function that converts Mysql date into a readable date
		function convertdate($date) {
			$date = strtotime($date);
			return date("M j, Y g:ia", $date);
		}
	}
?>