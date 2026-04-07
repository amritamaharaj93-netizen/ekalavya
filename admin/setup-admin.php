<?php
require_once '../config/database.php';

// First admin account
$username = 'admin';
$password = 'admin123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashed_password]);
    echo "Admin User Created Successfully! Username: $username, Password: $password<br>";
} catch (PDOException $e) {
    echo "Admin already exists or error: " . $e->getMessage();
}

// Create uploads directory
$upload_dir = '../uploads/results/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
    echo "Uploads directory created successfully!<br>";
}
?>
