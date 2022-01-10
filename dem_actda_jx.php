<?php
session_start();
include 'conexion.php';
//Borramos dicho registro
$sql = "UPDATE `demandantes` SET `nombre`= '" . $_POST['nombre']."',`apellido1`='" . $_POST['ap1'] . "',"
        . "`apellido2`='" . $_POST['ap2'] . "',`fechanacimiento`='" . $_POST['fecha'] . "',`sexo`='" . $_POST['sexo'] . "',"
        . "`movil`='" . $_POST['movil'] . "',`telefono`='" . $_POST['fijo'] . "',`email`='" . $_POST['email'] . "',"
        . "`direccion`='" . $_POST['direccion'] . "',`codigopostal`='" . $_POST['codigopostal'] . "',"
        . "`localidad`='" . $_POST['localidad'] . "',`vvg`='" . $_POST['vvg'] . "',`grado`='" . $_POST['disca'] . "' "
        . "WHERE `dni`= '" . $_SESSION['DNI'] . "'";
//Ejecutamos la consulta
$resultado = mysqli_query($conexion, $sql);
?>