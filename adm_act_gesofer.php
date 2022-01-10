<?php

include 'conexion.php';

if (isset($_POST['publi'])&&$_POST['publi']=="S") {
    $sql = "UPDATE ofertas SET publicar='S' WHERE codigo='".$_POST['codigo']."'";
    //Ejecutamos la consulta
    $resultado = mysqli_query($conexion, $sql);
   

}else {
    $sql = "UPDATE ofertas SET publicar='N' WHERE codigo='".$_POST['codigo']."'";
    //Ejecutamos la consulta
    $resultado = mysqli_query($conexion, $sql);

}
if (isset($_POST['cerr'])&&$_POST['cerr']=="S") {
    $sql = "UPDATE ofertas SET cerrada='S' WHERE codigo='".$_POST['codigo']."'";
    //Ejecutamos la consulta
    $resultado = mysqli_query($conexion, $sql);
    

}else {
    $sql = "UPDATE ofertas SET cerrada='N' WHERE codigo='".$_POST['codigo']."'";
    //Ejecutamos la consulta
    $resultado = mysqli_query($conexion, $sql);
  

}
?>