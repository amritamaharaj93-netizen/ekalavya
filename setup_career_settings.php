<?php
require_once 'config/database.php';

try {
    // Create the table
    $sql = "CREATE TABLE IF NOT EXISTS career_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        setting_key VARCHAR(100) NOT NULL UNIQUE,
        setting_value TEXT DEFAULT NULL
    )";
    $pdo->exec($sql);
    
    // Check if main_poster exists
    $stmt = $pdo->query("SELECT COUNT(*) FROM career_settings WHERE setting_key = 'main_poster'");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO career_settings (setting_key, setting_value) VALUES ('main_poster', 'careerpath.png')");
        echo "Table created and seeded successfully.";
    } else {
        echo "Table already exists and is seeded.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
