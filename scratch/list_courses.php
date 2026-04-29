<?php
require_once 'config/database.php';
$stmt = $pdo->query("SELECT id, title FROM courses");
while($row = $stmt->fetch()) {
    echo $row['id'] . ": " . $row['title'] . "\n";
}
