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
                                    <option value="30">Estudios Post-Secundarios</option>
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
                            <?php
                            $sql2 = "SELECT * FROM `formacion`";
                            $result2 = mysqli_query($conexion, $sql2);
                            ?>
                            <td class="title1">Titulación</td>
                            <td><input id="lista1" list="formacion1" name="titulo1" style="height: 20px; width: 75%;" onchange="titulacion(this.getAttribute('id'))">
                                <datalist id="formacion1">
                                    <?php
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo '<option value="' . $row['titulo'] . '">';
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
                            <td class="title1">¿Tiene alguna Discapacidad?</td>
                            <td><input type="checkbox"  name="discapacidad"/></td>

                        </tr>
                        <tr>
                            <td class="title1">¿Acude a  Servicios Sociales? </td>
                            <td><input type="checkbox" name="consejalia"/></td>
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
                $sql1 = "SELECT * FROM demandantes WHERE 1";
                //Añadimos el filtrado
                if ($_POST['nivelformativo'] != "") {
                    $sql1 = $sql1 . " AND demandantes.nivelformativo='" . $_POST['nivelformativo'] . "'";
                }
                if ($_POST['perfil1'] != "") {
                    $sql1 = $sql1 . " AND dni IN(SELECT demperpro.dni FROM demperpro INNER JOIN perfilesprofesionales ON demperpro.codigo = perfilesprofesionales.codigo WHERE perfilprofesional='" . $_POST['perfil1'] . "')";
                }
                if (isset($_POST['carnetconducir'])) {
                    $sql1 = $sql1 . " AND demandantes.carnetconducir='S'";
                }
                if (isset($_POST['discapacidad'])) {
                    $sql1 = $sql1 . " AND demandantes.discapacidad='S'";
                }
                if (isset($_POST['consejalia'])) {
                    $sql1 = $sql1 . " AND demandantes.consejalia='S'";
                }
                $sql1 = $sql1 . " ORDER BY fechaactualizacion DESC LIMIT 100";
                $result = mysqli_query($conexion, $sql1);
                mysqli_num_rows($result);
                echo '<div id="busemp">
                            <table border=1px solid black; style="margin:20px;">
                                <tr>
                                    <th>DNI </th>
                                    <th>Nombre </th>
                                    <th>Telefono </th>
                                    <th>Carnet de conducir </th>
                                    <th>Discapacidad </th>
                                    <th>Acude a SS </th>
                                    <th>Nivel formativo </th>
                                    <th>Perfil Profesional</th>
                                    <th>Titulación</th>
                                    <th>Currículum</th>
                                </tr>';
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                    echo '<tr>
                                    <td>' . $row['dni'] . '</td>
                                    <td>' . $row['nombre'] . '</td>
                                    <td>' . $row['telefono'] . '</td>
                                    <td>' . $row['carnetconducir'] . '</td>
                                    <td>' . $row['discapacidad'] . '</td>
                                    <td>' . $row['consejalia'] . '</td>
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
                    $resultpf = mysqli_query($conexion, $sqlpf);
                    while ($rowpf = mysqli_fetch_array($resultpf, MYSQLI_ASSOC)) {
                        echo $rowpf['perfilprofesional'] ."<br>";
                    }
                    echo ' </td> 
                                    </td>
                                    <td>'; // $row['titulo'] .
                    $sqltit1 = "SELECT formacion.titulo FROM formacion INNER JOIN demfor ON formacion.codigo = demfor.codigo WHERE dni='" . $row['dni'] . "'";
                    $resulti1 = mysqli_query($conexion, $sqltit1);
                    while ($rowti = mysqli_fetch_array($resulti1, MYSQLI_ASSOC)) {
                        echo $rowti['titulo']."<br>";
                    }
                    echo ' </td> 
                                    <td>';
                    echo "<a style='text-decoration: none;' target='blank' title='CV' href='VerCurriculum.php?dni=" . $row['dni'] . "'>Ver CV</a>";
                    echo ' </td>
                                </tr>';
                }
                echo '</table>
                       <div id="botton"><a style="text-decoration: none;" title="Descargar Excel" href="dat_exe.php?sql=';
                echo $sql1;
                echo '"> Descargar Excel </a></button><br></div>       
                        </div>';
                //echo $sql1;
            }
            ?>
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