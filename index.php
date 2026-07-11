<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: store.php");
} else {
    header("Location: user_login.php");
}
exit;