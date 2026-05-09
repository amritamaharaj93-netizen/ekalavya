<?php
include 'config/database.php';
$stmt = $pdo->query("SELECT id, student_id, name, admit_card FROM students ORDER BY id DESC LIMIT 5");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($students);
echo "</pre>";
