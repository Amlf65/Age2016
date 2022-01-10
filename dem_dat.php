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
        <link type='text/css' href='css/demo.css' rel='stylesheet' media='screen'/>
        <link type='text/css' href='css/basic.css' rel='stylesheet' media='screen'/>
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <!-- Modal -->
        <script type='text/javascript' src='js/jquery.js'></script>
        <script type='text/javascript' src='js/jquery.simplemodal.js'></script>
        <script type='text/javascript' src='js/basic.js'></script>
        <script>
            function actContra(vieja, nueva, nueva2) {
                if (vieja == nueva && vieja == nueva2) {
                    document.getElementById('contraresul').innerHTML = 'La contraseña antigua no debe coincidir con la nueva contraseña';
                } else if (nueva == nueva2) {
                    var parametros = {
                        "contrasena": vieja, "nueva": nueva
                    };
                    $.ajax({
                        data: parametros, //datos que se envian a traves de ajax
                        url: 'dem_act_jx.php', //archivo que recibe la peticion
                        type: 'post', //método de envio
                        beforeSend: function () {
                            $("#contraresul").html("Procesando, espere por favor...");
                        },
                        success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                            $("#contraresul").html(response);
                        }
                    });
                } else {
                    document.getElementById('contraresul').innerHTML = 'Las contraseñas no coinciden';
                }
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
            ?>
            <section id="contenido">
                <?php
                include 'dem_busc.php';
                include 'dem_aside.php';
                ?>
                <section>
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
                                <td><?php echo ($row['mejora'] == 'N') ? 'No' : 'Sí'; ?></td>
                            </tr><tr>
                                <td class="title1">Cobra prestación:</td>
                                <td><?php echo ($row['perceptor'] == 'N') ? 'No' : (($row['perceptor'] == NULL) ? '' : 'Sí'); ?></td>
                            </tr><tr>
                                <td class="title1">Discapacidad y Certificado:</td>
                                <td><?php echo ($row['discapacidad'] == 'N') ? 'No' : (($row['discapacidad'] == NULL) ? '' : 'Sí'); ?></td>
                            </tr><tr>
                                <td class="title1">Porcentaje:</td>
                                <td><?php echo ($row['grado'] == '0') ? '0' : (($row['grado'] == NULL) ? '' : $row['grado']); ?>%</td>
                            </tr><tr>
                                <td class="title1">Acude a servicios sociales:</td>
                                <td><?php echo ($row['consejalia'] == 'N') ? 'No' : (($row['consejalia'] == NULL) ? '' : 'Sí'); ?></td>
                            </tr><tr>
                                <td class="title1">U.T.S:</td>
                                <td><?php echo ($row['uts'] == 'N') ? 'No' : (($row['uts'] == NULL) ? '' : 'Sí'); ?></td>
                            </tr><tr>
                                <td class="title1">Inmigrante:</td>
                                <td><?php echo ($row['inmigrante'] == 'N') ? 'No' : (($row['inmigrante'] == NULL) ? '' : 'Sí'); ?></td>
                            </tr>
                        </table>
                        <div class="submit">
                            <a href="dem_actda.php"><input type="submit" name="actualizar" value="Actualizar"/></a>
                        </div>
                        <legend>Actualizar Contraseña</legend>
                        <form>
                            <table>
                                <tr>
                                    <td class="title1">Contraseña Antigua</td>
                                    <td><input type="password" id="contraVieja" name="contraVieja"></td>
                                </tr>
                                <tr>
                                    <td class="title1">Nueva Contraseña</td>
                                    <td><input type="password" id="contraNueva" name="contraNueva"></td>
                                </tr>
                                <tr>
                                    <td class="title1">Repita Contraseña</td>
                                    <td><input type="password" id="contraNueva2" name="contraNueva2"></td>
                                </tr>
                            </table>
                            <div class="submit">
                                <input type="button" name="actualizar" value="Actualizar" onclick="actContra(contraVieja.value, contraNueva.value, contraNueva2.value)"/>
                                <p id="contraresul"></p>
                            </div>
                            <legend>Eliminar cuenta</legend>
                            <!-- MODAL -->
                            <div id='basic-modal'>

                                <button name="basic" class='basic'>&nbsp;Eliminar&nbsp;</button>
                                <!-- Modal -->
                                <div id="basic-modal-content">
                                    <p style="text-decoration: none; color:black; 
                                       font-family: 'Libre Franklin', 'Helvetica', 'Neue helvetica', 'arial', 'sans-serif'; font-weight: bold; font-size:120%;text-align:center;">¿Está seguro de que desea eliminar la cuenta de forma permanente?</p><br>
                                    <p><a href="" style="font-size:120%;   color:blue; 
                                          font-family: 'Libre Franklin', 'Helvetica', 'Neue helvetica', 'arial', 'sans-serif';"><strong>Cancelar</strong></a></p>

                                    <p><a href="eliminar.php" style="font-size:120%;  color:red; 
                                          font-family: 'Libre Franklin', 'Helvetica', 'Neue helvetica', 'arial', 'sans-serif';"><strong> Aceptar</strong></a></p>
                                </div>
                                <!-- preload the images -->
                                <div style='display:none'>
                                    <img src='img/x.png' alt='' />
                                </div>
                                <!-- Fin de modal -->
                            </div>

                            </section>
                            </section>
                    </div>>
                    <?php include('footer.php') ?>
                    </body>
                    </html>