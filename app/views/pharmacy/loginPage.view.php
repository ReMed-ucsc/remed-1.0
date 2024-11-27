<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="Login-page.css">
    <link rel="stylesheet" href="../Navbar/navbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
</head>
<body>

<?php include '../Navbar/non-reg-navbar.php';
        

?>
<div class="fullpage">
<div class="container">
    <div class="box-left">
        <h2>Log in to ReMed</h2>
        <p>Welcome back! Log in to access your pharmacy's dashboard, where you can manage inventory, process customer orders, and update your pharmacy's details. Stay connected with your customers, track deliveries, and ensure your pharmacy runs smoothly. Enter your credentials to continue.</p>
    </div>
    <div class="box-right">
        <form id="login-form" action="login.php" method="POST">
            <h2>Log in</h2>
            <label for="email">User name or Email Address:</label>
            <input type="email" id="email" name="email" required placeholder="Value">
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required placeholder="Value">
            
            <div class="form-footer">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>
            
            <button type="submit" class="register-btn">Register</button>
            <a href="#" class="forgot-password">Forgot Password?</a>
        </form>
    </div>
</div>
</div>

</body>
</html>
