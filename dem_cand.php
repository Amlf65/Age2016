<!DOCTYPE html>
<html lang="es">
    <head>
        <title>TU AGENCIA DE COLOCACIÓN</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link rel="stylesheet" type="text/css" href="css/dem.css"/>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script>
            $(function () {
                $(".boton").bind("click", function () {//Si se hace click en .boton
                    $(this).text($(this).text() == "MÁS" ? "MENOS" : "MÁS");//MÁS cambia 
                    $(this).prev().slideToggle(1000);//El contenido previo se despliega o se contrae
                });
            });
            function borrar(origen, cod) {
                var codigo = {
                    "codigo": cod, "origen": origen.value
                };
                $.ajax({
                    data: codigo, //datos que se envian
                    url: 'dem_borcand.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    beforeSend: function () {
                        $(origen).val("PROCESANDO...");
                    },
                    success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $('#ajaxcand').html(response);
                    }
                });
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
            $sql = "SELECT * FROM `demandantes` "
                    . "WHERE `dni`='" . $_SESSION['DNI'] . "'";
            //Ejecutamos la consulta
            $resultados = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_array($resultados, MYSQLI_ASSOC);
            ?>
            <section id="contenido">                     
                <?php
                include 'dem_busc.php';
                include 'dem_aside.php';
                ?>
                <div id="candidaturas3">
                    <legend>Mis candidaturas</legend>
                    <div id="ajaxcand">
                        <?php
                        //Sentencia SQL que obtiene los contenidos por orden
                        $sqlcand = "SELECT * FROM `demofer` WHERE `dni`='" . $_SESSION['DNI'] . "'";
                        $resultcand = mysqli_query($conexion, $sqlcand);
                        if (mysqli_num_rows($resultcand) != 0) {
                            while ($rowcand = mysqli_fetch_array($resultcand, MYSQLI_ASSOC)) {
                                //Sentencia SQL para obtener información sobre la candidatura
                                $sqlcand2 = "SELECT * FROM `ofertas` WHERE `codigo`='" . $rowcand['codigo'] . "'";
                                $resultcand2 = mysqli_query($conexion, $sqlcand2);
                                $rowcand2 = mysqli_fetch_array($resultcand2, MYSQLI_ASSOC);
                                echo '<form>
                                        <div class="candidatura">
                                            <input type="text" name="codigo" value="' . $rowcand2['codigo'] . '" style="display:none;"/>
                                            <p class="titulo">' . $rowcand2['titulo'] . '</p>
                                            <p class="descp">' . $rowcand2['descripcion'] . '</p>
                                            <input type="button" name="cancelar" value="CANCELAR" onclick="borrar(this, codigo.value)">
                                            <p><strong>Fecha de inscripci&oacute;n</strong></p>
                                            <p class="obser">' . $rowcand2['observaciones'] . '</br><a href="oferta.php?codigo=' . $rowcand['codigo'] . '" class="cand_masinfo">+INFO</a></p>
                                            <p class="boton">MÁS</p>
                                        </div>
                                    </form>';
                            }
                        } else {
                            echo '<h1>No hay candidaturas</h1>';
                        }
                        //Ejecutamos la primera consulta
                        if (isset($_POST['info'])) {
                            $sql = "SELECT * FROM `ofertas` WHERE `codigo`='" . $rowcand['codigo'] . "'";
                            $result = mysqli_query($conexion, $sql);
                            header('location:oferta.php');
                        }
                        ?>
                    </div>
                </div>    
            </section>
        </div>        
        <div style="position:relative; height: 100px; bottom:-65px !important;width:100%;">
            <?php include('footer.php') ?>
        </div>
    </body>
</html>