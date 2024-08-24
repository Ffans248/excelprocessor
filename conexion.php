<?php

$mysqli = new mysqli('localhost', 'root', '', 'Excelprocessor');

if($mysqli->connect_errno){
    echo 'Falló la conexión ' . $mysqli->connect_error;
    die();
}

