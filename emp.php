<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link rel="stylesheet" type="text/css" href="css/interfazempre.css"/>
        <link rel="stylesheet" type="text/css" href="css/formucss.css"/>

    </head>
    <body>
        <div id="contenedor1">
            <?php
            include 'header.php';
            include 'conexion.php';
            if (!isset($_SESSION['CIF'])) {
                header('location:emp_acc.php');
            }
            //Ejecutamos la consulta
            $sql = "SELECT * FROM `empresa` "
                    . "WHERE `cif`='" . $_SESSION['CIF'] . "'";
            $resultados = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_array($resultados, MYSQLI_ASSOC);
            if (!isset($_SESSION['CIF'])) {
                header('Location:emp_acc.php');
                
            }
            ?>
            <div id="imgempresaa"><img src="img/imgempresaa.png" style="width:100%;"/></div>
            <br/><br/>
            <h1><?php
                // Enseñar nombre de empresa
            echo $row['nombre'];
                ?></h1>
            <table border="2">
                    <tr>
                        <td>Contacto</td>
                        <td><?php echo $row['personacontacto'];?></td>
                    </tr>
                    <tr>
                        <td>Localidad</td>
                        <td><?php echo $row['localidad'];?></td>
                    </tr>
                    <tr>
                        <td>Dirección</td>
                        <td><?php echo $row['direccion'];?></td>
                    </tr>
                    <tr>
                        <td>Código postal</td>
                        <td><?php echo $row['codigopostal'];?></td>
                    </tr>
                    <tr>
                        <td>Tipo de empresa</td>
                        <td><?php echo $row['tipoempresa'];?></td>
                    </tr>
                    <tr>
                        <td>Sector profesional</td>
                        <td><?php echo $row['sectorprofesional'];?></td>
                    </tr>
                    <tr>
                        <td>Teléfono</td>
                        <td><?php echo $row['telefono'];?></td>
                    </tr>
                    <tr>
                        <td>Móvil</td>
                        <td><?php echo $row['movil'];?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $row['email'];?></td>
                    </tr>
                    <tr>
                        <td>Gerente</td>
                        <td><?php echo $row['gerente'];?></td>
                    </tr>
            </table>

            <div id="opciones">
                
                <div id="oferta">
                    <div id="imgen">
                        <a href="form_oferta.php"><img src="img/i1.png"/></a>
                    </div>
                    <h3>Publicar oferta</h3>
                </div>  

                <div id="modper">
                    <div id="imgen">
                        <a href="emp_actda.php" target="blank"><img src="img/i2.png"/></a>
                    </div>
                    <h3>Actualizar perfil</h3>
                </div>

                <div id="modfer">
                    <div id="imgen">
                        <a href="emp_gesofer.php"><img src="img/i4.png"/></a>
                    </div> 
                    <h3>Gestionar ofertas</h3>
                </div>
            </div>
            <br/><br/>
                <div style="width: 110%; position: relative; right: 5%;">
            <?php include('footer.php') ?>
        </div>
    </body>
</html>
