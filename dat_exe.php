<?php
if (isset($_GET['sql'])) {
    $sql=$_GET['sql'];
}else{
    echo "No hemos podido descargar el Excel";
}
//conexion
include 'conexion.php';
$result = mysqli_query($conexion, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$d = array_count_values($row);
if ($d > 0) {
//descargar
    header('content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename= archivo.xls");
    header("Pragma: no-cache");
    header("Expires:0");
} else {
    echo("No hay registros en la tabla");
}
echo("<table border=1>");
    echo("<tr>");
        foreach ($row as $clave => $valor) {
            echo("<td><strong> ".$clave."</strong> </td>");
        }
        if(isset ($row['dni'])){
        echo("<td><strong>pf1</strong></td>");
        echo("<td><strong>pf2</strong></td>");
        echo("<td><strong>pf3</strong></td>");
        }
    echo("</tr>");
    echo("<tr>");
        foreach ($row as $clave => $valor) {
            echo("<td>".$valor."</td>");
        }
        if(isset ($row['dni'])){
            $sqlpf = "SELECT `perfilesprofesionales`.`perfilprofesional` FROM `perfilesprofesionales` inner join `demperpro` ON perfilesprofesionales.codigo = demperpro.codigo WHERE dni='" . $row['dni'] . "'";
            $resultpf = mysqli_query($conexion,$sqlpf);
            for ($i = 0;$i < 3;$i++){
                    $rowpf = mysqli_fetch_array($resultpf, MYSQLI_ASSOC);
                    if(isset( $rowpf['perfilprofesional'])){
                        echo("<td>" . $rowpf['perfilprofesional'] . "</td>");
                    }else{
                        echo("<td></td>");
                    }
            }
        }
    echo("</tr>");
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo("<tr>");
        foreach ($row as $clave => $valor) {
            echo("<td>".$valor."</td>");
        }
        if(isset ($row['dni'])){
            $sqlpf = "SELECT `perfilesprofesionales`.`perfilprofesional` FROM `perfilesprofesionales` inner join `demperpro` ON perfilesprofesionales.codigo = demperpro.codigo WHERE dni='" . $row['dni'] . "'";
            $resultpf = mysqli_query($conexion,$sqlpf);
            for ($i = 0;$i < 3;$i++){
                    $rowpf = mysqli_fetch_array($resultpf, MYSQLI_ASSOC);
                    if(isset( $rowpf['perfilprofesional'])){
                        echo("<td>" . $rowpf['perfilprofesional'] . "</td>");
                    }else{
                        echo("<td></td>");
                    }
            }
        }
    echo("</tr>");
}
echo ("</table>");
?>