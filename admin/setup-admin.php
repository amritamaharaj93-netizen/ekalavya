<?php
require_once '../config/database.php';

echo "<h2>Eklavya Academy - Admin System Setup</h2>";

try {
    // 1. Create missing tables
    $queries = [
        "CREATE TABLE IF NOT EXISTS `admin_users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `username` varchar(50) NOT NULL UNIQUE,
            `password` varchar(255) NOT NULL,
            `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        
        "CREATE TABLE IF NOT EXISTS `test_series` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` varchar(255) NOT NULL,
            `category` varchar(100) DEFAULT NULL,
            `price` varchar(50) DEFAULT NULL,
            `description` text DEFAULT NULL,
            `link` varchar(255) DEFAULT NULL,
            `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        "CREATE TABLE IF NOT EXISTS `study_material` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` varchar(255) NOT NULL,
            `type` varchar(50) DEFAULT NULL,
            `category` varchar(100) DEFAULT NULL,
            `file_path` varchar(255) DEFAULT NULL,
            `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        "CREATE TABLE IF NOT EXISTS `scholarship_programs` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` varchar(255) NOT NULL,
            `benefit` varchar(255) DEFAULT NULL,
            `description` text DEFAULT NULL,
            `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
    ];

    foreach($queries as $query) {
        $pdo->exec($query);
    }
    echo "<p style='color:green;'>✓ Database tables verified/created.</p>";

    // 2. Create or Reset admin account
    $username = 'admin';
    $password = 'admin123';
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check = $pdo->prepare("SELECT id FROM admin_users WHERE username = ?");
    $check->execute([$username]);
    if ($check->fetch()) {
        // Update existing
        $stmt = $pdo->prepare("UPDATE admin_users SET password = ? WHERE username = ?");
        $stmt->execute([$hashed_password, $username]);
        echo "<p style='color:green;'>✓ Admin password has been reset to default.</p>";
    } else {
        // Insert new
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashed_password]);
        echo "<p style='color:green;'>✓ Admin account created successfully!</p>";
    }

    // 3. Create required directories
    $dirs = ['../uploads/results/', '../uploads/materials/'];
    foreach($dirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
            echo "<p style='color:green;'>✓ Directory created: $dir</p>";
        }
    }

    echo "<h3>Setup Complete!</h3>";
    echo "<p>Login URL: <a href='login.php'>Click Here to Login</a></p>";
    echo "<ul><li>Username: <b>admin</b></li><li>Password: <b>admin123</b></li></ul>";

} catch (PDOException $e) {
    echo "<p style='color:red;'>FATAL ERROR: " . $e->getMessage() . "</p>";
}
?>
