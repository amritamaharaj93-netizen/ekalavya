<?php
require_once 'config/database.php';

$id_to_delete = 3;
$stmt = $pdo->prepare("DELETE FROM test_series WHERE id = ?");
if ($stmt->execute([$id_to_delete])) {
    echo "Successfully deleted duplicate test series entry with ID: $id_to_delete\n";
} else {
    echo "Error deleting entry.\n";
}
?>
