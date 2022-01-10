<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/general.css"/> 
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel= "stylesheet" type="text/css" href="formucss.css">
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/> 
        <link rel= "stylesheet" type="text/css" href="css/empre.css"/>
    </head>
    <body>
        <div id="contenedor1">
            <br/>
            <div id="micuenta">  
                <p><a href="emp.php">MI CUENTA</a></p>
            </div>
            <br/><br/>
            <div id="imgempresaa"><img src="img/imgempresaa.png" alt="imagen principal de administrador"/></div> <br/>

            <div class="principal">
                <p id="titulo">MODIFICAR LOS DATOS DE LA EMPRESA</p>
            </div>
            <!--FORMULARIO-->
            <div class="contenido">
                <form method="post" action="registro_emp.php">
                    <div class="empresa">
                        <legend>Modifique los datos que desee actualizar</legend><br>
                        <table>
                            <tr>
                                <td id="title1">CIF/NIF</td>
                                <td><input title="Se necesita un CIF" type="text" name="cif" required/></td>
                            </tr>
                            <tr>
                                <td id="title1">Contrase&ntilde;a</td>
                                <td><input title="" type="password" name="contra" required/></td>
                            </tr>
                            <tr>
                                <td id="title1">Repetir contrase&ntilde;a</td>
                                <td><input title="" type="password" name="recontra" required/></td>
                            </tr>
                            <tr>
                                <td id="title1">Raz&oacuten Social</td>
                                <td><input title="" type="text" name="nombre" required/></td>
                            </tr>
                            <tr>
                                <td id="title1">Persona Contacto</td>
                                <td><input type="text" name="contacto"/></td>
                            </tr>
                            <tr>
                                <td id="title1">Localidad</td>
                                <td><input type="text" name="localidad"/></td>
                            </tr>
                            <tr>
                                <td id="title1">Dirección</td>
                                <td><input type="text" name="direccion"/></td>
                            </tr>
                            <tr>
                                <td id="title1">Código Postal</td>
                                <td><input type="text" name="cp"/></td>
                            </tr>
                            <tr>
                                <td id="title1">Tipo Empresa</td>
                                <td><input type="text" name="tipo"/></td>
                            </tr>
                            <tr>
                                <td id="title1">Sector Profesional</td>
                                <td><input type="text" name="sector"/></td>
                            </tr>
                            <tr>
                                <td id="title1">Tel&eacutefono</td>
                                <td><input type="text" name="tlfono"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="text" name="gerente"/></td>
                            </tr>
                            <tr>
                                <td id="title1">Email</td>
                                <td><input type="text" name="email"/></td>	
                            </tr>
                        </table><br/>
                    </div>
            </div>
            <br/><br/>

            <div class="submit">
                <input type="submit" name="aceptar" value="MODIFICAR"/>
            </div>
        </form>

        <br/><br/>
        <?php
        include ('footer.php')
        ?></div>
</body>
</html>