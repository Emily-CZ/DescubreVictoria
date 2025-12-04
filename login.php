<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM UsuariosAdmin WHERE Usuario = '$usuario' AND PasswordHash = '$pass'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $_SESSION['admin'] = $usuario;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrativo</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" href="imagenes/favicon.png" type="image/x-icon">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background: linear-gradient(135deg, #134E5E 0%, #71B280 100%);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card { 
            background: white; 
            padding: 50px 40px; 
            border-radius: 20px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.2); 
            text-align: center; 
            width: 100%;
            max-width: 400px;
        }

        .login-header h2 { margin: 0; color: #2c3e50; font-size: 1.8rem; }
        .login-header p { color: #7f8c8d; margin-top: 10px; margin-bottom: 30px; font-size: 0.9rem; }

        .form-group { margin-bottom: 20px; text-align: left; position: relative; }
        
        label { display: block; margin-bottom: 8px; color: #2e7d32; font-weight: 600; font-size: 0.9rem; }

        input { 
            width: 100%; 
            padding: 15px; 
            border: 2px solid #e0e0e0; 
            border-radius: 10px; 
            box-sizing: border-box; 
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input:focus { outline: none; border-color: #71B280; }

        /* Estilo para el contenedor de la contraseña */
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper input {
            padding-right: 45px; 
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            cursor: pointer;
            color: #95a5a6;
            font-size: 1.2rem;
            user-select: none; 
        }
        .toggle-password:hover { color: #2e7d32; }

        button { 
            width: 100%; 
            padding: 15px; 
            background: linear-gradient(to right, #11998e, #38ef7d); 
            color: white; 
            border: none; 
            border-radius: 10px; 
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer; 
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 10px;
        }

        button:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(56, 239, 125, 0.4); }

        .error-msg {
            background-color: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            border: 1px solid #ffcdd2;
        }

        .back-link {
            display: block;
            margin-top: 25px;
            color: #95a5a6;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }
        .back-link:hover { color: #2e7d32; }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <div style="font-size: 3rem; margin-bottom: 10px;">🔐</div>
            <h2>Bienvenido</h2>
            <p>Ingresa tus credenciales para administrar el sitio.</p>
        </div>

        <?php if(isset($error)) echo "<div class='error-msg'>⚠️ $error</div>"; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="user" required>
            </div>
            
            <div class="form-group">
                <label>Contraseña</label>
                <div class="password-wrapper">
                    <input type="password" name="pass" id="passwordInput" required>
                    <span class="toggle-password" onclick="togglePassword()">👁️</span>
                </div>
            </div>

            <button type="submit">Iniciar Sesión</button>
        </form>

        <a href="index.php" class="back-link">← Volver a la página principal</a>
    </div>

    <script>
        function togglePassword() {
            var input = document.getElementById("passwordInput");
            var icon = document.querySelector(".toggle-password");
            
            if (input.type === "password") {
                input.type = "text";
                icon.textContent = "🙈"; 
            } else {
                input.type = "password";
                icon.textContent = "👁️"; 
            }
        }
    </script>

</body>
</html>