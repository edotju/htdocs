<?php
include 'conexion_be.php'; // Conexión a la base de datos

// Recibir datos JSON
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['permisos'])) {
    $id = $data['id'];
    $permisos = $data['permisos']; // Esto ya es un string tipo: "Inicio,Perfil"

    // Usar sentencia preparada para seguridad
    $stmt = $conexion->prepare("UPDATE usuarios SET permisos = ? WHERE id = ?");
    $stmt->bind_param("si", $permisos, $id);

    if ($stmt->execute()) {
        echo "Permisos actualizados correctamente";
    } else {
        echo "Error al actualizar permisos: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Datos inválidos recibidos";
}
?>
    
