<?php
	session_start(); // Start your sessions to allow your page to interact with session variables

	// Connect to the database
	// Loading Classes
	function LoadClass($class){
	    include_once('Classes/' . $class . '.class.php');
	}

	LoadClass("Connect");
	$link = DbConnection::getConnection();
	LoadClass("Mysql");

	require 'password.php';

	function gethash($username) {
		$link = DbConnection::getConnection();
		$sql = "SELECT password FROM users WHERE username='".$username."' LIMIT 1";
		$res = mysqli_query($link, $sql) or die(Mysql::HandleError(mysqli_error($link)));
		$row = mysqli_fetch_assoc($res);
		return $row['password'];
	}

	function getsalt($username) {
		$link = DbConnection::getConnection();
		$sql = "SELECT salt FROM users WHERE username='".$username."' LIMIT 1";
		$res = mysqli_query($link, $sql) or die(Mysql::HandleError(mysqli_error($link)));
		$row = mysqli_fetch_assoc($res);
		return $row['salt'];
	}

	// Check to see if the username textbox has data in it
	if (isset($_POST['username'])) {
			// Defining local variables from the POST variables
			$username = $_POST['username'];    
	        $password = $_POST['password'];
			$salt = getsalt($username);
			$password = $salt.$password;
			$hash = gethash($username);
			if(password_verify($password, $hash)) {
				// Select data from the users table depending on the entered inputs
				$sql = "SELECT * FROM users WHERE username='".mysqli_real_escape_string($link, $username)."' LIMIT 1";
				// Execute the SELECT query
				$res = mysqli_query($link, $sql) or die(Mysql::HandleError(mysqli_error($link)));
				// Check to see if the data entered into the login form matches the database information
				if (mysqli_num_rows($res) == 1) {
					// Pull data from the database
					$row = mysqli_fetch_assoc($res);
					// Assign session variables with the id and username from the database
					$_SESSION['uid'] = $row['id'];
					$_SESSION['username'] = $row['username'];
					header("Location: index.php");
					exit();
				} else {
					echo "Invalid login information.";
					exit();
				}
			} else {
				echo "Invalid password";
			}
	}
?>