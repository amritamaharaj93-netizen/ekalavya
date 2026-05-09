<?php
$host = 'localhost';
$db   = 'ek';
$user = 'root';
$pass = '';
try {
     $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
     $pdo->exec("DELETE FROM courses WHERE title LIKE 'SEED%' OR title LIKE 'ANKUR%'");
     echo "Deleted successfully.\n";
} catch (Exception $e) {
     echo "Error: " . $e->getMessage();
}
