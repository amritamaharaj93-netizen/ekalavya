<?php
require_once 'config/database.php';
try {
    $stmt = $pdo->query("DESCRIBE contact_leads");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Columns in contact_leads:\n";
    foreach ($columns as $col) {
        echo "- " . $col['Field'] . " (" . $col['Type'] . ")\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
