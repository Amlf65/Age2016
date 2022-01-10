<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Demandantes</title>
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
                    <h3 id="quiso"><strong>DEMANDANTES</strong></h3>
                    <div id="contenido5">
                        <p>Las <strong>personas demandantes de empleo</strong> pueden registrarse en la web de nuestra Agencia de Colocación 
                            - Demandantes -, adjuntando su CV actualizado, para posibles procesos de selección, inscribirse en las ofertas de 
                            empleo que se adecuen a su perfil profesional o sí lo desean, recibir orientación e información profesional.</p><br/>
                        <p>También pueden presentarse en la Agencia de Colocación (nº0500000122) sita en la calle Juan Diego de la Fuente, 
                            nº38-40 de Telde, en horario de 09:00 a 14:30 de lunes a viernes y aportar la siguiente documentación:</p><br/>
                        <ul id="lista">
                            <li class="list">■ Currículum actualizado.</li>
                            <li class="list">■ Fotocopia del D.N.I.</li>
                            <li class="list">■ Fotocopia de Resolución Definitiva de Grado de Discapacidad, en su caso.</li>
                        </ul><br/>
                        <p><strong><u>IMPORTANTE:</u></strong> Para mantener la inscripción en nuestra bolsa de empleo, debes actualizar 
                            tus datos e informar que sigues interesado/a en buscar trabajo, en un plazo máximo de 1 año desde tu inscripción 
                            o desde tu última actualización.</p>
                    </div>
                    <div>
                        <div id="registrate" >
                            <div id="cajaImagen">
                                <a style="text-decoration: none;" title="Regístrate" href="form_dem.php" ><img src="img/registrate.png" alt="Regístrate"/></a>
                            </div>
                            <a style="text-decoration: none;" title="Regístrate" href="form_dem.php"><h3>Regístrate</h3></a>        
                        </div>
                        <div id="novedades">
                            <div id="cajaImagen">
                                <a style="text-decoration: none;" title="miperfil" href="dem_acc.php" ><img src="img/novedades.png" alt="Mi perfil"/></a>
                            </div>
                            <a style="text-decoration: none;" title="Mi perfil" href="dem_acc.php" ><h3>Mi perfil</h3></a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include ('footer.php'); ?>
    </body>
</html>
