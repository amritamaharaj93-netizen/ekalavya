<?php
session_start();
include 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM students WHERE student_id = :sid");
        $stmt->execute(['sid' => $student_id]);
        $student = $stmt->fetch();

        if ($student && password_verify($password, $student['password'])) {
            // Authentication Success
            $_SESSION['student_id'] = $student['student_id'];
            $_SESSION['student_name'] = $student['name'];
            $_SESSION['student_db_id'] = $student['id'];
            
            header("Location: student-dashboard.php");
            exit();
        } else {
            // Invalid credentials
            header("Location: student-login.php?error=Invalid Student ID or password.");
            exit();
        }

    } catch (PDOException $e) {
        header("Location: student-login.php?error=Technical issue. Contact administrator.");
        exit();
    }
} else {
    header("Location: student-login.php");
    exit();
}
?>
