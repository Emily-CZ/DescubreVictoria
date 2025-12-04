<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" href="imagenes/favicon.png" type="image/x-icon">

    <style>
        /* --- ESTILOS GENERALES --- */
        * { box-sizing: border-box; }
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f4f6f9; 
            margin: 0; 
            color: #333;
        }

        /* --- BARRA SUPERIOR --- */
        nav {
            background-color: #1b5e20; 
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .nav-title { font-size: 1.2rem; font-weight: 600; display: flex; align-items: center; gap: 10px;}
        .user-info { font-size: 0.9rem; margin-right: 20px; color: #bdc3c7; }
        
        .btn-logout {
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.85rem;
            transition: background 0.3s;
        }
        .btn-logout:hover { background-color: #c0392b; }
        
        .btn-home {
            background-color: #4caf50;
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.85rem;
            margin-left: 10px;
        }
        .btn-home:hover { background-color: #43a047; }

        /* --- CONTENIDO PRINCIPAL --- */
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 { margin: 0; color: #2c3e50; }

        .btn-add {
            background-color: #0288d1;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-add:hover { transform: translateY(-2px); background-color: #0277bd; }

        /* --- TABLA MODERNA --- */
        .card-table {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #ecf0f1;
            color: #7f8c8d;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        th, td { padding: 15px 20px; text-align: left; }
        
        /* Líneas divisorias */
        tr { border-bottom: 1px solid #f1f1f1; }
        tr:last-child { border-bottom: none; }
        tr:hover { background-color: #fafafa; }

        /* Estilos de las celdas */
        .id-col { color: #95a5a6; font-weight: bold; width: 50px; }
        .name-col { font-weight: 600; color: #2c3e50; }
        
        /* Miniatura de la imagen */
        .thumb-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
            vertical-align: middle;
            margin-right: 10px;
        }

        /* Botón de borrar */
        .btn-del {
            color: #e74c3c;
            background: rgba(231, 76, 60, 0.1);
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: background 0.3s;

            display: inline-flex; 
            align-items: center;  
            gap: 5px;             

        /* Botón de editar */
        .btn-edit {
            color: #f39c12;
            background: rgba(243, 156, 18, 0.1);
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: background 0.3s;
            margin-right: 5px; 

        }
        .btn-del:hover { background: rgba(231, 76, 60, 0.2); }

    </style>
</head>
<body>

    <nav>
        <div class="nav-title">⚙️ Panel de Control</div>
        <div>
            <span class="user-info">Hola, <strong><?php echo $_SESSION['admin']; ?></strong></span>
            <a href="index.php" class="btn-home" target="_blank">Ver Página Web</a>
            <a href="login.php" class="btn-logout">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container">
        
        <div class="header-actions">
            <h1>Mis Negocios</h1>
            <a href="nuevo_negocio.php" class="btn-add">➕ Nuevo Negocio</a>
        </div>

        <div class="card-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Negocio</th>
                        <th>Dirección</th>
                        <th style="text-align: right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM Negocios ORDER BY Id DESC";
                    $resultado = $conexion->query($sql);

                    if ($resultado->num_rows > 0) {
                        while($fila = $resultado->fetch_assoc()) {
                            $imagen = !empty($fila['foto']) ? $fila['foto'] : 'default.jpg';
                    ?>
                        <tr>
                            <td class="id-col">#<?php echo $fila['Id']; ?></td>
                            <td class="name-col">
                                <img src="imagenes/<?php echo $imagen; ?>" class="thumb-img">
                                <?php echo $fila['Nombre']; ?>
                            </td>
                            <td style="color: #666; font-size: 0.9rem;"><?php echo $fila['Direccion']; ?></td>
                            <td style="text-align: right;">

                            <a href="editar_negocio.php?id=<?php echo $fila['Id']; ?>" class="btn-edit">
                                   ✏️ Editar
                                </a>

                                <a href="eliminar.php?id=<?php echo $fila['Id']; ?>" 
                                   class="btn-del" 
                                   onclick="return confirm('¿Estás seguro de eliminar <?php echo $fila['Nombre']; ?>? No se puede deshacer.')">
                                   🗑️ Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='4' style='text-align:center; padding: 30px;'> No hay negocios registrados aún. </td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>