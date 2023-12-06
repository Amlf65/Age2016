<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Formulario</title>      
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/general.css" />
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel= "stylesheet" type="text/css" href="css/formucss.css">
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
    </head>
    <body>
        <?php include('header.php')?>
        <?php include('conexion.php')?>
        <div id="contenido">
            <form method="post">
                <div class="empresa">
                    <legend>Recuperación de Contraseña</legend><br>
                    <div id="table1">
                        <table >
                            Inserte su DNI:<br>
                            <input type="text" name="dni" name="dni"/><br>
                        </table>
                    </div>
                    <?php
                        //Consulta
                        if (isset($_POST['enviar'])) {
                            $dni=$_POST['dni'];
                            $sql="SELECT `Email`, `contrasena` FROM `demandantes` "
                                . "WHERE `DNI`='".$_POST["dni"]."'";
                            //Ejecutamos la consulta
                            $resultados= mysqli_query($conexion,$sql);
                            $fila= mysqli_fetch_array($resultados,MYSQLI_ASSOC);
                            $email = $fila['Email'];
                            echo $email;
                            $mensaje= "Buenas:\r\nSu contraseña es:".$fila['contrasena'];
                            //Validación: 1º Si la consulta es correcta envía a la interfaz
                            echo ($fila != NULL) ? mail($email, 'Recuperación de Contraseña', $mensaje, 'From: AgenciaTelde <info@address.com>') : (
                                //Si DNI está vacío
                                ($dni=="") ? "<p>Inserte DNI</p>" : "<p>DNI no registrado.</p>");
                        }
                    ?>
                    <div class="submit">
                        <input type="submit" name="enviar" value="Recuperar"/>
                    </div>
                </div>
            </form>
        </div>
        <?php include('footer.php')?>
    </body>
</html>