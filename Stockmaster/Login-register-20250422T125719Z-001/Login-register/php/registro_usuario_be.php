<?php 

    include 'conexion_be.php';

    $nombre_completo = trim($_POST['nombre_completo']);
    $correo = trim($_POST['correo']);
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    // Verificar si algún campo está vacío
    if (empty($nombre_completo) || empty($correo) || empty($usuario) || empty($password)) {
        echo '
            <script>
                alert("Todos los campos son obligatorios. Por favor, completa todos los campos.");
                window.location = "../index.php"; 
            </script>
        ';
        exit();
    }

    // Encriptar la contraseña
    $password = hash('sha512', $password);

    // Verificar que el correo no se repita en la base de datos 
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo'");
    if (mysqli_num_rows($verificar_usuario) > 0) {
        echo '
            <script>
                alert("Este correo ya está registrado, intenta con otro diferente.");
                window.location = "../index.php"; 
            </script>
        ';
        exit();
    }

    // Verificar que el usuario no se repita en la base de datos 
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
    if (mysqli_num_rows($verificar_usuario) > 0) {
        echo '
            <script>
                alert("Este usuario ya está registrado, intenta con otro diferente.");
                window.location = "../index.php"; 
            </script>
        ';
        exit();
    }

    // Insertar usuario en la base de datos
    $query = "INSERT INTO usuarios (nombre_completo, correo, usuario, contrasena) 
            VALUES ('$nombre_completo', '$correo', '$usuario', '$contrasena')";

    $ejecutar = mysqli_query($conexion, $query);

    if ($ejecutar) {
        echo '
            <script>
                alert("Usuario almacenado exitosamente.");
                window.location = "../index.php";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Inténtalo de nuevo, usuario no almacenado.");
                window.location = "../index.php";
            </script>
        ';
    }

    // Cerrar conexión
    mysqli_close($conexion);

?>
