<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Empresas</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="css/inicio.css"/>
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link type='text/css' href='css/demo.css' rel='stylesheet' media='screen'/>
        <link type='text/css' href='css/basic.css' rel='stylesheet' media='screen'/>
    </head>
    <body>
        <div id="contenedor1">
            <?php include ('header.php'); ?>
            <section>
                <div id="slider"><!--Inicio slider-->
                    <ul>
                        <li><img src="img/slider1.jpg" alt="Primera foto del slider"/></li>
                        <li><img src="img/slider2.JPG" alt="Segunda foto del slider "/></li>
                        <li><img src="img/slider3.jpg" alt="Tercera foto del slider "/></li>
                        <li><img src="img/slider4.jpg" alt="Cuarta foto del slider "/></li>
                    </ul>
                </div><!--Fin slider-->
                <br><br>
                <div id="content">
                    <h3 id="quiso"><strong>EMPRESAS</strong></h3>
                    <div id="contenido5">
                        <p>Como <strong>empresa</strong>, si se dispone de alguna/as vacantes profesionales pueden duplicar sus ofertas 
                            en la web de la Agencia de Colocación - Empresas-, previo registro o llamando al teléfono 828 013 600 en horario 
                            de 09:00 a 14:30 de lunes a viernes. También tiene la posibilidad de hacer la gestión vía email en la dirección 
                            agenciadecolocacionmunicipal@telde.es</p><br/>
                        <p>Le ofrecemos la posibilidad de realizar la preselección curricular y/o selección de personal, dejando a su criterio 
                            la elección de aquel candidato o candidata que más se adapte a su forma y puesto de trabajo.</p><br/>
                    </div>
                    <div id="registrate"><div id="cajaImagen">
                            <a style="text-decoration: none;" title="Regístrate" href="form_emp.php" ><img src="img/registrate.png" alt="Regístrate"/></a>
                        </div>
                        <a style="text-decoration: none;" title="Regístrate" href="form_emp.php"><h3>Regístrate</h3></a>        
                    </div>
                    <div id="novedades">
                        <div id="cajaImagen">
                            <a style="text-decoration: none;" title="miperfil" href="emp_acc.php" ><img src="img/novedades.png" alt="Mi perfil"/></a>
                        </div>
                        <a style="text-decoration: none;" title="Mi cuenta" href="emp_acc.php" ><h3>Mi perfil</h3></a>
                    </div>
                </div>
            </section>
        </div>
        <?php include ('footer.php'); ?>
    </body>
</html>