<?php
$servidor = "localhost";
$usuario = "root";     // Usuario
$password = "";        // Contraseña 
$base_datos = "DescubreVictoriaDB";

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
// echo "Conexión exitosa"; 
?>