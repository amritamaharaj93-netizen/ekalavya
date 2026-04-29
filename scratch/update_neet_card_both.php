<?php
require_once 'config/database.php';

// Update ID 1 to match both filters
$stmt = $pdo->prepare("UPDATE test_series SET description = 'AITS FullLength and Chapterwise test series for NEET Class 11 students.' WHERE id = 1");
if ($stmt->execute()) {
    echo "Successfully updated test series ID 1 for both sub-menu pages.\n";
} else {
    echo "Error updating entry.\n";
}
?>
