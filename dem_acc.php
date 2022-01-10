<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Acceso Demandantes</title>      
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/general.css" />
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel= "stylesheet" type="text/css" href="css/formucss.css">
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
    </head>
    <body>
        <div id="contenedor">
            <?php
            include('header.php');
            include('conexion.php');
            ?>
            <div id="contenido">
                <form method="post">
                    <div class="empresa">
                        <legend>Acceso Demandantes</legend><br>
                        <div>
                            <table style="text-align: center;">
                                <tr>
                                    <td><span><strong>DNI</strong></span><br></td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="dni" name="cif"/><br></td>
                                </tr>
                                <tr>
                                    <td><span><strong>Contraseña</strong></span><br></td>
                                </tr>
                                <tr>
                                    <td><input type="password" name="contra" name="contra"/></td>
                                </tr>
                            </table>
                        </div>
                        <div style="text-align: center;">
                            <input type="submit" style="width: 25%; margin-bottom:2%;" name="enviar" value="Acceder"/><br/>
                            <a href="recuperar_contrasena.php">¿Olvidó su usuario y contraseña?</a>    
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_POST['enviar'])) {
                    $dni = $_POST['dni'];
                    $contra = $_POST['contra'];

                    //Ejecutamos la primera consulta
                    $sql1 = "SELECT * FROM `demandantes` WHERE `dni`='" . $_POST["dni"] . "'";
                    $result1 = mysqli_query($conexion, $sql1);
                    $row = mysqli_fetch_array($result1, MYSQLI_ASSOC);

                    //Ejecutamos la segunda consulta
                    $sql2 = "SELECT * FROM `demandantes` WHERE `dni`='" . $_POST["dni"] . "' AND `contrasena`='"
                            . $_POST["contra"] . "'";
                    $result2 = mysqli_query($conexion, $sql2);
                    $rowContrasena = mysqli_fetch_array($result2, MYSQLI_ASSOC);

                    //Si DNI y CONTRESANA estan vacios
                    echo ($dni == "" && $contra == "") ? "<p>Inserte DNI y contraseña.</p>" : (
                            //Si DNI esta vacio
                            ($dni == "") ? "<p>Inserte usuario</p>" : (
                                    //Si CONTRASENA esta vacio
                                    ($contra == "") ? "<p>Inserte contraseña</p>" : (
                                            //Si DNI no se encuentra
                                            ($row == NULL) ? "Usuario incorrecto" : (
                                                    //Si DNI y CONTRASNEA no se coinciden - Si todo va bien
                                                    ($rowContrasena == NULL) ? "Contraseña incorrecta" : header('Location:dem.php')))));
                    //Asignamos el DNI del demandante a la variable $_SESSION
                    $_SESSION['DNI'] = $row['dni'];
                }
                ?>
            </div>	
        </div>
        <div style="position:absolute; bottom:0 !important;width:100%;">
            <?php include('footer.php') ?>
			</div>
    </body>
</html>