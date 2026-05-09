<?php
require_once 'config/database.php';

// Update ID 2 to match both filters
$stmt = $pdo->prepare("UPDATE test_series SET description = 'AITS FullLength and Chapterwise test series for JEE Class 11 students.' WHERE id = 2");
if ($stmt->execute()) {
    echo "Successfully updated JEE test series ID 2 for both sub-menu pages.\n";
} else {
    echo "Error updating entry.\n";
}
?>
