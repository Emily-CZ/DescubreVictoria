<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// 1. OBTENER DATOS
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Negocios WHERE Id = $id";
    $resultado = $conexion->query($sql);
    $negocio = $resultado->fetch_assoc();
}

$mensaje = "";

// 2. GUARDAR CAMBIOS
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $desc = $_POST['descripcion'];
    $dir = $_POST['direccion'];
    $tel = $_POST['telefono'];
    $cat_id = $_POST['categoria']; 
    $fb = $_POST['facebook'];
    $ig = $_POST['instagram'];

    $sql_foto = ""; 
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $nombre_original = basename($_FILES['foto']['name']);
        $foto_nombre = time() . "_" . $nombre_original;
        $ruta_destino = "imagenes/" . $foto_nombre;
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino)) {
            $sql_foto = ", foto = '$foto_nombre'";
        }
    }

    $sql = "UPDATE Negocios SET Nombre='$nombre', Descripcion='$desc', Direccion='$dir', Telefono='$tel', CategoriaId='$cat_id', Facebook='$fb', Instagram='$ig' $sql_foto WHERE Id=$id";

    if ($conexion->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        $mensaje = "Error al actualizar: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Editar Negocio</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; padding: 20px; max-width: 500px; margin: 0 auto; background-color: #e8f5e9; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        input, textarea, select { width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; font-family: 'Poppins', sans-serif;}
        button { width: 100%; padding: 12px; background: #f39c12; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 15px; font-weight: bold;}
        button:hover { background: #e67e22; }
        label { font-weight: 600; display: block; margin-top: 10px; color: #2e7d32; }
        .img-preview { width: 100px; height: 100px; object-fit: cover; border-radius: 10px; margin: 10px 0; border: 2px solid #ddd; }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="color: #f39c12;">✏️ Editar Negocio</h2>
        <?php if($mensaje) echo "<p style='color:red'>$mensaje</p>"; ?>
        
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $negocio['Id']; ?>">

            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $negocio['Nombre']; ?>" required>
            
            <label>Categoría:</label>
            <select name="categoria" required>
                <?php
                $cats = $conexion->query("SELECT * FROM Categorias");
                while($c = $cats->fetch_assoc()) {
                    $selected = ($c['Id'] == $negocio['CategoriaId']) ? 'selected' : '';
                    echo "<option value='".$c['Id']."' $selected>".$c['Nombre']."</option>";
                }
                ?>
            </select>

            <label>Imagen Actual:</label>
            <?php $img = !empty($negocio['foto']) ? $negocio['foto'] : 'default.jpg'; ?>
            <img src="imagenes/<?php echo $img; ?>" class="img-preview">
            <br>
            <label>Cambiar Imagen (Opcional):</label>
            <input type="file" name="foto" accept="image/*">

            <label>Descripción:</label>
            <textarea name="descripcion" rows="3" required><?php echo $negocio['Descripcion']; ?></textarea>
            
            <label>Dirección:</label>
            <input type="text" name="direccion" value="<?php echo $negocio['Direccion']; ?>" required>
            
            <label>Teléfono:</label>
            <input type="text" name="telefono" value="<?php echo $negocio['Telefono']; ?>" required>

            <label>Facebook:</label>
            <input type="text" name="facebook" value="<?php echo $negocio['Facebook']; ?>">

            <label>Instagram:</label>
            <input type="text" name="instagram" value="<?php echo $negocio['Instagram']; ?>">
            
            <button type="submit">Guardar Cambios</button>
        </form>
        <br>
        <div style="text-align: center;">
            <a href="dashboard.php" style="text-decoration: none; color: #555;">Cancelar y Volver</a>
        </div>
    </div>
</body>
</html>