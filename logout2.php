<?php
session_start();

// Remove all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to user login page
header("Location: user_login.php");
exit;
?>