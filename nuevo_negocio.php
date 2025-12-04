<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $desc = $_POST['descripcion'];
    $dir = $_POST['direccion'];
    $tel = $_POST['telefono'];
    $cat_id = $_POST['categoria']; 
    $foto_nombre = 'default.jpg';
    $fb = $_POST['facebook'];
    $ig = $_POST['instagram'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $nombre_original = basename($_FILES['foto']['name']);
        $foto_nombre = time() . "_" . $nombre_original;
        $ruta_destino = "imagenes/" . $foto_nombre;
        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino)) {
            $mensaje = "Error al subir la imagen.";
        }
    }

    if ($mensaje == "") {
        $sql = "INSERT INTO Negocios (Nombre, Descripcion, Direccion, Telefono, foto, CategoriaId, Facebook, Instagram) 
        VALUES ('$nombre', '$desc', '$dir', '$tel', '$foto_nombre', '$cat_id', '$fb', '$ig')";
        
        if ($conexion->query($sql) === TRUE) {
            $mensaje = "¡Negocio guardado exitosamente!";
        } else {
            $mensaje = "Error en BD: " . $conexion->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Nuevo Negocio</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; padding: 20px; max-width: 500px; margin: 0 auto; background-color: #e8f5e9; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        input, textarea, select { width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; font-family: 'Poppins', sans-serif;}
        button { width: 100%; padding: 12px; background: #0288d1; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 15px; font-weight: bold;}
        button:hover { background: #0277bd; }
        label { font-weight: 600; display: block; margin-top: 10px; color: #2e7d32; }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="color: #2e7d32;">➕ Registrar Negocio</h2>
        <?php if($mensaje) { 
            $color = strpos($mensaje, 'Error') !== false ? 'red' : 'green';
            echo "<p style='color:$color; text-align:center;'>$mensaje</p>"; 
        } ?>
        
        <form method="POST" action="" enctype="multipart/form-data">
            <label>Nombre:</label>
            <input type="text" name="nombre" required>
            
            <label>Categoría:</label>
            <select name="categoria" required>
                <option value="">Selecciona una opción...</option>
                <?php
                $cats = $conexion->query("SELECT * FROM Categorias");
                while($c = $cats->fetch_assoc()) {
                    echo "<option value='".$c['Id']."'>".$c['Nombre']."</option>";
                }
                ?>
            </select>

            <label>Logo/Imagen:</label>
            <input type="file" name="foto" accept="image/png, image/jpeg, image/jpg">

            <label>Descripción:</label>
            <textarea name="descripcion" rows="3" required></textarea>
            
            <label>Dirección:</label>
            <input type="text" name="direccion" required>
            
            <label>Teléfono:</label>
            <input type="text" name="telefono" required>

            <label>Facebook (Link completo):</label>
            <input type="text" name="facebook" placeholder="https://facebook.com/...">

            <label>Instagram (Link completo):</label>
            <input type="text" name="instagram" placeholder="https://instagram.com/...">
            
            <button type="submit">Guardar Negocio</button>
        </form>
        <br>
        <div style="text-align: center;">
            <a href="dashboard.php" style="text-decoration: none; color: #555;">← Volver al Panel</a>
        </div>
    </div>
</body>
</html>