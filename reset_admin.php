<?php
require_once 'config/database.php';

$username = 'admin';
$password = 'admin123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    $check = $pdo->prepare("SELECT id FROM admin_users WHERE username = ?");
    $check->execute([$username]);
    if ($check->fetch()) {
        $stmt = $pdo->prepare("UPDATE admin_users SET password = ? WHERE username = ?");
        $stmt->execute([$hashed_password, $username]);
        echo "Admin password has been reset to: admin123";
    } else {
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashed_password]);
        echo "Admin account created with password: admin123";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
