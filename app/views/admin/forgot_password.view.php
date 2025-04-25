<?php

require_once BASE_PATH . '/app/views/inc/header.view.php'

  ?>

<body class="login-body">
  <div class="login-container-out">
    <div class="login-container">
      <div class="login-left">
        <img src="<?= ROOT ?>/assets/images/ReMeD.png" alt="logo">
        <p>ONLINE PHARMACY LOCATOR <br> AND <br> MEDICINE TRACKER</p>
        <h3>Forgot Password</h3>
      </div>
      <div class="login-right">
        <form method="post" action="<?= ROOT ?>/admin/AuthController/sendResetLink">
          <label for="email">Enter your email address:</label>
          <input type="email" name="email" id="email" required>

          <button type="submit">Send Reset Link</button>
        </form>
      </div>
    </div>


  </div>
</body>
<?php require_once BASE_PATH . '/app/views/inc/footer.view.php' ?>