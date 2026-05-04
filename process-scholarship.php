<?php
include 'config/database.php';
include 'config/mail.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $program = $_POST['program'];
    $scholarship_type = isset($_POST['scholarship_type']) ? $_POST['scholarship_type'] : 'N/A';

    try {
        // 1. Check if user already exists
        $checkStmt = $pdo->prepare("SELECT id, student_id FROM students WHERE email = :email");
        $checkStmt->execute(['email' => $email]);
        $existing = $checkStmt->fetch(PDO::FETCH_ASSOC);

        // 2. Generate/Retrieve Student ID
        if ($existing) {
            $student_id = $existing['student_id'];
            $is_new = false;
        } else {
            $stmt = $pdo->query("SELECT MAX(id) as max_id FROM students");
            $next_id = ($stmt->fetch(PDO::FETCH_ASSOC)['max_id'] ?? 0) + 1;
            $unique_suffix = str_pad($next_id, 4, '0', STR_PAD_LEFT);
            $year = date('y'); 
            $student_id = "EK" . $year . $unique_suffix;
            $is_new = true;
        }

        // 3. Generate New Password
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password_raw = substr(str_shuffle($alphabet), 0, 8);
        $password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);

        // 4. Save/Update Database
        if ($is_new) {
            $stmt = $pdo->prepare("INSERT INTO students (student_id, name, email, phone, password, program) VALUES (:sid, :name, :email, :phone, :pass, :prog)");
            $stmt->execute([
                'sid' => $student_id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'pass' => $password_hashed,
                'prog' => $program
            ]);
        } else {
            $stmt = $pdo->prepare("UPDATE students SET name = :name, phone = :phone, password = :pass, program = :prog WHERE email = :email");
            $stmt->execute([
                'name' => $name,
                'phone' => $phone,
                'pass' => $password_hashed,
                'prog' => $program,
                'email' => $email
            ]);
        }

        // 5. Dispatch Institutional Email to Student (with full form details)
        $mailSubject = "Welcome to Ekalavya Academy - Registration Successful";
        $mailBody = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                <div style='background: #0a1f44; padding: 25px; text-align: center; border-bottom: 4px solid #fec107;'>
                    <h2 style='color: #fff; margin: 0;'>Ekalavya Academy Registration</h2>
                </div>
                <div style='padding: 30px; background: #fff;'>
                    <p>Dear <strong>$name</strong>,</p>
                    <p>Congratulations! You have successfully registered for the Ekalavya Scholarship Program. Your registration details and account credentials are provided below.</p>
                    
                    <h3 style='color: #0a1f44; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-top: 25px;'>Registration Summary</h3>
                    <table style='width: 100%; border-collapse: collapse; margin-bottom: 25px;'>
                        <tr><td style='padding: 8px 0; color: #666; width: 150px;'>Full Name:</td><td style='padding: 8px 0; font-weight: bold;'>$name</td></tr>
                        <tr><td style='padding: 8px 0; color: #666;'>Mobile Number:</td><td style='padding: 8px 0; font-weight: bold;'>$phone</td></tr>
                        <tr><td style='padding: 8px 0; color: #666;'>Applied Program:</td><td style='padding: 8px 0; font-weight: bold;'>$program</td></tr>
                        <tr><td style='padding: 8px 0; color: #666;'>Scholarship Type:</td><td style='padding: 8px 0; font-weight: bold;'>$scholarship_type</td></tr>
                    </table>

                    <h3 style='color: #0a1f44; border-bottom: 1px solid #eee; padding-bottom: 10px;'>Your Account Access</h3>
                    <div style='background: #f8f9fa; border-left: 4px solid #fec107; padding: 20px; margin: 15px 0;'>
                        <p style='margin: 0 0 10px 0;'><strong>Student ID:</strong> <span style='color: #0a1f44; font-size: 1.1rem; font-weight: bold;'>$student_id</span></p>
                        <p style='margin: 0;'><strong>Password:</strong> <span style='font-size: 1.1rem; font-weight: bold;'>$password_raw</span></p>
                    </div>
                    
                    <p>Please use these credentials to log in to your dashboard to access resources and important updates.</p>
                    <div style='text-align: center; margin-top: 30px;'>
                        <a href='" . SITE_URL . "student-login.php' style='display: inline-block; background: #0a1f44; color: #fff; padding: 15px 35px; text-decoration: none; border-radius: 50px; font-weight: bold; text-transform: uppercase; font-size: 0.9rem;'>Login to Student Dashboard</a>
                    </div>
                    <p style='margin-top: 40px; font-size: 0.85rem; color: #888; border-top: 1px solid #eee; padding-top: 20px;'>This is an automated message. Please do not reply directly to this email.<br>Best Regards, <strong>Management Team, Ekalavya Academy</strong></p>
                </div>
            </div>
        ";
        
        if (!sendInstitutionalMail($email, $mailSubject, $mailBody)) {
            error_log("Welcome Mail Failed for: $email");
        }

        // 6. Admin Alert Email
        $adminSubject = "New Student Registration: $student_id - $name";
        $adminBody = "
            <div style='font-family: Arial, sans-serif; color: #333;'>
                <h2 style='color: #0a1f44;'>New Scholarship Registration Details</h2>
                <table style='width: 100%; border-collapse: collapse; margin-top: 20px;'>
                    <tr><td style='padding: 10px; border: 1px solid #eee; background: #f9f9f9; width: 150px;'><strong>Student ID</strong></td><td style='padding: 10px; border: 1px solid #eee;'>$student_id</td></tr>
                    <tr><td style='padding: 10px; border: 1px solid #eee; background: #f9f9f9;'><strong>Full Name</strong></td><td style='padding: 10px; border: 1px solid #eee;'>$name</td></tr>
                    <tr><td style='padding: 10px; border: 1px solid #eee; background: #f9f9f9;'><strong>Email Address</strong></td><td style='padding: 10px; border: 1px solid #eee;'>$email</td></tr>
                    <tr><td style='padding: 10px; border: 1px solid #eee; background: #f9f9f9;'><strong>Phone Number</strong></td><td style='padding: 10px; border: 1px solid #eee;'>$phone</td></tr>
                    <tr><td style='padding: 10px; border: 1px solid #eee; background: #f9f9f9;'><strong>Target Program</strong></td><td style='padding: 10px; border: 1px solid #eee;'>$program</td></tr>
                    <tr><td style='padding: 10px; border: 1px solid #eee; background: #f9f9f9;'><strong>Scholarship Type</strong></td><td style='padding: 10px; border: 1px solid #eee;'>$scholarship_type</td></tr>
                    <tr><td style='padding: 10px; border: 1px solid #eee; background: #f9f9f9;'><strong>Account Password</strong></td><td style='padding: 10px; border: 1px solid #eee;'>$password_raw</td></tr>
                </table>
            </div>
        ";
        if (!sendInstitutionalMail(ADMIN_EMAIL, $adminSubject, $adminBody)) {
            error_log("Admin Alert Failed for registration: $student_id");
        }

        // Success - Redirect
        header("Location: " . BASE_URL . "registration-success.php?sid=" . urlencode($student_id) . "&pass=" . urlencode($password_raw) . "&name=" . urlencode($name));
        exit();

    } catch (Exception $e) {
        error_log("Registration Error: " . $e->getMessage());
        header("Location: " . BASE_URL . "scholarship.php?error=Technical system issue. Please contact support.");
        exit();
    }
} else {
    header("Location: " . BASE_URL . "scholarship.php");
    exit();
}

?>
