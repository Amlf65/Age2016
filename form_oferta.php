<?php
include 'conexion.php';
$sql = 'SELECT * FROM `perfilesprofesionales` WHERE `codigo` LIKE \'_\' ORDER BY perfilprofesional';
$sql3 = "SELECT * FROM `perfilesprofesionales`";
$result3 = mysqli_query($conexion, $sql);
$result7 = mysqli_query($conexion, $sql3);
$resultado = mysqli_query($conexion, $sql);

            
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Formulario</title>      
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/general.css" />
        <link rel="stylesheet" type="text/css" href="css/iconic.css"/>
        <link rel= "stylesheet" type="text/css" href="css/formucss.css">
        <link rel="stylesheet" type="text/css" href="css/headerIcons.css"/> 
        <script src="js/jquery-3.2.1.min.js"></script>
    </head>
    <body>
        <div id="contenedor1"> 
            <?php include('header.php') ;
     
if ((!isset($_SESSION['CIF']))&&(!isset($_SESSION['Nombre']))) {
    header('location:emp_acc.php');
}
            
            ?>
            <div class="principio">
                <p id="formtitulos">Nueva oferta de empleo</p>
            </div>
            <!--FORMULARIO-->
            <div class="contenido2">
                <form  action="registro_oferta.php" method="POST" ><br>
                    <div class="empresa2">   
                        <table>
                            <br>
                            <tr>
                                <td class="title3">Título de la oferta</td>
                                <td><input type="text" name="titulo" value="" required/></td>
                            </tr>
                            <tr>
                                <td class="title3">Descripción</td>
                                <td><textarea name="descripcion" cols="39" rows="5" required></textarea></td>
                            </tr>
                        </table><br/>
                    </div>
                    <br/><br/>
                    <div class="candidato2">
                        <legend>Requisitos para los candidatos</legend>
                        <table>
                            <br>
                            <tr>
                                <td class="title3">Nivel formativo</td>
                                <td><select style="height: 25px;" name="nivelformativo" required>
                                        <option value="" selected="selected">- Elija una opción -</option>
                                        <option value="00">Sin estudios</option>
                                        <option value="10">Estudios primarios</option>
                                        <option value="20">Estudios Secundarios</option>
                                        <option value="30">Estudios Post-Secundarios</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="title3">Otros requisitos</td>
                                <td> <textarea name="requisitos" placeholder="Requisitos inform&aacute;ticos, idiomas y experiencia laboral." cols="40" rows="5" required></textarea></td>
                            </tr>
                            <tr>
                                <td class="title3">Perfil profesional</td>
                                <td><input id="lista7" list="formacion7" name="pf" onchange="titulacion(this.getAttribute('id'))">
                                    <datalist id="formacion7">
                                        <?php
                                        while ($row7 = mysqli_fetch_array($result7, MYSQLI_ASSOC)) {
                                            echo '<option value="' . $row7['perfilprofesional'] . '">';
                                        }
                                        ?>
                                    </datalist>
                                </td>                       
                            </tr>
                            <tr>
                                <td class="title3">Carnet de conducir</td>
                                <td><input type="checkbox" name="carnetconducir"/></td>
                            <tr>
                                <td class="title3">Vehículo propio</td>
                                <td><input type="checkbox" name="vehiculopropio"/></td>
                            </tr>
                            <tr>
                                <td class="title3">Observaciones</td>
                                <td><textarea name="observaciones" cols="40" rows="5"></textarea></td>
                            </tr>
                        </table>
                        <table id="preguntas">
                            <tr>  
                                <td>¿Desea que el nombre de su empresa sea visible?</td>
                                    <td><input type="checkbox" class="check2" name="visible"/></td>
                            </tr>
                            <tr>  
                                <td>Nos comprometemos a informarle si alguno de los candidatos es
                                    contratado, la fecha de alta y el tipo de contrato realizado. Además de mantenerles
                                    informados sobre cualquier incidencia en caso de existir alguna.</td>
                                    <td><input type="checkbox" class="check2" name="acepto" required/></td>
                            </tr>
                            <tr>  
                                <td>Nos comprometemos a informarle si alguno de los candidatos es
                                    contratado, la fecha de alta y el tipo de contrato realizado. Además de mantenerles
                                    informados sobre cualquier incidencia en caso de existir alguna.</td>
                                    <td><input type="checkbox" class="check2" name="acepto" required/></td>
                            </tr>
                        </table><br>
                    </div>   
                    <div class="submit">
                        <input type="submit" value="REGISTRAR" onblur=""/> 
                    </div>
                </form>
            </div>
        </div>
        <?php include('footer.php') ?>
    </body>
</html>