<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once BASE_PATH . '/vendor/autoload.php';

function sendMail($to, $subject, $body) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'lakshan2020kavindu@gmail.com';
    $mail->Password = 'aqbk eidg wwuw rsqv';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('lakshan2020kavindu@gmail.com', 'ReMed');
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->send();
}
