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
            if (!isset($_SESSION['DNI'])) {
                header('location:dem_acc.php');
            }
            $sql = "SELECT * FROM `demandantes` WHERE `dni`='" . $_SESSION['DNI'] . "'";
            $result = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $sqlFormacion = "SELECT `demfor`.`dni`, `formacion`.`titulo` FROM `formacion` INNER JOIN `demfor` ON formacion.codigo = demfor.codigo HAVING `dni`='" . $_SESSION['DNI'] . "'";
            $resultFormacion = mysqli_query($conexion, $sqlFormacion); //Títulos
            $sqlCertificado = "SELECT `demcerpro`.`dni`, `cerpro`.`certificado` FROM `cerpro` INNER JOIN `demcerpro` ON cerpro.codigo = demcerpro.codigo HAVING `dni`='" . $_SESSION['DNI'] . "'";
            $resultCertificado = mysqli_query($conexion, $sqlCertificado); //Certificados
            $sqlExper = "SELECT `exper` FROM `demexp` WHERE `dni`='" . $_SESSION['DNI'] . "'";
            $resultExper = mysqli_query($conexion, $sqlExper); //Experiencia
            $sqlCursos = "SELECT `cursos` FROM `otroscursos` WHERE `dni`='" . $_SESSION['DNI'] . "'";
            $resultCursos = mysqli_query($conexion, $sqlCursos); //Otros cursos
            $sqlPerfilPro = "SELECT `demperpro`.`dni`, `perfilesprofesionales`.`perfilprofesional` FROM `demperpro` INNER JOIN `perfilesprofesionales` ON demperpro.codigo = perfilesprofesionales.codigo HAVING `dni`='" . $_SESSION['DNI'] . "'";
            $resultPerfilPro = mysqli_query($conexion, $sqlPerfilPro); //Perfil Profesional
            $sqlCv = "SELECT * FROM `demcv` WHERE `dni`='" . $_SESSION['DNI'] . "'";
            ?>
            <section id="contenido">                     
                <?php
                include 'dem_busc.php';
                include 'dem_aside.php';
                ?>
                <section>
                    <div id="datos">
                        <div class="puesto">
                            <legend>Datos académicos</legend>
                            <table>
                                <tr>
                                    <td class="title1">Nivel formativo</td>
                                    <?php
                                    $nivelformativo = ['- Elija una opción -' => '', 'Sin estudios' => '00', 'Estudios primarios' => '10', 'Estudios secundarios' => '20', 'Estudios post-secundarios' => '30'];
                                    if ($row['nivelformativo'] == NULL || $row['nivelformativo'] == '') {
                                        echo '';
                                    } else {
                                        foreach ($nivelformativo as $texto => $nivel) {
                                            if ($nivel == $row['nivelformativo']) {
                                                echo '<td>' . $texto . '</td>';
                                            } else {
                                                echo '';
                                            }
                                        }
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <td class="title1">Titulación</td>
                                    <td>
                                        <?php
                                        while ($rowFormacion = mysqli_fetch_array($resultFormacion, MYSQLI_ASSOC)) {
                                            echo $rowFormacion['titulo'] . '<br/>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <legend>Formación complementaria</legend>
                            <table>
                                <tr>
                                    <td class="title1">Certificados</td>
                                    <td>
                                        <?php
                                        while ($rowCertificado = mysqli_fetch_array($resultCertificado, MYSQLI_ASSOC)) {
                                            echo $rowCertificado['certificado'] . '<br/>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title1">Otros Cursos</td>
                                    <td>
                                        <?php
                                        while ($rowCursos = mysqli_fetch_array($resultCursos, MYSQLI_ASSOC)) {
                                            echo $rowCursos['cursos'];
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <legend>Experiencia laboral</legend>
                            <table>
                                <tr>
                                    <td class="title1">Experiencia</td>
                                    <td>
                                        <?php
                                        if (mysqli_num_rows($resultExper) != 0) {
                                            while ($rowExper = mysqli_fetch_array($resultExper, MYSQLI_ASSOC)) {
                                                echo $rowExper['exper'] . '<br/>';
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title1">Perfil Profesional</td>
                                    <td>
                                        <?php
                                        while ($rowPerfilPro = mysqli_fetch_array($resultPerfilPro, MYSQLI_ASSOC)) {
                                            echo $rowPerfilPro['perfilprofesional'] . '<br/>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title1">Carnet de conducir</td>
                                    <td><input type="checkbox"
                                        <?php
                                        /* Valida si no tiene o no ha registrado si tiene o no carnet */
                                        echo ($row['carnetconducir'] == 'N') ? '' : (($row['carnetconducir'] == NULL) ? '' : 'checked="checked"');
                                        ?>disabled/></td>
                                <tr>
                                    <td class="title1">Vehículo propio</td>
                                    <td><input type="checkbox"
                                        <?php
                                        /* Valida si no tiene o no ha registrado si tiene o no vehiculo propio */
                                        echo ($row['vehiculopropio'] == 'N') ? '' : (($row['vehiculopropio'] == NULL) ? '' : 'checked="checked"');
                                        ?>disabled/></td>
                                </tr>
                                <tr>
                                    <td class="title1">Observaciones</td>
                                    <?php echo '<td>' . $row['observaciones'] . '</td>' ?>
                                </tr>    
                            </table>
                        </div>
                        <legend>Curriculum</legend>
                        <table>
                            <tr>
                                <td class="title1">Ver Curriculum Vitae:</td>
                                <td><?php echo "<a title='CV' href='VerCurriculum.php?dni=" . $row['dni'] . "'  target='_blank'>Ver CV</a>" ?></td>
                            </tr>
                        </table>
                        <div class="submit">
                            <a href="dem_actcv.php"><input type="submit" name="actualizar" value="Actualizar"/></a>
                        </div>
                    </div>
                </section>
        </div>
        <div style="position:relative; bottom:-100px !important;width:100%;">
            <?php include ('footer.php'); ?>
        </div>
    </body>
</html>
