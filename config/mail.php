<?php
// config/mail.php
require_once __DIR__ . '/../libs/PHPMailer-6.8.0/src/Exception.php';
require_once __DIR__ . '/../libs/PHPMailer-6.8.0/src/PHPMailer.php';
require_once __DIR__ . '/../libs/PHPMailer-6.8.0/src/SMTP.php';

// Global Mail Configuration
define('SMTP_HOST', 'smtp.hostinger.com');
define('SMTP_USER', 'info@globalwebify.com');
define('SMTP_PASS', 'Aasminpass@435989856');
define('SMTP_PORT', 465); // SSL
define('SMTP_SECURE', 'ssl'); // Direct SSL for 465
define('ADMIN_EMAIL', 'info.ekalavyaeducation@gmail.com'); 

/**
 * Institutional Mail Dispatcher
 */
function sendInstitutionalMail($to, $subject, $body, $altBody = '') {
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USER;
        $mail->Password   = SMTP_PASS;
        $mail->SMTPSecure = SMTP_SECURE;
        $mail->Port       = SMTP_PORT;

        $mail->setFrom(SMTP_USER, 'Ekalavya Academy');
        $mail->addReplyTo(ADMIN_EMAIL, 'Ekalavya Academy Support');
        $mail->addAddress($to);

        // Deliverability Hardening
        $mail->CharSet = 'UTF-8';
        $mail->SMTPAutoTLS = false; // Prevents connection issues on many 465/SSL servers
        $mail->Sender = SMTP_USER;  // Sets Return-Path for SPF compliance
        $mail->XMailer = ' ';       // Hides PHPMailer header to reduce spam score

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $altBody ?: strip_tags($body);

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Institutional Mail Error: " . $mail->ErrorInfo);
        return false;
    }
}
?>
