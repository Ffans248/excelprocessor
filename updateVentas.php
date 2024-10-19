<?php
// Recibir las variables enviadas por POST
$id = $_POST['clave'];  // Clave primaria para identificar el registro a actualizar
$fecha_emision = $_POST['femision'];
$serie = $_POST['nserie'];
$numero_DTE = $_POST['nDTE'];
$id_receptor = $_POST['idRecep'];
$nombre_completo_receptor = $_POST['nomRecep'];
$monto_grantotal = $_POST['MGtotal'];
$monto_sinIVA = $_POST['MsinIVA'];
$monto_IVA = $_POST['MIVA'];
$fk_empresa = $_POST['fk_empresa'];

// CONEXIÓN A LA BASE DE DATOS
$conexion = new mysqli('localhost', 'usuario', 'contraseña', 'nombre_base_datos');

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para actualizar los datos en la tabla ventas
$sql = "UPDATE ventas 
        SET fecha_emision = ?, serie = ?, numero_DTE = ?, id_receptor = ?, 
            nombre_completo_receptor = ?, monto_grantotal = ?, monto_sinIVA = ?, monto_IVA = ?, fk_empresa = ?
        WHERE id = ?";

// Preparar la declaración SQL para evitar inyección de SQL
$stmt = $conexion->prepare($sql);

// Enlazar los parámetros con las variables recibidas
$stmt->bind_param('sssisssddii', $fecha_emision, $serie, $numero_DTE, $id_receptor, 
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
$conexion->close();
?>
