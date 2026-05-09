<?php
include 'config/database.php';
$ss = $pdo->query('SELECT id, name, created_at FROM students ORDER BY id DESC LIMIT 5')->fetchAll();
print_r($ss);
echo "Current Server Time: " . date('Y-m-d H:i:s') . "\n";
