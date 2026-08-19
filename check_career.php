<?php
require 'config/database.php';
$stmt = $pdo->query("DESCRIBE career_paths");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
