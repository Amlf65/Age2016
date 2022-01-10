<?php

//conexion
include 'conexion.php';
$sql = "SELECT `dni`,`nombre`,`apellido1`,`apellido2`,`fechanacimiento`,`sexo`,`movil`,`telefono`,`email`,`localidad`,`vvg`,`discapacidad`,`serviciossociales`,`uts`,`trabajadorsocial`,`perceptor`,`dificilinsercion`,`inmigrante`,`nivelformativo`,`titulacion`,`idiomas`,`conocimientosinformatica`,`experiencia`,`perfilprofesional1`,`perfilprofesional2`,`perfilprofesional3`,`fecharegistro`,`fechaactualizacion`,`colocacion`,`orientacion`,`primerainscripcion`,`interesadoformacion`,`interesemprender`,`carnetconducir`,`vehiculopropio`,`clases(s)`,`observaciones`,`cvenpdf`,`num`FROM `demandantes`  ";
$result = mysqli_query($conexion, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$d = array_count_values($row);
//sacar valores de row
//var_dump($row); Saca por pantalla el array
if ($d > 0) {
    
//descargar
 
      header('content-type: application/vnd.ms-excel');
      header("Content-Disposition: attachment; filename= archivo.xls");
      header("Pragma: no-cache");
      header("Expires:0");
    
  
// tabla excel     
    echo("<table border=1>");
    echo("<tr>");
    echo("<td><strong> DNI</strong> </td>");
    echo("<td><strong> Nombre</strong>  </td>");
    echo("<td> <strong>Apellido1</strong>  </td>");
    echo("<td> <strong>Apellido2</strong>  </td>");
     echo("<td> <strong>Fecha de nacimiento</strong>  </td>");
    echo("<td> <strong>Sexo</strong>  </td>");
    echo("<td> <strong>Movil</strong>  </td>");
    echo("<td><strong> Telefono </strong> </td>");
    echo("<td> <strong>Email</strong>  </td>");
    echo("<td> <strong>Localidad</strong>  </td>");
    echo("<td> <strong>VVG</strong>  </td>");
    echo("<td> <strong>Discapacidad</strong>  </td>");
    echo("<td><strong> Servicios sociales</strong>  </td>");
    echo("<td><strong> UTS </strong> </td>");
    echo("<td> <strong>Trabajador social</strong>  </td>");
    echo("<td><strong> Perceptor</strong>  </td>");
    echo("<td><strong> Dificil insercion</strong>  </td>");
    echo("<td><strong> Inmigrante</strong>  </td>");
    echo("<td><strong> Nivel formativo</strong> </td>");
    echo("<td><strong> Titulacion</strong>  </td>");
    echo("<td><strong> Idiomas</strong>  </td>");
    echo("<td><strong> Conocimientos informatica</strong>  </td>");
    echo("<td><strong> Experiencia</strong>  </td>");
    echo("<td><strong> Perfil profesional 1 </strong> </td>");
    echo("<td><strong> Perfil profesional 2</strong>  </td>");
    echo("<td><strong> Perfil profesional 3</strong>  </td>");
    echo("<td><strong> Fecha registro</strong>  </td>");
    echo("<td><strong> Fecha actualizacion</strong>  </td>");
    echo("<td><strong> Colocacion</strong>  </td>");
    echo("<td><strong> Orientacion</strong>  </td>");
    echo("<td><strong> Primera inscripcion</strong> </td>");
    echo("<td><strong> Interesado formacion</strong>  </td>");
    echo("<td><strong> Interes emprender</strong>  </td>");
    echo("<td><strong> Carnet conducir </strong> </td>");
    echo("<td><strong> Vehiculo propio</strong>  </td>");
    echo("<td><strong> Clases(s) </strong> </td>");
    echo("<td><strong> Observaciones</strong>  </td>");
    echo("<td><strong> CV en PDF</strong>  </td>");
    echo("<td><strong> Num</strong>  </td>");
    echo("</tr>");
    
//fila de resultados como un array numérico
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo("<tr>");
        echo("<td>".$row['dni']."</td>");
        echo("<td>".$row['nombre']."</td>");
        echo("<td>".$row['apellido1']."</td>");
        echo("<td>".$row['apellido2']."</td>");
        echo("<td>".$row['fechanacimiento']."</td>");
        echo("<td>".$row['sexo']."</td>");
        echo("<td>".$row['movil']."</td>");
        echo("<td>".$row['telefono']."</td>");
        echo("<td>".$row['email']."</td>");
        echo("<td>".$row['localidad']."</td>");
        echo("<td>".$row['vvg']."</td>");
        echo("<td>".$row['discapacidad']."</td>");
        echo("<td>".$row['serviciossociales']."</td>");
        echo("<td>".$row['uts']."</td>");
        echo("<td>".$row['trabajadorsocial']."</td>");
        echo("<td>".$row['perceptor']."</td>");
        echo("<td>".$row['dificilinsercion']."</td>");
        echo("<td>".$row['inmigrante']."</td>");
        echo("<td>".$row['nivelformativo']."</td>");
        echo("<td>".$row['titulacion']."</td>");
        echo("<td>".$row['idiomas']."</td>");
        echo("<td>".$row['conocimientosinformatica']."</td>");
        echo("<td>".$row['experiencia']."</td>");
        echo("<td>".$row['perfilprofesional1']."</td>");
        echo("<td>".$row['perfilprofesional2']."</td>");
        echo("<td>".$row['perfilprofesional3']."</td>");
        echo("<td>".$row['fecharegistro']."</td>");
        echo("<td>".$row['fechaactualizacion']."</td>");
        echo("<td>".$row['colocacion']."</td>");
        echo("<td>".$row['orientacion']."</td>");
        echo("<td>".$row['primerainscripcion']."</td>");
        echo("<td>".$row['interesadoformacion']."</td>");
        echo("<td>".$row['interesemprender']."</td>");
        echo("<td>".$row['carnetconducir']."</td>");
        echo("<td>".$row['vehiculopropio']."</td>");
        echo("<td>".$row['clases(s)']."</td>");
        echo("<td>".$row['observaciones']."</td>");
        echo("<td>".$row['cvenpdf']."</td>");
        echo("<td>".$row['num']."</td>");
        echo("</tr>");
    }
    echo ("</table>");
} else {
    echo("no hay registros en la tabla");
}

?>