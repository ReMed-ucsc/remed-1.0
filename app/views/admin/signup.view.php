<?php

require_once BASE_PATH . '/app/views/inc/header.view.php'

?>


<body class="login-body">
    <div class="login-container-out">
        <div class="login-container">
            <div class="login-left">
                <img src="<?= ROOT ?>/assets/images/ReMeD.png" alt="logo">
                <p>ONLINE PHARMACY LOCATOR <br> AND <br> MEDICINE TRACKER</p>
                <h3>ADMINISTRATOR</h3>
            </div>
            <div class="login-right">

                <form method="POST" action="<?= ROOT ?>/admin/SignUp">
                    <h2 class="login-header">Sign Up</h2>
                    <ul>
                    <li>
                            <label for="username">User Name:</label><br>
                            <input type="text" id="username" name="username" placeholder="Username" required>
                        </li>
                        <li>
                            <label for="email">Email Address:</label><br>
                            <input type="email" id="email" name="email" placeholder="Email" required>
                        </li>
                        <li>
                            <label for="contactNo">Contact Number:</label><br>
                            <input type="tel" id="contactNo" name="contactNo" placeholder="Contact Number" required>
                        </li>
                        <li>
                            <label for="password">Password:</label><br>
                            <input type="password" id="password" name="password" placeholder="Password" required>
                        </li>
                        <div class="remember">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">Remember me</label>
                        </div>


                        <button type="submit">SignUp</button>
                        <?php if (!empty($errors)): ?>
                            <div class="error">
                                <?= implode("<br>", $errors) ?>
                            </div>
                        <?php endif; ?>
                        <p class="forget">I have already account <span><a href="<?=ROOT?>/admin/login/">LogIn</a></span>?</p>
                        <p class="forget">Forget <span><a href="#"> Password</a></span>?</p>
                </form>
            </div>
        </div>
    </div>

    <?php require_once  BASE_PATH . '/app/views/inc/footer.view.php' ?>