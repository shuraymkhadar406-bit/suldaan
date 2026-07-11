<?php
session_start();
include "../db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Basic validation
    if (empty($full_name) || empty($email) || empty($password)) {
        header("Location: ../register.php?error=All fields are required");
        exit;
    }

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        header("Location: ../register.php?error=Email already exists");
        exit;
    }

    if (!preg_match('/^[A-Za-z0-9@#$%^&*!]+$/', $password)) {
    header("Location: ../register.php?error=Password can contain only letters, numbers, and @#$%^&*!");
    exit;
}
    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $sql = "INSERT INTO users(full_name, email, password)
            VALUES(?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$full_name, $email, $hashedPassword]);

    // Success → redirect to login
    header("Location: ../user_login.php?success=Account created successfully");
    exit;

} else {
    header("Location: ../register.php");
    exit;
}