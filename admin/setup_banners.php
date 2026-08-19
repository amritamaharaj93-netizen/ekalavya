<?php
require_once '../config/database.php';
try {
    $sql = "CREATE TABLE IF NOT EXISTS `banners` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `image` varchar(255) NOT NULL,
        `page_identifier` varchar(100) DEFAULT 'scholarship',
        `status` tinyint(1) DEFAULT 1,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $pdo->exec($sql);
    echo "Table created successfully.";
} catch(PDOException $e) {
    echo $e->getMessage();
}
?>
