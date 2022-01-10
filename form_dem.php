<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <link rel="stylesheet" type="text/css" href="css/general.css" />
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel="stylesheet" type="text/css" href="formucss.css" />
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/>
        <link rel="stylesheet" type="text/javascript" src="js/formujava.js" />
        <script type="text/javascript" src="js/Validación/Contraseña/validacion_contrasena.js"></script>
        <script type="text/javascript" src="js/Validación/DNI-NIE/validacion.js"></script>
        <script type="text/javascript" src="js/Validación/telefono/telef1.js"></script>
        <script type="text/javascript" src="js/Validación/FechaNacimiento/valida2.js"></script>
        <script type="text/javascript" src="js/Validación/CodigoPostal/codigoPostal.js"></script>
        <script type="text/javascript" src="js/Validación/sexo/sexo.js"></script>
        <script type="text/javascript" src="js/Validación/repetir/repetir.js"></script>
        <script language="javascript">
            function titulacion(id) {//Funcion para hacer aparecer más opciones de titulacion
                for (var x = 1; x < 9; x++) {//Se ejecutará mientras x sea menor al número de listas
                    (id == 'lista' + x) ? document.getElementById('lista' + (x + 1)).style.display = 'inline' : '';
                }
            }
        </script>
    </head>
    <body id="contenedor1">
        <?php
        include 'conexion.php';
        include 'header.php';
        $sql = "SELECT * FROM `formacion`";
        $sql2 = "SELECT * FROM `cerpro`";
        $sql3 = "SELECT * FROM `perfilesprofesionales`";
        $result = mysqli_query($conexion, $sql);
        $result2 = mysqli_query($conexion, $sql);
        $result3 = mysqli_query($conexion, $sql);
        $result4 = mysqli_query($conexion, $sql2);
        $result5 = mysqli_query($conexion, $sql2);
        $result6 = mysqli_query($conexion, $sql2);
        $result7 = mysqli_query($conexion, $sql3);
        $result8 = mysqli_query($conexion, $sql3);
        $result9 = mysqli_query($conexion, $sql3);
        ?>
        <div class="principal">
            <p id="formtitulos">Alta de usuario</p>
        </div>
        <!--FORMULARIO-->
        <script>
            /*function valida(valor){
             if(valor.value.length==0 ){return false} else {return true}
             }*/
            function envia() {
                vd = true;

                if (!validateDNI(document.getElementById("dni"))) {
                    vd = false
                }
                if (!validacion(document.getElementById("contrasena"))) {
                    vd = false
                }
                if (!validateRepetir(document.getElementById("repcon"))) {
                    vd = false
                }
                if (!fecha(document.getElementById("fechanacimiento"))) {
                    vd = false
                }
                if (!validateTelef(document.getElementById("movil"))) {
                    vd = false
                }
                if (!validateTelef(document.getElementById("telefono"))) {
                    vd = false
                }
                if (!validarCP(document.getElementById("codigopostal"))) {
                    vd = false
                }
                //EXPERIENCIA
                if (!titulacion(document.getElementById("pp1"))) {
                    vd = false
                }
                if (!titulacion(document.getElementById("pp2"))) {
                    vd = false
                }
                return vd;
            }
        </script>
        <div class="contenido">
            <form method="post" action="registro_dem.php" enctype="multipart/form-data" onSubmit="return envia();">
                <div class="empresa">
                    <!--PRIMER APARTADO-->
                    <legend>Datos personales</legend>
                    <table>
                        <tr>
                            <td id="title2">DNI/NIE</td>
                            <td colspan="2"><input type="text" id="dni" name="dni" required onblur="validateDNI(this)"/><br></td>
                        <span><div id="error2"></div></span>
                        </tr>
                        <tr>
                            <td id="title2">Contraseña</td>
                            <td colspan="2"><input type="password" name="contrasena" id="contrasena" required onblur="validacion(this)"/><br></td>
                        <span><div id="error"></div></span>
                        </tr>
                        <tr>
                            <td id="title2">Repetir contrase&ntilde;a</td>
                            <td colspan="2"><input type="password" id="repcon" name="repetir" required  onblur="validateRepetir(this, document.getElementById('contrasena'))"/><br</td>
                        <span><div id="error8"></div></span>
                        </tr>
                        <tr>
                            <td id="title2">Nombre</td>
                            <td colspan="2"><input type="text" name="nombre" required /></td>
                        </tr>
                        <tr>
                            <td id="title2">Apellido1</td>
                            <td colspan="2"><input type="text" name="apellido1" required /></td>
                        </tr>
                        <tr>
                            <td id="title2">Apellido2</td>
                            <td colspan="2"><input type="text" name="apellido2" required /></td>
                        </tr>
                        <tr>
                            <td id="title2">Fecha de nacimiento</td>
                            <td colspan="2"><input type="date" id="fechanacimiento" name="fechanacimiento" required onblur="fecha(this)"/></td>
                        <tr><td><span><div id="erro4"></div></span></td></tr>
                        </tr>
                        <tr>
                            <td rowspan="2" id="title2">Sexo</td>
                            <td>Hombre</td>
                            <td>Mujer</td>
                        </tr>
                        <td><input type="radio" name="sexo"  value="1" checked></td>
                        <td><input type="radio" name="sexo" value="2" ></td>
                        <tr>
                            <td rowspan="2" id="title2">Tel&eacute;fono</td>
                            <td colspan="2"><input type="text" id="movil" name="movil" value="" placeholder="Móvil" onblur="validateTelef(this)"/></td>
                        <tr>
                            <td colspan="2"><input type="text" id="telefono" name="telefono" value="" placeholder="Fijo" onblur="validateTelef(this)" /><br></td>
                        <span><div id="error3"></div></span>
                        </tr>
                        <tr>
                            <td id="title2">E-mail</td>
                            <td colspan="2"><input type="email" name="email" required/></td>
                        </tr>
                        <tr>
                            <td id="title2">Localidad</td>
                            <td colspan="2"><select style="height: 25px;" name="localidad" required>
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
                            <td id="title2">Dirección <br/></td>
                            <td colspan="2"><input type="text" name="direccion" required/></td>
                        </tr>
                        <tr>
                            <td id="title2">Código postal<br/></td>
                            <td colspan="2"><input type="text" name="codigopostal" id="codigopostal" required onblur="validarCP(this)" /><br></td>
                        <span><div id="error4"></div></span>
                        </tr>
                    </table><br/>
                </div>
                <br/><br/>

                <!--SERVICIOS SOCIALES-->
                <div class="empresa">
                    <legend>OTROS DATOS PERSONALES</legend>
                    <p><strong>¿Actualmente se encuentra en alguna de las siguientes situaciones?</strong></p>
                    <p>(Marque las casillas correspondientes)</p>
                    <table>
                        <tr>
                            <td><p class="deminfosc">¿Está inscrito/a en el Servicio Público de Empleo como Demandante?</p></td>
                            <td><input type="checkbox" name="demandante"/></td>
                        </tr><tr>
                            <td><p class="deminfosc">¿Está inscrito/a en el Servicio Público de Empleo como Mejora de Empleo?</p></td>
                            <td><input type="checkbox" name="mejora"/></td>
                        </tr><tr>
                            <td><p class="deminfosc">¿Está cobrando actualmente alguna prestación?</p></td>
                            <td><input type="checkbox" name="perceptor"/></td>
                        </tr><tr>
                            <td><p class="deminfosc">¿Tiene alguna Discapacidad y posee el Certificado de Discapacidad?</p></td>
                            <td><input type="checkbox" name="discapacidad"/></td>
                        </tr><tr>
                            <td class="deminfosc"><p class="deminfosc">Indique el porcentaje</p></td>
                            <td style=""><input type="text" name="grado" size=1/>%</td>
                        </tr><tr>
                            <td class="deminfosc"><p>¿Acude a la Concejalía de Servicios Sociales del M.I. Ayuntamiento de Telde?</p></td>
                            <td><input type="checkbox" name="consejalia"/></td>
                        </tr><tr>
                            <td class="deminfosc"><p>Unidad de Trabajo Social de su Zona</p></td>
                            <td><select style="height: 25px; width: 150px;" name="uts">
                                    <option value="" selected="selected">- Elija una opci&oacute;n -</option>
                                    <option value="U.T.S. SAN JOSÉ DE LAS LONGUERAS">U.T.S. SAN JOSÉ DE LAS LONGUERAS</option>
                                    <option value="U.T.S. OJOS DE GARZA">U.T.S. OJOS DE GARZA</option>
                                    <option value="U.T.S. MEDIANÍAS">U.T.S. MEDIANÍAS</option>
                                    <option value="U.T.S. LAS REMUDAS">U.T.S. LAS REMUDAS</option>
                                    <option value="U.T.S. JINÁMAR">U.T.S. JINÁMAR</option>
                                    <option value="U.T.S. COSTA">U.T.S. COSTA</option>
                                    <option value="U.T.S. CENTRO">U.T.S. CENTRO</option>
                                    <option value="U.T.S. CASAS NUEVAS">U.T.S. CASAS NUEVAS</option>
                                    <option value="U.T.S. RIESGO Y MENORES ">U.T.S. RIESGO Y MENORES</option>
                                </select></td>
                        </tr><tr>
                            <td class="deminfosc"><p>¿Es usted Inmigrante?</p></td>
                            <td class="demsc"><input type="checkbox" name="inmigrante"/></td>
                        </tr>
                    </table><br/>
                </div>
                <br/><br/>

                <!--DATOS ACADEMICOS-->
                <div class="puesto">
                    <legend>Datos acad&eacute;micos</legend>
                    <table>
                        <tr>
                            <td id="title2">Nivel formativo</td>
                            <td><select id="demnivfor" name="nivelformativo" required>
                                    <option value="" selected="selected">- Elija una opci&oacute;n -</option>
                                    <option value="00">Sin estudios</option>
                                    <option value="10">Estudios primarios</option>
                                    <option value="20">Estudios secundarios</option>
                                    <option value="30">Estudios post-secundarios</option>
                                </select></td>
                        </tr><tr>
                            <td id="title2" rowspan="3">Titulación</td>
                            <td><input id="lista1" list="formacion1" name="titulo1" onchange="titulacion(this.getAttribute('id'))">
                                <datalist id="formacion1">
                                    <?php
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo '<option value="' . $row['titulo'] . '">';
                                    }
                                    ?>
                                </datalist>
                            </td>
                        </tr><tr>
                            <td><input id="lista2" list="formacion2" name="titulo2" onchange="titulacion(this.getAttribute('id'))" style="display:none;">
                                <datalist id="formacion2">
                                    <?php
                                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                                        echo '<option value="' . $row2['titulo'] . '">';
                                    }
                                    ?>
                                </datalist>
                            </td>
                        </tr><tr>
                            <td><input id="lista3" list="formacion3" name="titulo3" style="display:none;">
                                <datalist id="formacion3">
                                    <?php
                                    while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                                        echo '<option value="' . $row3['titulo'] . '">';
                                    }
                                    ?>
                                </datalist>
                            </td>
                        </tr>
                    </table><br/>
                </div>
                <br/><br/>

                <!--FORMACIÓN COMPLEMENTARIA-->
                <div class="puesto">
                    <legend>Formación complementaria</legend>
                    <table>
                        <tr>
                            <td id="title2" rowspan="3">Certificados</td>
                            <td><input id="lista4" list="formacion4" name="fc1" onchange="titulacion(this.getAttribute('id'))">
                                <datalist id="formacion4">
                                    <?php
                                    while ($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                                        echo '<option value="' . $row4['certificado'] . '">';
                                    }
                                    ?>
                                </datalist>
                            </td>
                        </tr><tr>
                            <td><input id="lista5" list="formacion5" name="fc2" onchange="titulacion(this.getAttribute('id'))" style="display:none;">
                                <datalist id="formacion5">
                                    <?php
                                    while ($row5 = mysqli_fetch_array($result5, MYSQLI_ASSOC)) {
                                        echo '<option value="' . $row5['certificado'] . '">';
                                    }
                                    ?>
                                </datalist>
                            </td>
                        </tr><tr>
                            <td><input id="lista6" list="formacion6" name="fc3" style="display:none;">
                                <datalist id="formacion6">
                                    <?php
                                    while ($row6 = mysqli_fetch_array($result6, MYSQLI_ASSOC)) {
                                        echo '<option value="' . $row6['certificado'] . '">';
                                    }
                                    ?>
                                </datalist>
                            </td>
                        </tr><tr>
                            <td id="title2">Otros Cursos</td>
                            <td colspan="3"><textarea name="cursos" id="descripcion" style=""cols="39" rows="5"></textarea></td>
                        </tr>
                    </table><br/>
                </div>
                <br/><br/>

                <!--EXPERIENCIA-->
                <div class="candidato">
                    <legend>Experiencia laboral</legend>
                    <table class="candidato2">
                        <tr class="demexp">
                            <td  id="title1" style="border-bottom: 2px solid #ADC8F2;">Experiencia 1</td>
                            <td style="border-bottom: 2px solid #ADC8F2;"><textarea name="exp1" id="descripcion" cols="39" rows="5" placeholder="Puesto &#10Nombre de empresa &#10Período de tiempo &#10Funciones"></textarea></td>
                        </tr><tr class="demexp">
                            <td id="title1" style="border-bottom: 2px solid #ADC8F2;">Experiencia 2</td>
                            <td style="border-bottom: 2px solid #ADC8F2;"><textarea name="exp2" id="descripcion" cols="39" rows="5" placeholder="Puesto &#10Nombre de empresa &#10Período de tiempo &#10Funciones"></textarea></td>
                        </tr><tr class="demexp">
                            <td id="title1" style="border-bottom: 2px solid #ADC8F2;">Experiencia 3</td>
                            <td style="border-bottom: 2px solid #ADC8F2;"><textarea name="exp3" id="descripcion" cols="39" rows="5" placeholder="Puesto &#10Nombre de empresa &#10Período de tiempo &#10Funciones"></textarea></td>
                        </tr><tr>
                            <td id="title1" rowspan="3">Perfil profesional</td>
                            <td><input id="lista7" list="formacion7" id="pp1" name="pp1" onchange="titulacion(this.getAttribute('id'))">
                                <datalist id="formacion7">
                                    <?php
                                    while ($row7 = mysqli_fetch_array($result7, MYSQLI_ASSOC)) {
                                        echo '<option value="' . $row7['perfilprofesional'] . '">';
                                    }
                                    ?>
                                </datalist>
                            </td>
                        </tr><tr>
                            <td><input id="lista8" list="formacion8" id="pp2" name="pp2" onchange="titulacion(this.getAttribute('id'))" style="display:none;">
                                <datalist id="formacion8">
                                    <?php
                                    while ($row8 = mysqli_fetch_array($result8, MYSQLI_ASSOC)) {
                                        echo '<option value="' . $row8['perfilprofesional'] . '">';
                                    }
                                    ?>
                                </datalist>
                            </td>
                        </tr><tr>
                            <td><input id="lista9" list="formacion9" name="pp3" style="display:none;">
                                <datalist id="formacion9">
                                    <?php
                                    while ($row9 = mysqli_fetch_array($result9, MYSQLI_ASSOC)) {
                                        echo '<option value="' . $row9['perfilprofesional'] . '">';
                                    }
                                    ?>
                                </datalist>
                            </td>
                        </tr><tr>
                            <td id="title2">Carnet de conducir</td>
                            <td><input type="checkbox" name="carnetconducir"/></td>
                        </tr><tr>
                            <td id="title1">Vehículo propio</td>
                            <td><input type="checkbox" name="vehiculopropio"/></td>
                        </tr><tr>
                            <td id="title1">Observaciones</td>
                            <td><textarea name="observaciones" id="descripcion" style="resize: none;"cols="39" rows="5"></textarea></td>
                        </tr>
                    </table>
                </div>
                <br/><br/>
                <div id="curriculum">
                    <table>
                        <legend>Adjunte su curriculum</legend>
                        <tr>
                            <!--BOTÓN CURRICULUM-->
                            <td><input type="file" name="cv"  class="form-control" required/></td>
                        </tr>
                    </table>
                </div>
                <br/><br/>
                <div id="autoriza">
                    <table>
                        <legend>Veracidad de los datos</legend>
                        <tr>
                            <td></td>
                            <td><textarea name="texto" id="demdescripcion" cols="38" rows="6" readonly>Declaro la exactitud y la veracidad de los datos registrados y de mi currículum adjuntado autorizando a la Concejalía de Desarrollo Local, Industria, Comercio y Pymes del Ayuntamiento de Telde, a través de la Agencia de Colocación con número de identificación 0500000122, al tratamiento y comunicación de los mismos con las siguientes finalidades:

* La intermediación laboral con empresas interesadas que dispongan de ofertas de empleo presentadas que respondan a mi perfil profesional.

* La incorporación y remisión de mis datos en informes realizados de la actividad de la Agencia de Colocación con número de identificación 0500000122 al Servicio de Empleo Público Estatal y, en general, a los diferentes servicios públicos estatales y de las distintas comunidades autónomas.

* Su utilización en material de inserción y formación profesional que puedan ser llevados a cabo por la Agencia de Colocación con número de identificación 0500000122.
                                </textarea>
                            </td>
                        </tr><tr>
                            <td><input type="checkbox" name="poli" required/></td>
                            <td style="text-align: justify;">Sí, acepto el Servicio y el Tratamiento de Datos por parte de la Agencia de Colocación con número de identificación 0500000122.</td>
                        </tr><tr>
                            <td><input type="checkbox" name="politi" required/></td>
                            <td style="text-align: justify;">Sí, deseo recibir información sobre empleo, formación y emprendeduría.</td>
                        </tr><tr>
                            <td></td>
                            <td><div style="font-size: 12px; text-align: justify;">Los datos serán usados única y expresamente para el fin que han sido solicitados conforme al art 5 de la
                                    Ley Orgánica 15/1999 de 13 de diciembre de Protección de Datos de Carácter Personal, pudiendo
                                    ejercitar su derecho de acceso, rectificación y cancelación de sus datos personales conforme a la citada
                                    Ley, en la Concejalía de Desarrollo Local, Industria, Comercio y Pymes del. Ayuntamiento de Telde en la

                                    C/ Juan Diego de la Fuente nº 38-40 (San Gregorio). Los datos serán gestionados a través de una base
                                    de datos informatizada.
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <!--BOTÓN FORMULARIO-->
                <div class="submit">
                    <input type="submit"  class="btn btn-primary center-block" name="aceptar" value="Aceptar"/>
                </div>
            </form>
        </div>
        <br/><br/>
        <div style="width: 110%; position: relative; right: 5%;">
            <?php include 'footer.php' ?>
        </div>
    </body>
</html>