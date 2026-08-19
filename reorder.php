<?php
require 'config/database.php';
$stmt=$pdo->prepare("UPDATE courses SET created_at = '2026-05-04 18:48:25' WHERE id = 9");
if ($stmt->execute()) {
    echo "Updated order of 7th standard successfully!";
} else {
    echo "Failed";
}
