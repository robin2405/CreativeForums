<?php
	class Mysql {
		function HandleError($error) {
		    $link = DbConnection::getConnection();
		    mysqli_query($link, "INSERT INTO MysqlErrors(Description)VALUES(".$error.")");
		    exit();
		}
	}
?>