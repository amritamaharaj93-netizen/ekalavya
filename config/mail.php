<?php
// config/mail.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once 'libs/PHPMailer-6.8.0/src/Exception.php';
require_once 'libs/PHPMailer-6.8.0/src/PHPMailer.php';
require_once 'libs/PHPMailer-6.8.0/src/SMTP.php';

// Global Mail Configuration
define('SMTP_HOST', 'smtp.hostinger.com');
define('SMTP_USER', 'info@globalwebify.com');
define('SMTP_PASS', 'Aasminpass@435989856');
define('SMTP_PORT', 465); // SSL
define('SMTP_SECURE', PHPMailer::ENCRYPTION_SMTPS); // Use SSL

/**
 * Intelligent Mail Dispatcher
 * @param string $to Recipient Email
 * @param string $subject Email Subject
 * @param string $body Email Body (HTML)
 * @param string $altBody Email Alt Body (Plain Text)
 * @return bool Success status
 */
function sendInstitutionalMail($to, $subject, $body, $altBody = '') {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USER;
        $mail->Password   = SMTP_PASS;
        $mail->SMTPSecure = SMTP_SECURE;
        $mail->Port       = SMTP_PORT;

        // Recipients
        $mail->setFrom(SMTP_USER, 'Eklavya Academy');
        $mail->addAddress($to);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $altBody ?: strip_tags($body);

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Institutional Mail Error: {$mail->ErrorInfo}");
        return false;
    }
}
?>
