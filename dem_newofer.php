<?php
    session_start();
    include 'conexion.php';
    //Creamos un nuevo registro
    $sqlreg = "INSERT INTO `demofer`(`dni`, `codigo`) VALUES ('".$_SESSION['DNI']."','".$_POST['codigo']."')";
    $resultreg = mysqli_query($conexion, $sqlreg);
    echo 'INSCRITO';
?>