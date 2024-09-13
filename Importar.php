<?php
require 'vendor/autoload.php';
require 'conexion.php'; // Asegúrate de que este archivo define y establece la conexión a la base de datos

use PhpOffice\PhpSpreadsheet\IOFactory;
$NregistrosC=0;
$NregistrosV=0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se ha subido el archivo de Compras
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['archivo']['name'];  // Nombre del archivo
        $rutaTemporal = $_FILES['archivo']['tmp_name']; // Ruta temporal del archivo en el servidor

        // Cargar el documento de Excel
        $documento = IOFactory::load($rutaTemporal);
        $hoja = $documento->getSheet(0); // Obtiene la primera hoja del documento

        // Obtener el número de filas con datos
        $numeroFilas = $hoja->getHighestDataRow();

        // Procesar las filas para la columna actual
        for ($ifilas = 2; $ifilas <= $numeroFilas; $ifilas++) {
            $Col1 = $hoja->getCell('A' . $ifilas)->getValue();
            $Col2 = $hoja->getCell('B' . $ifilas)->getValue();
            $Col3 = $hoja->getCell('C' . $ifilas)->getValue();
            $Col4 = $hoja->getCell('D' . $ifilas)->getValue();
            $Col5 = $hoja->getCell('E' . $ifilas)->getValue();
            $Col6 = $hoja->getCell('F' . $ifilas)->getValue();
            $Col7 = $hoja->getCell('G' . $ifilas)->getValue();
            $Col8 = $hoja->getCell('H' . $ifilas)->getValue();
            $Col9 = $hoja->getCell('I' . $ifilas)->getValue();
            $Col10 = $hoja->getCell('J' . $ifilas)->getCalculatedValue();
            $Col11 = $hoja->getCell('K' . $ifilas)->getCalculatedValue();

            insertCompras($mysqli, $Col1, $Col2, $Col3, $Col4, $Col5, $Col6, $Col7, $Col8, $Col9, $Col10, $Col11);
            $NregistrosC++;
        }
    }

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
    header('Location: reporte.php');

} else {
    echo "Hubo un problema al subir los archivos.";
}

function insertCompras($mysqli, $Col1, $Col2, $Col3, $Col4, $Col5, $Col6, $Col7, $Col8, $Col9, $Col10, $Col11) {
    $sql = "INSERT INTO compras (fecha_emision, tipo_DTE, serie, numero_DTE, NIT_emisor, nombre_completo_emisor, codigo_establecimiento, moneda, monto_grantotal, monto_sinIVA, monto_IVA) 
            VALUES ('$Col1', '$Col2', '$Col3', '$Col4', '$Col5', '$Col6', '$Col7', '$Col8', '$Col9', '$Col10', '$Col11')";
    if ($mysqli->query($sql)) {
        
    } else {
        echo "Error al insertar compra: " . $mysqli->error;
    }
}

function insertVentas($mysqli, $Colm1, $Colm2, $Colm3, $Colm4, $Colm5, $Colm6, $Colm7, $Colm8) {
    $sql = "INSERT INTO ventas (fecha_emision, serie, numero_DTE, id_receptor, nombre_completo_receptor, monto_grantotal, monto_sinIVA, monto_IVA) 
            VALUES ('$Colm1', '$Colm2', '$Colm3', '$Colm4', '$Colm5', '$Colm6', '$Colm7', '$Colm8')";
    if ($mysqli->query($sql)) {
        
    } else {
        echo "Error al insertar venta: " . $mysqli->error;
    }
}
