
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <title>Eliminar cuenta</title>
    </head>
    <body>
        <div id="contenedor1">
        <?php
        include ('header.php');
        ?>
            <h5 style="color:blue;"><a href="dem_dat.php">Volver a mi cuenta</a></h5>
        <h2>¿Está seguro que desea eliminar su cuenta?</h2>
        <h3>Si lo hace, esta cuenta de borrará de forma permanente</h3>
        <form action="eliminar.php" method="POST">
            <input type="submit" value="Eliminar"/>
        </form>
        <?php

        
        include('conexion.php');
         if($_SESSION['CIF']){
         $sqldrop = "delete from empresa where `cif`='" . $_SESSION['CIF'] . "'";
          $resultdrop = mysqli_query($conexion, $sqldrop);
          header('Location: fin_ses.php');
         }else{
             echo 'No se ha podido eliminar la cuenta';
         }
        ?>
        <?php
        include ('footer.php');
        ?>
        </div>
    </body>
</html>
