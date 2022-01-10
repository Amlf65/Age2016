<!DOCTYPE html>
<html lang="es">
   <head>
      <title>TU AGENCIA DE COLOCACIÓN</title>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <link rel="stylesheet" type="text/css" href="css/general.css"/>
      <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
      <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
   </head>
   <body>
      <div id="contenedor1">
      <?php include ('header.php'); ?>
      <section>
        <div id="slider"><!--Inicio slider-->
            <ul>
                <li><img alt="1" src="img/slider1.jpg"/></li>
                <li><img alt="2"  src="img/slider2.jpg"/></li>
                <li><img alt="3"  src="img/slider3.jpg"/></li>
                <li><img alt="4"  src="img/slider4.jpg"/></li>
            </ul>
        </div><!--Fin slider-->
        <div id="divcon" style="overflow: hidden;">
                 <!--APARTADO CONTACTO-->
                 <div id="infocon">
                 <h3><strong>CONTACTO</strong></h3>
                 <div class="contac">
                <strong><img id='imgTelefono' src="img/telefono.png"/> 828-013-600</strong><br>
                <p>C/Juan Diego de la Fuente Nº38-40, 35200 TELDE<br>
                    agenciadecolocacionmunicipal@telde.es</p>
                <p><strong>De Lunes a Viernes</strong></p>
                <p><strong>De 9:00 a 14:30.</strong></p>
                </div>
                 </div>
            <div class="redes2">
                <a href="#"><img alt="twitter" width="50%" height="80px" class="red1" src="img/twitter.png"></a>
                <a href="#"><img alt="face" width="50%" height="80px" class="red2" src="img/facebook.png"></a>
            </div>
                 <div class="mapa2" style="position: relative; bottom: 260px; left: 38%;">
                 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1761.4851596000562!2d-15.417905142136336!3d27.994804464034456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xc4097e50b89ec71%3A0x77ed766c593db489!2sCalle+Juan+Diego+de+la+Fuente%2C+40%2C+35200+Telde%2C+Las+Palmas!5e0!3m2!1ses!2ses!4v1509966941327" width="550" height="400" frameborder="0"></iframe>
                </div>
             </div>
      </section>
      </div>
       <div style="position:relative; height: 100px; bottom:-150px !important;width:100%;">
        <?php include('footer.php') ?>
       </div>
   </body>
</html>