<?php
/**
 * Legacy db connect file.
 * Kept for old includes, but main app now uses Database class.
 */

$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'root'; // local MAMP password on my setup
$db_name = 'db_portfolio';

try {
    // build mysql dsn string
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    
    // open PDO connection
    $pdo = new PDO($dsn, $db_user, $db_pass);
    
    // throw exceptions for db errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // use real prepared statements
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
} catch (PDOException $e) {
    // log actual error, show simple msg to user
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection failed. Please contact the administrator.");
}

// keep $connect alias for older files
$connect = $pdo;

?>