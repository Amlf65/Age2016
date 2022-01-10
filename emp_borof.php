<?php
session_start();
include 'conexion.php';
//Borramos dicho registro
$sqldel = "DELETE FROM `ofertas` WHERE `cif`='" . $_SESSION['CIF'] . "' AND `codigo`='$_GET[codigo]'";
//Ejecutamos la consulta
$resultadosdel = mysqli_query($conexion, $sqldel);
include 'emp_gesofer.php';
