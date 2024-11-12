<?php

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Replace these with your own validation/authentication logic
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Example hardcoded credentials for testing
    $valid_username = 'admin';
    $valid_password = 'admin123';

    if ($username == $valid_username && $password == $valid_password) {
        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        // Redirect to admin dashboard or homepage
        header("Location:http://localhost/MVC/public/admin/dashboard");
        exit;
    } else {
        $error_message = "Invalid username or password!";
    }
}
require_once BASE_PATH . '/app/views/inc/header.view.php'

?>

<div class="login-container-out">
    <div class="login-container">
        <div class="login-left">
            <img src="<?= ROOT ?>/assets/images/ReMeD.png" alt="logo">
            <p>ONLINE PHARMACY LOCATOR <br> AND <br> MEDICINE TRACKER</p>
            <h3>ADMINISTRATOR</h3>
        </div>
        <div class="login-right">

            <form method="POST" action="">
                <h2 class="login-header">Log in</h2>
                <ul>
                    <li>
                        <label for="username">Username or Email Address:</label><br>
                        <input type="text" id="username" name="username" placeholder="value" required>
                    </li>
                    <li>
                        <label for="password">Password:</label><br>
                        <input type="password" id="password" name="password" placeholder="value" required>
                    </li>
                    <div class="remember">
                        <input type="checkbox" name="remember" id="remember" required>
                        <label for="remember">Remember me</label>
                    </div>

                    <button type="submit">Login</button>
                    <?php if (isset($error_message)) { ?>
                        <p class="error"><?php echo $error_message; ?></p>
                    <?php } ?>

                    <p class="forget">Forget <span><a href="#"> Password</a></span>?</p>
            </form>
        </div>
    </div>
</div>

<?php require_once  BASE_PATH . '/app/views/inc/footer.view.php' ?>