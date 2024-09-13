<?php

if (isset($_GET['file'])) {
    $file = urldecode($_GET['file']);
    
    if (file_exists($file)) {
        // Enviar el archivo al navegador
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . basename($file) . '"');
        header('Cache-Control: max-age=0');
        readfile($file);

        // Eliminar el archivo después de la descarga
        unlink($file);
    }
}

// Redirigir a archivos.php
header('Location: archivos.html');
exit;

?>
