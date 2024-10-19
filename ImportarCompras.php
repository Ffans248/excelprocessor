<?php
require 'vendor/autoload.php';
require 'conexion.php'; // Asegúrate de que este archivo define y establece la conexión a la base de datos

use PhpOffice\PhpSpreadsheet\IOFactory;

$NregistrosC = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se ha subido el archivo de Compras
    if (isset($_POST['empresaCompras']) && !empty($_POST['empresaCompras']) && isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $empresaId = $_POST['empresaCompras']; // Capturar el ID de la empresa seleccionada
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

            insertCompras($mysqli, $empresaId, $Col1, $Col2, $Col3, $Col4, $Col5, $Col6, $Col7, $Col8, $Col9, $Col10, $Col11);
            $NregistrosC++;
        }
    }
    $mysqli->close();
    header( 'Location: archivos.php');

}else {
    echo "Hubo un problema al subir los archivos.";
}

function insertCompras($mysqli, $empresaId, $Col1, $Col2, $Col3, $Col4, $Col5, $Col6, $Col7, $Col8, $Col9, $Col10, $Col11)
{
    $sql = "INSERT INTO compras (fk_empresa, fecha_emision, tipo_DTE, serie, numero_DTE, NIT_emisor, nombre_completo_emisor, codigo_establecimiento, moneda, monto_grantotal, monto_sinIVA, monto_IVA) 
            VALUES ('$empresaId', '$Col1', '$Col2', '$Col3', '$Col4', '$Col5', '$Col6', '$Col7', '$Col8', '$Col9', '$Col10', '$Col11')";
    if ($mysqli->query($sql)) {
    } else {
        echo "Error al insertar compra: " . $mysqli->error;
    }
}
