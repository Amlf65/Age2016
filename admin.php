<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TU AGENCIA DE COLOCACIÓN</title>
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/index.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link rel= "stylesheet" type="text/css" href="css/formucss.css"/>
    </head>
    <body>
        <div id="contenedor1">
            <?php
            include 'header.php';
            include 'conexion.php';
            ?>
            <div id="contenido">
                <div class="empresa">
                    <form method="post">
                        <legend>Introduce los datos para iniciar sesión</legend><br/>
                        <div id="table1">
                            <table style="text-align: center;">
                                <tr>
                                    <td><span><strong>Usuario</strong></span><br/></td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="nombre"/><br/> </td>
                                </tr>
                                <tr>
                                    <td><span><strong>Contraseña</strong></span><br/></td>
                                </tr>
                                <tr>
                                    <td><input type="password" name="contradmin"/></td>
                                </tr>
                            </table>
                        </div>
                        <div style="text-align: center;">
                            <input type="submit" style="width: 25%; margin-bottom:2%;" name="enviar" value="Acceder"/><br/>
                            <a href="">¿Olvidó su usuario y contraseña?</a>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            if (isset($_POST['enviar'])) {
                $usu = $_POST['nombre'];
                $contra = $_POST['contraadmin'];
                $sql = "SELECT * FROM `administradores` WHERE admin=\"" . $_POST['nombre'] . "\";";
//Ejecutamos la consulta
                $result = mysqli_query($conexion, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
//Validación: 1º Si la consulta es correcta envía a la interfaz
                echo ($row != NULL) ? header('Location:adm.php') : (
                        //Si CIF y CONTRASEÑA están vacíos
                        ($usu == "" && $contra == "") ? "<p>Inserte usuario y contraseña.</p>" : (
                                //Si CIF está vacío
                                ($usu == "") ? "<p>Inserte usuario</p>" : (
                                        //Si CONTRASEÑA está vacío, o, la consulta es erronea
                                        ($usu == "") ? "<p>Inserte contraseña</p>" : "<p>El usuario y contraseña no coinciden.</p>")));
                //Variable $_SESSION
                session_start();
                $_SESSION['CIF'] = "0500000122";
                $_SESSION['admin'] = $row['admin'];
            }
            ?>
        </div> 
        <div style="position:absolute; bottom:0 !important;width:100%;">
            <?php include('footer.php') ?>
        </div>
    </body>
</html>