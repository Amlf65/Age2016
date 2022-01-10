<!DOCTYPE html>
<html lang="es">
    <head>
        <title>TU AGENCIA DE COLOCACIÓN</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link rel="stylesheet" type="text/css" href="css/dem.css">
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
        <div id="contenedor">
            <?php
            include 'header.php';
            include 'conexion.php';
            if (!isset($_SESSION['DNI'])) {
                header('location:dem_acc.php');
            }
            $sql = "SELECT * FROM `demandantes` WHERE `dni`='" . $_SESSION['DNI'] . "'";
            $result = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            ?>   
            <section id="contenido">  
                <?php
                include 'dem_busc.php';
                include 'dem_aside.php';
                ?>

                <div id="ofertas">
                    <div id="ajaxofer">
                        <?php
                        if (isset($_POST['busqueda']) && $_POST['busqueda'] != "Buscar una oferta...") {
                            //Sentencia SQL que obtiene los contenidos por orden
                            $sqlofer = "SELECT * FROM `ofertas` WHERE `cerrada`='N' AND `publicar`='S' AND `titulo` LIKE '%" . $_POST['busqueda'] . "%' AND `codigo` NOT IN (SELECT `codigo`FROM `demofer` WHERE `dni`='" . $_SESSION['DNI'] . "')";
                            $resultofer = mysqli_query($conexion, $sqlofer);
                            //Imprimimos los distintos resutlados
                            if (mysqli_num_rows($resultofer) != 0) {
                                while ($rowofer = mysqli_fetch_array($resultofer, MYSQLI_ASSOC)) {
                                    echo '<div class="oferta">
                                                <p>' . $rowofer['titulo'] . ' - Fecha - Empresa</p>
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
                                                        $nivelformativo = ['No especificado' => '', 'Sin estudios' => '00', 'Estudios primarios' => '10', 'Estudios secundarios' => '20', 'Estudios post-secundarios' => '30'];
                                                        if ($rowofer['nivelformativo'] == NULL || $rowofer['nivelformativo'] == '') {
                                                            echo '';
                                                        } else {
                                                            foreach ($nivelformativo as $texto => $nivel) {
                                                                if ($nivel == $rowofer['nivelformativo']) {
                                                                    echo $texto;
                                                                } else {
                                                                    echo '';
                                                                }
                                                            }
                                                        }
                                                        echo '</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Otros Datos:</td>
                                                            <td>' . $rowofer['observaciones'] . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="button" name="registro" value="INSCRIBIRSE" onclick="registrar(this, codigo.value)"/></td>
                                                            <td><a href="oferta.php?codigo=' . $rowofer['codigo'] . '"><input type="button" name="info" value="+INFO"/></td>
                                                        </tr>
                                                    </form>
                                                </table>
                                                <button class="boton">MÁS</button>
                                            </div>';
                                }
                            } else {
                                echo '<h1>No hay resultados</h1>';
                            }
                        } else {
                            //Sentencia SQL que obtiene los contenidos por orden
                            $sqlofer = "SELECT * FROM `ofertas` WHERE `codigo` NOT IN (SELECT `codigo`FROM `demofer` WHERE `dni`='" . $_SESSION['DNI'] . "') AND `cerrada`='N' AND `publicar`='S'";
                            $resultofer = mysqli_query($conexion, $sqlofer);
                            //Imprimimos los distintos resutlados
                            while ($rowofer = mysqli_fetch_array($resultofer, MYSQLI_ASSOC)) {
                                echo '<div class="oferta">
                                                <p>' . $rowofer['titulo'] . ' - Fecha - Empresa</p>
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
                                                        $nivelformativo = ['No especificado' => '', 'Sin estudios' => '00', 'Estudios primarios' => '10', 'Estudios secundarios' => '20', 'Estudios post-secundarios' => '30'];
                                                        if ($rowofer['nivelformativo'] == NULL || $rowofer['nivelformativo'] == '') {
                                                            echo '';
                                                        } else {
                                                            foreach ($nivelformativo as $texto => $nivel) {
                                                                if ($nivel == $rowofer['nivelformativo']) {
                                                                    echo $texto;
                                                                } else {
                                                                    echo '';
                                                                }
                                                            }
                                                        }
                                                        echo '</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Otros Datos:</td>
                                                            <td>' . $rowofer['observaciones'] . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="button" name="registro" value="INSCRIBIRSE" onclick="registrar(this, codigo.value)"/></td>
                                                            <td><a href="oferta.php?codigo=' . $rowofer['codigo'] . '"><input type="button" name="info" value="+INFO"/></td>
                                                        </tr>
                                                    </form>
                                                </table>
                                                <button class="boton">MÁS</button>
                                            </div>';
                            }
                        }
                        //Ejecutamos la primera consulta
                        if (isset($_POST['info'])) {
                            $sql = "SELECT * FROM `ofertas` WHERE `codigo`='" . $rowofer['codigo'] . "'";
                            $result = mysqli_query($conexion, $sql);
                            header('location:oferta.php');
                        }
                        ?>
                    </div>
            </section>
        </div>
        <?php include ('footer.php'); ?>
    </body>
</html>
