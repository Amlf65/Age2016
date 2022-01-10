<?php
include 'conexion.php';
$sql = "SELECT * FROM `ofertas` WHERE `codigo`='12200002'";
$result = mysqli_query($conexion, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
echo $row['titulo'];

?>
