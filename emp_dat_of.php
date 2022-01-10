<?php
include 'conexion.php';
//perpro

if (isset($_POST['carnetconducir'])) $carnetconducir = 'S'; else $carnetconducir = 'N';
if (isset($_POST['vehiculopropio'])) $vehiculopropio = 'S'; else $vehiculopropio = 'N';
//Creamos la sentencia SQL y la ejecutamos
$sql="UPDATE `ofertas` SET `titulo`='".$_POST['titulo']."',`descripcion`='$_POST[descripcion]',"
        . "`requisitos`='$_POST[requisitos]',`nivelformativo`='$_POST[nivelformativo]',"
        . "`carnetconducir`='$carnetconducir',`vehiculopropio`='$vehiculopropio',`observaciones`='$_POST[observaciones]'"
        . " WHERE `codigo`='$_GET[codigo]'";

$result= mysqli_query($conexion, $sql);


$sqltit1 = "SELECT `codigo` FROM `perfilesprofesionales` WHERE `perfilprofesional` = '" . $_POST['pf'] . "'";
$resulti1 = mysqli_query($conexion, $sqltit1);
$row1 = mysqli_fetch_array($resulti1, MYSQLI_ASSOC);
if (isset($_POST['pf']))
    $resulcod1 = mysqli_query($conexion, "INSERT INTO `oferperpro`(`id`, `codigo`) VALUES ('$_GET[codigo]', '" . $row1['codigo'] . "')");

include 'emp_actof.php';
