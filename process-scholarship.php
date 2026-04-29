<?php
include 'config/database.php';
include 'config/mail.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $program = $_POST['program'];

    // 1. Generate Unique Student ID (Format: EK[YY]XXXX)
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM students");
    $count = $stmt->fetch()['total'];
    $unique_suffix = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
    $year = date('y'); 
    $student_id = "EK" . $year . $unique_suffix;

    // 2. Generate Random Professional Password
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $password_raw = substr(str_shuffle($alphabet), 0, 8);
    $password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO students (student_id, name, email, phone, password, program) VALUES (:sid, :name, :email, :phone, :pass, :prog)");
        $stmt->execute([
            'sid' => $student_id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'pass' => $password_hashed,
            'prog' => $program
        ]);

        // 3. Dispatch Institutional Email
        $mailSubject = "Welcome to Eklavya Academy - Registration Successful";
        $mailBody = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                <div style='background: #f8f9fa; padding: 20px; text-align: center; border-bottom: 3px solid #fec107;'>
                    <h2>Eklavya Academy Registration</h2>
                </div>
                <div style='padding: 20px;'>
                    <p>Dear <strong>$name</strong>,</p>
                    <p>Congratulations! You have successfully registered for the ESAT Scholarship Exam. Your portal access has been provisioned.</p>
                    <div style='background: #fff; border: 1px solid #ddd; padding: 15px; border-radius: 8px; margin: 20px 0;'>
                        <p style='margin: 0;'><strong>Student ID:</strong> <span style='color: #fec107; font-size: 1.2rem;'>$student_id</span></p>
                        <p style='margin: 0;'><strong>Password:</strong> <span style='font-size: 1.2rem;'>$password_raw</span></p>
                    </div>
                    <p>Please log in to your dashboard to download your Admit Card & access Test Series.</p>
                    <a href='" . SITE_URL . "student-login.php' style='display: inline-block; background: #fec107; color: #000; padding: 12px 25px; text-decoration: none; border-radius: 50px; font-weight: bold;'>Login to Dashboard</a>
                    <p style='margin-top: 30px; font-size: 0.9rem; color: #777;'>Best Regards,<br>Management Team<br>Eklavya Academy</p>
                </div>
            </div>
        ";
        
        sendInstitutionalMail($email, $mailSubject, $mailBody);

        // Optional: Admin alert
        $adminSubject = "New Scholarship Registration: $name";
        $adminBody = "A new student has registered for ESAT.<br>Name: $name<br>Email: $email<br>Phone: $phone<br>Program: $program";
        sendInstitutionalMail(SMTP_USER, $adminSubject, $adminBody);

        // Success - Redirect
        header("Location: " . BASE_URL . "registration-success.php?sid=" . urlencode($student_id) . "&pass=" . urlencode($password_raw) . "&name=" . urlencode($name));
        exit();

    } catch (PDOException $e) {
        // Redir with error
        header("Location: " . BASE_URL . "scholarship.php?error=Technical issue occurred. Please try again.");
        exit();
    }
} else {
    header("Location: " . BASE_URL . "scholarship.php");
    exit();
}

?>
