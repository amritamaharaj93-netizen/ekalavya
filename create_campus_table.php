<?php
require_once 'config/database.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS campus_images (
        id INT AUTO_INCREMENT PRIMARY KEY,
        image VARCHAR(255) NOT NULL,
        alt_text VARCHAR(255) DEFAULT NULL,
        sort_order INT DEFAULT 0,
        status TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Table created successfully.";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
