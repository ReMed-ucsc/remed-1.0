<?php
require_once BASE_PATH . '/app/views/inc/header.view.php'
?>

<body class="login-body">
  <div class="login-container-out">
    <div class="login-container">
      <div class="login-left">
        <img src="<?= ROOT ?>/assets/images/ReMeD.png" alt="logo">
        <p>ONLINE PHARMACY LOCATOR <br> AND <br> MEDICINE TRACKER</p>
        <h3>Reset Your Password</h3>
      </div>
      <div class="login-right">
        <form method="post" action="<?= ROOT ?>/admin/AuthController/resetPassword">
          <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
          <label>New Password:</label>
          <input type="password" name="password" required>
          <button type="submit">Reset Password</button>
        </form>
      </div>
    </div>


  </div>
</body>
<?php require_once BASE_PATH . '/app/views/inc/footer.view.php' ?>