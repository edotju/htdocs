<?php
require_once 'connection.php';
session_start();

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = sanitize_input($_POST["usuario"]);
    $password = $_POST["password"];
    
    // Consulta actualizada para incluir el nombre del rol
    $stmt = $conn->prepare("
        SELECT u.id, u.usuario, u.password, u.nombre, r.nombre AS rol
        FROM usuarios u
        LEFT JOIN Roles r ON u.id_rol = r.id
        WHERE u.usuario = ?
    ");

    if ($stmt === false) {
        $login_err = "Error de sistema: " . $conn->error;
    } else {
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Comparación directa (sin hash)
            if ($password === $user["password"]) {
                session_regenerate_id();
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $user["id"];
                $_SESSION["usuario"] = $user["usuario"];
                $_SESSION["nombre"] = $user["nombre"];
                $_SESSION["rol"] = $user["rol"];

                // Redirige según el rol
                if ($user["rol"] === "Master_Admin" || $user["rol"] === "admin") {
                    header("location: dashboard.php");
                } else {
                    header("location: dashboard.php");
                }
                exit;
            } else {
                $login_err = "Usuario o contraseña incorrectos.";
            }
        } else {
            $login_err = "Usuario o contraseña incorrectos.";
        }

        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario - Login</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f0f2f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .register-link {
            margin-top: 15px;
            text-align: center;
            font-size: 0.9rem;
        }

        .alert {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h3>Sistema de Inventario</h3>
            <p class="text-muted">Inicio de Sesión</p>
        </div>
        
        <?php 
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger text-center">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>    
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </div>
            <div class="register-link">
                <p>¿No tienes una cuenta? <a href="registro.php">Regístrate</a></p>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
