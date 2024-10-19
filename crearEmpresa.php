<?php
require 'conexion.php';

if (!$mysqli) {
    die("La conexion fallo: " . mysqli_connect_error());
} else {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['numero'];
    $descripcion = $_POST['descrip'];
    $email = $_POST['email'];

    $sql = "INSERT INTO empresa(nombre, telefono, descripcion, email) VALUES('$nombre', '$telefono', '$descripcion', '$email')";
    
    if (mysqli_query($mysqli, $sql)) {

        header("Location: newempresa.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
}