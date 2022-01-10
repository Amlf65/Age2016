<!DOCTYPE html>
<html lang="es">
    <head>
        <title>TU AGENCIA DE COLOCACIÓN</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link rel="stylesheet" type="text/css" href="css/ofemp.css"/>
        <link rel="stylesheet" type="text/css" href="css/formucss.css"/>    
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script>
            $(function () {
                $(".boton").bind("click", function () {//Si se hace click en .boton
                    $(this).text($(this).text() == "MÁS" ? "MENOS" : "MÁS");//MÁS cambia 
                    $(this).prev().slideToggle();//El contenido previo se despliega o se contrae
                });
            });
            function registrar(origen, cod) {
                if (origen.value != "Registrado") {
                    var codigo = {
                        "codigo": cod
                    };
                    $.ajax({
                        data: codigo, //datos que se envian a traves de ajax
                        url: 'dem_newofer.php', //archivo que recibe la peticion
                        type: 'post', //método de envio
                        beforeSend: function () {
                            $(origen).val("PROCESANDO...");
                        },
                        success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                            $(origen).val(response);
                        }
                    });
                }
            }
        </script>
    </head>
    <body>
        <?php
        include 'header.php';
        include 'conexion.php';
        $sql = "SELECT * FROM `ofertas` WHERE `codigo`='$_GET[codigo]'";
        $result = mysqli_query($conexion, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $row['cif'];
        $sqln = "SELECT * FROM `empresa`  where cif ='" . $row['cif'] . "'";

        $result2 = mysqli_query($conexion, $sqln);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        ?>
        <div id="ofertacontenedor">
            <div id="descripcion">
                <table>
                    <legend><h1><?php echo $row['titulo']; ?></h1></legend> 

                    <?php if ($row['visible'] == "S") {
                        echo "
                          <tr>
                            <td>
                                <h2>Empresa</h2>
                            </td>  
                          </tr>
                          <tr> 
                            <td>
                           " . $row2['nombre'] . "<br/>
                             " . $row2['direccion'] . "
                            </td>
                          </tr>";
                    }
                    ?>

                    <tr>
                        <td><h2>Descripción</h2></td>
                    </tr> 
                    <tr>
                        <td><?php echo $row['descripcion'] ?></td>
                    </tr>
                </table>
            </div>
            <div id="resto">
                <table>
                    <tr>
                        <td><h2>Requisitos</h2></td>
                    </tr>
                    <tr>
                        <td><?php echo $row['requisitos'] ?></td>
                    </tr>
                    <tr>
                        <td><h5 id="nivfor2">Nivel formativo</h5></td>
                    </tr>
                    <tr>
                        <td><?php
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
                            ?></td>
                    </tr>
                    <tr>
                        <td><h5 id="nivfor2">Perfil profesional</h5></td>
                    </tr>
                    <tr>
                        <td><?php echo $row['perfilprofesional']; ?></td>
                    </tr>
                    <tr>
                        <td><?php
                            if ($row['carnetconducir'] == "S") {
                                echo "<h5>Necesario el carnet de conducir</h5>";
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <td><?php
                            if ($row['vehiculopropio'] == "S") {
                                echo "<h5>Necesario vehículo propio</h5>";
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <td><h5 id="nivfor2">Observaciones</h5></td>
                    </tr>
                    <tr>
                        <td><?php echo $row['observaciones']; ?></td>
                    </tr>


                    <?php
                    if (isset($_SESSION['CIF'])) {
                        echo "<form><table id='botones'>
                                <tr>
                                   <td class='boton1'><a href='emp_gesofer.php'>OFERTAS</a></td>
                                   <td class='boton2'><a href='emp_actof.php?codigo=" . $row['codigo'] . "'>ACTUALIZAR</a></td>
                                </tr>";
                    } else if (isset($_SESSION['DNI'])) {
                        echo "<form><table id='botones'>
                                <tr>
                                    <input type='text' name='codigo' value='" . $row['codigo'] . "' style='display:none;'/>
                                    <td class='boton1'><a href='dem_ofer.php'>OFERTAS</a></td>
                                    <td class='boton2'><input type='button' id='registro' value='INSCRIBIRSE' onclick='registrar(this, codigo.value)'></td>
                                </tr>";
                    }
                    echo '</table></form>';
                    ?>   
                </table>
            </div>       
        </div>
        <div style="position:relative; height: 100px; bottom:-150px !important;width:110%; right: 5%;">
<?php include('footer.php') ?>
        </div>
    </body>
</html>