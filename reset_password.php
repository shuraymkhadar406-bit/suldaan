<?php
include "db_conn.php";

// Check if token exists in the URL
if (!isset($_GET['token']) || empty($_GET['token'])) {
    die("Invalid or missing reset token.");
}

$token = $_GET['token'];

$stmt = $conn->prepare("SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()");
$stmt->execute([$token]);

if ($stmt->rowCount() == 0) {
    die("Invalid or expired reset token.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>

<h2>Reset Password</h2>

<form action="php/reset_password.php" method="POST">

    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

    <input type="password" name="password" placeholder="Enter New Password" required>

    <button type="submit">Reset Password</button>

</form>

</body>
</html>