<?php
include 'config/database.php';
$ss = $pdo->query('SELECT id, student_id, name, admit_card FROM students')->fetchAll();
print_r($ss);
