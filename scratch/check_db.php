<?php
include 'config/database.php';
$stmt = $pdo->query('SELECT id, title, slug, description FROM courses');
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo 'ID: ' . $row['id'] . ' | Title: ' . $row['title'] . ' | Slug: ' . $row['slug'] . ' | Desc: ' . $row['description'] . PHP_EOL;
}
