<?php

class MailUtility
{
    public function sendMail($email, $otp)
    {
        $to = $email;
        $subject = "OTP for your account";
        $message = "Your OTP is: " . $otp;

        // Must include \r\n for msmtp and real email clients to parse headers
        $headers  = "From: Remed Admin <remedservice@gmail.com>\r\n";
        $headers .= "Reply-To: remedservice@gmail.com\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            return "Mail sent";
        } else {
            return "Mail failed";
        }
    }
}
