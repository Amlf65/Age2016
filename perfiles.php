<!DOCTYPE html>
<?php
    include 'conexion.php';
    $sql = 'SELECT * FROM `perfilesprofesionales` WHERE `codigo` LIKE \'_\'';
    $resultado = mysqli_query($conexion, $sql);
    $resultado2 = mysqli_query($conexion, $sql);
    $resultado3 = mysqli_query($conexion, $sql);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <title></title>
        <script language="javascript" src="js/jquery-3.2.1.min.js"></script>
        
        <script language="javascript">
    // SELECT 1a
            $(document).ready(function(){
                    $("#pf1a").change(function () {

                            //$('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                            $("#pf1a option:selected").each(function () {
                                    id_pf1a = $(this).val();
                                    $.post("sel/getpf1b.php", { id_pf1a: id_pf1a }, function(data){
                                            $("#pf1b").html(data);
                                    });            
                            });
                    })
            });
	// SELECT 1b 
            $(document).ready(function(){
                    $("#pf1b").change(function () {
                            $("#pf1b option:selected").each(function () {
                                    id_pf1b = $(this).val();
                                    $.post("sel/getpf1c.php", { id_pf1b: id_pf1b }, function(data){
                                            $("#pf1c").html(data);
                                    });            
                            });
                    })
            });
       
    // SELECT 2a
    $(document).ready(function(){
                    $("#pf2a").change(function () {

                            //$('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                            $("#pf2a option:selected").each(function () {
                                    id_pf2a = $(this).val();
                                    $.post("sel/getpf2b.php", { id_pf2a: id_pf2a }, function(data){
                                            $("#pf2b").html(data);
                                    });            
                            });
                    })
            });
	// SELECT 2b
            $(document).ready(function(){
                    $("#pf2b").change(function () {
                            $("#pf2b option:selected").each(function () {
                                    id_pf2b = $(this).val();
                                    $.post("sel/getpf2c.php", { id_pf2b: id_pf2b }, function(data){
                                            $("#pf2c").html(data);
                                    });            
                            });
                    })
            });
         
    // SELECT 3
    $(document).ready(function(){
                    $("#pf3a").change(function () {

                            //$('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                            $("#pf3a option:selected").each(function () {
                                    id_pf3a = $(this).val();
                                    $.post("sel/getpf3b.php", { id_pf3a: id_pf3a }, function(data){
                                            $("#pf3b").html(data);
                                    });            
                            });
                    })
            });
	
            $(document).ready(function(){
                    $("#pf3b").change(function () {
                            $("#pf3b option:selected").each(function () {
                                    id_pf3b = $(this).val();
                                    $.post("sel/getpf3c.php", { id_pf3b: id_pf3b }, function(data){
                                            $("#pf3c").html(data);
                                    });            
                            });
                    })
            });
                        		
		</script>
    </head>
    <body>
        <!-- SELECT 1-->
        <form id="select1" name="select1" action="guarda.php" method="POST">
            <div> 
                <select name="pf1a" style="width: 15.5%;" id="pf1a">
                    <option value="0">--Seleccionar Perfil Profesional--</option>
                <?php while ($row = mysqli_fetch_array($resultado)) { ?>
                    <option value="<?php echo $row['codigo']; ?>"><?php  echo $row['perfilprofesional']; ?></option>
                <?php } ?>
                </select>
            </div> <br/>

            <div> 
                <select style="width: 15.5%;" name="pf1b" id="pf1b">
                    
                </select>
            </div><br />

            <div>
                <select style="width: 15.5%;" name="pf1c" id="pf1c">
                    
                </select>
            </div> <br />
            
        </form>
         <!-- SELECT 2-->
        <form id="select2" name="select2" action="guarda.php" method="POST">
            <div>
                <select style="width: 15.5%;" name="pf2a" id="pf2a">
                    <option value="0">--Seleccionar Perfil Profesional--</option>
                <?php while ($row = mysqli_fetch_array($resultado2)) { ?>
                    <option value="<?php echo $row['codigo']; ?>"><?php  echo $row['perfilprofesional']; ?></option>
                <?php } ?>
                </select>
            </div> <br/>

            <div>
                <select style="width: 15.5%;" name="pf2b" id="pf2b">
                    
                </select>
            </div><br />

            <div> 
                <select style="width: 15.5%;" name="pf2c" id="pf2c">
                    
                </select>
            </div> <br />
            
        </form>
         <!-- SELECT 3-->
       <form id="select3" name="select3" action="guarda.php" method="POST">
            <div>
                <select style="width: 15.5%;" name="pf3a" id="pf3a">
                    <option value="0">--Seleccionar Perfil Profesional--</option>
                <?php while ($row = mysqli_fetch_array($resultado3)) { ?>
                    <option value="<?php echo $row['codigo']; ?>"><?php  echo $row['perfilprofesional']; ?></option>
                <?php } ?>
                </select>
            </div> <br/>

            <div>
                <select style="width: 15.5%;" name="pf3b" id="pf3b">
                    
                </select>
            </div><br />

            <div>
                <select style="width: 15.5%;" name="pf3c" id="pf3c">
                    
                </select>
            </div> <br />
            <input type="submit" id="enviar" name="enviar" value="Guardar" />
        </form>
        
    </body>
</html>
