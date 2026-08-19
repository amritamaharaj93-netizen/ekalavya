<?php
require 'config/database.php';
$sql = "ALTER TABLE courses ADD COLUMN card_features TEXT NULL AFTER description";
$stmt = $pdo->prepare($sql);
if ($stmt->execute()) {
    echo "Column card_features added successfully.";
} else {
    echo "Failed to add column.";
}
