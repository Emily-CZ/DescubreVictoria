<?php
session_start();
include 'conexion.php';

if (isset($_SESSION['admin']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM Negocios WHERE Id = $id";
    $conexion->query($sql);
}

header("Location: dashboard.php");
exit();
?>