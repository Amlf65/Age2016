<?php
include 'conexion.php';
if (isset($_GET['dni'])) {

    $sqlcv = "SELECT * FROM `demcv` WHERE `dni`='".$_GET['dni']."'";//" . $row['dni'] . "
    $result = mysqli_query($conexion, $sqlcv);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "<iframe src='data:application/pdf; base64," . base64_encode($row['cvenpdf']) . "' width='100%;' height='95%;'></iframe>";
    }
}else{
    echo "No hemos podido encontrar el currículum";
}