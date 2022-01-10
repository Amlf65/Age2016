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

    </head>
    <body>
        <div id="contenedor">
            <?php
            include ('header.php');
            include 'conexion.php';
            if (isset($_GET['cif'])) {
                
              
            $sql = "SELECT * FROM `empresa` WHERE `cif`='" . $_GET['cif']. "'";
            $result = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            ?>
            <section id="contenido">
                <section>
                    <div id="datos">
                        <legend>Mis Datos</legend>
                        <table>
                            <tr>
                                <td class="title1">CIF:</td>
                                <td><?php echo $row['cif'] ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Contraseña:</td>
                                <td><?php echo  $row['contrasena'] ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Nombre:</td>
                                <td><?php echo $row['nombre'] ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Persona contacto: </td>
                                <td><?php echo $row['personacontacto'] ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Localidad:</td>
                                <td><?php echo (isset($row['localidad'])) ? $row['localidad'] : ''; ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Dirección:</td>
                                <td><?php echo (isset($row['direccion'])) ? $row['direccion'] : ''; ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Código postal:</td>
                                <td><?php echo (isset($row['codigopostal'])) ? $row['codigopostal'] : ''; ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Tipo empresa:</td>
                                <td><?php echo (isset($row['tipoempresa'])) ? $row['tipoempresa'] : '';  ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Sector profesional:</td>
                                <td><?php echo (isset($row['sectorprofesional'])) ? $row['sectorprofesional'] : '';  ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Teléfono fijo:</td>
                                <td><?php echo (isset($row['telefono'])) ? $row['telefono'] : ''; ?></td>
                            </tr>
                            <tr>
                                <td class="title1">Teléfono móvil:</td>
                                <td><?php echo (isset($row['movil'])) ? $row['movil'] : ''; ?></td>
                            </tr>
                            <tr>
                                <td class="title1">E-mail:</td>
                                <td><?php echo (isset($row['email'])) ? $row['email'] : ''; ?></td>
                            </tr>
                        </table>
                    </div>
                </section>
            </section>
        </div>
            <?php }include('footer.php') ?>
    </body>
</html>