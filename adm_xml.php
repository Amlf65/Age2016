<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/index.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link rel= "stylesheet" type="text/css" href="css/formucss.css"/> 
    </head>
    <body>
        <div id="contenedor1">
            <?php
            include('header.php');
            include ('conexion.php');
            if (!isset($_SESSION['admin'])) {
                header('location:admin.php');
            }
            ?>
            <div id="contenido">
                <form action="dat_xml.php" method="post">
                    <div class="empresa">
                        <legend> Introduce el mes y el a&ntilde;o: </legend>
                        <div id="tablexml" style="text-align: center; margin-bottom: 5%;"> 
                            <br/>
                            <select name="mes" id="mes" style="height: 25px;">
                                <option value="00" selected>--Selecciona--</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>    
                            </select>
                            <select name="anio" id="anio" style="height: 25px;">
                                <?php
                                for ($anio = (date("Y")); date("Y") - 2 <= $anio; $anio--) {
                                    echo "<option value=" . $anio . ">" . $anio . "</option>";
                                }
                                ?>
                            </select> 
                            
                            
                        </div>
                        <div class="submit" style="text-align: center;">
                            <input type="submit" style="width: 38%; margin-bottom:2%;" name="enviar" value="GENERAR XML" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div style="position:absolute; bottom:0 !important; width: 100%;">
        <?php include('footer.php') ?>
        </div>
    </body>
</html>
