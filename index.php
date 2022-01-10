<!DOCTYPE html>
<html lang="es">
    <head>
        <title>TU AGENCIA DE COLOCACIÓN</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/general.css"/>
<!--        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>-->
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link type='text/css' href='css/demo.css' rel='stylesheet' media='screen'/>
        <link type='text/css' href='css/basic.css' rel='stylesheet' media='screen'/>
        <!-- Modal -->
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/basic.js'></script>
    </head>
    <body>
        <div id="contenedor1">
            <?php include ('header.php'); ?>
            <section style="margin-top: 3%;">
                <div id="slider"><!--Inicio slider-->
                    <ul>
                        <li><img src="img/slider1.jpg" alt="Primera foto del slider"/></li>
                        <li><img src="img/slider2.JPG" alt="Segunda foto del slider "/></li>
                        <li><img src="img/slider3.jpg" alt="Tercera foto del slider "/></li>
                        <li><img src="img/slider4.jpg" alt="Cuarta foto del slider "/></li>
                    </ul>
                </div><!--Fin slider-->
                <div id="content" style="margin-top: 3%;">
                    <div id="registrate">
                        <!-- MODAL -->
                        <div id='basic-modal'>
                        <div id="cajaImagen">
                            <a style="text-decoration: none;" title="Regístrate" name="basic" class='basic' href="" ><img src="img/registrate.png" alt="Regístrate"/></a>
                        </div>
                        <a style="text-decoration: none;" title="Regístrate" name="basic" class='basic'  href=""><h3>Regístrate</h3></a> </div>
                        <!-- Modal -->
                        <div id="basic-modal-content">
                            <p style="text-decoration: none; color:black; 
                               font-family: 'Libre Franklin', 'Helvetica', 'Neue helvetica', 'arial', 'sans-serif'; font-weight: bold; font-size:150%;text-align:center;">¿Cómo desea registrarse?</p><br>
                            <p><a href="form_dem.php" style="font-size:130%; text-decoration: none; color:blue; 
                                  font-family: 'Libre Franklin', 'Helvetica', 'Neue helvetica', 'arial', 'sans-serif';">Demandante</a></p><br>
                            
                            <p><a href="form_emp.php" style="font-size:130%; text-decoration: none; color:blue; 
font-family: 'Libre Franklin', 'Helvetica', 'Neue helvetica', 'arial', 'sans-serif';">Empresa</a></p>
                        </div>
                        <!-- preload the images -->
		<div style='display:none'>
			<img src='img/x.png' alt='' />
		</div>
                        <!-- Fin de modal -->
                    </div>
                    <div id="novedades">
                        <div id="cajaImagen">
                            <a style="text-decoration: none;" title="Novedades" href="novedades.php" ><img src="img/novedades.png" alt="Novedades"/></a>
                        </div>
                        <a style="text-decoration: none;" title="Novedades" href="novedades.php" ><h3>Novedades</h3></a>
                    </div>
                    <div id="trabajosFormacion">
                        <div id="cajaImagen">
                            <a style="text-decoration: none;" title="TrabajosFormación" href="tra_for.php" ><img src="img/trabajosFormacion.png" alt="Trabajos Formación"/></a>
                        </div>
                        <a style="text-decoration: none;" title="TrabajosFormación" href="tra_for.php" ><h3>Trabajos-Formación</h3></a>
                    </div>
                    <div id="cajaInfo" style="margin-top: 5%;">
                        <p class="infoIzq"><a href="documents/DEFINE TU PERFIL PROFESIONAL.pdf" target="blank">DEFINE TU PERFIL PROFESIONAL</a></p>
                        <p class="infoDer"><a href="documents/HERRAMIENTAS PARA LA BÚSQUEDA DE EMPLEO.pdf" target="blank">HERRAMIENTAS PARA LA BÚSQUEDA DE EMPLEO</a></p>
                        <div id="imagen"><a href="documents/GUIA DE EMPLEO. AÑO 2017.pdf" target="blank"><img src="img/info.png" alt="Información" width="70"/></a></div>
                        <p class="infoIzq"><a href="documents/EL CURRÍCULUM VITAE (CV).pdf" target="blank">EL CURRICULUM VITAE (CV)</a></p>
                        <p class="infoDer"><a href="documents/EL PROCESO DE SELECCIÓN.pdf" target="blank">EL PROCESO DE SELECCIÓN</a></p>
                    </div>
                </div>
            </section>
        </div>
        <?php include ('footer.php'); ?>
    </body>
</html>