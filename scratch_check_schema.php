<?php
include 'config/database.php';
$s = $pdo->query('SHOW CREATE TABLE students')->fetch();
print_r($s);
