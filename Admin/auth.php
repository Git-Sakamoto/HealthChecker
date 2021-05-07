<?php
session_start();

header('Expires:-1');
header('Cache-Control:');
header('Pragma:');

if(!isset($_SESSION["user_name"])) {
	header("Location: /HealthChecker/Admin/login.php");
	exit;
}
?>