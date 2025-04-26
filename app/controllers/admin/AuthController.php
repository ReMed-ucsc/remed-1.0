<?php

require_once BASE_PATH . '/app/core/Mailer.php';

class AuthController
{
    use Controller;

    public function index()
    {
        require BASE_PATH . '/app/views/admin/forgot_password.view.php';
    }

    public function sendResetLink()
    {
        $email = $_POST['email'];
        $user = new Admin();
        $found = $user->findByEmail($email);

        if ($found) {
            $token = bin2hex(random_bytes(50));
            $user->saveResetToken($email, $token); // saves token + expiry

            $link = ROOT . "/admin/AuthController/showResetForm?token=$token";
            sendMail(
                $email,
                'Reset Your Password - ReMed',
                "
            <div style='font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px;'>
                <div style='max-width: 600px; margin: auto; background-color: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 30px;'>
                    <h2 style='color:#02224c;'>ReMed Password Reset</h2>
                    <p>Hello,</p>
                    <p>We received a request to reset your password. Click the button below to proceed:</p>
                    <p style='text-align: center; margin: 30px 0;'>
                        <a href='$link' style='background-color: #2a9d8f; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;'>Reset Password</a>
                    </p>
                    <p>If the button doesn’t work, copy and paste this link into your browser:</p>
                    <p style='word-break: break-all;'>$link</p>
                    <hr style='margin: 30px 0;'>
                    <p style='font-size: 12px; color: #999;'>If you didn’t request a password reset, you can safely ignore this email.</p>
                    <p style='font-size: 12px; color: #999;'>– The ReMed Team</p>
                </div>
            </div>
            "
            );
            redirect("admin/login/?forget");
        } else {
            echo "Email not found.";
        }
    }

    public function showResetForm()
    {
        $token = $_GET['token'] ?? '';
        $user = (new Admin())->findByToken($token);

        if (!$user || strtotime($user->token_expiry) < time()) {
            echo "Invalid or expired token.";
            return;
        }

        require BASE_PATH . '/app/views/admin/reset_password.view.php';
    }

    public function resetPassword()
    {
        $token = $_POST['token'];
        $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user = new Admin();

        if ($user->resetPassword($token, $newPassword)) {
            redirect('admin/login/?resetSuccessful');
            
        } else {
            echo "Invalid or expired token.";
        }
    }
}
