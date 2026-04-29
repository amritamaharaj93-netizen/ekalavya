<?php
include 'config/database.php';
include 'config/mail.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    try {
        // 1. Save to Database
        $stmt = $pdo->prepare("INSERT INTO contact_leads (name, phone, email, subject, message) VALUES (:name, :phone, :email, :subj, :msg)");
        $stmt->execute([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'subj' => $subject,
            'msg' => $message
        ]);

        // 2. Dispatch Institutional Email
        $adminSubject = "Institutional Inquiry: $subject [From $name]";
        $adminBody = "
            <div style='font-family: Arial, sans-serif; padding: 25px; border: 1px solid #ddd; border-radius: 12px;'>
                <h2 style='color: #0d6efd;'>New Contact Inquiry</h2>
                <hr>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Mobile:</strong> $phone</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Nature of Inquiry:</strong> $subject</p>
                <div style='background: #f8f9fa; padding: 15px; border-radius: 8px; margin-top: 15px;'>
                    <p style='margin: 0;'><strong>Message:</strong></p>
                    <p style='margin: 10px 0 0;'>$message</p>
                </div>
            </div>
        ";
        
        sendInstitutionalMail(SMTP_USER, $adminSubject, $adminBody);

        // Success - Redirect
        header("Location: " . BASE_URL . "contact.php?status=success");
        exit();

    } catch (PDOException $e) {
        header("Location: " . BASE_URL . "contact.php?error=failed");
        exit();
    }
}

?>
