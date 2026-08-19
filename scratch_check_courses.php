<?php
require_once 'config/database.php';
$stmt = $pdo->query("SELECT id, title, category, slug, hero_banner FROM courses");
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($courses);
echo "</pre>";
