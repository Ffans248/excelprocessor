<?php
// Variables recibidas desde el formulario por POST
error_reporting(0);
$id = $_POST['clave'];  // Esta es la clave de la tabla compras
$fecha_emision = $_POST['femision'];
$t_DTE = $_POST['t_DTE'];
$serie = $_POST['nserie'];
$numero_DTE = $_POST['nDTE'];
$NIT_emisor = $_POST['NITemisor'];
$nombre_completo_emisor = $_POST['NCemisor'];
$codigo_establecimiento = $_POST['Cestablecimiento'];
$moneda = $_POST['monedda'];
$monto_grantotal = $_POST['MGTotal'];
$monto_sinIVA = $_POST['MsinIVA'];
$monto_IVA = $_POST['MIVA'];
$fk_empresa = $_POST['fk_empresa'];

// CONEXIÓN A LA BASE DE DATOS
$conexion = new mysqli('localhost', 'root', '', 'Excelprocessor');

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para actualizar los datos
$sql = "UPDATE compras 
        SET fecha_emision = ?, tipo_DTE = ?, serie = ?, numero_DTE = ?, 
            NIT_emisor = ?, nombre_completo_emisor = ?, codigo_establecimiento = ?, 
            moneda = ?, monto_grantotal = ?, monto_sinIVA = ?, monto_IVA = ?, fk_empresa = ?
        WHERE id = ?";

// Preparar la declaración SQL para evitar inyección de SQL
$stmt = $conexion->prepare($sql);

// Enlazar los parámetros con las variables recibidas
$stmt->bind_param('ssssisssddiii', $fecha_emision, $t_DTE, $serie, $numero_DTE, 
                  $NIT_emisor, $nombre_completo_emisor, $codigo_establecimiento, 
                  $moneda, $monto_grantotal, $monto_sinIVA, $monto_IVA, $fk_empresa, $id);

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
