<?php
include 'config/database.php';
$s = $pdo->query('SELECT * FROM study_material');
while($r = $s->fetch()) {
    echo $r['file_path'] . "\n";
}
?>
