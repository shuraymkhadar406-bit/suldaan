<?php
include "../db_conn.php";

if(isset($_POST['email'])){

    $email = $_POST['email'];

    $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check)>0){
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>

<form method="POST">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="password" name="password" placeholder="New Password" required>
    <button type="submit" name="update">Update Password</button>
</form>

</body>
</html>

<?php
    }else{
        echo "Email not found!";
    }
}

if(isset($_POST['update'])){

    $email=$_POST['email'];
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);

    mysqli_query($conn,"UPDATE users SET password='$password' WHERE email='$email'");

    echo "Password updated successfully.<br>";
    echo "<a href='user_login.php'>Login Now</a>";
}
?>