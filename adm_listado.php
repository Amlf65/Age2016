
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/admin.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
    </head>
    <body>
        <div id="contenedor1">
            <?php
            include 'header.php';
            include 'conexion.php';
            if (!isset($_SESSION['admin'])) {
                header('location:admin.php');
            }
            ?>
            <h1>Usuarios inscritos en la oferta</h1>
                <div id="filtrar">
                    <?php
                    if(isset($_GET['codigo'])){
                    $sql = "SELECT * FROM `demandantes` WHERE `dni`IN(SELECT dni FROM demofer WHERE codigo=". $_GET['codigo'] .")";
                    $result = mysqli_query($conexion, $sql);
                    if (mysqli_num_rows($result)== 0){
                        echo "No hay usuarios inscritos";
                    }else {
                    
                    ?>
                    <div id="busemp">
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
                            </tr>
                    <?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {?>
                            <tr>
                                <td> <?php echo $row['dni'] ?></td>
                                <td><?php echo $row['nombre'] ?></td>
                                <td><?php echo $row['telefono'] ?></td>
                                <td><?php echo $row['carnetconducir'] ?></td>
                                <td><?php echo $row['vehiculopropio'] ?></td>
                                <td><?php  switch ($row['nivelformativo']) {
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
                                            } ?>
                                </td>
                                <td>
                                    <?php 
                                    $sqlpf = "SELECT `perfilesprofesionales`.`perfilprofesional` FROM `perfilesprofesionales` inner join `demperpro` ON perfilesprofesionales.codigo = demperpro.codigo WHERE dni='" . $row['dni'] . "'";
                                    $resultpf = mysqli_query($conexion, $sqlpf);
                                        for ($i = 0; $i < 3; $i++){
                                            $rowpf = mysqli_fetch_array($resultpf, MYSQLI_ASSOC);
                                            if(isset($rowpf['perfilprofesional']))echo  $rowpf['perfilprofesional'] . "<br>";
                                        }
                                    ?>
                                </td>
                                 </tr>
                    <?php }
                    echo '</table>
                       <div id="botton"><a style="text-decoration: none;" title="Descargar Excel" href="dat_exe.php?sql=';
                    echo $sql;
                    echo '"> Descargar Excel </a></button><br></div>       
                        </div>';
                    }}?>
                </table>
                </div>
        </div>
        </div>
                <?php 
                include 'footer.php'; ?>
                </body>
                </html>


