<?php
require_once 'config/database.php';

$stmt = $pdo->prepare("UPDATE test_series SET description = 'FullLength mock test for JEE Class 11 students.' WHERE id = 2");
$stmt->execute();
echo "Updated JEE card description.\n";
?>
