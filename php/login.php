<?php
session_start();
include "../db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: ../user_login.php?error=All fields are required");
        exit;
    }

    // Get user from database
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if (!$user) {
        header("Location: ../user_login.php?error=Email not found");
        exit;
    }

    // Verify password
    if (!password_verify($password, $user['password'])) {
        header("Location: ../user_login.php?error=Wrong password");
        exit;
    }

    // Save session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['full_name'] = $user['full_name'];

    // Redirect to home/dashboard
    header("Location: ../store.php");
    exit;

} else {
    header("Location: ../user-login.php");
    exit;
}