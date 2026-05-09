<?php
require_once '../config/database.php';

try {
    // Create banners table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `banners` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `image` varchar(255) NOT NULL,
        `link` varchar(255) DEFAULT NULL,
        `alt_text` varchar(255) DEFAULT NULL,
        `sort_order` int(11) DEFAULT 0,
        `status` tinyint(1) DEFAULT 1,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Create about_cards table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `about_cards` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `icon_class` varchar(100) DEFAULT 'fas fa-atom',
        `icon_color` varchar(50) DEFAULT 'text-purple',
        `blob_color` varchar(50) DEFAULT 'rgba(108, 92, 231, 0.1)',
        `title` varchar(255) NOT NULL,
        `subtitle` varchar(255) DEFAULT NULL,
        `description` text DEFAULT NULL,
        `badges` text DEFAULT NULL,
        `link` varchar(255) DEFAULT NULL,
        `sort_order` int(11) DEFAULT 0,
        `status` tinyint(1) DEFAULT 1,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    echo "Tables created successfully!\n";

    // Insert default data if empty
    $count = $pdo->query("SELECT COUNT(*) FROM banners")->fetchColumn();
    if ($count == 0) {
        $pdo->exec("INSERT INTO banners (image, link, alt_text) VALUES 
            ('home banner1.png', 'scholarship', 'Ekalavya Home Banner 1'),
            ('home banner4.png', 'course-detail.php?slug=nurture-jee-11', 'Ekalavya Home Banner 2'),
            ('home banner3.png', 'course-detail.php?slug=seed-jee-9', 'Ekalavya Home Banner 3')");
        echo "Default banners inserted.\n";
    }

    $count = $pdo->query("SELECT COUNT(*) FROM about_cards")->fetchColumn();
    if ($count == 0) {
        $pdo->exec("INSERT INTO about_cards (icon_class, icon_color, blob_color, title, subtitle, description, badges, link) VALUES 
            ('fas fa-atom', 'text-purple', 'rgba(108, 92, 231, 0.1)', 'IIT-JEE', 'Elite Engineering Program', 'Strategic physics-mathematics fusion designed for the toughest entrance exam on the planet.', 'Class 11, Class 12, Repeaters', 'courses.php?category=IIT-JEE'),
            ('fas fa-dna', 'text-pink', 'rgba(253, 121, 168, 0.1)', 'NEET-UG', 'Premier Medical Program', 'Visual conceptual biology and reactive chemistry modules for top-tier medical college placements.', 'Class 11, Class 12, Dropper', 'courses.php?category=NEET'),
            ('fas fa-vial', 'text-cyan', 'rgba(0, 206, 201, 0.1)', 'SCHOOL PREP', 'Junior Scholars Program', 'Nurturing curiosity into competency for NTSE, Olympiads, and early competitive edge.', 'Class 7, Class 8, Class 9, Class 10', 'courses.php?category=School Prep (Class 7th-12th)')");
        echo "Default about cards inserted.\n";
    }

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
