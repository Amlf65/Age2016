<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Acceso Empresas</title>      
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/general.css" />
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel= "stylesheet" type="text/css" href="css/formucss.css">
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
    </head>
    <body>
        <div id="contenedor">
        <?php include('header.php') ?>
        <?php include('conexion.php') ?>
        <div id="contenido">
            <form method="post">
                <div class="empresa">
                    <legend>Acceso Empresas</legend><br>
                    <div>
                        <table style="text-align: center;">
                            <tr>
                                <td><span><strong>CIF</strong></span><br></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="cif" /><br></td>
                            </tr>
                            <tr>
                                <td><span><strong>Contraseña</strong></span><br></td>
                            </tr>
                            <tr>
                                <td><input type="password" name="contra" /></td>
                        </tr>
                        </table>
                    </div>
                    <?php
                    if (isset($_POST['enviar'])) {
                        $cif = $_POST['cif'];
                        $contra = $_POST['contra'];
                        
                        //Ejecutamos la primera consulta
                        $sql1 = "SELECT * FROM `empresa` WHERE `cif`='" . $_POST["cif"] . "'";
                        $result1 = mysqli_query($conexion, $sql1);
                        $rowCIF = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                        
                        //Ejecutamos la segunda consulta
                        $sql2 = "SELECT * FROM `empresa` WHERE `cif`='" . $_POST["cif"] . "' AND `contrasena`='"
                                . $_POST["contra"] . "'";
                        $result2 = mysqli_query($conexion, $sql2);
                        $rowContrasena = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                        
                        //Si CIF y CONTRESANA estan vacios
                        echo ($cif == "" && $contra == "") ? "<p>Inserte CIF y contraseña.</p>" : (
                            //Si CIF esta vacio
                            ($cif == "") ? "<p>Inserte usuario</p>" : (
                                //Si CONTRASENA esta vacio
                                ($contra == "") ? "<p>Inserte contraseña</p>" : (
                                    //Si CIF no se encuentra
                                    ($rowCIF==NULL) ? "Usuario incorrecto" : (
                                        //Si CIF y CONTRASEÑA no coinciden - Si todo va bien
                                        ($rowContrasena==NULL)? "Contraseña incorrecta": header('Location:emp.php')))));
                        
                        session_start();
                        $_SESSION['CIF'] = $rowCIF['cif'];
                        $_SESSION['Nombre'] = $rowContrasena['nombre'];
                    }
                    ?>
                    <div style="text-align: center;">
                        <input type="submit" style="width: 25%; margin-bottom:2%;" name="enviar" value="Acceder"/><br/>
                        <a href="recuperar_contrasena.php">¿Olvidó su usuario y contraseña?</a>    
                    </div>
                </div>
            </form>
        </div>
        </div>
        <div style="position:absolute; bottom:0 !important;width:100%;">
            <?php include('footer.php') ?>
			</div>
    </body>
</html>