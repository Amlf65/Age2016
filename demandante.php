<!DOCTYPE html>
<html lang="es">
    <head>
        <title>TU AGENCIA DE COLOCACIÓN</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link rel="stylesheet" type="text/css" href="css/dem.css">
    </head>
    <body>
        <div id="contenedor">
            <?php
            include ('header.php');
            include 'conexion.php';
            if (isset($_GET['dni'])) {
                $sql = "SELECT * FROM `demandantes` WHERE `dni`='" . $_GET['dni'] . "'";
                $result = mysqli_query($conexion, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            ?>
            <section id="contenido">
                <div id="datos">
                    <legend>Datos Personales</legend>
                    <table>
                        <tr>
                            <td class="title1">DNI:</td>
                            <td><?php echo $row['dni'] ?></td>
                        </tr><tr>    
                            <td class="title1">Nombre y apellidos:</td>
                            <td><?php echo $row['nombre'] . " " . $row['apellido1'] . " " . $row['apellido2'] ?></td>
                        </tr><tr>
                            <td class="title1">Contraseña:</td>
                            <td><?php echo $row['contrasena'] ?></td>
                        </tr><tr>
                            <td class="title1">Fecha de nacimiento:</td>
                            <td><?php echo (isset($row['fechanacimiento'])) ? $row['fechanacimiento'] : ''; ?></td>
                        </tr><tr>
                            <td class="title1">Sexo:</td>
                            <td><?php echo ($row['sexo'] == '1') ? 'Hombre' : (($row['sexo'] == '2') ? 'Mujer' : ''); ?></td>
                        </tr><tr>
                            <td class="title1">Teléfono móvil:</td>
                            <td><?php echo (isset($row['movil'])) ? $row['movil'] : ''; ?></td>
                        </tr><tr>
                            <td class="title1">Teléfono fijo:</td>
                            <td><?php echo (isset($row['telefono'])) ? $row['telefono'] : ''; ?></td>
                        </tr><tr>
                            <td class="title1">E-mail:</td>
                            <td><?php echo (isset($row['email'])) ? $row['email'] : ''; ?></td>
                        </tr><tr>
                            <td class="title1">Localidad:</td>
                            <td><?php echo (isset($row['localidad'])) ? $row['localidad'] : ''; ?></td>
                        </tr><tr>
                            <td class="title1">Dirección:</td>
                            <td><?php echo (isset($row['direccion'])) ? $row['direccion'] : ''; ?></td>
                        </tr><tr>
                            <td class="title1">Código postal:</td>
                            <td><?php echo (isset($row['codigopostal'])) ? $row['codigopostal'] : ''; ?></td>
                        </tr>
                    </table><br/>
                    <legend>Otros Datos Personales</legend>
                    <table>
                        <tr>
                            <td class="title1">Inscrito/a como Demandante:</td>
                            <td><?php echo ($row['demandante'] == 'N') ? 'No' : 'Sí'; ?></td>
                        </tr><tr>
                            <td class="title1">Inscrito/a como Mejora de Empleo:</td>
                            <td><?php echo ($row['mejora'] == 'N') ? 'No' :  'Sí'; ?></td>
                        </tr><tr>
                            <td class="title1">Cobra prestación:</td>
                            <td><?php echo ($row['perceptor'] == 'N') ? 'No' : 'Sí'; ?></td>
                        </tr><tr>
                            <td class="title1">Discapacidad y Certificado:</td>
                            <td><?php echo ($row['discapacidad'] == 'N') ? 'No' : 'Sí'; ?></td>
                        </tr><tr>
                            <td class="title1">Porcentaje:</td>
                            <td><?php echo $row['grado'] .' %' ?></td>
                        </tr><tr>
                            <td class="title1">Acude a servicios sociales:</td>
                            <td><?php echo ($row['consejalia'] == 'N') ? 'No' : 'Sí'; ?></td>
                        </tr><tr>
                            <td class="title1">U.T.S:</td>
                            <td><?php echo ($row['uts'] == 'N') ? 'No' : 'Sí'; ?></td>
                        </tr><tr>
                            <td class="title1">Inmigrante:</td>
                            <td><?php echo ($row['inmigrante'] == 'N') ? 'No' :  'Sí'; ?></td>
                        </tr>
                    </table>
                    <?php
                    $sqlFormacion= "SELECT `formacion`.`titulo` FROM `formacion` INNER JOIN `demfor` ON formacion.codigo = demfor.codigo where `dni`='".$_GET['dni']."'";//Consulto las titulaciones registradas segun el DNI demandante
                    $resultFormacion= mysqli_query($conexion, $sqlFormacion);
                    ?>                        
                    <br/><legend>Datos Académicos</legend>
                    <table>
                        <tr>
                            <td class="title1">Nivel formativo:</td>
                            <td><?php switch ($row['nivelformativo']) {
                                    case 00:
                                        echo "Sin estudios";
                                        break;
                                    case 10:
                                        echo "Estudios Primarios";
                                        break;
                                    case 20:
                                        echo "Estudios Secundarios";
                                        break;
                                    case 30:
                                        echo "Estudios Post-secundarios";
                                        break;
                                } ?></td>
                        </tr><tr>
                            <td class="title1" rowspan="3">Titulación:</td>
                            <?php echo ($rowFormacion = mysqli_fetch_array($resultFormacion, MYSQLI_ASSOC)) ? "<td>" . $rowFormacion['titulo'] . "</td>" : "<td>--</td>"; 
                                  echo ($rowFormacion = mysqli_fetch_array($resultFormacion, MYSQLI_ASSOC)) ? "</tr><tr><td>" . $rowFormacion['titulo'] . "</td>" : "</tr><tr><td>--</td>"; 
                                  echo ($rowFormacion = mysqli_fetch_array($resultFormacion, MYSQLI_ASSOC)) ? "</tr><tr><td>" . $rowFormacion['titulo'] . "</td>" : "</tr><tr><td>--</td>"; ?>
                        </tr>
                    </table>
                    <?php
                    $sqlCertificado= "SELECT `cerpro`.`certificado` FROM `cerpro` INNER JOIN `demcerpro` ON cerpro.codigo = demcerpro.codigo where `dni`='".$_GET['dni']."'";//Consulto los certificados registradas segun el DNI demandante
                    $resultCertificado= mysqli_query($conexion, $sqlCertificado);
                    ?>
                    <br/><legend>Formación complementaria</legend>
                    <table>
                        <tr>
                            <td class="title1" rowspan="3">Certificado:</td>
                            <?php echo ($rowCertificado = mysqli_fetch_array($resultCertificado, MYSQLI_ASSOC)) ? "<td>" . $rowCertificado['certificado'] . "</td>" : "<td>--</td>"; 
                                  echo ($rowCertificado = mysqli_fetch_array($resultCertificado, MYSQLI_ASSOC)) ? "</tr><tr><td>" . $rowCertificado['certificado'] . "</td>" : "</tr><tr><td>--</td>"; 
                                  echo ($rowCertificado = mysqli_fetch_array($resultCertificado, MYSQLI_ASSOC)) ? "</tr><tr><td>" . $rowCertificado['certificado'] . "</td>" : "</tr><tr><td>--</td>"; ?>
                        </tr><tr>
                            <td class="title1">Otros Cursos:</td>
                            <?php $resultOC= mysqli_query($conexion, "SELECT `cursos` FROM `otroscursos` WHERE `dni` ='".$_GET['dni']."'");
                            $rowOC = mysqli_fetch_array($resultOC, MYSQLI_ASSOC);?>
                            <td><?php echo $rowOC['cursos']; ?></td>
                        </tr>
                    </table>
                    <?php
                    $sqlPerfilPro= "SELECT `perfilesprofesionales`.`perfilprofesional` FROM `perfilesprofesionales` INNER JOIN `demperpro` ON perfilesprofesionales.codigo = demperpro.codigo where `dni`='".$_GET['dni']."'";//Consulto los perfiles profesionales registradas segun el DNI demandante
                    $resultPerfilPro= mysqli_query($conexion, $sqlPerfilPro);
                    $sqlExper= "SELECT * FROM `demexp` where `dni` ='".$_GET['dni']."'";//Consulto los perfiles profesionales registradas segun el DNI demandante
                    $resultExper= mysqli_query($conexion, $sqlExper);
                    ?>
                    <br/><legend>Experiencia laboral</legend>
                    <table>
                        <tr>
                            <td class="title1" rowspan="3">Experiencia:</td>
                            <?php echo ($rowExper = mysqli_fetch_array($resultExper, MYSQLI_ASSOC)) ? "<td>" . $rowExper['exper'] . "</td>" : "<td>--</td>"; 
                                  echo ($rowExper = mysqli_fetch_array($resultExper, MYSQLI_ASSOC)) ? "</tr><tr><td>" . $rowExper['exper'] . "</td>" : "</tr><tr><td>--</td>"; 
                                  echo ($rowExper = mysqli_fetch_array($resultExper, MYSQLI_ASSOC)) ? "</tr><tr><td>" . $rowExper['exper'] . "</td>" : "</tr><tr><td>--</td>"; ?>
                        </tr><tr>
                            <td class="title1" rowspan="3">Perfiles Profesionales:</td>
                            <?php echo ($rowPerfilPro = mysqli_fetch_array($resultPerfilPro, MYSQLI_ASSOC)) ? "<td>" . $rowPerfilPro['perfilprofesional'] . "</td>" : "<td>--</td>"; 
                                  echo ($rowPerfilPro = mysqli_fetch_array($resultPerfilPro, MYSQLI_ASSOC)) ? "</tr><tr><td>" . $rowPerfilPro['perfilprofesional'] . "</td>" : "</tr><tr><td>--</td>"; 
                                  echo ($rowPerfilPro = mysqli_fetch_array($resultPerfilPro, MYSQLI_ASSOC)) ? "</tr><tr><td>" . $rowPerfilPro['perfilprofesional'] . "</td>" : "</tr><tr><td>--</td>"; ?>
                        </tr><tr>
                            <td class="title1">Carnet de conducir:</td>
                            <td><?php echo ($row['carnetconducir'] == 'N') ? 'No' : (($row['carnetconducir'] == NULL) ? '' : 'Sí'); ?></td>
                        </tr>
                        <tr>
                            <td class="title1">Vehiculo:</td>
                            <td><?php echo ($row['vehiculopropio'] == 'N') ? 'No' : (($row['vehiculopropio'] == NULL) ? '' : 'Sí'); ?></td>
                        </tr>
                        <tr>
                            <td class="title1">Observaciones:</td>
                            <td><?php echo $row['observaciones'] ?></td>
                        </tr>
                    </table>
                    <br/><legend>Curriculum</legend>
                    <table>
                        <tr>
                            <td class="title1">Ver Curriculum Vitae:</td>
                            <td><?php echo "<a title='CV' href='VerCurriculum.php?dni=". $row['dni'] ."'  target='_blank'>Ver CV</a>"?></td>
                        </tr>
                    </table>
            </section>
        </div>
        <?php }include('footer.php') ?>
    </body>
</html>