<?php
require 'config/database.php';
$stmt=$pdo->query('SELECT id, created_at FROM courses');
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
