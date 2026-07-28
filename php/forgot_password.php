<?php
include "../db_conn.php";

$email = $_POST['email'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->execute([$email]);

if($stmt->rowCount() > 0){

    $token = bin2hex(random_bytes(32));
    $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

    $conn->prepare("DELETE FROM password_resets WHERE email=?")->execute([$email]);

    $conn->prepare("INSERT INTO password_resets(email,token,expires_at)
    VALUES(?,?,?)")->execute([$email,$token,$expires]);

    echo "Reset Link:<br>";
    echo "http://localhost/your_project/reset_password.php?token=$token";
}
else{
    echo "Email not found.";
}
?>