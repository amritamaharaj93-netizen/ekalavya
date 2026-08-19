<?php
require_once 'config/database.php';

try {
    // Create site_settings table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `site_settings` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `setting_key` varchar(100) NOT NULL UNIQUE,
        `setting_value` text DEFAULT NULL,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    echo "site_settings table created successfully!\n";

    // Insert default breadcrumb image if not exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM site_settings WHERE setting_key = 'breadcrumb_bg_image'");
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        $pdo->exec("INSERT INTO site_settings (setting_key, setting_value) VALUES ('breadcrumb_bg_image', 'TopFront & side .png')");
        echo "Default breadcrumb background image inserted.\n";
    }

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
