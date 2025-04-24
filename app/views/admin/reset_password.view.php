<h2>Reset Your Password</h2>

<form method="post" action="<?= ROOT ?>/admin/AuthController/resetPassword">
  <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
  <label>New Password:</label>
  <input type="password" name="password" required>
  <button type="submit">Reset Password</button>
</form>