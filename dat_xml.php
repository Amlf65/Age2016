<?php
$mes = $_POST['mes'];
$año = $_POST['anio'];
echo $mes;
echo $año;
if ($mes == '00')
    crearanual($año);
else
    crearmensual($mes, $año);
header('Location:dat_desxml.php');

function crearmensual($mes, $año) {
    $xml = new DomDocument('1.0', 'UTF-8'); //creo documento
    include'conexion.php'; //conecto BD
    $ENVIO_ENPI = $xml->createElement('ENVIO_ENPI');
    $ENVIO_ENPI = $xml->appendChild($ENVIO_ENPI);
    $ENVIO_MENSUAL = $xml->createElement('ENVIO_MENSUAL');
    $ENVIO_MENSUAL = $ENVIO_ENPI->appendChild($ENVIO_MENSUAL);
    $CODIGO_AGENCIA = $xml->createElement('CODIGO_AGENCIA', '0500000122');
    $CODIGO_AGENCIA = $ENVIO_MENSUAL->appendChild($CODIGO_AGENCIA);
    $AÑO_MES_ENVIO = $xml->createElement('AÑO_MES_ENVIO', $año . $mes);
    $AÑO_MES_ENVIO = $ENVIO_MENSUAL->appendChild($AÑO_MES_ENVIO);
    $ACCIONES_REALIZADAS = $xml->createElement('ACCIONES_REALIZADAS');
    $ACCIONES_REALIZADAS = $ENVIO_MENSUAL->appendChild($ACCIONES_REALIZADAS);

    //Datos de accion de cada usuario registrado en bd en el mes y año indicado.
    $sql = "SELECT * FROM `demandantes` WHERE MONTH(`fecharegistro`)=" . $mes . " and YEAR(`fecharegistro`)=" . $año
            . " OR MONTH(`orientacion`)=" . $mes . " and YEAR(`orientacion`)=" . $año;
   
    $result = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $ACCION = $xml->createElement('ACCION');
        $ACCION = $ACCIONES_REALIZADAS->appendChild($ACCION);
        $ID_TRABAJADOR = $xml->createElement('ID_TRABAJADOR', $row['dni']);
        $ID_TRABAJADOR = $ACCION->appendChild($ID_TRABAJADOR);
        $NOMBRE_TRABAJADOR = $xml->createElement('NOMBRE_TRABAJADOR', $row['nombre']);
        $NOMBRE_TRABAJADOR = $ACCION->appendChild($NOMBRE_TRABAJADOR);
        $APELLIDO1_TRABAJADOR = $xml->createElement('APELLIDO1_TRABAJADOR', $row['apellido1']);
        $APELLIDO1_TRABAJADOR = $ACCION->appendChild($APELLIDO1_TRABAJADOR);
        $APELLIDO2_TRABAJADOR = $xml->createElement('APELLIDO2_TRABAJADOR', $row['apellido2']);
        $APELLIDO2_TRABAJADOR = $ACCION->appendChild($APELLIDO2_TRABAJADOR);
        $FECHA_NACIMIENTO = $xml->createElement('FECHA_NACIMIENTO', str_replace("-","",$row['fechanacimiento']));
        $FECHA_NACIMIENTO = $ACCION->appendChild($FECHA_NACIMIENTO);
        $SEXO_TRABAJADOR = $xml->createElement('SEXO_TRABAJADOR', $row['sexo']);
        $SEXO_TRABAJADOR = $ACCION->appendChild($SEXO_TRABAJADOR);
        $NIVEL_FORMATIVO = $xml->createElement('NIVEL_FORMATIVO', $row['nivelformativo']);
        $NIVEL_FORMATIVO = $ACCION->appendChild($NIVEL_FORMATIVO);
        $DISCAPACIDAD = $xml->createElement('DISCAPACIDAD', $row['discapacidad']);
        $DISCAPACIDAD = $ACCION->appendChild($DISCAPACIDAD);
        $INMIGRANTE = $xml->createElement('INMIGRANTE', $row['inmigrante']);
        $INMIGRANTE = $ACCION->appendChild($INMIGRANTE);
        $COLOCACION = $xml->createElement('COLOCACION', $row['colocacion']);
        $COLOCACION = $ACCION->appendChild($COLOCACION);
        //Finalizo los datos del usuario
    }
    $DATOS_AGREGADOS = $xml->createElement('DATOS_AGREGADOS');
    $DATOS_AGREGADOS = $ENVIO_MENSUAL->appendChild($DATOS_AGREGADOS);
    // TOTAL PERSONAS
    $TOTAL_PERSONAS = $xml->createElement('TOTAL_PERSONAS',mysqli_num_rows($result) );
    $TOTAL_PERSONAS = $DATOS_AGREGADOS->appendChild($TOTAL_PERSONAS);
    // TOTAL DE  NUEVAS REGISTRADAS
    $sql1 = "SELECT count(*) FROM `demandantes` WHERE MONTH(`fecharegistro`)=" . $mes . " and YEAR(`fecharegistro`)=" . $año;
    $result1 = mysqli_query($conexion, $sql1);
    $rowNR = mysqli_fetch_array($result1, MYSQLI_ASSOC);
        $TOTAL_NUEVAS_REGISTRADAS = $xml->createElement('TOTAL_NUEVAS_REGISTRADAS', $rowNR['count(*)']);
    $TOTAL_NUEVAS_REGISTRADAS = $DATOS_AGREGADOS->appendChild($TOTAL_NUEVAS_REGISTRADAS);
    // TOTAL DE PERSONAS PERCEPTORES
    $sql2 = "SELECT count(*) FROM `demandantes` WHERE (MONTH(`fecharegistro`)=".$mes." and YEAR(`fecharegistro`)=".$año." OR MONTH(`orientacion`)=".$mes." and YEAR(`orientacion`)=".$año.") and `perceptor` = 'S'"	       ;
    $result2 = mysqli_query($conexion, $sql2);
    $rowPer = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $TOTAL_PERSONAS_PERCEPTORES = $xml->createElement('TOTAL_PERSONAS_PERCEPTORES', $rowPer['count(*)']);
    $TOTAL_PERSONAS_PERCEPTORES = $DATOS_AGREGADOS->appendChild($TOTAL_PERSONAS_PERCEPTORES);
    //TOTAL DE PERSONAS INSERCION 
    $sql3 = "SELECT count(*) FROM `demandantes` WHERE (MONTH(`fecharegistro`)=".$mes." and YEAR(`fecharegistro`)=".$año." OR MONTH(`orientacion`)=".$mes." and YEAR(`orientacion`)=".$año.") and `dificilinsercion` = 'S'"	       ;
    $result3 = mysqli_query($conexion, $sql3);
    $rowDIN = mysqli_fetch_array($result3, MYSQLI_ASSOC);
    $TOTAL_PERSONAS_INSERCION = $xml->createElement('TOTAL_PERSONAS_INSERCION', $rowDIN['count(*)']);
    $TOTAL_PERSONAS_INSERCION = $DATOS_AGREGADOS->appendChild($TOTAL_PERSONAS_INSERCION);
    

    //MANUAL
    $TOTAL_OFERTAS = $xml->createElement('TOTAL_OFERTAS',0);
    $TOTAL_OFERTAS = $DATOS_AGREGADOS->appendChild($TOTAL_OFERTAS);
    $TOTAL_OFERTAS_ENVIADAS = $xml->createElement('TOTAL_OFERTAS_ENVIADAS',0);
    $TOTAL_OFERTAS_ENVIADAS = $DATOS_AGREGADOS->appendChild($TOTAL_OFERTAS_ENVIADAS);
    $TOTAL_OFERTAS_CUBIERTAS = $xml->createElement('TOTAL_OFERTAS_CUBIERTAS',0);
    $TOTAL_OFERTAS_CUBIERTAS = $DATOS_AGREGADOS->appendChild($TOTAL_OFERTAS_CUBIERTAS);
    $TOTAL_PUESTO = $xml->createElement('TOTAL_PUESTO',0);
    $TOTAL_PUESTO = $DATOS_AGREGADOS->appendChild($TOTAL_PUESTO);
    $TOTAL_PUESTOS_CUBIERTOS = $xml->createElement('TOTAL_PUESTOS_CUBIERTOS',0);
    $TOTAL_PUESTOS_CUBIERTOS = $DATOS_AGREGADOS->appendChild($TOTAL_PUESTOS_CUBIERTOS);
    $TOTAL_CONTRATOS = $xml->createElement('TOTAL_CONTRATOS',0);
    $TOTAL_CONTRATOS = $DATOS_AGREGADOS->appendChild($TOTAL_CONTRATOS);
    $TOTAL_CONTRATOS_INDEFINIDOS = $xml->createElement('TOTAL_CONTRATOS_INDEFINIDOS',0);
    $TOTAL_CONTRATOS_INDEFINIDOS = $DATOS_AGREGADOS->appendChild($TOTAL_CONTRATOS_INDEFINIDOS);
	//COLOCACIÓN
    $sql4 = "SELECT count(*) FROM `demandantes` WHERE (MONTH(`fecharegistro`)=".$mes." and YEAR(`fecharegistro`)=".$año." OR MONTH(`orientacion`)=".$mes." and YEAR(`orientacion`)=".$año.") and `colocacion` = 'S'";
    $result4 = mysqli_query($conexion, $sql4);
    $rowCOL = mysqli_fetch_array($result4, MYSQLI_ASSOC);
    $TOTAL_PERSONAS_COLOCADAS = $xml->createElement('TOTAL_PERSONAS_COLOCADAS',$rowCOL['count(*)']);
    $TOTAL_PERSONAS_COLOCADAS = $DATOS_AGREGADOS->appendChild($TOTAL_PERSONAS_COLOCADAS);
        
    $xml->formatOutput = true;
    $el_xml = $xml->saveXML();
    $xml->save('xml.xml');
    //Mostramos el XML puro
    //echo htmlentities($el_xml);
}
function crearanual($año) {
    $xml = new DomDocument('1.0', 'UTF-8'); //creo documento
    include'conexion.php'; //conecto BD

    $ENVIO_ENPI = $xml->createElement('ENVIO_ENPI');
    $ENVIO_ENPI = $xml->appendChild($ENVIO_ENPI);
    $ENVIO_MENSUAL = $xml->createElement('ENVIO_MENSUAL');
    $ENVIO_MENSUAL = $ENVIO_ENPI->appendChild($ENVIO_MENSUAL);
    $CODIGO_AGENCIA = $xml->createElement('CODIGO_AGENCIA', '0500000122');
    $CODIGO_AGENCIA = $ENVIO_MENSUAL->appendChild($CODIGO_AGENCIA);
    $AÑO_MES_ENVIO = $xml->createElement('AÑO_MES_ENVIO', $año);
    $AÑO_MES_ENVIO = $ENVIO_MENSUAL->appendChild($AÑO_MES_ENVIO);
    $ACCIONES_REALIZADAS = $xml->createElement('ACCIONES_REALIZADAS');
    $ACCIONES_REALIZADAS = $ENVIO_MENSUAL->appendChild($ACCIONES_REALIZADAS);
    
    //DATOS AGREGADOS
    $DATOS_AGREGADOS = $xml->createElement('DATOS_AGREGADOS');
    $DATOS_AGREGADOS = $ENVIO_MENSUAL->appendChild($DATOS_AGREGADOS);
    // TOTAL PERSONAS
    $sql0 = "SELECT count(*) FROM `demandantes` WHERE YEAR(`fecharegistro`)=" . $año . " or `orientacion` = YEAR(`fecharegistro`)=" . $año ;
    $result0 = mysqli_query($conexion, $sql0);
    $rowPR = mysqli_fetch_array($result0, MYSQLI_ASSOC);
        $TOTAL_PERSONAS = $xml->createElement('TOTAL_PERSONAS', $rowPR['count(*)']);
    $TOTAL_PERSONAS = $DATOS_AGREGADOS->appendChild($TOTAL_PERSONAS);

    // TOTAL DE  NUEVAS REGISTRADAS
    $sql1 = "SELECT count(*) FROM `demandantes` WHERE YEAR(`fecharegistro`)=" . $año;
    $result1 = mysqli_query($conexion, $sql1);
    $rowNR = mysqli_fetch_array($result1, MYSQLI_ASSOC);
        $TOTAL_NUEVAS_REGISTRADAS = $xml->createElement('TOTAL_NUEVAS_REGISTRADAS', $rowNR['count(*)']);
    $TOTAL_NUEVAS_REGISTRADAS = $DATOS_AGREGADOS->appendChild($TOTAL_NUEVAS_REGISTRADAS);

    // TOTAL DE PERSONAS PERCEPTORES
    $sql2 = "SELECT count(*) FROM `demandantes` WHERE (YEAR(`fecharegistro`)=" . $año . " and `perceptor` = 'S') or `orientacion` = YEAR(`fecharegistro`)=" . $año;
    $result2 = mysqli_query($conexion, $sql2);
    $rowPer = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $TOTAL_PERSONAS_PERCEPTORES = $xml->createElement('TOTAL_PERSONAS_PERCEPTORES', $rowPer['count(*)']);
    $TOTAL_PERSONAS_PERCEPTORES = $DATOS_AGREGADOS->appendChild($TOTAL_PERSONAS_PERCEPTORES);

    //TOTAL DE PERSONAS INSERCION 
    $sql3 = "SELECT count(*) FROM `demandantes` WHERE (YEAR(`fecharegistro`)=" . $año . " and `dificilinsercion` = 'S' )or `orientacion` = YEAR(`fecharegistro`)=" . $año;
    $result3 = mysqli_query($conexion, $sql3);
    $rowDIN = mysqli_fetch_array($result3, MYSQLI_ASSOC);
        $TOTAL_PERSONAS_INSERCION = $xml->createElement('TOTAL_PERSONAS_INSERCION', $rowDIN['count(*)']);
    $TOTAL_PERSONAS_INSERCION = $DATOS_AGREGADOS->appendChild($TOTAL_PERSONAS_INSERCION);

    
    //Manual
    $TOTAL_OFERTAS = $xml->createElement('TOTAL_OFERTAS',0);
    $TOTAL_OFERTAS = $DATOS_AGREGADOS->appendChild($TOTAL_OFERTAS);

    $TOTAL_OFERTAS_ENVIADAS = $xml->createElement('TOTAL_OFERTAS_ENVIADAS',0);
    $TOTAL_OFERTAS_ENVIADAS = $DATOS_AGREGADOS->appendChild($TOTAL_OFERTAS_ENVIADAS);

    $TOTAL_OFERTAS_CUBIERTAS = $xml->createElement('TOTAL_OFERTAS_CUBIERTAS',0);
    $TOTAL_OFERTAS_CUBIERTAS = $DATOS_AGREGADOS->appendChild($TOTAL_OFERTAS_CUBIERTAS);

    $TOTAL_PUESTO = $xml->createElement('TOTAL_PUESTO',0);
    $TOTAL_PUESTO = $DATOS_AGREGADOS->appendChild($TOTAL_PUESTO);

    $TOTAL_PUESTOS_CUBIERTOS = $xml->createElement('TOTAL_PUESTOS_CUBIERTOS',0);
    $TOTAL_PUESTOS_CUBIERTOS = $DATOS_AGREGADOS->appendChild($TOTAL_PUESTOS_CUBIERTOS);

    $TOTAL_CONTRATOS = $xml->createElement('TOTAL_CONTRATOS',0);
    $TOTAL_CONTRATOS = $DATOS_AGREGADOS->appendChild($TOTAL_CONTRATOS);

    $TOTAL_CONTRATOS_INDEFINIDOS = $xml->createElement('TOTAL_CONTRATOS_INDEFINIDOS',0);
    $TOTAL_CONTRATOS_INDEFINIDOS = $DATOS_AGREGADOS->appendChild($TOTAL_CONTRATOS_INDEFINIDOS);

    $sql4 = "SELECT count(*) FROM `demandantes` WHERE YEAR(`fecharegistro`)=" . $año . " and `colocacion` = 'S' or `orientacion` = YEAR(`fecharegistro`)=" . $año;
    $result4 = mysqli_query($conexion, $sql4);
    $rowCOL = mysqli_fetch_array($result4, MYSQLI_ASSOC);
         $TOTAL_PERSONAS_COLOCADAS = $xml->createElement('TOTAL_PERSONAS_COLOCADAS',$rowCOL['count(*)']);
    $TOTAL_PERSONAS_COLOCADAS = $DATOS_AGREGADOS->appendChild($TOTAL_PERSONAS_COLOCADAS);

    $xml->formatOutput = true;
    $el_xml = $xml->saveXML();
    $xml->save('xml.xml');
    //Mostramos el XML puro
    //echo htmlentities($el_xml);
}
?>