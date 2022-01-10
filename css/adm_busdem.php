<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel= "stylesheet" type="text/css" href="css/formucss.css"/>   
        <link rel="stylesheet" type="text/css" href="css/general.css"/> 
        <link rel="stylesheet" type="text/css" href="css/admin.css"/>
    </head>
    <body>
        <div id="contenedor1">
            <?php
            include 'header.php';
            include 'conexion.php';
            ?>
            <br/>
            <div id="imgempresaa"><img src="img/admin.jpg" width="100%;"/></div>
            <legend>Buscar demandante</legend>
            <div id="busdem">
                <form method="post">
                    <table style="margin: 0 auto; border: 2px solid #ADC8F2;">
                        <br>
                        <tr>
                            <td class="title1">Nivel formativo</td>
                            <td><select name="nivelformativo" style="height: 25px;">
                                    <option value= "" selected="selected">- Elija una opción -</option>
                                    <option value="00">Sin estudios</option>
                                    <option value="10">Estudios Primarios</option>
                                    <option value="20">Estudios Secundarios</option>
                                    <option value="30">Estudios Post-Universitarios</option>
                                </select>
                            </td>
                        </tr>
                        <tr> 
                            <?php
                            $sql = "SELECT * FROM `perfilesprofesionales`";
                            $result = mysqli_query($conexion, $sql);
                            ?>
                            <td class="title1">Perfiles profesionales</td>
                            <td>
                                <input id="lista1" list="formacion1" style="height: 20px; width: 75%;"  name="perfil1">
                                <datalist id="formacion1">
                                    <?php
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo '<option value="' . $row['perfilprofesional'] . '">';
                                    }
                                    ?>
                                </datalist>
                            </td>
                        </tr>
                        <tr>
                            <td class="title1">Carnet de conducir</td>
                            <td><input type="checkbox" name="carnetconducir"/></td>
                        </tr>
                        <tr>
                            <td class="title1">Vehículo propio</td>
                            <td><input type="checkbox"  name="vehiculopropio"/></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="submit">
                                    <input type="submit" value="BUSCAR" name="buscar" onblur=""/> 
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php
            if (isset($_POST['buscar'])) {
                $sql1= "SELECT * FROM demandantes WHERE 1";
                //Añadimos el filtrado
                if($_POST['nivelformativo']!=""){ $sql1 = $sql1 . " AND demandantes.nivelformativo='".$_POST['nivelformativo']."'";}
                if($_POST['perfil1'] != ""){ $sql1 = $sql1 . " AND dni IN(SELECT demperpro.dni FROM demperpro INNER JOIN perfilesprofesionales ON demperpro.codigo = perfilesprofesionales.codigo WHERE perfilprofesional='".$_POST['perfil1']."')"; }
                if (isset($_POST['vehiculopropio'])){ $sql1= $sql1 ." AND demandantes.vehiculopropio='S'"; }
                $sql1= $sql1 . " ORDER BY fechaactualizacion DESC LIMIT 100";
                $result = mysqli_query($conexion, $sql1);
                mysqli_num_rows($result);
                echo    '<div id="busemp">
                            <table border=1px solid black; style="margin:20px;">
                                <tr>
                                    <th>DNI </th>
                                    <th>Nombre </th>
                                    <th>Telefono </th>
                                    <th>Carnet de conducir </th>
                                    <th>Vehiculo Propio </th>
                                    <th>Nivel formativo </th>
                                    <th>Perfil Profesional</th>
                                    <th>Currículum</th>
                                </tr>';
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    
                           echo '<tr>
                                    <td>' . $row['dni'] . '</td>
                                    <td>' . $row['nombre'] . '</td>
                                    <td>' . $row['telefono'] . '</td>
                                    <td>' . $row['carnetconducir'] . '</td>
                                    <td>' . $row['vehiculopropio'] . '</td>
                                    <td>';
                                    switch ($row['nivelformativo']) {
                                    case 00:
                                        echo "Sin estudios";
                                        break;
                                    case 10:
                                        echo "Estudios Primarios";
                                        break;
                                    case 20:
                                        echo "Estudios Secundarios";
                                        break;
                                    case 30:
                                        echo "Estudios Post-secundarios";
                                        break;
                                }
                                echo '</td>
                                    <td>'; // $row['perfilprofesional'] .
                                    $sqlpf = "SELECT `perfilesprofesionales`.`perfilprofesional` FROM `perfilesprofesionales` inner join `demperpro` ON perfilesprofesionales.codigo = demperpro.codigo WHERE dni='" . $row['dni'] . "'";
                                    $resultpf = mysqli_query($conexion,$sqlpf);
                                    while ($rowpf = mysqli_fetch_array($resultpf, MYSQLI_ASSOC)) {
                                        echo $rowpf['perfilprofesional'];
                                    }
                                   echo ' </td>  
                                    <td>';
                                        echo "<a style='text-decoration: none;' title='CV' href='VerCurriculum.php?dni=". $row['dni'] ."' target='_blanck'>Ver CV</a>";
                              echo ' </td>
                                </tr>';
                }
                       echo '</table>
                       <div id="botton"><a style="text-decoration: none;" title="Descargar Excel" href="dat_exe.php?sql=';echo $sql1;echo '"> Descargar Excel </a></button><br></div>       
                        </div>';
                            //echo $sql1;
            }
            ?>
        </div>
        <div style="position:relative;left: 5%; width:98.5%;">
            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
