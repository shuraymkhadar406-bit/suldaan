<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="css/user.css">
</head>
<body>

<div class="container mt-5">

    <form action="php/login.php"
          method="POST"
          class="shadow p-4 rounded"
          style="max-width:450px; margin:auto;">

       <h2 class="text-center mb-2">Welcome Back</h2>

<p class="text-center text-muted mb-4">
Login to your Digital Library
</p>

        <!-- Error Message -->
        <?php if(isset($_GET['error'])) { ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_GET['error']); ?>
            </div>
        <?php } ?>

        <!-- Success Message -->
        <?php if(isset($_GET['success'])) { ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_GET['success']); ?>
            </div>
        <?php } ?>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Login
        </button>

        <div class="text-center mt-3">
            Don't have an account?
            <a href="register.php">Register</a>
        </div>

    </form>

</div>

</body>
</html>