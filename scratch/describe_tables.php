<?php
$_SERVER['HTTP_HOST'] = 'localhost';
require_once 'config/database.php';

$tables = ['students', 'study_material', 'student_materials'];
foreach ($tables as $t) {
    echo "\n--- $t ---\n";
    try {
        $stmt = $pdo->query("DESCRIBE $t");
        while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "{$r['Field']} - {$r['Type']}\n";
        }
    } catch (Exception $e) {
        echo "Table $t does not exist.\n";
    }
}
?>
