<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubre Victoria</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="imagenes/favicon.png" type="image/x-icon">
    <style>
        /* --- ESTILOS GENERALES --- */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #e8f5e9; 
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- BARRA DE NAVEGACIÓN --- */
        nav {
            background: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand { font-weight: 800; font-size: 1.2rem; color: #2e7d32; text-decoration: none; }
        .btn-login { text-decoration: none; color: #555; font-weight: 600; font-size: 0.9rem; transition: color 0.3s; }
        .btn-login:hover { color: #2e7d32; }

        /* --- HERO HEADER --- */
        .hero {
            background: linear-gradient(135deg, #134E5E 0%, #71B280 100%);
            color: white;
            text-align: center;
            padding: 60px 20px 80px 20px; 
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
            margin-bottom: 50px;
            box-shadow: 0 10px 30px rgba(19, 78, 94, 0.3);
            position: relative;
        }

        .hero h1 { font-size: 3rem; margin-bottom: 10px; text-shadow: 0 2px 4px rgba(0,0,0,0.2); }
        .hero p { font-size: 1.2rem; opacity: 0.9; font-weight: 300; }

        /* --- BUSCADOR --- */
        .buscador-container {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .buscador-input {
            padding: 15px 25px;
            width: 400px;
            max-width: 100%;
            border-radius: 50px;
            border: none;
            outline: none;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-buscar {
            padding: 15px 30px;
            border-radius: 50px;
            border: none;
            background-color: white;
            color: #134E5E;
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: transform 0.2s, background 0.3s;
        }
        .btn-buscar:hover { transform: scale(1.05); background-color: #f1f8e9; }

        /* --- SECCIÓN DE CATEGORÍAS --- */
        .categorias-wrapper {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .cat-pill {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.3s;
        }

        .cat-pill:hover {
            background: white;
            color: #2e7d32;
            transform: translateY(-2px);
        }

        /* Estilo para la categoría seleccionada */
        .cat-pill.active {
            background: white;
            color: #134E5E;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        /* --- RED DE TARJETAS --- */
        .contenedor-main {
            flex: 1; 
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            padding: 0 20px 50px 20px;
        }

        .contenedor-negocios { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px; }

        /* --- FLIP CARDS --- */
        .flip-card { background-color: transparent; width: 100%; height: 380px; perspective: 1000px; }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1); 
            border-radius: 20px;
        }

        .flip-card:hover .flip-card-inner { transform: rotateY(180deg); }

        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            border-radius: 20px;
            padding: 30px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .flip-card-front { background-color: white; color: #333; }
        
        .flip-card-back { 
            background: linear-gradient(135deg, #134E5E 0%, #71B280 100%); 
            color: white; 
            transform: rotateY(180deg); 
        }

        .logo-img { 
            width: 110px; 
            height: 110px; 
            object-fit: cover; 
            border-radius: 50%; 
            margin-bottom: 20px; 
            border: 4px solid #e8f5e9;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        /* --- ESTILOS REDES SOCIALES --- */
        .redes-sociales {
            margin-top: 20px;
            display: flex;
            gap: 15px;
        }

        .btn-social {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: white;
            font-size: 1.2rem;
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: rgba(255, 255, 255, 0.2); 
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .btn-social:hover {
            transform: translateY(-3px) scale(1.1);
            background-color: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-social.fb:hover { color: #1877F2; }
        .btn-social.ig:hover { color: #E1306C; } 

        .flip-card-front h2 { margin: 10px 0; color: #2e7d32; font-size: 1.4rem; } 
        .desc { color: #546e7a; font-size: 0.95rem; line-height: 1.5; }
        .cat-label { font-size: 0.8rem; background: #e8f5e9; color: #2e7d32; padding: 4px 10px; border-radius: 10px; margin-bottom: 10px; font-weight: 600; }
        
        .info-back { font-size: 1.1em; margin: 15px 0; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .link-blanco { color: white; text-decoration: none; font-weight: 600; border-bottom: 1px dotted white; transition: opacity 0.3s; }
        .link-blanco:hover { opacity: 0.8; }

        footer { background-color: #263238; color: #cfd8dc; text-align: center; padding: 30px; margin-top: auto; font-size: 0.9rem; }
    </style>
</head>
<body>

    <nav>
        <a href="index.php" class="brand">Descubre Victoria</a>
        <a href="login.php" class="btn-login">Soy Admin 🔐</a>
    </nav>

    <header class="hero">
        <h1>Descubre lo mejor de tu ciudad</h1>
        <p>Encuentra lugares, entretenimiento y servicios en Ciudad Victoria.</p>
        
        <div class="buscador-container">
            <form action="index.php" method="GET" style="display:flex; gap:10px; align-items:center;">
                <input type="text" class="buscador-input" name="q" placeholder="Ej. Parque, Café, Tacos...">
                <button type="submit" class="btn-buscar">Buscar</button>
            </form>
        </div>

        <div class="categorias-wrapper">
            <a href="index.php" class="cat-pill <?php echo !isset($_GET['cat']) ? 'active' : ''; ?>">Todas</a>
            
            <?php
            // Obtener las categorías de la base de datos
            $cats_sql = "SELECT * FROM Categorias";
            $cats_res = $conexion->query($cats_sql);
            
            // Categoría seleccionada actualmente
            $cat_actual = isset($_GET['cat']) ? $_GET['cat'] : null;

            while($c = $cats_res->fetch_assoc()) {
                $clase_activa = ($cat_actual == $c['Id']) ? 'active' : '';
                echo '<a href="index.php?cat='.$c['Id'].'" class="cat-pill '.$clase_activa.'">'.$c['Nombre'].'</a>';
            }
            ?>
        </div>
    </header>

    <div class="contenedor-main">
        <div class="contenedor-negocios">
            <?php
            // LÓGICA DE FILTRADO
            $sql = "SELECT * FROM Negocios WHERE 1=1"; 

            if (isset($_GET['q']) && !empty($_GET['q'])) {
                $busqueda = $conexion->real_escape_string($_GET['q']);
                $sql .= " AND (Nombre LIKE '%$busqueda%' OR Descripcion LIKE '%$busqueda%')";
            }

            if (isset($_GET['cat']) && !empty($_GET['cat'])) {
                $categoria_id = intval($_GET['cat']);
                $sql .= " AND CategoriaId = $categoria_id";
            }

            $sql .= " ORDER BY Id DESC"; 

            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                while($fila = $resultado->fetch_assoc()) {
                    $imagen = !empty($fila['foto']) ? $fila['foto'] : 'default.jpg';
            ?>
                
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="imagenes/<?php echo $imagen; ?>" alt="Logo" class="logo-img">
                            <h2><?php echo $fila['Nombre']; ?></h2>
                            <p class="desc"><?php echo $fila['Descripcion']; ?></p>
                        </div>
                        <div class="flip-card-back">
                            <div class="info-back">
                                <span>📍</span>
                                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($fila['Direccion'] . ' Ciudad Victoria'); ?>" 
                                   target="_blank" class="link-blanco">
                                    <?php echo $fila['Direccion']; ?>
                                </a>
                            </div>
                            <div class="info-back">
                                <span>📞</span>
                                <a href="tel:<?php echo $fila['Telefono']; ?>" class="link-blanco" style="text-decoration:none;">
                                    <?php echo $fila['Telefono']; ?>
                                </a>
                            </div>
                            <div class="redes-sociales">
                            <?php if(!empty($fila['Facebook'])) { ?>
                                <a href="<?php echo $fila['Facebook']; ?>" target="_blank" class="btn-social fb">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            <?php } ?>

                            <?php if(!empty($fila['Instagram'])) { ?>
                                <a href="<?php echo $fila['Instagram']; ?>" target="_blank" class="btn-social ig">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            <?php } ?>
                        </div>
                        </div>
                    </div>
                </div>

            <?php
                }
            } else {
                echo "<div style='text-align:center; width:100%; grid-column: 1 / -1; margin-top: 50px;'>
            <p style='font-size: 1.5rem; color: #546e7a;'>No encontramos lo que buscas 😢</p>
            <a href='index.php' style='display:inline-block; margin-top:15px; padding:10px 20px; background:#2e7d32; color:white; text-decoration:none; border-radius:25px; font-weight:bold;'>Ver todo de nuevo</a>
          </div>";
            }
            ?>
        </div>
    </div>

    <footer>
        <p>© 2025 Descubre Victoria.</p>
    </footer>

</body>
</html>