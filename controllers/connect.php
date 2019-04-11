<?php
$dsn = "mysql:host=localhost;dbname=bandes_dessinnees;port=3306;charset=utf8mb4;";
$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
  $pdo = new PDO($dsn, "root", "root", $options);
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}

$sessionName = 'bd-shop';
$timestamp = time() + 600;
session_name($sessionName);
session_start();
setcookie($sessionName, session_id(), $timestamp);

$_SESSION['basket'] ?? $_SESSION['basket'] = [];
