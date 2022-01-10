<!DOCTYPE html>
<html lang="es">
    <head>
        <title>TU AGENCIA DE COLOCACIÓN</title>
        <meta charset="utf-8"/>
        <meta id="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link rel="stylesheet" type="text/css" href="css/dem.css">
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script>
            function cambio() {
                if ($('#carnetconducir').prop('checked')) {var carnetconducir = "S";} else {var carnetconducir = "N";}
                if ($('#vehiculopropio').prop('checked')) {var vehiculopropio = "S";} else {var vehiculopropio = "N";}
                var parametros = {
                    "nivelformativo": $("#nivelformativo").val(), "carnetconducir": carnetconducir, "vehiculopropio": vehiculopropio, "observaciones": $("#observaciones").val(),//DATOS DEMANDANTE
                    "titulacion1": $("#titulacion1").val(), "titulacion2": $("#titulacion2").val(), "titulacion3": $("#titulacion3").val(),//TITULACIONES
                    "certificado1": $("#certificado1").val(), "certificado2": $("#certificado2").val(), "certificado3": $("#certificado3").val(),//CERTIFICADOS
                    "cursos": $("#otroscursos").val(), "experiencia1": $("#experiencia1").val(), "experiencia2": $("#experiencia2").val(), "experiencia3": $("#experiencia3").val(),//OTROS CURSOS Y EXPERIENCIA
                    "perfilprofesional1": $("#perfilprofesional1").val(), "perfilprofesional2": $("#perfilprofesional2").val(), "perfilprofesional3": $("#perfilprofesional3").val(),//PERFILES PROFESIONALES
                }
                $.ajax({
                    data: parametros, //datos que se envian a traves de ajax
                    url: 'dem_act_jx.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    beforeSend: function () {
                        $("#result").html("Procesando, espere por favor...");
                    },
                    success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#result").html(response);
                    }
                });                
            }
        </script>
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
            $resultFormacion = mysqli_query($conexion, $sqlFormacion);//Titulaciones
            $sqlformaciones = "SELECT `titulo` FROM `formacion`";
            $resultformaciones = mysqli_query($conexion, $sqlformaciones);//Lista de tiulaciones
            $sqlCertificado = "SELECT `demcerpro`.`dni`, `cerpro`.`certificado` FROM `cerpro` INNER JOIN `demcerpro` ON cerpro.codigo = demcerpro.codigo HAVING `dni`='" . $_SESSION['DNI'] . "'";
            $resultCertificado = mysqli_query($conexion, $sqlCertificado);//Cretificados
            $sqlcertificados = "SELECT * FROM `cerpro`";
            $resultcertificados = mysqli_query($conexion, $sqlcertificados);//Listado de certificados
            $sqlExper = "SELECT `exper` FROM `demexp` WHERE `dni`='" . $_SESSION['DNI'] . "'";
            $resultExper = mysqli_query($conexion, $sqlExper);//Experiencia profesional
            $sqlCursos = "SELECT `cursos` FROM `otroscursos` WHERE `dni`='" . $_SESSION['DNI'] . "'";
            $resultCursos = mysqli_query($conexion, $sqlCursos);
            $rowCursos = mysqli_fetch_array($resultCursos, MYSQLI_ASSOC);//Otros curssos
            $sqlPerfilPro = "SELECT `demperpro`.`dni`, `perfilesprofesionales`.`perfilprofesional` FROM `demperpro` INNER JOIN `perfilesprofesionales` ON demperpro.codigo = perfilesprofesionales.codigo HAVING `dni`='" . $_SESSION['DNI'] . "'";
            $resultPerfilPro = mysqli_query($conexion, $sqlPerfilPro);//Perfl profesional
            $sqlperfilesprofesionales = "SELECT `perfilprofesional`FROM `perfilesprofesionales`";
            $resultperfilesprofesionales = mysqli_query($conexion, $sqlperfilesprofesionales);//Listado de perfiles profesionales
            ?>
            <section id="contenido">                     
                <?php
                include 'dem_busc.php';
                include 'dem_aside.php';
                ?>
                <section>
                    <div id="datos">
                        <div class="puesto">
                            <legend>Datos acad&eacute;micos</legend>
                            <form action="dem_cv.php">
                                <table>
                                    <tr>
                                        <td class="title1"><p>Nivel Formativo</p></td>
                                        <td><select id="nivelformativo" name="nivelformativo" required>
                                                <?php
                                                $nivelformativo = ['- Elija una opción -' => '', 'Sin estudios' => '00', 'Estudios primarios' => '10', 'Estudios secundarios' => '20', 'Estudios post-secundarios' => '30'];
                                                if ($row['nivelformativo'] == NULL) {
                                                    foreach ($nivelformativo as $texto => $nivel) {
                                                        echo '<option value="' . $nivel . '">' . $texto . '</option>';
                                                    }
                                                } else {
                                                    foreach ($nivelformativo as $texto => $nivel) {
                                                        if ($nivel == $row['nivelformativo']) {
                                                            echo '<option value="' . $nivel . '" selected="selected">' . $texto . '</option>';
                                                        } else {
                                                            echo '<option value="' . $nivel . '">' . $texto . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select></td>
                                    </tr>
                                    <?php
                                    $titulacion = 0;//TITULACION
                                    while ($rowFormacion = mysqli_fetch_array($resultFormacion, MYSQLI_ASSOC)) {
                                        $titulacion++;
                                        echo '<tr><td class="title1"><p>Titulación ' . $titulacion . '</p></td>
                                            <td><input id="titulacion'.$titulacion.'" list="titulacion" name="titulacion'.$titulacion.'" value="' . $rowFormacion['titulo'] . '">
                                                <datalist id="titulacion">
                                                   <?php';
                                        while ($rowformaciones = mysqli_fetch_array($resultformaciones, MYSQLI_ASSOC)) {
                                            echo '<option value="' . $rowformaciones['titulo'] . '">';
                                        }
                                        echo '?>
                                                </datalist></td></tr>';
                                    }
                                    while ($titulacion<3) {
                                        $titulacion++;
                                        echo '<tr><td class="title1"><p>Titulación ' . $titulacion . '</p></td>
                                            <td><input id="titulacion'.$titulacion.'" list="titulacion" name="titulacion'.$titulacion.'" value="">
                                                <datalist id="titulacion">
                                                   <?php';
                                        while ($rowformaciones = mysqli_fetch_array($resultformaciones, MYSQLI_ASSOC)) {
                                            echo '<option value="' . $rowformaciones['titulo'] . '">';
                                        }
                                        echo '?>
                                                </datalist></td></tr>';
                                    }
                                    ?>
                                </table>
                                <legend>Formación complementaria</legend>
                                <table>
                                    <?php
                                    $certificados = 0;//CERTIFICADOS
                                    while ($rowCertificado = mysqli_fetch_array($resultCertificado, MYSQLI_ASSOC)) {
                                        $certificados++;
                                        echo '<tr><td class="title1"><p>Certificado ' . $certificados . '</p></td>
                                            <td><input id="certificado'.$certificados.'" list="certificado" name="certificado'.$certificados.'" value="' . $rowCertificado['certificado'] . '">
                                                <datalist id="certificado">
                                                    <?php';
                                        while ($rowcertificados = mysqli_fetch_array($resultcertificados, MYSQLI_ASSOC)) {
                                            echo '<option value="' . $rowcertificados['certificado'] . '">';
                                        }
                                        echo '?>
                                                </datalist></td></tr>';
                                    }
                                    while ($certificados<3) {
                                        $certificados++;
                                        echo '<tr><td class="title1"><p>Certificado ' . $certificados . '</p></td>
                                            <td><input id="certificado'.$certificados.'" list="certificado" name="certificado'.$certificados.'" value="">
                                                <datalist id="certificado">
                                                    <?php';
                                        while ($rowcertificados = mysqli_fetch_array($resultcertificados, MYSQLI_ASSOC)) {
                                            echo '<option value="' . $rowcertificados['certificado'] . '">';
                                        }
                                        echo '?>
                                                </datalist></td></tr>';
                                    }
                                    ?>
                                    <tr>
                                        <td class="title1">Otros Cursos</td>
                                        <td><textarea name="otroscursos" id="otroscursos" style="resize: none;" cols="39" rows="5"><?php echo $rowCursos['cursos'] ?></textarea></td>
                                    </tr>
                                </table>
                                <legend>Experiencia laboral</legend>
                                <table>  
                                    <?php
                                    $experiencia = 0;//EXPERIENCIA
                                    while ($rowExper = mysqli_fetch_array($resultExper, MYSQLI_ASSOC)) {
                                        $experiencia++;
                                        echo '<tr><td class="title1"><p>Experiencia ' . $experiencia . '</p></td>
                                            <td><input type="text" id="experiencia'.$experiencia.'" name="experiencia'.$experiencia.'" value="' . $rowExper['exper'] . '"/></td></tr>';
                                    }
                                    while ($experiencia<3) {
                                        $experiencia++;
                                        echo '<tr><td class="title1"><p>Experiencia ' . $experiencia . '</p></td>
                                            <td><input type="text" id="experiencia'.$experiencia.'"  name="experiencia'.$experiencia.'" value=""></td></tr>';
                                    }
                                    $perfilProfesional = 0;//PERFILES PROFESIONALES
                                    while ($rowPerfilPro = mysqli_fetch_array($resultPerfilPro, MYSQLI_ASSOC)) {
                                        $perfilProfesional++;
                                        echo '<tr><td class="title1"><p>Perfil Profesional ' . $perfilProfesional . '</p></td>
                                            <td><input id="perfilprofesional'.$perfilProfesional.'" list="perfilprofesional" name="perfilprofesional'.$perfilProfesional.'" value="' . $rowPerfilPro['perfilprofesional'] . '">
                                                <datalist id="perfilprofesional">
                                                    <?php';
                                        while ($rowperfilesprofesionales = mysqli_fetch_array($resultperfilesprofesionales, MYSQLI_ASSOC)) {
                                            echo '<option value="' . $rowperfilesprofesionales['perfilprofesional'] . '">';
                                        }
                                        echo '?>
                                                </datalist></td></tr>';
                                    }
                                    while ($perfilProfesional<3) {
                                        $perfilProfesional++;
                                        echo '<tr><td class="title1"><p>Perfil Profesional ' . $perfilProfesional . '</p></td>
                                            <td><input id="perfilprofesional'.$perfilProfesional.'" list="perfilprofesional" name="perfilprofesional'.$perfilProfesional.'" value=" ">
                                                <datalist id="perfilprofesional">
                                                    <?php';
                                        while ($rowperfilesprofesionales = mysqli_fetch_array($resultperfilesprofesionales, MYSQLI_ASSOC)) {
                                            echo '<option value="' . $rowperfilesprofesionales['titulo'] . '">';
                                        }
                                        echo '?>
                                                </datalist></td></tr>';
                                    }
                                    ?>
                                    <tr>
                                        <td class="title1"><p>Carnet de conducir</p></td>
                                        <td><input type="checkbox" name="carnetconducir"  id="carnetconducir" 
                                            <?php
                                            //Valida si no tiene o no ha registrado si es VVG
                                            echo ($row['carnetconducir'] == 'N') ? '' : (
                                                    ($row['carnetconducir'] == NULL) ? '' :
                                                            ' checked');
                                            ?>/></td>
                                    </tr>
                                    <tr>
                                        <td class="title1"><p>Vehículo propio</p></td>
                                        <td><input type="checkbox" name="vehiculopropio"  id="vehiculopropio" 
                                            <?php
                                            //Valida si no tiene o no ha registrado si es VVG
                                            echo ($row['vehiculopropio'] == 'N') ? '' : (
                                                    ($row['vehiculopropio'] == NULL) ? '' :
                                                            ' checked');
                                            ?>/></td>
                                    </tr>
                                    <tr>
                                        <td class="title1">Observaciones</td>
                                        <td><textarea name="observaciones" id="observaciones" style="resize: none;" cols="39" rows="5"><?php echo $row['observaciones'] ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><input type="button" name="actualizar" value="Actualizar" id="guardar" class="enviar" onclick="cambio()"/></td>
                                        <td><input type="submit" name="finalizar" value="Finalizar" id="cancelar" class="enviar"/></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><p id="result"></p></td>
                                    </tr>
                                </table>
                            </form>           
                        </div><br/>
                        <div class="CV"><br/>
                            <legend>Actualizar mi curriculum vitae</legend>
                            <form enctype="multipart/form-data" method="post" action="dem_cv.php">
                                <table>
                                    <tr>
                                        <td><input type="file" name="cv"  class="form-control" required/> <input type="submit" class="btn btn-primary center-block" name="actualizarpdf" value="Actualizar"/></td>
                                        <?php
                                        if (isset($_POST['actualizarpdf'])) {
                                            $nombre = $_FILES["cv"]["tmp_name"];
                                            $tamano = $_FILES["cv"]["size"];
                                            $tipo = $_FILES["cv"]["type"];
                                            $cv = fopen($nombre, "r");
                                            $_SERVER['DOCUMENT_ROOT'] . '/intranet/upload/' . $archivo = fread($cv, $tamano);
                                            $archivo = addslashes($archivo);
                                            fclose($cv);
                                            $sql = " UPDATE `demcv` SET `cvenpdf`=('$archivo'),`tipo`=('$tipo') WHERE `dni`= '" . $_SESSION['DNI'] . "'";
                                            $result = mysqli_query($conexion, $sql);
                                            echo "CV actualizado";
                                        }
                                        ?>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </section>
        </div>
        <div style="position:relative; bottom:-155px !important;width:100%;">
            <?php include ('footer.php'); ?>
        </div>
    </body>
</html>