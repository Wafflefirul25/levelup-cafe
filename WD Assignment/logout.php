<?php
//Start session where PHP knows which session to clear
session_start();

//Unset all the session variables
$_SESSION = array();

//Completely destroy the session o the server
session_destroy();

//Safely redirect the admin back to the login page
header("Location: login.php");
exit;
?>