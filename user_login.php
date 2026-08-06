<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/user.css">
</head>
<body>

<div class="main-container">

    <!-- Left Side -->
    <div class="welcome-section">
        <h1>📚 Digital Library</h1>
        <h2>Welcome Back!</h2>

        <p>
            Login to your account and continue your journey of
            discovering, learning and growing with thousands of books.
        </p>

        <ul>
            <li>📖 Thousands of Books</li>
            <li>⬇️ Easy Downloads</li>
            <li>🔒 Secure & Trusted</li>
        </ul>
    </div>

    <!-- Login Card -->
    <div class="login-card">

        <h2>Welcome Back</h2>
        <p class="subtitle">Login to your Digital Library</p>

        <?php if(isset($_GET['error'])) { ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_GET['error']); ?>
            </div>
        <?php } ?>

        <?php if(isset($_GET['success'])) { ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_GET['success']); ?>
            </div>
        <?php } ?>

        <form action="php/login.php" method="POST">

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
                       id="password"
                       name="password"
                       class="form-control"
                       required>

                <div class="form-check mt-2">
                    <input class="form-check-input"
                           type="checkbox"
                           id="showPassword">

                    <label class="form-check-label">
                        Show Password
                    </label>
                </div>
            </div>

            <div class="text-end mb-3">
                <a href="forget password.php">
                    Forgot Password?
                </a>
            </div>

            <button type="submit"
                    class="btn btn-primary w-100">
                Login
            </button>

            <div class="text-center mt-3">
                Don't have an account?
                <a href="register.php">Register</a>
            </div>

        </form>

    </div>

</div>

<script>
document.getElementById("showPassword")
.addEventListener("change", function () {

    let password =
    document.getElementById("password");

    password.type =
    this.checked ? "text" : "password";
});

window.onload = function(){
    document.querySelector("form").reset();
};
</script>

</body>
</html>