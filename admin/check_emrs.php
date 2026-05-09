<?php
require_once '../config/database.php';
$stmt = $pdo->prepare("SELECT content_json FROM scholarship_tabs WHERE tab_slug = 'school'");
$stmt->execute();
$row = $stmt->fetch();
echo $row['content_json'];
?>
