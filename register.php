<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/user.css">
</head>
<body>

<div class="container mt-5">

    <form action="php/register.php"
          method="POST"
          class="shadow p-5 rounded mx-auto"
          style="max-width:500px;">

        <<h2 class="text-center mb-2">Create Account</h2>

<p class="text-center text-muted mb-4">
Join the Digital Library & E-Book Store
</p>
        <?php if(isset($_GET['error'])){ ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_GET['error']); ?>
        </div>
        <?php } ?>

        <?php if(isset($_GET['success'])){ ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_GET['success']); ?>
        </div>
        <?php } ?>

        <div class="mb-3">
            <label>Full Name</label>
            <input type="text"
                   name="full_name"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>
        </div>

        <button class="btn btn-primary w-100">
            Register
        </button>

        <div class="text-center mt-3">
            Already have an account?
            <a href="user_login.php">Login</a>
        </div>

    </form>

</div>



</body>
</html>