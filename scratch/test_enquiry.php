<?php
$_SERVER["REQUEST_METHOD"] = "POST";
$_POST['name'] = "Test User";
$_POST['phone'] = "1234567890";
$_POST['email'] = "test@example.com";
$_POST['course'] = "Phy-Mod";
$_SERVER['HTTP_REFERER'] = "http://localhost/eklavya/study-material.php";

require_once 'process-enquiry.php';
?>
