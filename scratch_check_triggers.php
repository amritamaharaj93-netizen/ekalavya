<?php
include 'config/database.php';
$s = $pdo->query('SHOW TRIGGERS')->fetchAll();
print_r($s);
