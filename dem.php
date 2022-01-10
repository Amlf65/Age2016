<!DOCTYPE html>
<html lang="es">
    <head>
        <title>TU AGENCIA DE COLOCACIÓN</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link rel="stylesheet" type="text/css" href="css/dem.css"/>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script>
            function borrar(origen, cod) {
                var codigo = {
                    "codigo": cod, "origen": origen.value
                };
                $.ajax({
                    data: codigo, //datos que se envian
                    url: 'dem_borcand.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    beforeSend: function () {
                        $(origen).val("PROCESANDO...");
                    },
                    success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $('#ajaxcand').html(response);
                    }
                });
            }
            function actualizarFecha() {
                var fecha = {
                    "actualizar": 'origen'
                };
                $.ajax({
                    data: fecha, //datos que se envian
                    url: 'dem_act_jx.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $('#fecha').html(response);
                    }
                });
            }
        </script>
    </head>
    <body>
        <div id="contenedor">
            <?php
            include 'header.php';
            include 'conexion.php';
            if (!isset($_SESSION['DNI'])) {
                header('location:dem_acc.php');
            }
            $sql = "SELECT * FROM `demandantes` "
                    . "WHERE `dni`='" . $_SESSION['DNI'] . "'";
            //Ejecutamos la consulta
            $resultados = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_array($resultados, MYSQLI_ASSOC);
            $sqlFormacion = "SELECT `demfor`.`dni`, `formacion`.`titulo` FROM `formacion` INNER JOIN `demfor` ON formacion.codigo = demfor.codigo HAVING `dni`='" . $_SESSION['DNI'] . "'";
            $resultFormacion = mysqli_query($conexion, $sqlFormacion);
            $sqlCertificado = "SELECT `demcerpro`.`dni`, `cerpro`.`certificado` FROM `cerpro` INNER JOIN `demcerpro` ON cerpro.codigo = demcerpro.codigo HAVING `dni`='" . $_SESSION['DNI'] . "'";
            $resultCertificado = mysqli_query($conexion, $sqlCertificado); //Certificados
            $sqlExper = "SELECT `exper` FROM `demexp` WHERE `dni`='" . $_SESSION['DNI'] . "'";
            $resultExper = mysqli_query($conexion, $sqlExper); //Experiencia
            $sqlCursos = "SELECT `cursos` FROM `otroscursos` WHERE `dni`='" . $_SESSION['DNI'] . "'";
            $resultCursos = mysqli_query($conexion, $sqlCursos); //Otros cursos
            $sqlPerfilPro = "SELECT `demperpro`.`dni`, `perfilesprofesionales`.`perfilprofesional` FROM `demperpro` INNER JOIN `perfilesprofesionales` ON demperpro.codigo = perfilesprofesionales.codigo HAVING `dni`='" . $_SESSION['DNI'] . "'";
            $resultPerfilPro = mysqli_query($conexion, $sqlPerfilPro); //Perfil Profesional
            ?>
            <section id="contenido">                     
                <?php
                include 'dem_busc.php';
                include 'dem_aside.php';
                ?>
                <aside id="tuInfo">
                    <div>
                        <h6>Fecha de la última actualización de tu CV</h6>
                        <p id="fecha"><?php echo $row['fechaactualizacion'] ?></p>
                        <button id="actualizar" onclick="actualizarFecha()">ACTUALIZAR</button>
                    </div>
                    <hr noshade="noshade" />
                    <div id="formacion">
                        <h1 id="titulo2">Formación que te puede interesar</h1> 
                        <p>Ejemplo de texto donde se muestra información sobre el tipo de información mostrado.</p><br/>
                        <hr noshade="noshade" />
                        <p>Nombre de ofertantes</p><br/>
                        <hr/>
                        <p>Ejemplo de texto donde se muestra información sobre el tipo de información mostrado.</p><br/>
                        <p>Nombre de ofertantes</p>
                        <hr/>
                    </div>   
                </aside>
                <section>
                    <div id="candidaturas">
                        <legend>Mis Candidaturas</legend>
                        <div id="ajaxcand">
                            <?php
                            //Sentencia SQL que obtiene los contenidos por orden
                            $sqlcand = "SELECT * FROM `demofer` WHERE `dni`='" . $_SESSION['DNI'] . "' LIMIT 4";
                            $resultcand = mysqli_query($conexion, $sqlcand);
                            if (mysqli_num_rows($resultcand) != 0) {
                                while ($rowcand = mysqli_fetch_array($resultcand, MYSQLI_ASSOC)) {
                                    //Sentencia SQL para obtener información sobre la candidatura
                                    $sqlcand2 = "SELECT * FROM `ofertas` WHERE `codigo`='" . $rowcand['codigo'] . "'";
                                    $resultcand2 = mysqli_query($conexion, $sqlcand2);
                                    $rowcand2 = mysqli_fetch_array($resultcand2, MYSQLI_ASSOC);
                                    echo '<form><div class="puestos">
                                    <input type="text" name="codigo" value="' . $rowcand2['codigo'] . '" style="display:none;"/>
                                    <p class="titulo"><strong>' . $rowcand2['titulo'] . '</strong></p>
                                    <input type="button" class="borrar" name="cancelar" value="BORRAR" onclick="borrar(this,codigo.value)">
                                </div></form>';
                                }
                            } else {
                                echo '<h3>No hay candidaturas</h3>';
                            }
                            ?>
                        </div>
                    </div>
                    <div id="CV">
                        <legend>Mi CV</legend>
                        <table>
                            <tr>
                                <td class="title1">Nombre y Apellidos</td>
                                <td><?php echo $row['nombre'] . ' ' . $row['apellido1'] . ' ' . $row['apellido2'] ?></td>
                            </tr>
                            <tr>
                                <td class="title1">DNI</td>
                                <td><?php echo $row['dni'] ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Localidad</td>
                                <td><?php echo $row['localidad'] ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Dirección</td>
                                <td><?php echo $row['direccion'] ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Código Postal</td>
                                <td><?php echo $row['codigopostal'] ?></td>
                            </tr>
                            <tr>
                                <td class="title1">E-mail</td>
                                <td><?php echo $row['email'] ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Teléfono Móvil</td>
                                <td><?php echo $row['movil'] ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Teléfono Fijo</td>
                                <td><?php echo $row['telefono'] ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Nivel Formativo</td>
                                <td><?php
                                    $nivelformativo = ['No hay registro' => '', 'Sin estudios' => '00', 'Estudios primarios' => '10', 'Estudios secundarios' => '20', 'Estudios post-secundarios' => '30'];
                                    if ($row['nivelformativo'] == NULL || $row['nivelformativo'] == '') {
                                        echo '';
                                    } else {
                                        foreach ($nivelformativo as $texto => $nivel) {
                                            if ($nivel == $row['nivelformativo']) {
                                                echo $texto;
                                            } else {
                                                echo '';
                                            }
                                        }
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Titulación</td>
                                <td><?php
                                    while ($rowFormacion = mysqli_fetch_array($resultFormacion, MYSQLI_ASSOC)) {
                                        echo $rowFormacion['titulo'] . '<br/>';
                                    }
                                    ?></td>
                            </tr>
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
                                <td class="title1">Carnet de Conducir</td>
                                <td><?php echo ($row['carnetconducir'] == 'N') ? 'No' : 'Sí' ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Vehículo Propio</td>
                                <td><?php echo ($row['vehiculopropio'] == 'N') ? 'No' : 'Sí' ?></td>
                            </tr>
                        </table>
                    </div> 
                </section>      
            </section>
        </div>         
<?php include ('footer.php'); ?>
    </body>
</html>