<?php
include "../db_conn.php";

$token = $_POST['token'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("SELECT * FROM password_resets WHERE token=?");
$stmt->execute([$token]);

if($stmt->rowCount()==0){
    die("Invalid Token");
}

$row = $stmt->fetch();

$email = $row['email'];

$conn->prepare("UPDATE users SET password=? WHERE email=?")
->execute([$password,$email]);

$conn->prepare("DELETE FROM password_resets WHERE email=?")
->execute([$email]);

echo "Password changed successfully.";
?>