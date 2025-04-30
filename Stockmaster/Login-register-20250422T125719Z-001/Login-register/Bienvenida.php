<?php
    session_start();



    if(!isset($_SESSION['usuario'])){
        echo '<script>
                alert("Por favor debes iniciar sesión");
                window.location = "index.php";
              </script>';
        session_destroy();
        die();
    }

    $usuario = $_SESSION['usuario'];

    include 'php/conexion_be.php';

    $query = "SELECT permisos FROM usuarios WHERE usuario='$usuario'";
    $resultado = mysqli_query($conexion, $query);
    $row = mysqli_fetch_assoc($resultado);

    $permisos = isset($row['permisos']) ? explode(',', $row['permisos']) : [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #001f3f;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            width: 100%;
            background-color: #004080;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-tabs {
            display: flex;
            gap: 10px;
        }

        .nav-tabs button {
            background-color: #3498db;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .nav-tabs button:hover {
            background-color: #2980b9;
        }

        .cerrar-sesion {
            text-decoration: none;
            color: white;
            background-color: red;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
        }

        .cerrar-sesion:hover {
            background-color: darkred;
        }

        h1 {
            font-size: 8vw;
            text-align: center;
            margin-top: 100px;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 10vw;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 14vw;
            }

            .nav-tabs {
                flex-direction: column;
                gap: 5px;
                align-items: flex-start;
            }

            header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .cerrar-sesion {
                align-self: flex-end;
            }
        }
    </style>
</head>
<body>

    <header>
        <div class="nav-tabs">
            <button id="btninicio" onclick="location.href='inicio.php'">Inicio</button>
            <button id="btnperfil" onclick="location.href='perfil.php'">Perfil</button>
            <button id="btnconfig" onclick="location.href='configuracion.php'">Configuración</button>
            <button id="btnayuda" onclick="location.href='ayuda.php'">Ayuda</button>
        </div>
        <a href="php/cerrar_sesion.php" class="cerrar-sesion">Cerrar Sesión</a>
    </header>

    <h1>Bienvenido</h1>


    <script>
        // Permisos del usuario pasados desde PHP a JS
        const permisos = <?= json_encode($permisos); ?>;

        // Lista de todos los IDs de botones disponibles
        const botones = ['btninicio', 'btnperfil', 'btnconfig', 'btnayuda'];

        // Recorremos todos los botones
        botones.forEach(id => {
            if (!permisos.includes(id)) {
                const btn = document.getElementById(id);
                if (btn) btn.disabled = true; // Deshabilita si no tiene permiso
            }

        });
    </script>



</body>
</html>
