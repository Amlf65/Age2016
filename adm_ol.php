<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link rel="stylesheet" type="text/css" href="css/admin.css"/>
        <link rel= "stylesheet" type="text/css" href="css/formucss.css"/>
        <script type='text/javascript' src='js/jquery.js'></script>
        <script> 
            function cambicol(origen, cod) {
                
                
                if (origen.checked){
                      
                      if(document.getElementById("colocacion").innerHTML=="S"){
                document.getElementById("colocacion").innerHTML="N";
                origen.value = "N";
                origen.checked= false;
            }else{
                  
              document.getElementById("colocacion").innerHTML="S";  
              origen.value= "S";
              origen.checked= false;
            }
            
                var codigo = {
                    "dni": cod, "coloca": origen.value
                };
                $.ajax({
                    data: codigo, //datos que se envian
                    url: 'adm_act_ol1.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    beforeSend: function () {
                        $(origen).val("PROCESANDO...");
                    },
                    success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $('#ajaxcand').html(response);
                    }
                })};
            }
            function cambioori(origen, cod) {
                
                if (origen.checked){
                      var f = new Date();

                document.getElementById("orientacion").innerHTML=f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
              origen.checked= false;
           
            
                var codigo = {
                    "dni": cod, "fecha":  document.getElementById("orientacion").innerHTML
                };
                $.ajax({
                    data: codigo, //datos que se envian
                    url: 'adm_act_ol2.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    beforeSend: function () {
                        $(origen).val("PROCESANDO...");
                    },
                    success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $('#ajaxcand').html(response);
                    }
                })};
            
            }
            function cambioact(origen, cod) {
                
                if (origen.checked){
                      var f = new Date();

                document.getElementById("actualizacion").innerHTML=f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
              origen.checked= false;
           
            
                var codigo = {
                    "dni": cod, "fecha":  document.getElementById("actualizacion").innerHTML
                };
                $.ajax({
                    data: codigo, //datos que se envian
                    url: 'adm_act_ol3.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    beforeSend: function () {
                        $(origen).val("PROCESANDO...");
                    },
                    success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $('#ajaxcand').html(response);
                    }
                })};
            
            }
        
        </script>
    </head>
    <body>
        <div id="contenedor1">
            <?php include 'header.php';?>
            <div id="imgempresaa"><img src="img/admin.jpg"/></div>
            <div id="contenido">
                <div style="clear:both"></div>
                <h1 style="text-align: center;"> ORIENTACIÓN LABORAL</h1>
                <form method="post">
                    <div class="empresa">
                        <legend>Introduzca el DNI del usuario</legend><br>
                        <div>
                            <table style="text-align: center;">
                                <tr><td style="background: #fff; border: 0px solid white;"><span><strong>DNI</strong></span><br></td></tr>
                                <tr><td style="background: #fff; border: 0px solid white;"><input type="text" id="dni" name="dni"/><br></td></tr>
                            </table>
                        </div>
                        <div style="text-align: center;">
                            <input type="submit" style="width: 30%; margin-bottom:2%;" name="consultar" value="CONSULTAR"/>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_POST['consultar'])) {
                    $sql = "SELECT * FROM `demandantes` WHERE dni=\"" . $_POST['dni'] . "\";";
                    $result = mysqli_query($conexion, $sql);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    if ($row['dni'] == null) {
                        echo '<br/>El dni no se corresponde con la base de datos.';
                        
                    } else {
                        $date = date_create($row['orientacion']);
                        $date1 = date_create($row['fechaactualizacion']);
                ?>
                
                <div id="admol">
                    <form method="post" >
                        <table>
                            <tr>
                                <th> Nombre </th>
                                <th> Colocación </th>
                                <th> Orientación </th>
                                <th> Actualización </th>
                            </tr><tr>
                                
                                <td  rowspan="2"> <?php echo $row['nombre']; ?></td>
                                <td><span id="colocacion"><?php echo $row['colocacion']; ?> </span></td>
                                <td><span id="orientacion"> <?php echo date_format($date, 'd/m/Y');   ?></span> </td>
                                <td><span id="actualizacion"> <?php echo date_format($date1, 'd/m/Y'); ?></span></td>
                            </tr><tr>
                                <td><input type="checkbox" name="col" id="col" value="<?php echo $row['colocacion']; ?>" onclick="cambicol(this, '<?php echo $row['dni']; ?>')"/></td>
                                <td><input type="checkbox" name="ori" id="ori" value="<?php echo $row['orientacion']; ?>" onclick="cambioori(this, '<?php echo $row['dni']; ?>')"/></td>
                                <td><input type="checkbox" name="act" id="act" value="<?php echo $row['fechaactualizacion']; ?>" onclick="cambioact(this,'<?php echo $row['dni']; ?>')"/></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
                    <?php
                    //action="registro_ol.php"
                }
            }
            if (isset($_POST['guardar'])) {

                if (isset($_POST['colocacion']))
                    $coloca = 'S';
                else
                    $coloca = 'N';
                if (isset($_POST['orientacion']))
                    $ori = 'AND orientacion=CURDATE()';
                else
                    $ori = '';
                //$dni=$_POST['dni'];
                $sql = "UPDATE `demandantes` SET `colocacion`='$coloca',$ori WHERE `dni`='" . $dni . "'";
                $result = mysqli_query($conexion, $sql);
                echo "Los datos han sido modificados correctamente";
            }// else {
            //echo "No se han guardado las modificaciones";
            //echo sql;
            //}
            ?>
        </div>
        <div style="width: 110%; position: relative; margin: 0 auto;">
        <?php include('footer.php');?>
        </div>
    </body>
</html>