<?php
$pdo = new PDO('mysql:host=localhost;dbname=ek', 'root', '');
$stmt = $pdo->query('SHOW TABLES');
while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
    $table = $row[0];
    $stmt2 = $pdo->query("SHOW COLUMNS FROM $table");
    while ($col = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        if (strpos($col['Type'], 'char') !== false || strpos($col['Type'], 'text') !== false) {
            $stmt3 = $pdo->query("SELECT * FROM $table WHERE `" . $col['Field'] . "` LIKE '%scholar image1%'");
            if ($stmt3->rowCount() > 0) {
                echo "Found in $table." . $col['Field'] . "\n";
            }
        }
    }
}
?>
