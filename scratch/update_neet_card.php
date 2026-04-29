<?php
require_once 'config/database.php';

// Update ID 1 to be a Full Length Mock
$stmt = $pdo->prepare("UPDATE test_series SET title = 'AITS NEET Class 11th (Full Length Mock)', slug = 'aits-neet-class-11-full-length' WHERE id = 1");
if ($stmt->execute()) {
    echo "Successfully updated test series ID 1\n";
} else {
    echo "Error updating entry.\n";
}
?>
