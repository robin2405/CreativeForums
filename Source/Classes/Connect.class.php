<?php
	class DbConnection {
		private static $connection;
		private function __construct() {} // not needed in this example, really, as we only need a connection, which is a stable resource.
		private function __clone() {} // nothing to see here, move on!
		private function __wakeup() {} // ...and I really mean it!
		public static function getConnection() {
			$host = "localhost"; // the host info assigned by your hosting provider
			$username = "root"; // the username you supply when setting up your database
			$password = ""; // the password you chose for your database
			$db = "creativeforums"; // the database name you assigned when setting up your database
			if (!isset(self::$connection)) {
			    self::$connection = new mysqli($host, $username, $password, $db);
			    // and so created was a connection for all creatures, big and small, 
			    // to share and enjoy!
			}
			return self::$connection; 
		}
	}
?>