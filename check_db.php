<?php
require_once 'config/database.php';
$stmt = $pdo->query("DESCRIBE test_series");
$columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($columns);
echo "</pre>";
