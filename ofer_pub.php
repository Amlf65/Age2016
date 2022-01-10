<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
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
            function buscador(busc) {
                if (busc.value == 'Buscar una oferta...') {
                    busc.value = '';
                }
                ;
            }
            function oferta(nofer, boton) {
                if (nofer.value == '' || /^\s+$/.test(nofer.value)) {
                    nofer.value = 'Buscar una oferta...';
                    boton.value = 'OFERTAS'
                }
                ;
            }
            function ofertas(boton) {
                boton.value = 'BUSCAR';
            }
        </script>
    </head>
    <body>
        <div id="contenedor1">
            <?php
            include 'conexion.php';
            include 'header.php';
            ?>   
            <section id="contenido"> 
                <div id="ofertas">
                    <form action="ofer_pub.php" method="post">
                        <div id="buscador"> 
                            <input type="text" name="busqueda" id="busqueda" value="Buscar una oferta..." onfocus="buscador(this)" onblur="oferta(this, buscar)" onkeypress="ofertas(buscar)"/>
                            <input type="submit" name="buscar" id="buscar" value="OFERTAS"/>
                        </div>
                    </form>
                    <div id="ajaxofer">
                        <?php
                        if (isset($_POST['busqueda']) && $_POST['busqueda'] != 'Buscar una oferta...') { //Sentencia SQL que obtiene los contenidos por orden
                        $sqlofer = "SELECT * FROM `ofertas` WHERE publicar='S' AND cerrada='N' AND `titulo` LIKE '%" . $_POST['busqueda'] . "%'";
                        $resultofer = mysqli_query($conexion, $sqlofer);
                        //Imprimimos los distintos resutlados
                        while ($rowofer = mysqli_fetch_array($resultofer, MYSQLI_ASSOC)) {
                        echo '<div class="oferta">
                                        <p>' . $rowofer['titulo'] . '</br> - Fecha - Empresa</p>
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
                                                                                                     
                                                </tr>
                                            </form>
                                        </table>
                                        <button class="boton">MÁS</button>
                                        <br/>
                                    </div>';
                        }
                        } else {
                        //Sentencia SQL que obtiene los contenidos por orden
                        $sqlofer = "SELECT * FROM `ofertas` WHERE `publicar` = 'S' AND cerrada='N'";
                        $resultofer = mysqli_query($conexion, $sqlofer);
                        //Imprimimos los distintos resutlados
                        while ($rowofer = mysqli_fetch_array($resultofer, MYSQLI_ASSOC)) {
                        echo '<div class="oferta">
                                        <p>' . $rowofer['titulo'] . '<br/> - Fecha - Empresa</p>
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
                                                    
                                                </tr>
                                            </form>
                                        </table>
                                        <button class="boton">MÁS</button>
                                    </div>';

                        //Ejecutamos la primera consulta
                        }
                        }
                        if (isset($_POST['info'])) {
                        $sql = "SELECT * FROM `ofertas` WHERE `codigo`='" . $rowofer['codigo'] . "'";
                        $result = mysqli_query($conexion, $sql);
                        header('location:oferta.php');
                        }
                        ?>
                    </div>
                </div>
            </section>
            <div style="position:relative; height: 100px; bottom:0 !important;width:110%; right: 5%;">
                <?php include('footer.php') ?>
            </div>
        </div>
    </body>
</html>