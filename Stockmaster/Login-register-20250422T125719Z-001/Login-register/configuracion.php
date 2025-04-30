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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
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
        <button onclick="location.href='Bienvenida.php'">Volver</button>
    </div>
        <a href="php/cerrar_sesion.php" class="cerrar-sesion">Cerrar Sesión</a>
    </header>

    <h1>Configuración</h1>

</body>
</html>