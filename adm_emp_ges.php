<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link rel= "stylesheet" type="text/css" href="css/empre.css"/>
    </head>
    <body>
        <div id="contenedor1">
            <?php
            include 'header.php';
            include 'conexion.php';
            ?>
            <div id="micuenta">
                <p><a href="emp.php">MI CUENTA</a></p>
            </div>
            <br/><br/>
            <div id="imgempresaa"><img src="img/imgempresaa.png"/></div>
            <h1>Gestión de ofertas: ¿Qué ofertas deseas publicar?</h1>
            <div id="tablaof">
                <table style="width:100%; background-color:white;text-align:center; border:1px double black;">
                    <form method="post"> 
                        <?php
                        $sql = "SELECT * FROM `ofertas`";
                        $result = mysqli_query($conexion, $sql);
                        ?>                        
                        <tr>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Publicar</th>
                            <th>Cerrada</th>
<?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $row['titulo'] ?></td>
                                <td><?php echo $row['descripcion'] ?></td>
                                <td><input type="checkbox" name="chbox" value="<?php echo $row['publicar'] ?>"/></td>
                                <td><input type="checkbox" name="chbox2" value="<?php echo $row['cerrada'] ?>"/></td>
<?php } ?>
                        </tr>
                </table>    
                <br>
                <input type="submit" name="guardar" value="Guardar" />
                </form>  
            </div>
            <br/><br/>
<?php include 'footer.php'; ?>
    </body>
</html>