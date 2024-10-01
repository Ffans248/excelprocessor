<?php
require 'vendor/autoload.php';
require 'conexion.php'; // Asegúrate de que este archivo define y establece la conexión a la base de datos

use PhpOffice\PhpSpreadsheet\IOFactory;
$NregistrosC=0;
$NregistrosV=0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se ha subido el archivo de Ventas
    if (isset($_FILES['archivo2']) && $_FILES['archivo2']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo2 = $_FILES['archivo2']['name'];
        $rutaTemporal2 = $_FILES['archivo2']['tmp_name'];

        // Cargar el documento de Excel
        $documento2 = IOFactory::load($rutaTemporal2);
        $hoja2 = $documento2->getSheet(0);

        // Obtener el número de filas con datos
        $numeroFilas2 = $hoja2->getHighestDataRow();

        for ($ifilas2 = 2; $ifilas2 <= $numeroFilas2; $ifilas2++) {
            $Colm1 = $hoja2->getCell('A' . $ifilas2)->getValue();
            $Colm2 = $hoja2->getCell('B' . $ifilas2)->getValue();
            $Colm3 = $hoja2->getCell('C' . $ifilas2)->getValue();
            $Colm4 = $hoja2->getCell('D' . $ifilas2)->getValue();
            $Colm5 = $hoja2->getCell('E' . $ifilas2)->getValue();
            $Colm6 = $hoja2->getCell('F' . $ifilas2)->getValue();
            $Colm7 = $hoja2->getCell('G' . $ifilas2)->getCalculatedValue();
            $Colm8 = $hoja2->getCell('H' . $ifilas2)->getCalculatedValue();

            insertVentas($mysqli, $Colm1, $Colm2, $Colm3, $Colm4, $Colm5, $Colm6, $Colm7, $Colm8);
            $NregistrosV++;
        }
    }
    $mysqli->close();
    header( 'Location: archivos.html');

} else {
    echo "Hubo un problema al subir los archivos.";
}


function insertVentas($mysqli, $Colm1, $Colm2, $Colm3, $Colm4, $Colm5, $Colm6, $Colm7, $Colm8) {
    $sql = "INSERT INTO ventas (fecha_emision, serie, numero_DTE, id_receptor, nombre_completo_receptor, monto_grantotal, monto_sinIVA, monto_IVA) 
            VALUES ('$Colm1', '$Colm2', '$Colm3', '$Colm4', '$Colm5', '$Colm6', '$Colm7', '$Colm8')";
    if ($mysqli->query($sql)) {
        
    } else {
        echo "Error al insertar venta: " . $mysqli->error;
    }
}
