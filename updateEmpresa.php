<?php
// Variables recibidas desde el formulario por POST
//error_reporting(0);
$id = $_POST['clave'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$descripcion = $_POST['descripcion'];
$email = $_POST['email'];


// CONEXIÓN A LA BASE DE DATOS
$conexion = new mysqli('localhost', 'root', '', 'Excelprocessor');

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para actualizar los datos
$sql = "UPDATE empresa 
        SET nombre = ?, telefono = ?, descripcion = ?, email = ?
        WHERE id = ?";

// Preparar la declaración SQL para evitar inyección de SQL
$stmt = $conexion->prepare($sql);

// Enlazar los parámetros con las variables recibidas
$stmt->bind_param('ssssi', $nombre, $telefono, $descripcion, $email, $id);

// Ejecutar la declaración
if ($stmt->execute()) {
    echo "Registro actualizado correctamente.";
} else {
    echo "Error al actualizar el registro: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();
header("Location: empresas.php");
exit();
?>