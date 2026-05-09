<?php
include 'config/database.php';
$s = $pdo->query("SELECT student_id, admit_card FROM students WHERE student_id = 'EK260005'")->fetch();
print_r($s);
