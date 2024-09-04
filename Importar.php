<form action="#" method="POST" enctype="multipart/form-data">
    <input type="file" name="archivo" required>
    <input type="submit" value="Subir Archivo">
</form>

<?php 
require 'vendor/autoload.php';
require 'conexion.php'; // Asegúrate de que este archivo define y establece la conexión a la base de datos
use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se ha subido un archivo
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['archivo']['name'];  // Nombre del archivo
        $rutaTemporal = $_FILES['archivo']['tmp_name']; // Ruta temporal del archivo en el servidor

        // Cargar el documento de Excel
        $documento = IOFactory::load($rutaTemporal);
        $hoja = $documento->getSheet(0); // Obtiene la primera hoja del documento

        // Obtener el número de filas y columnas con datos
        $numerofilas = $hoja->getHighestDataRow();
        $numerocomumnas = $hoja->getHighestDataColumn();

        // Procesar los datos
        for($irows = 0; $irows <= $numerofilas;$irows++){

        }
        for ($ifilas = 2; $ifilas <= $numerofilas; $ifilas++) {
            // Obtener el valor de la celda en la columna 1 (A) de la fila actual
            $celda = $hoja->getCell('A' . $ifilas);
            $dato = $celda->getValue();

            // Asegúrate de que tu variable de conexión está definida y abierta
            $mysqli = new mysqli('localhost', 'root', '', 'Excelprocessor');

            if ($mysqli->connect_error) {
                die("Conexión fallida: " . $mysqli->connect_error);
            }

            // Escapar el valor para evitar inyecciones SQL
            $dato = $mysqli->real_escape_string($Origen);

            // Insertar datos en la base de datos
            $sql = "INSERT INTO compras (fecha_emision) VALUES ('$dato')";
            if ($mysqli->query($sql) === TRUE) {
                echo "Nuevo registro creado exitosamente\n";
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }

        $mysqli->close(); // Cerrar la conexión a la base de datos

    } else {
        echo "Hubo un problema al subir el archivo.";
    }
}
?>

