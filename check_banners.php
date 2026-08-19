<?php
require 'c:/xampp/htdocs/eklavya/config/database.php';
$stmt = $pdo->query('DESCRIBE banners');
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
