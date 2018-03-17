<?php
// Initialize the session
session_start();
 // Unset all of the session variables
$_SESSION = array();
// Destroy the session.
session_destroy();
//regenerate ssesionid
session_regenerate_id();
// Redirect to index.php
header("location: index.php");
exit;
