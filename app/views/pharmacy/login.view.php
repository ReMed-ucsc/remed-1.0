<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/loginPage.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/navbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    include BASE_PATH . '/app/views/inc/pharmacy/nonRegNavbar.php';
    // include 'Database.php';
    ?>
    <div class="fullpage">
        <div class="container">
            <div class="box-left">
                <h2>Log in to Remed</h2>

                <?php if (!empty($success)) {  ?>
                    <div>
                        <?= $success ?>
                    </div>
                <?php } else { ?>
                    <p>Welcome back! Log in to access your pharmacy’s dashboard, where you can manage inventory, process customer orders, and update your pharmacy's details. Stay connected with your customers, track deliveries, and ensure your pharmacy runs smoothly. Enter your credentials to continue.</p>

                <?php } ?>
            </div>
            <div class="box-right">
                <?php if (!empty($errors)): ?>
                    <div class="error-message">
                        <?= implode("<br>", $errors) ?>
                    </div>
                <?php endif; ?>

                <!-- <?php if (!empty($success)): ?>
                    <div class="success-message">
                        <?= $success ?>
                    </div>
                <?php endif; ?> -->

                <form id="login-form" action="" method="POST">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required><br>

                    <div class="form-footer">
                        <label>
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                    </div>

                    <button type="submit" class="register-btn">Login</button>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </form>
            </div>
        </div>
    </div>
    <!-- <?php
            require_once BASE_PATH . '/app/views/inc/pharmacy/footer.view.php';
            ?> -->



</body>


</html>