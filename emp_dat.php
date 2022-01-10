<?php
include 'conexion.php';
session_start();

if (isset($_POST['nombre'])) {
//Creamos la sentencia SQL y la ejecutamos
$sql="UPDATE `empresa` SET `nombre`='$_POST[nombre]',`personacontacto`='$_POST[personacontacto]',"
        . "`localidad`='$_POST[localidad]',`direccion`='$_POST[direccion]',`codigopostal`='$_POST[codigopostal]',"
        . "`tipoempresa`='$_POST[tipoempresa]',`sectorprofesional`='$_POST[sectorprofesional]',`telefono`='$_POST[telefono]',"
        . "`movil`='$_POST[movil]',`email`='$_POST[email]',`gerente`='$_POST[gerente]' Where `cif`='$_SESSION[CIF]'";
$result= mysqli_query($conexion, $sql);

include 'emp_actda.php';
}

if (isset($_POST['contrasena'])) {//Actualización de contraseña
    $sql2 = "SELECT `contrasena` FROM `empresa` WHERE `cif`='".$_SESSION['CIF']."'";
    //Ejecutamos la consulta
    $resultado = mysqli_query($conexion, $sql2);
    $row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
    if ($row['contrasena']==$_POST['contrasena']) {//Si la contraeña de la base de datos es igual a 
        $sql3 = "UPDATE `empresa` SET `contrasena`='" . $_POST['nueva'] . "'"
                . " WHERE `cif`= '" . $_SESSION['CIF'] . "'";
        //Ejecutamos la consulta
        $resultado = mysqli_query($conexion, $sql3);
        echo 'Contraseña actualizada';   
    }
    
      include 'emp_actda.php';
}
