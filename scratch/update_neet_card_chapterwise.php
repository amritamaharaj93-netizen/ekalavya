<?php
require_once 'config/database.php';

// Update ID 1 to match Chapterwise filter
$stmt = $pdo->prepare("UPDATE test_series SET description = 'Chapterwise test series for NEET Class 11 students.' WHERE id = 1");
if ($stmt->execute()) {
    echo "Successfully updated test series ID 1 for Chapterwise page.\n";
} else {
    echo "Error updating entry.\n";
}
?>
