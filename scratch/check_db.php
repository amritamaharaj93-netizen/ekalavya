<?php
// Bypass config check for CLI
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "eklavya_academy");

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    echo "Table Structure for 'courses':\n";
    $stmt = $pdo->query("DESCRIBE courses");
    while ($row = $stmt->fetch()) {
        echo "{$row['Field']} - {$row['Type']}\n";
    }

    echo "\nCurrent Courses:\n";
    $stmt = $pdo->query("SELECT id, title, category, slug FROM courses");
    while ($row = $stmt->fetch()) {
        echo "ID: {$row['id']}, Title: {$row['title']}, Category: {$row['category']}, Slug: {$row['slug']}\n";
    }
} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}
?>
