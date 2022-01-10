<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/general.css" /> 
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel= "stylesheet" type="text/css" href="formucss.css">
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/> 
        <script type="text/javascript" src="js/Validación/Contraseña/validacion_contrasena.js"></script>
        <script type="text/javascript" src="js/Validación/DNI-NIE/validacion.js"></script>
        <script type="text/javascript" src="js/Validación/telefono/telef.js"></script>
        <script type="text/javascript" src="js/Validación/CodigoPostal/codigoPostal.js"></script>
        <script type="text/javascript" src="js/Validación/repetir/repetir.js"></script>
        <script type="text/javascript" src="js/Validación/CIF/cif.js"></script>
    </head>
    <body>
        <div id="contenedor1">
            <?php
            include ('header.php');
            ?>
            <div class="principal">
                <p id="formtitulos">Alta de empresa</p>
            </div>
            <!--FORMULARIO-->
            <div class="contenido">
                <form method="post" action="registro_emp.php">
                    <div class="empresa">
                        <legend>Datos de la empresa</legend><br>
                        <table>
                            <tr>
                                <td id="title1">CIF</td>
                                <td><input type="text" id="cif" name="cif" onblur="validaCif(this)"/><br</td>
                            <span><div id="error10"></div></span>
                            </tr>
                            <tr>
                                <td id="title1">Contrase&ntilde;a (6 o más caracteres)</td>
                                <td><input title="" type="password" name="contrasena" id="contrasena" onblur="validacion(this)" required/><br</td>
                            <span><div id="error"></div></span>
                            </tr>
                            <tr>
                                <td id="title1">Repetir contrase&ntilde;a</td>
                                <td colspan="2"><input type="password" name="repetir" required  onblur="validateRepetir(this, document.getElementById('contrasena'))"/><br</td>
                            <span><div id="error8"></div></span>
                            </tr>
                            <tr>
                                <td id="title1">Raz&oacuten Social</td>
                                <td><input title="" type="text" name="nombre" required/></td>
                            </tr>
                            <tr>
                                <td id="title1">Persona Contacto</td>
                                <td><input type="text" name="personacontacto" required/></td>
                            </tr>
                            <tr>
                                <td id="title1">Localidad</td>      
                                <td><select style="height: 25px; width: 62%;"  name="localidad" required>
                                        <option value="" selected="selected">- Selecciona -</option>
                                        <option value="Agaete">Agaete</option>
                                        <option value="Agüimes">Agüimes</option>
                                        <option value="La Aldea de San Nicolás">La Aldea de San Nicolás</option>
                                        <option value="Artenara">Artenara</option>
                                        <option value="Arucas">Arucas</option>
                                        <option value="Firgas">Firgas</option>
                                        <option value="Gáldar">Gáldar</option>
                                        <option value="Ingenio">Ingenio</option>
                                        <option value="Mogán">Mogán</option>
                                        <option value="Moya">Moya</option>
                                        <option value="Las Palmas de Gran Canaria">Las Palmas de Gran Canaria</option>
                                        <option value="San Bartolomé de Tirajana">San Bartolomé de Tirajana</option>
                                        <option value="Santa Brígida">Santa Brígida</option>
                                        <option value="Santa Lucía de Tirajana">Santa Lucía de Tirajana</option>
                                        <option value="Santa María de Guía">Mogán</option>
                                        <option value="Tejeda">Tejeda</option>
                                        <option value="Telde">Telde</option>
                                        <option value="Valleseco">Valleseco</option>
                                        <option value="Valsequillo">Valsequillo</option>
                                        <option value="Vega de San Mateo">Vega de San Mateo</option>                           
                                    </select></td>
                            </tr>
                            <tr>
                                <td id="title1">Dirección</td>
                                <td><input type="text" name="direccion" required  /></td>
                            </tr>
                            <tr>
                                <td id="title1">Código Postal</td>
                                <td><input id="cp" name="codigopostal"  required onblur="validarCP(this)"/><br</td>
                            <span><div id="error4"></div></span>
                            </tr>
                            <tr>
                                <td id="title1">Tipo Empresa</td>
                                <td><input type="text" name="tipoempresa" required/></td>
                            </tr>
                            <tr>
                                <td id="title1">Sector Profesional</td>
                                <td><input type="text" name="sectorprofesional" required/></td>
                            </tr>
                            <tr>
                                <td rowspan="2" id="title1">Tel&eacutefono</td>
                                <td><input type="tel" name="telefono" pattern="[\d]{9})" value="" placeholder="Fijo" required onblur="validateTelef(this)"/></td>
                            </tr>
                            <tr>

                                <td><input type="tel" name="movil" value="" pattern="[\d]{9})" placeholder="Móvil" required onblur="validateTelef(this)"/><br</td>
                            <span><div id="error3"></div></span>
                            </tr>
                            <tr>
                                <td id="title1">Email</td>
                                <td><input type="email" name="email" required/></td>	
                            </tr>
                        </table><br/>
                    </div>
                    <div class="submit">
                        <input type="submit" name="aceptar" value="Enviar"/>
                    </div>
                </form>
            </div>
            <br/><br/>
            <div style="width: 110%; position: relative; right: 5%;">
                <?php include ('footer.php') ?>
            </div>
    </body>
</html>