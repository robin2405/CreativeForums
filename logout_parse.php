<?php
session_start(); // Start your sessions to allow your page to interact with session variables
session_destroy(); // This will destroy (remove) any session variables that have been set
header("Location: index.php");
?>