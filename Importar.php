<form action="#" method="POST" enctype="multipart/form-data">
    <input type="file" name="archivo" required>
    <input type="submit" value="Subir Archivo">
</form>
<?php
require 'vendor/autoload.php';
require 'conexion.php'; // Asegúrate de que este archivo define y establece la conexión a la base de datos
require 'conexion.php'; // Asegúrate de que este archivo define y establece la conexión a la base de datos
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se ha subido un archivo
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['archivo']['name'];  // Nombre del archivo
        $rutaTemporal = $_FILES['archivo']['tmp_name']; // Ruta temporal del archivo en el servidor

        // Cargar el documento de Excel
        $documento = IOFactory::load($rutaTemporal);
        $hoja = $documento->getSheet(0); // Obtiene la primera hoja del documento

        // Obtener el número de filas con datos
        $numerofilas = $hoja->getHighestDataRow();
        $letra = $hoja->getHighestColumn();


        // Inicializar campoident fuera del ciclo
        $campoident = 1;

        // Ciclo while que controla la columna a procesar
        
            // Procesar las filas para la columna actual
            for ($ifilas = 2; $ifilas <= $numerofilas; $ifilas++) {
                // Definir el nombre del campo y la letra de la columna en base a $campoident
                $cabecera = '';
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


                // Llamar a la función insertFe con la columna y el campo correspondiente
                insertFe(
                    $ifilas,
                    $Col1,
                    $Col2,
                    $Col3,
                    $Col4,
                    $Col5,
                    $Col6,
                    $Col7,
                    $Col8,
                    $Col9,
                    $Col10,
                    $Col11
                );
            }

            // Incrementar campoident para la siguiente columna y reiniciar el ciclo for
            
        }

        $mysqli->close(); // Cerrar la conexión a la base de datos

    } else {
        echo "Hubo un problema al subir el archivo.";
    }


function insertFe(


    $ifilas,
    $Col1,
    $Col2,
    $Col3,
    $Col4,
    $Col5,
    $Col6,
    $Col7,
    $Col8,
    $Col9,
    $Col10,
    $Col11
) {
    global $hoja;

    // Obtener el valor de la celda en la columna especificada



    // Asegúrate de que tu variable de conexión está definida y abierta
    $mysqli = new mysqli('localhost', 'root', '', 'Excelprocessor');

    if ($mysqli->connect_error) {
        die("Conexión fallida: " . $mysqli->connect_error);
    }

    // Escapar el valor para evitar inyecciones SQL

    $Col1 = $mysqli->real_escape_string($Col1);
    $Col2 = $mysqli->real_escape_string($Col2);
    $Col3 = $mysqli->real_escape_string($Col3);
    $Col4 = $mysqli->real_escape_string($Col4);
    $Col5 = $mysqli->real_escape_string($Col5);
    $Col6 = $mysqli->real_escape_string($Col6);
    $Col7 = $mysqli->real_escape_string($Col7);
    $Col8 = $mysqli->real_escape_string($Col8);
    $Col9 = $mysqli->real_escape_string($Col9);
    $Col10 = $mysqli->real_escape_string($Col10);
    $Col11 = $mysqli->real_escape_string($Col11);
    // Insertar datos en la base de datos
    $sql = "INSERT INTO compras (fecha_emision, tipo_DTE, serie, numero_DTE, NIT_emisor, nombre_completo_emisor, codigo_establecimiento, moneda, monto_grantotal, monto_sinIVA, monto_IVA) VALUES ('$Col1', '$Col2', '$Col3', '$Col4', '$Col5','$Col6', '$Col7', '$Col8', '$Col9', '$Col10', '$Col11')";
    if ($mysqli->query($sql) === TRUE) {
        echo "Nuevo registro creado exitosamente<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close(); // Cerrar la conexión para cada inserción
}
