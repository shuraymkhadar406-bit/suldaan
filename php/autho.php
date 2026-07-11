<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php?error=Please login first");
    exit;
}
?>