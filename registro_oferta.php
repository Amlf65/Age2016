<?php
session_start();
include 'conexion.php';


if (isset($_POST['carnetconducir'])) $carnet='S'; else $carnet='N';

if (isset($_POST['vehiculopropio'])) $vehiculo='S'; else $vehiculo='N';

if (isset($_POST['visible'])) $visibilidad='S'; else $visibilidad='N';

$nivel=$_POST['nivelformativo'];

$sql= "INSERT INTO `ofertas`(`titulo`, `descripcion`, `visible`, "
        . "`nivelformativo`, `requisitos`, `perfilprofesional`, `carnetconducir`, "
        . "`vehiculopropio`, `observaciones`, `publicar`, `cerrada`, `cif`, `fecha`) VALUES ('".$_POST['titulo']."','".$_POST['descripcion']."',"
        . "'".$visibilidad."','".$nivel."','".$_POST['requisitos']."','".$_POST['pf']."','".$carnet."',"
        . "'".$vehiculo."','".$_POST['observaciones']."','".$publicar='N'."','".$cerrada='N'."','".$_SESSION['CIF']."',CURDATE())";

    if(mysqli_query($conexion,$sql)){
        include 'emp_gesofer.php';
    } else {
        echo "Introduzca sus datos de manera correcta</br>";
        echo $sql;
    }


