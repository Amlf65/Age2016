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
                    </div>
                </form>
                <form method="post">
                    <div class="empresa">
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
                $sql = "SELECT * FROM `demandantes` WHERE dni=\"" . $_POST['dni'] . "\";";
                $result = mysqli_query($conexion, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($row == null) {
                    echo '<br/>El dni no se corresponde con la base de datos.';
                } else {
                header('Location: demandante.php?dni=' . $_POST['dni'] . '');
                } 
            }
            if (isset($_POST['enviar2'])) {
                $sql = "SELECT * FROM `empresa` WHERE cif=\"" . $_POST['cif'] . "\";";
                $result = mysqli_query($conexion, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($row == null) {
                    echo '<br/>El cif no se corresponde con la base de datos.';
                } else {
                header('Location: empresa.php?cif=' . $_POST['cif'] . '');
            } 
            }
            ?>
        </div>
        <div style="position:relative; height: 100px; bottom:-50px !important;width:100%; left: 5%;">
            <?php include('footer.php'); ?>
        </div>
    </body>
</html>


