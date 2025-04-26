<?php

require_once BASE_PATH . '/app/core/Mailer.php';

class AuthController {

public function index() {
    require BASE_PATH . '/app/views/admin/forgot_password.view.php';
}

public function sendResetLink() {
    $email = $_POST['email'];
    $user = new Admin();
    $found = $user->findByEmail($email);

    if ($found) {
        $token = bin2hex(random_bytes(50));
        $user->saveResetToken($email, $token); // saves token + expiry

        $link = ROOT . "/admin/AuthController/showResetForm?token=$token";
        sendMail($email, 'Reset your password', "Click to reset: <a href='$link'>$link</a>");
        echo "Check your email for reset link!";
    } else {
        echo "Email not found.";
    }
}

public function showResetForm() {
    $token = $_GET['token'] ?? '';
    $user = (new Admin())->findByToken($token);

    if (!$user || strtotime($user->token_expiry) < time()) {
        echo "Invalid or expired token.";
        return;
    }

    require BASE_PATH . '/app/views/admin/reset_password.view.php';
}

public function resetPassword() {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user = new Admin();

    if ($user->resetPassword($token, $newPassword)) {
        echo "Password reset successful.";
    } else {
        echo "Invalid or expired token.";
    }
}
}
