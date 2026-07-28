<?php
include "db_conn.php";

$token = $_GET['token'];

$stmt = $conn->prepare("SELECT * FROM password_resets WHERE token=?");
$stmt->execute([$token]);

if($stmt->rowCount() == 0){
    die("Invalid Token");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>

<form action="php/reset_password.php" method="POST">

<input type="hidden" name="token" value="<?php echo $token; ?>">

<input type="password" name="password" placeholder="New Password" required>

<button type="submit">Reset Password</button>

</form>

</body>
</html>