<?php 

$id =$_GET['id'];

//CONEXION
include("conexion.php");
 
if(!$mysqli){
    die("La conexión fallo: " . mysqli_connect_error());
}else{
    
    $sql = "DELETE FROM compras WHERE id= $id";

    if(mysqli_query($mysqli, $sql)){
        
        header("Location: index.php");
    }else{
        echo "Error: " . mysqli_error($mysqli);
    }
    
}?>