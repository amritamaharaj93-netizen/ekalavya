<?php
include 'config/database.php';
include 'config/mail.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    try {
        // 1. Save to Database (contact_leads table)
        $stmt = $pdo->prepare("INSERT INTO contact_leads (name, phone, email, subject, message) VALUES (:name, :phone, :email, :subj, :msg)");
        $stmt->execute([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'subj' => "Admission Enquiry: $course",
            'msg' => "Candidate interested in $course."
        ]);

        // 2. Dispatch Institutional Email
        $adminSubject = "New Admission Enquiry: $course [Lead]";
        $adminBody = "
            <div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #eee;'>
                <h2 style='color: #fec107;'>New Admission Inquiry</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Mobile:</strong> $phone</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Interested Program:</strong> $course</p>
            </div>
        ";
        
        sendInstitutionalMail(ADMIN_EMAIL, $adminSubject, $adminBody);

        // Success - Check for AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo json_encode(['status' => 'success', 'message' => 'Your enquiry has been submitted successfully! Our team will contact you shortly.']);
            exit();
        }

        header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=enquiry_sent");
        exit();

    } catch (PDOException $e) {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo json_encode(['status' => 'error', 'message' => 'System error. Please try again later.']);
            exit();
        }
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=failed");
        exit();
    }
}
?>
