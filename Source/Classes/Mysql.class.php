<?php
	class Mysql {
		function HandleError($error) {
		    $sql = "INSERT INTO MysqlErrors(Description)VALUES(".$error.")";
		    exit();
		}
	}
?>