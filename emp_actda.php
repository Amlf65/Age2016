<!DOCTYPE html>
<html lang="es">
    <head>
        <title>TU AGENCIA DE COLOCACIÓN</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link rel="stylesheet" type="text/css" href="css/interfazempre.css"/>
        <link rel="stylesheet" type="text/css" href="css/formucss.css"/>
        <link type='text/css' href='css/demo.css' rel='stylesheet' media='screen'/>
        <link type='text/css' href='css/basic.css' rel='stylesheet' media='screen'/>
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <!-- Modal -->
        <script type='text/javascript' src='js/jquery.js'></script>
        <script type='text/javascript' src='js/jquery.simplemodal.js'></script>
        <script type='text/javascript' src='js/basic.js'></script>
        <script>
            function actContra(vieja, nueva, nueva2) {
                if (vieja == nueva && nueva == nueva2) {
                    document.getElementById('contraresul').innerHTML = 'La contraseña antigua no debe coincidir con la nueva contraseña';
                } else if (nueva == nueva2) {
                    var parametros = {
                        "contrasena": vieja, "nueva": nueva
                    };
                    $.ajax({
                        data: parametros, //datos que se envian a traves de ajax
                        url: 'emp_dat.php', //archivo que recibe la peticion
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
        <div id="contenedor1">
            <?php
            include 'header.php';
            include 'conexion.php';
            if (!isset($_SESSION['CIF'])) {
                header('location:emp_acc.php');
            }
            $sql = "SELECT * FROM `empresa` "
                    . "WHERE `cif`='" . $_SESSION['CIF'] . "'";
            //Ejecutamos la consulta
            $resultados = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_array($resultados, MYSQLI_ASSOC);
            if (!isset($_SESSION['CIF'])) {
                header('Location:emp_acc.php');
            }
            ?>

            <div id="imgempresaa" style="position: relative; left: 10%;"><img src="img/imgempresaa.png"/></div>
            <br/><br/>
            <section>
                <div id="datos">

                    <legend>Mi Perfil</legend>  
                    <form method="post" action="emp_dat.php">
                        <table id="empperfil">   

                            <tr>
                                <td class="title3">Nombre</td>
                                <td><input type="text" name="nombre" value="<?php echo $row['nombre'] ?> "></td>
                            </tr>                        
                            <tr>
                                <td class="title3">Contacto </td>
                                <td><input type="text" name="personacontacto" value="<?php echo $row['personacontacto'] ?> "></td>
                            </tr>                         
                            <tr>
                                <td class="title3">Localidad</td>
                                <td><input type="text" name="localidad" value="<?php echo $row['localidad'] ?> "></td>
                            </tr>                    
                            <tr>
                                <td class="title3">Dirección</td>
                                <td><input type="text" name="direccion" value="<?php echo $row['direccion'] ?> "></td>
                            </tr>                          
                            <tr>
                                <td class="title3">Código Postal</td>
                                <td><input type="text" name="codigopostal" value="<?php echo $row['codigopostal'] ?> "></td>
                            </tr>                            
                            <tr>
                                <td class="title3">Tipo de empresa</td>
                                <td><input type="text" name="tipoempresa" value="<?php echo $row['tipoempresa'] ?> "></td>
                            </tr>                        
                            <tr>
                                <td class="title3">Sector profesional</td>
                                <td><input type="text" name="sectorprofesional" value="<?php echo $row['sectorprofesional'] ?> "></td>
                            </tr>                          
                            <tr>
                                <td class="title3">Teléfono</td>
                                <td><input type="text" name="telefono" value="<?php echo $row['telefono'] ?> "></td>
                            </tr>                           
                            <tr>
                                <td class="title3">Móvil</td>
                                <td><input type="text" name="movil" value="<?php echo $row['movil'] ?> "></td>
                            </tr>                            
                            <tr>
                                <td class="title3">Email</td>
                                <td><input type="text" name="email" value="<?php echo $row['email'] ?> "></td>
                            </tr>
                            <tr>
                                <td class="title3">Gerente</td>
                                <td><input type="text" name="gerente" value="<?php echo $row['gerente'] ?> "></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" value="Actualizar" name="Actualizar" style="width: 45%; color: #5B5858;"></td>
                                <td></td>
                            </tr>
                        </table>        
                    </form>
                    <form>
                        <table id="empperfil">
                            <h3>Actualizar Contraseña</h3>
                            <tr>
                                <td class="title3">Contraseña Antigua</td>
                                <td><input type="password" id="contraVieja" name="contraVieja"></td>
                            </tr>
                            <tr>
                                <td class="title3">Nueva Contraseña</td>
                                <td><input type="password" id="contraNueva" name="contraNueva"></td>
                            </tr>
                            <tr>
                                <td class="title3">Repita Contraseña</td>
                                <td><input type="password" id="contraNueva2" name="contraNueva2"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="submit"><input type="submit" name="actualizar" style="width: 45%; color: #5B5858;" value="Actualizar" onclick="actContra(contraVieja.value, contraNueva.value, contraNueva2.value)"/></td>
                                <td></td>
                            </tr>
                        </table>
                        <div>
                            <p id="contraresul "></p>
                        </div><br>
                        <legend>Eliminar cuenta</legend>
                            <!-- MODAL -->
                            <div id='basic-modal'><br>

                                <button name="basic" class='basic' style="width: 45%;background-color: #ADC8F2;color: #5B5858;font-size: 13pt; font-weight: bold; text-align: center; width: 15%; padding: 0.3%;margin-bottom: 2%;">&nbsp;Eliminar&nbsp;</button>
                                <!-- Modal -->
                                <div id="basic-modal-content">
                                    <p style="text-decoration: none; color:black; 
                                       font-family: 'Libre Franklin', 'Helvetica', 'Neue helvetica', 'arial', 'sans-serif'; font-weight: bold; font-size:120%;text-align:center;">¿Está seguro de que desea eliminar la cuenta de forma permanente?</p><br>
                                    <p><a href="" style="font-size:120%;   color:blue; 
                                          font-family: 'Libre Franklin', 'Helvetica', 'Neue helvetica', 'arial', 'sans-serif';"><strong>Cancelar</strong></a></p>

                                    <p><a href="eliminaremp.php" style="font-size:120%;  color:red; 
                                          font-family: 'Libre Franklin', 'Helvetica', 'Neue helvetica', 'arial', 'sans-serif';"><strong> Aceptar</strong></a></p>
                                </div>
                                <!-- preload the images -->
                                <div style='display:none'>
                                    <img src='img/x.png' alt='' />
                                </div>
                                <!-- Fin de modal -->
                            </div>
                    </form>
                </div>
            </section>      
        </div>
        <?php include ('footer.php'); ?>
    </body>
</html>