<?php

include 'conexion.php';
if (isset($_POST['coloca'])&&$_POST['coloca']=="S") {
    
    $sql = "UPDATE demandantes SET colocacion='S' WHERE dni='".$_POST['dni']."'";
    //Ejecutamos la consulta
    $resultado = mysqli_query($conexion, $sql);

}else {
    
    $sql = "UPDATE demandantes SET colocacion='N' WHERE dni='".$_POST['dni']."'";
    //Ejecutamos la consulta
    $resultado = mysqli_query($conexion, $sql);

}
?>