<h2>Forgot Password</h2>

<form method="post" action="<?= ROOT ?>/admin/AuthController/sendResetLink">
  <label for="email">Enter your email address:</label>
  <input type="email" name="email" id="email" required>

  <button type="submit">Send Reset Link</button>
</form>
