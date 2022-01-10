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
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script>
            function cambio() {
                if ($('#demandante').prop('checked')) {var demandante = "S";} else {var demandante = "N";}
                if ($('#mejora').prop('checked')) {var mejora = "S";} else {var mejora = "N";}
                if ($('#perceptor').prop('checked')) {var perceptor = "S";} else {var perceptor = "N";}
                if ($('#discapacidad').prop('checked')) {var discapacidad = "S";} else {var discapacidad = "N";}
                if ($('#consejalia').prop('checked')) {var consejalia = "S";} else {var consejalia = "N";}
                if ($('#uts').prop('checked')) {var uts = "S";} else {var uts = "N";}
                if ($('#inmigrante').prop('checked')) {var inmigrante = "S";} else {var inmigrante = "N";}
                var parametros = {
                    "nombre": $("#nombre").val(), "ap1": $("#ap1").val(), "ap2": $("#ap2").val(), "fecha": $("#fecha").val(), "sexo": $("input[name='sexo']:checked").val(),
                    "disca": $("#disca").val(), "localidad": $("#localidad  option:selected").text(), "direccion": $("#direccion").val(),
                    "codigopostal": $("#codigopostal").val(), "email": $("#email").val(), "movil": $("#movil").val(), "fijo": $("#fijo").val(),
                    "demandante": demandante, "mejora": mejora, "perceptor": perceptor, "discapacidad": discapacidad, "consejalia": consejalia, "uts": uts, "inmigrante": inmigrante
                };
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
            include 'header.php';
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
                        <div class="puesto">
                            <h4>Mis Datos</h4>
                            <form action="dem_dat.php">
                                <legend>Sobre mí</legend>
                                <table>
                                    <tr>
                                        <td class="title1"><p>Nombre</p></td>
                                        <td><input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre'] ?>"/></td>
                                    </tr>
                                    <tr>
                                        <td class="title1"><p>Primer Apellido</p></td>
                                        <td><input type="text" name="ape1" id="ap1" value="<?php echo $row['apellido1'] ?>"/></td>
                                    </tr>
                                    <tr>
                                        <td class="title1"><p>Segundo Apellido</p></td>
                                        <td><input type="text" name="ape2" id="ap2" value="<?php echo $row['apellido2'] ?>"/></td>
                                    </tr>
                                    <tr>
                                        <td class="title1"><p>DNI/NIE</p></td>
                                        <td><p><b><em><?php echo $_SESSION['DNI'] ?></em></b></p></td>
                                    </tr>
                                    <tr>
                                        <td class="title1"><p>Fecha de nacimiento</p></td>
                                        <td><input type="date" id="fecha" name="fecha" value="<?php echo $row['fechanacimiento'] ?>"/></td>
                                    </tr>
                                    <tr>
                                        <td class="title1"><p>Sexo</p></td>
                                        <td><?php
                                            echo ($row['sexo'] == '1') ? '<input type="radio" name="sexo" checked="checked" value="1">&nbsp; <label>Masculino</label><br/>
                                    <input type="radio" name="sexo" value="2">&nbsp; <label>Femenino</label>' : (
                                                    ($row['sexo'] == '2') ? '<input type="radio" name="sexo" value="1">&nbsp; <label>Masculino</label><br/>
                                        <input type="radio" name="sexo" checked="checked" value="2">&nbsp; <label>Femenino</label>' : (
                                                            ($row['sexo'] == NULL) ? '<input type="radio" name="sexo" value="1">&nbsp; <label>Masculino</label><br/>
                                            <input type="radio" name="sexo" value="2">&nbsp; <label>Femenino</label>' : ''));
                                            ?></td>
                                    </tr>
                                </table>
                                <legend>Lugar de residencia</legend>
                                <table>
                                    <tr>
                                        <td class="title1"><p>Localidad</p></td>
                                        <td><select id="localidad" name="localidad">
                                                <?php
                                                $localidad = ['- Elija una opción -', 'Guía', 'Gáldar', 'Telde', 'Teror'];
                                                if ($row['localidad'] == NULL) {
                                                    echo '<option value="" selected="selected">' . $localidad[0] . '</option>';
                                                    for ($i = 1; $i < count($localidad); $i++) {
                                                        echo '<option value="" selected="selected">' . $localidad[$i] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">' . $localidad[0] . '</option>';
                                                    for ($i = 1; $i < count($localidad); $i++) {
                                                        if ($localidad[$i] == $row['localidad']) {
                                                            echo '<option value="" selected="selected">' . $localidad[$i] . '</option>';
                                                        } else {
                                                            echo '<option value="">' . $localidad[$i] . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td class="title1"><p>Dirección</p></td>
                                        <td><input type="text" id="direccion" name="direccion" value="<?php echo $row['direccion'] ?>"/></td>
                                    </tr>
                                    <tr>
                                        <td class="title1"><p>Código Postal</p></td>
                                        <td><input type="text" id="codigopostal" name="codigopostal" value="<?php echo $row['codigopostal'] ?>"/></td>
                                    </tr>
                                </table>
                                <legend>Contacto</legend>
                                <table>
                                    <tr>
                                        <td class="title1"><p>E-mail</p></td>
                                        <td><input type="text" id="email" name="email" value="<?php echo $row['email'] ?>"/></td>
                                    </tr>
                                    <tr>
                                        <td class="title1"><p>Teléfono Móvil</p></td>
                                        <td><input type="text" id="movil" name="movil" value="<?php echo $row['movil'] ?>"/></td>
                                    </tr>
                                    <tr>
                                        <td class="title1"><p>Teléfono Fijo</p></td>
                                        <td><input type="text" name="fijo" id="fijo" value="<?php echo $row['telefono'] ?>"/><br/></td>
                                    </tr>
                                </table>
                                <legendContacto</legend>
                                <table>
                                    <tr>
                                        <td class="title1">Inscrito/a como Demandante:</td>
                                        <td><input type="checkbox" id="demandante"
                                            <?php
                                            /* Valida si no tiene o no ha registrado si tiene o no carnet */
                                            echo ($row['demandante'] == 'N') ? '' : (($row['demandante'] == NULL) ? 'checked="checked"' : 'checked="checked"');
                                            ?>/></td>
                                    </tr><tr>
                                        <td class="title1">Inscrito/a como Mejora de Empleo:</td>
                                        <td><input type="checkbox" id="mejora"
                                            <?php
                                            /* Valida si no tiene o no ha registrado si tiene o no carnet */
                                            echo ($row['mejora'] == 'N') ? '' : (($row['mejora'] == NULL) ? 'checked="checked"' : 'checked="checked"');
                                            ?>/></td>
                                    </tr><tr>
                                        <td class="title1">Cobra prestación:</td>
                                        <td><input type="checkbox" id="perceptor"
                                            <?php
                                            /* Valida si no tiene o no ha registrado si tiene o no carnet */
                                            echo ($row['perceptor'] == 'N') ? '' : (($row['perceptor'] == NULL) ? '' : 'checked="checked"');
                                            ?>/></td>
                                    </tr><tr>
                                        <td class="title1">Discapacidad y Certificado:</td>
                                        <td><input type="checkbox" id="discapacidad"
                                            <?php
                                            /* Valida si no tiene o no ha registrado si tiene o no carnet */
                                            echo ($row['discapacidad'] == 'N') ? '' : (($row['discapacidad'] == NULL) ? '' : 'checked="checked"');
                                            ?>/></td>
                                    </tr><tr>
                                        <td class="title1">Porcentaje:</td>
                                        <td><input type="text" name="disca" maxlength="5" size="3"  id="disca"
                                            <?php
                                            //Valida si no tiene o no ha registrado un grado de discapacidad
                                            echo ($row['grado'] == '0') ? ' value="0"' : (
                                                    ($row['grado'] == NULL) ? ' value="0"' :
                                                            'value="' . $row['grado'] . '"');
                                            ?> style="text-align:right;"/>%</td>
                                    </tr><tr>
                                        <td class="title1">Acude a servicios sociales:</td>
                                        <td><input type="checkbox" id="consejalia"
                                            <?php
                                            /* Valida si no tiene o no ha registrado si tiene o no carnet */
                                            echo ($row['consejalia'] == 'N') ? '' : (($row['consejalia'] == NULL) ? '' : 'checked="checked"');
                                            ?>/></td>
                                    </tr><tr>
                                        <td class="title1">U.T.S:</td>
                                        <td><input type="checkbox" id="uts"
                                            <?php
                                            /* Valida si no tiene o no ha registrado si tiene o no carnet */
                                            echo ($row['uts'] == 'N') ? '' : (($row['uts'] == NULL) ? '' : 'checked="checked"');
                                            ?>/></td>
                                    </tr><tr>
                                        <td class="title1">Inmigrante:</td>
                                        <td><input type="checkbox" id="inmigrante"
                                            <?php
                                            /* Valida si no tiene o no ha registrado si tiene o no carnet */
                                            echo ($row['inmigrante'] == 'N') ? '' : (($row['inmigrante'] == NULL) ? '' : ' checked="checked"');
                                            ?>/></td>
                                    </tr>
                                    <tr>
                                        <td><input type="button" name="guardar" value="Guardar" id="guardar" class="enviar" onclick="cambio()"/></td>
                                        <td><input type="submit" name="finalizar" value="Finalizar" id="cancelar" class="enviar"/></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><p id="result"></p></td>
                                    </tr>
                                </table>
                            </form>           
                        </div>  
                    </div>
                </section>
            </section>
        </div>
        <?php include ('footer.php'); ?>
    </body>
</html>