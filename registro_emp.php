<link rel="stylesheet" type="text/css" href="css/general.css"/>
<link rel="stylesheet" type="text/css" href="css/iconic.css"/>
<link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
<link type='text/css' href='css/demo.css' rel='stylesheet' media='screen'/>
<link type='text/css' href='css/basic.css' rel='stylesheet' media='screen'/>
<?php
 include 'conexion.php';
$sql= "INSERT INTO `empresa`(`cif`, `contrasena`, `nombre`, `personacontacto`, `localidad`, `direccion`, `codigopostal`, `tipoempresa`, "
        . "`sectorprofesional`, `telefono`, `movil`, `email`)".
 "VALUES('".$_POST['cif']."','".$_POST['contrasena']."','".$_POST['nombre']."','"
         .$_POST['personacontacto']."','".$_POST['localidad']."','".$_POST['direccion']."','"
         .$_POST['codigopostal']."','".$_POST['tipoempresa']."','"
         .$_POST['sectorprofesional']."','".$_POST['telefono']."','".$_POST['movil']."','".$_POST['email']."')";
$resultados=mysqli_query($conexion,$sql);
$sql2 = "SELECT * FROM `empresa` WHERE cif='".$_POST['cif']."'";
$result = mysqli_query($conexion, $sql2);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if($resultados){
    include ('header.php');
    echo' <div id="contenedoracc">Se ha registrado correctamente. <a href="emp_acc.php">Iniciar sesión</a></div>';
    include ('footer.php');
    } elseif($row != NULL ){
    include ('header.php');
    echo ' <div id="contenedoracc">El usuario registrado ya existe. <a href="form_emp.php">Volver al formulario</a></div>';
    include ('footer.php');
}else{
    include ('header.php');
    echo' <div id="contenedoracc">No se ha podido registrar correctamente. Por favor, inténtelo de nuevo o póngase en contacto con la agencia de colocación de Telde. <a href="form_emp.php">Volver al formulario</a></div>';
    include ('footer.php'); 
}