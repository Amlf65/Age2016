<?php

include 'conexion.php';
$fechaactual = getdate();
if (isset($_POST['fecha'])) {//Actualización de la fecha de ultima actualización en la interfaz principal
    $sql = "UPDATE `demandantes` SET `fechaactualizacion`='" . $fechaactual['year'] . "-" . $fechaactual['mon'] . "-" . $fechaactual['mday'] . "'"
            . " WHERE `dni`= '" . $_POST['dni']. "'";
    //Ejecutamos la consulta
    $resultado = mysqli_query($conexion, $sql);
    echo $fechaactual['year'] . "-" . $fechaactual['mon'] . "-" . $fechaactual['mday'];
}
?>