<?php

$db_host="localhost";
$db_usuario="root";
$db_contra="";
$db_nombre="c9agencia";

$conexion = mysqli_connect($db_host, $db_usuario, $db_contra,$db_nombre);

if (!$conexion){
    die("Conexión erronea : ".mysqli_connect_error());


}
mysqli_set_charset($conexion, "utf8");
