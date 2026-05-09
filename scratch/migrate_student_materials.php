<?php
$_SERVER['HTTP_HOST'] = 'localhost';
require_once 'config/database.php';

$sql = "CREATE TABLE IF NOT EXISTS student_materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    material_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

try {
    $pdo->exec($sql);
    echo "Table student_materials created successfully.\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
