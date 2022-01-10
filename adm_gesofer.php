<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script>
            function cambio(self, codigo) {
                var publi=document.getElementById("publicar").value;
                var cerr=document.getElementById("cerrada").value;
                if (self.id=="publicar"){
                    if(publi=="N") {
                         publi = "S"; 
                         document.getElementById("publicar").value="S";
                    } else {
                         publi = "N";
                         document.getElementById("publicar").value="N";
                    }}
               if (self.id=="cerrada"){
                        if(cerr=="N") {
                         cerr = "S";
                         document.getElementById("cerrada").value="S";
                    } else {
                        cerr = "N";
                        document.getElementById("cerrada").value="N";
                 }
                }
                var parametros = {
                   "publi": publi, "cerr": cerr, "codigo": codigo
               };
                
                $.ajax({
                    data: parametros, //datos que se envian a traves de ajax
                    url: 'adm_act_gesofer.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    beforeSend: function () {
                        $("#prueba").html("Procesando, espere por favor...");
                    },
                    success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#prueba").html(response);
                    }
                });
            }
        </script>
    </head>
    <body>
        <div id="contenedor1">
            <?php
            include 'header.php';
            include 'conexion.php';
            ?>
            <br>
            <div id="imgadmin"><img src="img/admin.jpg" width="100%"/></div>
            <h1>Gestión de ofertas:</h1>
            <div id="tablaof">
                <form id="select1" name="oferta"  method="POST">
                    <div>
                        <select name="ofertas" style="width: 15.5%;" id="ofertas" onChange='document.oferta.submit()'>
                            <option value="">Seleccione una opción</option>
                            <option value="WHERE 1">Todas las ofertas</option>
                            <option value="WHERE cerrada='N'">Ofertas abiertas</option>
                            <option value="WHERE cerrada='S'">Ofertas cerradas</option>
                        </select>
                    </div><br/>
                </form>
            </div>
                <div id="filtrar">
                    <?php
                    if(!isset($_POST['ofertas'])) $resultado="WHERE 1"; else $resultado = $_POST['ofertas'];
                    $sql = "SELECT * FROM `ofertas`" . $resultado;
                    $result = mysqli_query($conexion, $sql);
                    ?>
                    <form  name="actu" method="post">
                    <table style="width:100%; background-color:white;text-align:center; border:1px double black;">
                        <tr>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Publicar</th>
                            <th>Cerrada</th>
                            <th>Usuarios Inscritos</th>
<?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                        </tr>
                            <tr>
                                <td><?php echo $row['titulo']?></td>
                                <td><?php echo $row['descripcion']?></td>
                                <?php /*Valida la oferta está publicada o no*/
                                /*Tengo una duda si rosaura quiere despublicar una oferta pero sin cerrarla como lo haria*/
                                echo ($row['publicar'] == 'N') ? '<td><input type="checkbox" id="publicar" name="publicar"  value="N" onclick="(cambio(this, '.$row['codigo'].'))"/></td>': '<td><input type="checkbox" id="publicar" name="publicar"  value="S" onclick="(cambio(this, '.$row['codigo'].'))" checked/></td>';
                                echo ($row['cerrada']  == 'N') ? '<td><input type="checkbox" id="cerrada"  name="cerrada" value="N" onclick="(cambio(this, '.$row['codigo'].'))"/></td>': '<td><input type="checkbox" id="cerrada" name="cerrada"  value="S" onclick="(cambio(this, '.$row['codigo'].'))" checked/></td>';
                                ?>
                                <td>
                                    <input type="hidden" name="codigo" value="<?php echo $row['codigo'];?>"/>
                                    <a href="adm_listado.php?codigo=<?php echo $row['codigo'];?>"/> Listado </a> </td>
<?php }?>
                            </tr>
                    </table>
                    
                    </form>
                </div>
        </div><p id="prueba"></p>
                <?php 
                
                include 'footer.php'; ?>
                </body>
                </html>