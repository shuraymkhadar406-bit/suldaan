<?php
include "../db_conn.php";

if (!isset($_GET['token'])) {
    die("Invalid or missing reset token");
}

$token = $_GET['token'];

$stmt = $conn->prepare("SELECT * FROM password_resets WHERE token=?");
$stmt->execute([$token]);

if ($stmt->rowCount() == 0) {
    die("Invalid token");
}

$data = $stmt->fetch(PDO::FETCH_ASSOC);


if (strtotime($data['expires_at']) < time()) {
    die("Token expired");
}

$email = $data['email'];

echo "Token verified. You can reset your password.";

?>