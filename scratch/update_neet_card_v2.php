<?php
require_once 'config/database.php';

// Revert title and add FullLength to description
$stmt = $pdo->prepare("UPDATE test_series SET title = 'NEET Class 11th (Enthusiast DLP)', description = 'FullLength mock test for NEET Class 11 students.' WHERE id = 1");
if ($stmt->execute()) {
    echo "Successfully updated test series ID 1 description\n";
} else {
    echo "Error updating entry.\n";
}
?>
