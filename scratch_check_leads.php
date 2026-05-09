<?php
require_once 'config/database.php';
$stmt = $pdo->query("DESCRIBE contact_leads");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
