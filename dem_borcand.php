<?php

session_start();
include 'conexion.php';
//Borramos dicho registro
$sqldel = "DELETE FROM `demofer` WHERE `dni`='" . $_SESSION['DNI'] . "' AND `codigo`='" . $_POST['codigo'] . "'";
//Ejecutamos la consulta
$resultadosdel = mysqli_query($conexion, $sqldel);
//Mostramos los resultados de nuevo
$sqlcand = "SELECT * FROM `demofer` WHERE `dni`='" . $_SESSION['DNI'] . "'";
$resultcand = mysqli_query($conexion, $sqlcand);
if (mysqli_num_rows($resultcand) != 0) {
    while ($rowcand = mysqli_fetch_array($resultcand, MYSQLI_ASSOC)) {
        //Sentencia SQL para obtener información sobre la candidatura
        $sqlcand2 = "SELECT * FROM `ofertas` WHERE `codigo`='" . $rowcand['codigo'] . "'";
        $resultcand2 = mysqli_query($conexion, $sqlcand2);
        $rowcand2 = mysqli_fetch_array($resultcand2, MYSQLI_ASSOC);
        if ($_POST['origen'] == "CANCELAR") {
            echo '<form method="post">
                    <div class="candidatura">
                        <p class="titulo">' . $rowcand2['titulo'] . '</p>
                        <p class="descp">' . $rowcand2['descripcion'] . '</p>
                        <input type="button" name="cancelar" value="CANCELAR" onclick="borrar(this, codigo.value)">
                        <p><strong>Fecha de inscripci&oacute;n</strong></p>
                        <p class="obser">' . $rowcand2['observaciones'] . '</p>
                        <p class="boton">MÁS</p>
                        <input type="text" name="codigo" value="' . $rowcand2['codigo'] . '" style="display:none;"/>
                    </div>
                </form>';
        } else if ($_POST['origen'] == "BORRAR") {
            echo '<form><div class="puestos">
                    <input type="text" name="codigo" value="' . $rowcand2['codigo'] . '" style="display:none;"/>
                    <p class="titulo"><strong>' . $rowcand2['titulo'] . '</strong></p>
                    <input type="button" class="borrar" name="cancelar" value="BORRAR" onclick="borrar(this,codigo.value)">
                </div></form>';
        }
    }
} else {
    echo '<h1>No hay candidaturas</h1>';
}
?>