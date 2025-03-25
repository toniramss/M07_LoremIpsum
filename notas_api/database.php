<?php
// database.php
$host = "localhost";
$port = "3308";
$db_name = "NotasPrivadasBD";
$username = "root"; 
$password = "1234";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db_name;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>