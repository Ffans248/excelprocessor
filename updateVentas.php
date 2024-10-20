<?php
// Recibir las variables enviadas por POST
$id = $_POST['clave'];  // Clave primaria para identificar el registro a actualizar
$fecha_emision = $_POST['femision'];
$serie = $_POST['nserie'];
$numero_DTE = $_POST['nDTE'];
$id_receptor = $_POST['idRecep'];
$nombre_completo_receptor = $_POST['nomRecep'];
$monto_grantotal = $_POST['MGTotal'];
$monto_sinIVA = $_POST['MsinIVA'];
$monto_IVA = $_POST['MIVA'];
$fk_empresa = $_POST['fk_empresa'];

// CONEXIÓN A LA BASE DE DATOS
require 'conexion.php'; // Asumiendo que este archivo gestiona la conexión

// Verificar conexión


// Consulta SQL para actualizar los datos en la tabla ventas
$sql = "UPDATE ventas 
        SET fecha_emision = ?, serie = ?, numero_DTE = ?, id_receptor = ?, 
            nombre_completo_receptor = ?, monto_grantotal = ?, monto_sinIVA = ?, monto_IVA = ?, fk_empresa = ?
        WHERE id = ?";

// Preparar la declaración SQL para evitar inyección de SQL
$stmt = $mysqli->prepare($sql);

// Enlazar los parámetros con las variables recibidas
$stmt->bind_param('sssissdiii', $fecha_emision, $serie, $numero_DTE, $id_receptor, 
                  $nombre_completo_receptor, $monto_grantotal, $monto_sinIVA, 
                  $monto_IVA, $fk_empresa, $id);

// Ejecutar la declaración
if ($stmt->execute()) {
    echo "Registro actualizado correctamente.";
} else {
    echo "Error al actualizar el registro: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$mysqli->close();

header("Location: index.php");
exit();
?>
