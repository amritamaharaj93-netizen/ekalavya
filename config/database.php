<?php
// config/database.php

if (php_sapi_name() == 'cli' || (isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['SERVER_ADDR'] == '127.0.0.1'))) {
    // Local Settings (XAMPP)
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "ek");
    define("BASE_URL", "/eklavya/");
    define("SITE_URL", "http://localhost/eklavya/");
} else {
    // Hostinger Live Settings
    define("DB_HOST", "localhost");
    define("DB_USER", "u769307048_ek");
    define("DB_PASS", "KunalGW@1411");
    define("DB_NAME", "u769307048_ek");
    define("BASE_URL", "/");
    define("SITE_URL", "https://eklavya-academy.com/"); // Placeholder, usually the domain
}

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Hidden on live environment if possible
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        die("Local Connection Failed: " . $e->getMessage());
    } else {
        die("Our apologies! We are experiencing a technical issue.");
    }
}
?>