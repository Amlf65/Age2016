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
        <link rel="stylesheet" type="text/css" href="css/gesof.css"/>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script>
            $(function () {
                $(".boton").bind("click", function () {//Si se hace click en .boton
                    $(this).text($(this).text() == "MÁS" ? "MENOS" : "MÁS");//MÁS cambia 
                    $(this).prev().slideToggle();//El contenido previo se despliega o se contrae
                });
            });
            function borrar(origen, cod) {
                var codigo = {
                    "codigo": cod, "origen": origen.value
                };
                $.ajax({
                    data: codigo, //datos que se envian
                    url: 'emp_borof.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    beforeSend: function () {
                        $(origen).val("PROCESANDO...");
                    }
//                   , success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
//                        $('#ajaxcand').html(response);
//                    }
                });
            }
        </script>
    </head>
    <body>
        <div id="contenedor1">
            <?php
            include 'header.php';
            include 'conexion.php';
            if (!isset($_SESSION['CIF'])) {
                header('location:emp_acc.php');
            }
            $sql = "SELECT * FROM `empresa` WHERE `cif`='" . $_SESSION['CIF'] . "'";
            $result = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            ?>   
            <section id="contenido"> 
                <div id="ofertas">
                    <div id="ajaxofer">
                        <form method="post">
                            <div id="buscador"> 
                                <input type="text" name="busqueda" id="busqueda" style="width: 84%;"value="">
                                <input type="submit" name="buscar" id="buscar" value="BUSCAR">
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['busqueda'])) {
                            //Sentencia SQL que obtiene los contenidos por orden
                            $sqlofer = "SELECT * FROM `ofertas` WHERE `cif`='" . $_SESSION['CIF'] . "' AND `titulo` LIKE '%" . $_POST['busqueda'] . "%'";
                            $resultofer = mysqli_query($conexion, $sqlofer);
                            //Imprimimos los distintos resutlados
                            while ($rowofer = mysqli_fetch_array($resultofer, MYSQLI_ASSOC)) {
                                echo '<div class="oferta">
                                        <p>' . $rowofer['titulo'] . '</p>
                                        <table>
                                            <form>
                                                <input type="text" name="codigo" value="' . $rowofer['codigo'] . '" style="display:none;"/>
                                                <tr>
                                                    <td>Descripcion:</td>
                                                    <td>' . $rowofer['descripcion'] . '</td>
                                                </tr>
                                                                                                <tr>
                                                    <td>Nivel Formativo:</td>
                                                    <td>';
                                switch ($rowofer['nivelformativo']) {
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
                                echo '</td>
                                                </tr>
                                                <tr>
                                                    <td>Otros Datos:</td>
                                                    <td>' . $rowofer['observaciones'] . '</td>
                                                </tr>
                                                <tr>                  
                                                    <td><a href="oferta.php?codigo=' . $rowofer['codigo'] . '"><input type="button" name="info" value="+Info"/></a></td>
                                                    <td><a href="emp_actof.php?codigo=' . $rowofer['codigo'] . '"><input type="button" name="modif" value="Actualizar"/></a></td>
                                                    <td><a href="emp_borof.php?codigo=' . $rowofer['codigo'] . '">
                                                        <form><input type="text" name="codigo" value="' . $rowofer['codigo'] . '" style="display:none;"/>
                                                        <input type="button" class="borrar" name="cancelar" value="Eliminar" onclick="borrar(this,codigo.value)"></form></a>
                                                    </td>
                                                </tr>
                                            </form>
                                        </table>
                                        <button class="boton">MÁS</button>
                                        <br/>
                                    </div>';
                            }
                        } else {
                            //Sentencia SQL que obtiene los contenidos por orden
                            $sqlofer = "SELECT * FROM `ofertas` WHERE `cif`='" . $_SESSION['CIF'] . "'";
                            $resultofer = mysqli_query($conexion, $sqlofer);
                            //Imprimimos los distintos resutlados
                            while ($rowofer = mysqli_fetch_array($resultofer, MYSQLI_ASSOC)) {
                                echo '<div class="oferta">
                                        <p>' . $rowofer['titulo'] . '</p>
                                        <table>
                                            <form>
                                                <input type="text" name="codigo" value="' . $rowofer['codigo'] . '" style="display:none;"/>
                                                <tr>
                                                    <td>Descripcion:</td>
                                                    <td>' . $rowofer['descripcion'] . '</td>
                                                </tr>
                                                <tr>
                                                    <td>Nivel Formativo:</td>
                                                    <td>';
                                switch ($rowofer['nivelformativo']) {
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

                                echo '</td>
                                                </tr>
                                                <tr>
                                                    <td>Otros Datos:</td>
                                                    <td>' . $rowofer['observaciones'] . '</td>
                                                </tr>
                                                <tr>                  
                                                    <td><a href="oferta.php?codigo=' . $rowofer['codigo'] . '"><input type="button" name="info" value="+Info"/></a></td>
                                                    <td><a href="emp_actof.php?codigo=' . $rowofer['codigo'] . '"><input type="button" name="modif" value="Actualizar"/></a></td>
                                                    <td><a href="emp_borof.php?codigo=' . $rowofer['codigo'] . '">
                                                        <form><input type="text" name="codigo" value="' . $rowofer['codigo'] . '" style="display:none;"/>
                                                
                                                        <input type="button" class="borrar" name="cancelar" value="Eliminar" onclick="borrar(this,codigo.value)"></form></a>
                                                    </td>
                                                </tr>
                                            </form>
                                        </table>
                                        <button class="boton">MÁS</button>
                                    </div>';

                                //Ejecutamos la primera consulta

                                if (isset($_POST['info'])) {
                                    $sql = "SELECT * FROM `ofertas` WHERE `codigo`='" . $rowofer['codigo'] . "'";
                                    $result = mysqli_query($conexion, $sql);
                                    header('location:oferta.php');
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
        <div style="position:relative; height: 100px; bottom:-262px !important;width:100%;">
                <?php include('footer.php') ?>
            </div>
    </body>
</html>