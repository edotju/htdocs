<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        echo '<script>
                alert("Por favor debes iniciar sesión");
                window.location = "index.php";
              </script>';
        session_destroy();
        die();
    }

    // Conexión a la base de datos
    include 'php/conexion_be.php'; // Asegúrate de que esta ruta esté bien

    $query = "SELECT id, nombre_completo, correo, usuario, permisos FROM usuarios";
    $resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
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
            font-size: 4vw;
            text-align: center;
            margin: 30px 0;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #0074D9;
        }

        td {
            background-color: #003366;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 6vw;
            }

            table {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 8vw;
            }
        }

        .dropdown {
        position: relative;
        display: inline-block;
    }

        .dropbtn {
            background-color: #0074D9;
            color: white;
            padding: 6px 12px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #003366;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            padding: 10px;
            z-index: 1;
            border-radius: 4px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content label {
            color: white;
            font-size: 13px;
    }

    </style>
</head>
<body>

    <header>
        <h2>Panel de Administración</h2>
        <a href="php/cerrar_sesion.php" class="cerrar-sesion">Cerrar Sesión</a>
    </header>

    <h1>Usuarios Registrados</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Usuario</th>
            <th>Permisos</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nombre_completo'] ?></td>
                <td><?= $row['correo'] ?></td>
                <td><?= $row['usuario'] ?></td>
                <td>
                    <div class="dropdown">
                        <button class="dropbtn">Editar Permisos</button>
                        <div class="dropdown-content">
                            <?php 
                                $botones = ['Inicio', 'Perfil', 'Config', 'Ayuda'];
                                $permisos_actuales = explode(',', $row['permisos']); 
                                foreach ($botones as $boton): 
                            ?>
                                <label>
                                    <input type="checkbox" 
                                        data-user-id="<?= $row['id'] ?>" 
                                        value="<?= $boton ?>" 
                                        <?= in_array($boton, $permisos_actuales) ? 'checked' : '' ?>>
                                    <?= $boton ?>
                                </label><br>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </td>

            </tr>
        <?php endwhile; ?>
    </table>

    <script>
    document.querySelectorAll('.dropdown-content input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const userId = checkbox.dataset.userId;
            const permisosSeleccionados = Array.from(
                document.querySelectorAll(`input[data-user-id="${userId}"]:checked`)
            ).map(cb => cb.value);

            // Enviar los permisos al servidor con fetch
            fetch('php/actualizar_permisos.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: userId,
                    permisos: permisosSeleccionados.join(',')
                })
            })
            .then(res => res.text())
            .then(data => {
                console.log('Permisos actualizados:', data);
            });
        });
    });
</script>


</body>
</html>
