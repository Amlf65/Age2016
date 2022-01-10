<link rel="stylesheet" type="text/css" href="css/general.css"/>
<link rel="stylesheet" type="text/css" href="css/iconic.css"/>
<link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
<link type='text/css' href='css/demo.css' rel='stylesheet' media='screen'/>
<link type='text/css' href='css/basic.css' rel='stylesheet' media='screen'/>
<?php
    include 'conexion.php';
    //OTROS DATOS PERSONALES
    if (isset($_POST['demandante'])) $demandante = 'S'; else $demandante = 'N';
    if (isset($_POST['mejora'])) $mejora = 'S'; else $mejora = 'N'; 
    if (isset($_POST['perceptor'])) $perceptor = 'S'; else $perceptor = 'N';
    if (isset($_POST['discapacidad'])) $discapacidad = 'S'; else $discapacidad = 'N';
    if (isset($_POST['grado'])) $grado = (int) $_POST['grado']; else $grado = 0;
    if (isset($_POST['consejalia'])) $consejalia = 'S'; else $consejalia = 'N';
    //UTS ES UN SELECT
    if (isset($_POST['inmigrante'])) $inmigrante = 'S'; else $inmigrante = 'N';
    $edad = date("Y") - date("Y", strtotime($_POST['fechanacimiento']));
    ($edad <= 30 && $edad > 45 || $sexo = 2 || $inmigrante = 'S' || $discapacidad = 'S') ? $dificilinsercion = 'S' : $dificilinsercion = 'N';
   
    if (isset($_POST['carnetconducir'])) $carnet = 'S'; else $carnet = 'N';
    if (isset($_POST['vehiculopropio']))$vehiculopropio = 'S'; else $vehiculopropio = 'N';
   
    /* Datos personales (demandante) */
    $sql1 = "INSERT INTO `demandantes`(`dni`, `contrasena`, `nombre`, `apellido1`,`apellido2`, `fechanacimiento`, `sexo`, `movil`, `telefono`,`email`, `direccion`, `codigopostal`,`localidad`,`demandante`, `mejora`, `perceptor`, `discapacidad`, `grado`, `consejalia`, `uts`, `inmigrante`, `dificilinsercion`, `nivelformativo`, `carnetconducir`, `vehiculopropio`, `observaciones`,`colocacion`, `fecharegistro`,`fechaactualizacion`, `primerainscripcion`) "
            . "VALUES('" . $_POST['dni'] . "','" . $_POST['contrasena'] . "','" . $_POST['nombre'] . "','". $_POST['apellido1'] . "','" . $_POST['apellido2'] . "','" . $_POST['fechanacimiento'] . "','". $_POST['sexo'] . "','" . $_POST['movil'] . "','". $_POST['telefono'] . "','" . $_POST['email'] . "','" . $_POST['direccion'] . "','". $_POST['codigopostal'] . "','" . $_POST['localidad'] . "','" . $demandante . "','". $mejora . "','" . $perceptor . "','" . $discapacidad . "','" . $grado . "','" . $consejalia . "','". $_POST['uts'] . "','". $inmigrante . "','" . $dificilinsercion . "','" . $_POST['nivelformativo'] . "','" . $carnet . "','" . $vehiculopropio . "','". $_POST['observaciones'] . "','N',CURDATE(),CURDATE(),'S')";
    if ($result1 = mysqli_query($conexion, $sql1)) {
        
        /* DATOS ACADEMICOS (demfor) (nivel formativo esta insertado en la anterior sql)*/
        for ($i=1;$i<=3;$i++){
            $name= 'titulo'. $i;
                $sqltit1 = "SELECT `codigo` FROM `formacion` WHERE `titulo` = '" . $_POST[$name] . "'";
                if($resulti1 = mysqli_query($conexion, $sqltit1)){
                    $row1 = mysqli_fetch_array($resulti1, MYSQLI_ASSOC);
                    $resulcod1 = mysqli_query($conexion, "INSERT INTO `demfor`(`dni`, `codigo`) VALUES ('" . $_POST['dni'] . "','" . $row1['codigo'] . "')");
                }
        }

        /*  FORMACIÓN COMPLEMENTARIA (demcerpro) */
        for ($i=1;$i<=3;$i++){
            $name= 'fc'. $i;
            if(isset($_POST[$name])){  
                $sql = "SELECT `codigo` FROM `cerpro` WHERE `certificado` = '" . $_POST[$name] . "'";
                $result = mysqli_query($conexion, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $resultin = mysqli_query($conexion, "INSERT INTO `demcerpro`(`dni`, `codigo`) VALUES ('" . $_POST['dni'] . "','" . $row['codigo'] . "')");
             }
        }
        if(isset($_POST['cursos'])){ /* OTROSCURSOS (otroscursos) */
            $sql4 = "INSERT INTO `otroscursos`(`dni`, `cursos`)". "VALUES('" . $_POST['dni'] . "','" . $_POST['cursos'] . "')";
            $result4 = mysqli_query($conexion, $sql4);
         }

        /* EXPERIENCIA LABORAL (demexp) */
        for ($i=1;$i<=3;$i++){
            $name= 'exp'. $i;
            if(isset($_POST[$name])){  
                $sql = "INSERT INTO `demexp`(`dni`, `exper`) VALUES ('" . $_POST['dni'] . "','" .$_POST[$name] . "')";
                $result = mysqli_query($conexion, $sql);
             }
        }
        for ($i=1;$i<=3;$i++){/* PERFIL PROFESIONAL (demperpro) */
            $name= 'pp'. $i;
            if (isset($_POST[$name])) {
                $sqltit7 = "SELECT `codigo` FROM `perfilesprofesionales` WHERE `perfilprofesional` = '" . $_POST[$name] . "'";
                $resulti7 = mysqli_query($conexion, $sqltit7);
                $row7 = mysqli_fetch_array($resulti7, MYSQLI_ASSOC);
                $resulcod7 = mysqli_query($conexion, "INSERT INTO `demperpro`(`dni`, `codigo`) VALUES ('" . $_POST['dni'] . "','" . $row7['codigo'] . "')");
               
            }
        }
        //CARNET VEHICULO Y OBSERVACIONES ENTAN EN DEMANDANTES
        //CURRICULUM VITAE
        if (isset($_POST['aceptar'])) {
            $nombre = $_FILES["cv"]["tmp_name"];
            $tamano = $_FILES["cv"]["size"];
            $tipo = $_FILES["cv"]["type"];
            $cv = fopen($nombre, "r");
            $_SERVER['DOCUMENT_ROOT'] . '/intranet/upload/'.$archivo = fread($cv, $tamano);
            $archivo = addslashes($archivo);
            fclose($cv);
            $sql = "INSERT INTO `demcv`(`cvenpdf`,`dni`, `tipo`) VALUES ('$archivo','" . $_POST['dni'] . "', '$tipo')";
            $result = mysqli_query($conexion, $sql);
        }

        include ('header.php');
        echo' <div id="contenedoracc">Se ha registrado correctamente. <a href="dem_acc.php">Iniciar sesión</a></div>';
        include ('footer.php');
     }else{
        $sql2 = "SELECT * FROM `demandantes` WHERE dni='".$_POST['dni']."'";
        if ($result = mysqli_query($conexion, $sql2)) {
            include ('header.php');
            echo ' <div id="contenedoracc">El usuario registrado ya existe. <a href="form_dem.php">Volver al formulario</a></div>';
            include ('footer.php');
        }else {
            include ('header.php');
            echo' <div id="contenedoracc">No se ha podido registrar correctamente. Por favor, inténtelo de nuevo o póngase en contacto con la agencia de colocación de Telde. <a href="form_dem.php">Volver al formulario</a></div>';
            include ('footer.php');
        }
    }
        
     