<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel= "stylesheet" type="text/css" href="css/general.css"/>
        <link rel= "stylesheet" type="text/css" href="css/formucss.css"/>   
        <link rel="stylesheet" type="text/css" href="css/admin.css"/> 
    </head>
    <body>
        <div id="contenedor">
            <?php
            include 'header.php';
            include 'conexion.php';
            if (!isset($_SESSION['admin'])) {
                header('location:admin.php');
            }
            ?>
            <br/>
            <div id="imgempresaa"><img src="img/admin.jpg" alt="imagen principal de administrador"/></div>
            <legend>BUSCAR EMPRESAS</legend>
            <?php
            $sql = "SELECT * FROM `empresa`;";
            $result = mysqli_query($conexion, $sql);
            ?>
            <div id="busemp">
                <table style="margin: 20px; border:2px solid #ADC8F2;">
                    <tr>
                        <th>CIF</th>
                        <th>Nombre</th>
                        <th>Persona de contacto</th>
                        <th>Telefono</th>
                        <th>Tipo de empresa</th>
                        <th>Sector Profesional</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                        <tr>
                            <td> <?php echo $row['cif'] ?> </td>
                            <td> <?php echo $row['nombre'] ?> </td>
                            <td> <?php echo $row['personacontacto'] ?> </td>
                            <td> <?php echo $row['telefono'] ?> </td>
                            <td> <?php echo $row['tipoempresa'] ?> </td>
                            <td> <?php echo $row['sectorprofesional'] ?> </td>  
                        </tr>
                        
                    <?php } ?>     
                </table>
                <div id="botton"><a style="text-decoration: none;" title="Descargar Excel" href="dat_exe.php?sql=<?php echo $sql?>"> Descargar Excel </a></button><br></div> 
            </div>
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