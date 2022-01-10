<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link rel= "stylesheet" type="text/css" href="css/admin.css"/>    
    </head>
    <body>
        <div id="contenedor1">
            <?php
            include 'conexion.php';
            include 'header.php';
            if (!isset($_SESSION['admin'])) {
                header('location:admin.php');
            }
            $sql = "SELECT * FROM `demandantes` "
                    . "WHERE `nombre`='" . $_SESSION['Nombre'] . "'";
            //Ejecutamos la consulta
            $resultados = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_array($resultados, MYSQLI_ASSOC);
            ?>
            <br/>
            <div id="imgadmin"><img src="img/admin.jpg" width="100%"/></div>
            <div id="admintable"><table>
                    </br>
                    </br>
                    </br>
                    </br>
                  
                    <tr>
                        <th>EMPRESAS</th>
                        <th>DEMANDANTES</th>
                    </tr>
                    <tr>
                        <td><a href="form_emp.php" style="text-decoration: none;">Registrar una empresa</a></td>
                        <td><a href="form_dem.php" style="text-decoration: none;">Registrar demandante</a></td>
                    </tr>
                    <tr>
                        <td><a href="adm_busemp.php" style="text-decoration: none;">Buscar empresas</a></td>
                        <td><a href="adm_busdem.php" style="text-decoration: none;">Buscar demandantes</a></td>
                    </tr>
                    <tr>
                        <td><a href="adm_gesofer.php" style="text-decoration: none;">Gestionar ofertas de empleo</a></td>
                        <td><a href="adm_contra.php" style="text-decoration: none;">Consultar contraseñas</a></td>
                    </tr>
                    <tr>
                        <td><a href="form_oferta.php" style="text-decoration: none;">Añadir oferta de empleo</a></td>
                        <td><a href="adm_ol.php" style="text-decoration: none;">Orientaci&oacute;n laboral</a></td>
                    </tr>
                </table>
            </div>
            <div id="trabajosFormacion2">
                <div id="cajaImagen">
                    <a style="text-decoration: none;" title="GestionNoticias" href="/noti/wp-admin" target="black"><img src="img/noticias.png" alt="Gestión Noticias"/></a>
                </div>
                <a style="text-decoration: none;" title="GestionNoticias" href="/noti/wp-admin" target="black"><h3>GESTIÓN DE NOTICIAS</h3></a>
                <div id="cajaImagen">
                    <a style="text-decoration: none;" title="ConsultarFichas" href="adm_ficha.php" target="black"><img src="img/consultar.png" style="padding: 8%;" alt="Consultar Fichas"/></a>
                </div>
                <a style="text-decoration: none;" title="ConsultarFichas" href="adm_ficha.php" target="black"><h3>CONSULTAR FICHAS</h3></a>
            </div>
        </div>
    <br/>
    <div>
        <?php include('footer.php') ?>
    </div>
</body>
</html>




