<?php
include 'config/database.php';
$stmt = $pdo->prepare("INSERT INTO students (student_id, name, email, phone, password, program) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute(['TEST999', 'Test Student', 'test999@example.com', '1234567890', 'pass', 'NEET']);
$s = $pdo->query("SELECT created_at FROM students WHERE student_id = 'TEST999'")->fetch();
print_r($s);
// Cleanup
$pdo->query("DELETE FROM students WHERE student_id = 'TEST999'");
