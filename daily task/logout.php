<?php 
session_start();
// unset all session variables
unset($_SESSION["rid"]);
unset($_SESSION["name"]);
unset($_SESSION["email"]);
// destroy the session
session_destroy();
header("Location: login.php");


?>