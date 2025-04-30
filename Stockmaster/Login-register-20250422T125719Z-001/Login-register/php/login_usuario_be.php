<?php 

    session_start();

 include 'conexion_be.php';
 $usuario = $_POST['usuario'];
 $password = $_POST['password'];


    // Verificar si es el administrador
    if ($usuario === "admin@gmail.com" && $password === "admin123") {
        $_SESSION['usuario'] = "admin@gmail.com";
        header("location: ../admi.php");
        exit;
    }


 $password = hash('sha512', $password);

 $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario' and password='$password'");



    if (mysqli_num_rows($validar_login) > 0){
        $_SESSION['usuario'] = $usuario;
        header("location: ../Bienvenida.php");
        exit;
    }else if
        // Verificar si algún campo está vacío
         (empty($usuario) || empty($password)) {
        echo '
            <script>
                alert("Todos los campos son obligatorios. Por favor, completa todos los campos.");
                window.location = "../index.php"; 
            </script>
        ';
        exit;
    }else  
        echo ' 
            <script>
                alert("Usuario o Contraseña equivocados, por favor verifique los datos introducidos");
                window.location = "../index.php";
            </script>
            '; 
        exit;

       

       

                                  