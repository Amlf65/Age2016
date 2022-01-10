<!DOCTYPE html>
<html lang="es">
    <head>
        <title>TU AGENCIA DE COLOCACIÓN</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
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
            $sql = "SELECT * FROM `ofertas` WHERE `codigo`='$_GET[codigo]'";
            //Ejecutamos la consulta
            $resultados = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_array($resultados, MYSQLI_ASSOC);
            $sql2 = 'SELECT * FROM `perfilesprofesionales` WHERE `codigo` LIKE \'_\' ORDER BY perfilprofesional';
            $sql3 = "SELECT * FROM `perfilesprofesionales`";
            $result3 = mysqli_query($conexion, $sql2);
            $result7 = mysqli_query($conexion, $sql3);
            $resultado = mysqli_query($conexion, $sql2);
            if (!isset($_SESSION['CIF'])) {
                header('Location:emp_acc.php');
            }
            ?>

            <div id="imgempresaa" style="position: relative; left: 10%;"><img src="img/imgempresaa.png"/></div>
            <br/><br/>
            <section>
                <div id="datos">
                    <form method="post" action=<?php echo "emp_dat_of.php?codigo=$_GET[codigo]" ?>>
                        <table id="empperfil">
                            <legend>ACTUALIZAR OFERTA</legend>                      
                            <tr>
                                <td class="title3">Título</td>
                                <td><input type="text" name="titulo" value="<?php echo $row['titulo'] ?>" ></td>
                            </tr>                        
                            <tr>
                                <td class="title3">Descripción </td>
                                <td><textarea type="text" name="descripcion" placeholder="<?php echo $row['descripcion'] ?>" cols="40" rows="5"></textarea></td>
                            </tr>                         
                            <tr>
                                <td class="title3">Requisitos</td>
                                <td><input type="text" name="requisitos" value="<?php echo $row['requisitos'] ?>"></td>
                            </tr>                    
                            <tr>
                                <td class="title3">Nivel Formativo</td>
                                <td>
                                    <select id="nivfor" name="nivelformativo" value=" <?php echo $row['nivelformativo']?>">
                                        
                                    <option value="" selected="selected"><?php
                                    switch ($row['nivelformativo']) {
                                        case 00:
                                            echo "Sin estudios";
                                            break;
                                        case 10:
                                            echo "Estudios primarios";
                                            break;
                                        case 20:
                                            echo "Estudios secundarios";
                                            break;
                                        case 30:
                                            echo "Estudios post-secundarios";
                                            break;
                                    }
                                    ?></option>
                                    <option value="00">Sin estudios</option>
                                    <option value="10">Estudios primarios</option>
                                    <option value="20">Estudios Secundarios</option>
                                    <option value="30">Estudios Post-Universitarios</option>
                                    </select></td>
                            </tr>                          
                            <tr>
                                <td class="title3">Perfil profesional</td>
                                <td><input id="lista7" list="formacion7" name="pf" value="">
                                    <datalist id="formacion7">
                                        <?php
                                        while ($row7 = mysqli_fetch_array($result7, MYSQLI_ASSOC)) {
                                            echo '<option value="' . $row7['perfilprofesional'] . '">';
                                        }
                                        ?>
                                    </datalist>
                                </td>                       
                            </tr>
                            <tr>
                                <td class="title3">Carnet de Conducir</td>
                                <td><input type="checkbox" name="carnetconducir" value="<?php if (isset($_POST['carnetconducir'])) $carnetconducir = 'S'; else $carnetconducir = 'N';
                                     echo ($carnetconducir == 'N') ? '<td><input  type="checkbox" name="carnet"/></td>': '<td><input type="checkbox" name="carnet" checked/></td>';?></td>
                            </tr>                        
                            <tr>
                                <td class="title3">Vehículo Propio</td>
                                <td><input type="checkbox" name="vehiculopropio" value="<?php if (isset($_POST['vehiculopropio'])) $vehiculopropio = 'S'; else $vehiculopropio = 'N';
                                     echo ($vehiculopropio == 'N') ? '<td><input  type="checkbox" name="vehiculo"/></td>': '<td><input type="checkbox" name="vehiculo" checked/></td>';?></td>
                            </tr>                          
                            <tr>
                                <td class="title3">Observaciones</td>
                                <td><textarea type="text" name="observaciones" placeholder="<?php echo $row['observaciones'] ?>" cols="40" rows="5"></textarea></td>
                            </tr>                           
                            <tr>
                                <td></td>
                                <td><input type="submit" style="width: 25%; color: #5B5858;"  value="Actualizar" name="Actualizar"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </section>      
        </div>
         <?php include ('footer.php'); ?>
    </body>
</html>