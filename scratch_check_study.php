<?php
include 'config/database.php';
$stmt = $pdo->query("SELECT * FROM study_material");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rows, JSON_PRETTY_PRINT);
