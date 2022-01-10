<?php
/*
$db_host="mysql.hostinger.es";
$db_usuario="u898077887_telde";
$db_contra="Telde_2017";
$db_nombre="u898077887_agen";
*/

$db_host="localhost";
$db_nombre="agencia";
$db_usuario="root";
$db_contra="";

$conexion = mysqli_connect($db_host, $db_usuario, $db_contra,$db_nombre);

if (!$conexion){
    die("Conexión erronea : ".mysqli_connect_error());
}
mysqli_set_charset($conexion, "utf8");