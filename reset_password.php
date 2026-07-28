<?php
include "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = $conn->prepare("SELECT * FROM users WHERE email=?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {

        $new_password = password_hash($password, PASSWORD_DEFAULT);

        $update = $conn->prepare(
            "UPDATE users SET password=? WHERE email=?"
        );

        $update->execute([$new_password, $email]);

        echo "Password changed successfully.";

    } else {

        echo "Email not found.";

    }
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h3>Reset Password</h3>

<form method="POST">

<input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">


<div class="mb-3">
<label>New Password</label>
<input type="password" name="password" class="form-control" required>
</div>


<button class="btn btn-success">
Change Password
</button>

</form>

</div>

</body>
</html>