<?php
require_once 'config/database.php';

$stmt = $pdo->query("SELECT id, title, category, price FROM test_series");
$tests = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Test Series List:\n";
foreach ($tests as $test) {
    echo "ID: " . $test['id'] . " | Title: " . $test['title'] . " | Category: " . $test['category'] . " | Price: " . $test['price'] . "\n";
}
?>
