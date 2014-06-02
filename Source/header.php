<?php
	require "connect.php";

	session_start(); // Start your sessions to allow your page to interact with session variables
	
	if (isset($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
	} else {
		$uid = "";
	}

	// PreDefined Variables
	$logged="";
	$table="";
	$pages="";
	$topics="";

	// Setting the players online status
	echo'<script language="javascript">
        window.setInterval(
        	function cancelClicked() {
	            // function below will run clear.php?h=michael
	            $.ajax({
	                url: "Functions/UpdateUserOnline.php" ,
	                success : function() { 
	                    // Do something when the code is executed
	                }
	            });
        	}
        , 5000);
    </script>';

	// Loading Classes
	function LoadClass($class){
	    include_once('Classes/' . $class . '.class.php');
	}

	LoadClass("Mysql");
	LoadClass("Convert");
	LoadClass("Site");
	LoadClass("User");

	$permission = User::getpermission($uid);
	$admin = 'admin';
	
	$getTheme = Site::getTheme();
	$Root = Site::getRoot();
	
	include_once(dirname(__FILE__)."/Themes/".$getTheme."/header.php");
?>