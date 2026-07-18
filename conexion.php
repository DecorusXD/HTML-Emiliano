<?php
$host = "localhost";
$user = "root";
$password = "12345678"; 
$database = "hotel_db";
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
