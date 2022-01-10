<?php
session_start();
include 'conexion.php';
$fechaactual = getdate();
if (isset($_POST['nombre'])) {//Actualización de los datos
    $sql = "UPDATE `demandantes` SET `nombre`= '" . $_POST['nombre'] . "',`apellido1`='" . $_POST['ap1'] . "', `apellido2`='" . $_POST['ap2'] . "',`fechanacimiento`='" . $_POST['fecha'] . "',`sexo`='" . $_POST['sexo'] . "', `movil`='" . $_POST['movil'] . "',`telefono`='" . $_POST['fijo'] . "',`email`='" . $_POST['email'] . "', `direccion`='" . $_POST['direccion'] . "',`codigopostal`='" . $_POST['codigopostal'] . "',"
            . "`localidad`='" . $_POST['localidad'] . "',`grado`='" . $_POST['disca'] . "',  `fechaactualizacion`='" . $fechaactual['year'] . "-" . $fechaactual['mon'] . "-" . $fechaactual['mday'] . "', `demandante`='".$_POST['demandante']."', `mejora`='".$_POST['mejora']."', `perceptor`='".$_POST['perceptor']."', `discapacidad`='".$_POST['discapacidad']."', `consejalia`='".$_POST['consejalia']."', `uts`='".$_POST['uts']."', `inmigrante`='".$_POST['inmigrante']."' WHERE `dni`= '" . $_SESSION['DNI'] . "'";
    //Ejecutamos la consulta
    $resultado = mysqli_query($conexion, $sql);
    echo 'Actualizado';
} else if (isset($_POST['nivelformativo'])) {//Actualización del CV
    //TABLA DEMANDANTES
    $sqldem = "UPDATE `demandantes` SET `nivelformativo`='" . $_POST['nivelformativo'] . "', `carnetconducir`= '" . $_POST['carnetconducir'] . "',`vehiculopropio`='" . $_POST['vehiculopropio'] . "', "
            . "`fechaactualizacion`='" . $fechaactual['year'] . "-" . $fechaactual['mon'] . "-" . $fechaactual['mday'] . "', `observaciones`='" . $_POST['observaciones'] . " 'WHERE `dni`= '" . $_SESSION['DNI'] . "'";
    $resultado = mysqli_query($conexion, $sqldem);
    //TITULACIONES
    $sqlFormacion = "DELETE FROM `demfor` WHERE `dni`='" . $_SESSION['DNI'] . "'";//Consulto los certificados registrados según el DNI demandante
    $resultFormacion = mysqli_query($conexion, $sqlFormacion);
    for($x=1;$x<4;$x++){
        if($_POST['titulacion'.$x]!=NULL && $_POST['titulacion'.$x]!=' '){
            $sqlformacion = "SELECT `codigo` FROM `formacion` WHERE `titulo`='".$_POST['titulacion'.$x]."'";//Consulto el codigo de la titulacion recogida
            $resultformacion = mysqli_query($conexion, $sqlformacion);//Resultado la consulta anterior (debe ser 1)
            if (mysqli_num_rows($resultformacion) != 0) {//Si la consulta tiene resultado...
                $rowformacion = mysqli_fetch_array($resultformacion, MYSQLI_ASSOC);//Código de la titulacion recogida
                $sqlforma = "INSERT INTO `demfor`(`codigo`, `dni`) VALUES ('".$rowformacion['codigo']."','" . $_SESSION['DNI'] . "')";//Consulto los certificados registrados según el DNI demandante
                $resultforma = mysqli_query($conexion, $sqlforma);
            }
        }
    }
    //CERTIFICADOS PROFESIONALES
    $sqlCertificado = "DELETE FROM `demcerpro` WHERE `dni`='" . $_SESSION['DNI'] . "'";//Consulto los certificados registrados según el DNI demandante
    $resultCertificado = mysqli_query($conexion, $sqlCertificado);
    for($x=1;$x<4;$x++){
        if($_POST['certificado'.$x]!=NULL && $_POST['certificado'.$x]!=' '){
            $sqlcerti = "SELECT `codigo` FROM `cerpro` WHERE `certificado`='".$_POST['certificado'.$x]."'";//Consulto el codigo de la titulacion recogida
            $resultcerti = mysqli_query($conexion, $sqlcerti);//Resultado la consulta anterior (debe ser 1)
            if (mysqli_num_rows($resultcerti) != 0) {//Si la consulta tiene resultado...
                $rowcerti = mysqli_fetch_array($resultcerti, MYSQLI_ASSOC);//Código de la titulacion recogida
                $sqlcertificado = "INSERT INTO `demcerpro`(`codigo`, `dni`) VALUES ('".$rowcerti['codigo']."','" . $_SESSION['DNI'] . "')";//Consulto los certificados registrados según el DNI demandante
                $resultcertificado = mysqli_query($conexion, $sqlcertificado);
            }
        }
    }
    //OTROS CURSOS
    $sqlotros = "SELECT * FROM `otroscursos` WHERE `dni`='".$_SESSION['DNI']."'";
    $resultotros = mysqli_query($conexion, $sqlotros);
    if (($rowdemcer = mysqli_fetch_array($resultotros, MYSQLI_ASSOC))==0) {
        $sqlnewotros = "INSERT INTO `otroscursos`(`dni`, `cursos`) VALUES ('".$_SESSION['DNI']."','" .$_POST['cursos'] . "')";
        $resultnewotros = mysqli_query($conexion, $sqlnewotros);
    }else{
        $sqlupotros = "UPDATE `otroscursos` SET `cursos`='" .$_POST['cursos'] . "' WHERE `dni`= '" . $_SESSION['DNI'] . "'";
        $resultotros = mysqli_query($conexion, $sqlupotros);
    }    
    $x=1;//EXPERIENCIA
    $sqldemexp = "SELECT `exper` FROM `demexp` WHERE `dni`='".$_SESSION['DNI']."'";
    $resultdemexp = mysqli_query($conexion, $sqldemexp);
    if (mysqli_num_rows($resultdemexp) == 0) {
        do{
            if ($_POST['experiencia'.$x]!=NULL && $_POST['experiencia'.$x]!=' ') {
                $sqlnewdemexp = "INSERT INTO `demexp`(`dni`, `exper`) VALUES ('".$_SESSION['DNI']."','" .$_POST['experiencia'.$x] . "')";
                $resultadonewdemexp = mysqli_query($conexion, $sqlnewdemexp);
            }     
            $x++;           
        }while($x<4);
    }else{
        $sqldeldemexp = "DELETE FROM `demexp` WHERE `dni`='".$_SESSION['DNI']."'";
        $resultdeldemexp = mysqli_query($conexion, $sqldeldemexp);
        while($x < 4){
            if ($_POST['experiencia'.$x]!=NULL && $_POST['experiencia'.$x]!=' ') {
                $sqlnewdemexp = "INSERT INTO `demexp`(`dni`, `exper`) VALUES ('".$_SESSION['DNI']."','" .$_POST['experiencia'.$x] . "')";
                $resultadonewdemexp = mysqli_query($conexion, $sqlnewdemexp);                
            }
            $x++;
        }
    }//PERFILES PROFESIONALES
    $sqlPerfilProfesional = "DELETE FROM `demperpro` WHERE `dni`='" . $_SESSION['DNI'] . "'";//Consulto los certificados registrados según el DNI demandante
    $resultPerfilProfesional= mysqli_query($conexion, $sqlPerfilProfesional);
    for($x=1;$x<4;$x++){
        if($_POST['perfilprofesional'.$x]!=NULL && $_POST['perfilprofesional'.$x]!=' '){
            $sqlperfilprofesional = "SELECT `codigo` FROM `perfilesprofesionales` WHERE `perfilprofesional`='".$_POST['perfilprofesional'.$x]."'";//Consulto el codigo de la titulacion recogida
            $resultperfilprofesional = mysqli_query($conexion, $sqlperfilprofesional);//Resultado la consulta anterior (debe ser 1)
            if (mysqli_num_rows($resultperfilprofesional) != 0) {//Si la consulta tiene resultado...
                $rowperfilprofesional = mysqli_fetch_array($resultperfilprofesional, MYSQLI_ASSOC);//Código de la titulacion recogida
                $sqlperpro = "INSERT INTO `demperpro`(`codigo`, `dni`) VALUES ('".$rowperfilprofesional['codigo']."','" . $_SESSION['DNI'] . "')";//Consulto los certificados registrados según el DNI demandante
                $resultperpro = mysqli_query($conexion, $sqlperpro);
            }
        }
    }
    echo 'Actualizado';
}else if (isset($_POST['actualizar'])) {//Actualización de la fecha de ultima actualización en la interfaz principal
    $sql = "UPDATE `demandantes` SET `fechaactualizacion`='" . $fechaactual['year'] . "-" . $fechaactual['mon'] . "-" . $fechaactual['mday'] . "'"
            . " WHERE `dni`= '" . $_SESSION['DNI'] . "'";
    //Ejecutamos la consulta
    $resultado = mysqli_query($conexion, $sql);
    echo $fechaactual['year'] . "-" . $fechaactual['mon'] . "-" . $fechaactual['mday'];
} else if (isset($_POST['contrasena'])) {//Actualización de contraseña
    $sql = "SELECT `contrasena` FROM `demandantes` WHERE `dni`='".$_SESSION['DNI']."'";
    $resultado = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
    if ($row['contrasena']==$_POST['contrasena']) {//Si la contraeña de la base de datos es igual a 
        $sql = "UPDATE `demandantes` SET `contrasena`='" . $_POST['nueva'] . "'"
                . " WHERE `dni`= '" . $_SESSION['DNI'] . "'";
        //Ejecutamos la consulta
        $resultado = mysqli_query($conexion, $sql);
        echo 'Contraseña actualizada';
    }else{echo 'La contraseña antigua no coincide';}
}
?>