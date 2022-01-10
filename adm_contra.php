<?php
include 'conexion.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/admin.css"/>
        <link rel= "stylesheet" type="text/css" href="css/formucss.css"/>
        <link rel= "stylesheet" type="text/css" href="css/general.css"/>
    </head>
    <body>
        <div id="contenedor1">
            <?php
            include 'header.php';
            include ('conexion.php');
            if (!isset($_SESSION['admin'])) {
                header('location:admin.php');
            }
            ?>
            <div id="imgempresaa"><img src="img/admin.jpg" alt="imagen principal de administrador"/></div>
            <div id="contenido">
                <div style="clear:both"></div>
                <form method="post">
                    <div class="empresa">
                        <legend>Introduzca el DNI</legend><br>
                        <div id="table1">
                            <table style="text-align: center;">
                                <tr>
                                    <td style="background: #fff; border: 0px solid white;"><span><strong>DNI</strong></span><br></td>
                                </tr>
                                <tr>
                                    <td style="background: #fff; border: 0px solid white;"><input type="text" id="dni" style="height: 25px;" name="dni"/><br></td>
                                </tr>
                            </table>
                        </div>
                        <div style="text-align: center;">
                            <input type="submit" style="width: 30%; margin-bottom:2%;" name="enviar" value="BUSCAR"/>
                        </div>

                        <legend>Introduzca el CIF</legend><br>
                        <div id="table2">
                            <table style="text-align: center;">
                                <tr>
                                    <td style="background: #fff; border: 0px solid white;"><span><strong>CIF</strong></span><br></td>
                                </tr>
                                <tr>
                                    <td style="background: #fff; border: 0px solid white;"><input type="text" id="dni" style="height: 25px;" name="cif"/><br></td>
                                </tr>
                            </table>
                        </div>
                        <div style="text-align: center;">
                            <input type="submit" style="width: 30%; margin-bottom:2%;"name="enviar2" value="BUSCAR"/>
                        </div>
                    </div>
                </form>
            </div>
            <?php
            if (isset($_POST['enviar'])) {
                $sql = "SELECT contrasena FROM `demandantes` WHERE dni=\"" . $_POST['dni'] . "\";";
                $result = mysqli_query($conexion, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($row == null) {
                    echo '<br/>El dni no se corresponde con la base de datos.';
                } else {
                    ?>  
                    <div id="table1">

                        <table>
                            <tr> <?php echo "<br/>La contraseña del usuario introducido es " . $row['contrasena'] . "."; ?> </tr>
                        </table>
                    </div>  
                    <?php
                }
            } else
            if (isset($_POST['enviar2'])) {
                $sql = "SELECT contrasena FROM `empresa` WHERE cif=\"" . $_POST['cif'] . "\";";
                $result = mysqli_query($conexion, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($row == null) {
                    echo '<br/>El cif no se corresponde con la base de datos.';
                } else {
                    ?>  
                    <div id="table1">

                        <table>
                            <tr> <?php echo "<br/>La contraseña de la empresa introducida es " . $row['contrasena'] . "."; ?> </tr>
                        </table>
                    </div>  
                    <?php
                }
            }
            ?>
        </div>
        <footer style="position:relative; height: 100px; bottom:0 !important;width:90%;">
                <div style="display: inline-block;width: 30%;height: 66px;font-family: 'Helvetica';">
                <strong><img id='imgTelefono' src="img/telefono.png" alt="Icono de teléfono"/> 828-013-600</strong><br>
                C/Juan Diego de la Fuente Nº38-40, 35200 TELDE<br>
                agenciadecolocacionmunicipal@telde.es
            </div>
            <div style="display: inline-block;width: 34%;font-family: 'Helvetica';margin: 0 auto;">
                <a href="#"><img class="redes" style="position: relative; left: 45%;" src="img/twitter.png" alt="Twitter"></a>
                <a href="#"><img class="redes" style="position: relative; left: 45%;" src="img/facebook.png" alt="Twitter"></a>
            </div>
            <div style="display: inline-block;width: 30%;height: 66px;font-family: 'Helvetica';">
                <iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d880.7399237392871!2d-15.417648870816809!3d27.995129498917088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2a61fa10329fce18!2sOficina+de+Empleo+Telde!5e0!3m2!1ses!2ses!4v1500978514202" title="Ubicación de la Agencia de colocación" allowfullscreen></iframe>
            </div>
        </footer>
    </body>
</html>